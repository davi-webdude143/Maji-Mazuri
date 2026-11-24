<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\CustomerCredit;
use App\Models\MeterReading;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class BillController extends Controller
{
    /**
     * Display all bills.
     */
    public function index(Request $request)
    {
        $search = trim($request->input('search', ''));

        $query = Bill::with([
            'customer',
            'meterReading.meter',
            'carriedForwardTo',
        ]);

        if ($search !== '') {
            $query->where(function ($query) use ($search) {

                $query->where(
                    'invoice_number',
                    'like',
                    '%' . $search . '%'
                )

                ->orWhere(
                    'status',
                    'like',
                    '%' . $search . '%'
                )

                ->orWhereHas('customer', function ($customerQuery) use ($search) {

                    $customerQuery
                        ->where(
                            'full_name',
                            'like',
                            '%' . $search . '%'
                        )

                        ->orWhere(
                            'customer_number',
                            'like',
                            '%' . $search . '%'
                        )

                        ->orWhere(
                            'phone_number',
                            'like',
                            '%' . $search . '%'
                        )

                        ->orWhere(
                            'area',
                            'like',
                            '%' . $search . '%'
                        );
                })

                ->orWhereHas('meterReading.meter', function ($meterQuery) use ($search) {

                    $meterQuery->where(
                        'meter_number',
                        'like',
                        '%' . $search . '%'
                    );
                });
            });
        }

        $totalBills = (clone $query)->count();

        $paidBills = (clone $query)
            ->where('status', 'paid')
            ->count();

        $unpaidBills = (clone $query)
            ->where('status', 'unpaid')
            ->count();

        $partiallyPaidBills = (clone $query)
            ->where('status', 'partially_paid')
            ->count();

        $bills = $query
            ->latest('billing_date')
            ->paginate(10)
            ->withQueryString();

        return view(
            'bills.index',
            compact(
                'bills',
                'search',
                'totalBills',
                'paidBills',
                'unpaidBills',
                'partiallyPaidBills'
            )
        );
    }


    /**
     * Show the form for creating a bill.
     */
    public function create()
    {
        $readings = MeterReading::with('meter.customer')
            ->whereDoesntHave('bill')
            ->latest('reading_date')
            ->get();

        return view(
            'bills.create',
            compact('readings')
        );
    }


    /**
     * Store a new bill.
     *
     * Billing rules:
     *
     * 1. A meter reading can generate only one bill.
     * 2. The current water charge is calculated at KSh 120 per unit.
     * 3. Existing bills are NOT transferred into the new bill.
     * 4. Each billing period keeps its own invoice and balance.
     * 5. Available customer credit is applied to the new bill.
     * 6. CustomerCredit records are updated to show how much credit was used.
     * 7. The customer's available credit balance is reduced accordingly.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'meter_reading_id' => 'required|exists:meter_readings,id',
            'billing_date' => 'required|date',
            'previous_balance' => 'nullable|numeric|min:0',
        ]);

        $bill = DB::transaction(function () use ($validated) {

            /*
             |------------------------------------------------------------------
             | Load Reading, Meter and Customer
             |------------------------------------------------------------------
             */

            $reading = MeterReading::with('meter.customer')
                ->lockForUpdate()
                ->findOrFail(
                    $validated['meter_reading_id']
                );

            if (!$reading->meter) {
                abort(
                    422,
                    'The selected meter reading is not linked to a meter.'
                );
            }

            $customer = $reading->meter->customer;

            if (!$customer) {
                abort(
                    422,
                    'The selected meter is not linked to a customer.'
                );
            }

            /*
             |------------------------------------------------------------------
             | Prevent Duplicate Bill
             |------------------------------------------------------------------
             */

            if ($reading->bill) {
                abort(
                    422,
                    'A bill has already been generated for this meter reading.'
                );
            }

            /*
             |------------------------------------------------------------------
             | Lock Customer
             |------------------------------------------------------------------
             */

            $customer = $customer
                ->newQuery()
                ->lockForUpdate()
                ->findOrFail($customer->id);

            /*
             |------------------------------------------------------------------
             | Fixed Tariff
             |------------------------------------------------------------------
             */

            $ratePerUnit = 120.00;

            /*
             |------------------------------------------------------------------
             | Consumption
             |------------------------------------------------------------------
             */

            $consumption = round(
                (float) $reading->consumption,
                2
            );

            /*
             |------------------------------------------------------------------
             | Current Water Charge
             |------------------------------------------------------------------
             */

            $waterCharge = round(
                $consumption * $ratePerUnit,
                2
            );

            /*
             |------------------------------------------------------------------
             | Previous Balance
             |------------------------------------------------------------------
             |
             | IMPORTANT:
             |
             | We no longer automatically transfer previous unpaid bills
             | into this invoice.
             |
             | The optional previous_balance field remains available for
             | legitimate opening/legacy balances entered by an authorized
             | user, but existing invoices remain separate.
             |
             */

            $previousBalance = round(
                (float) ($validated['previous_balance'] ?? 0),
                2
            );

            /*
             |------------------------------------------------------------------
             | Gross Amount Due For This Invoice
             |------------------------------------------------------------------
             */

            $grossAmountDue = round(
                $previousBalance + $waterCharge,
                2
            );

            /*
             |------------------------------------------------------------------
             | Lock Available Customer Credits
             |------------------------------------------------------------------
             |
             | Credits are consumed oldest-first.
             |
             | This gives us a predictable audit trail:
             |
             | oldest credit -> newest credit
             |
             */

            $creditRecords = CustomerCredit::query()
                ->where('customer_id', $customer->id)
                ->where('balance', '>', 0)
                ->orderBy('created_at')
                ->orderBy('id')
                ->lockForUpdate()
                ->get();

            /*
             |------------------------------------------------------------------
             | Calculate Available Credit
             |------------------------------------------------------------------
             */

            $ledgerCreditBalance = round(
                (float) $creditRecords->sum('balance'),
                2
            );

            /*
             |------------------------------------------------------------------
             | Available Customer Credit
             |------------------------------------------------------------------
             |
             | The customer balance is retained as the quick-access balance.
             | The credit ledger is the detailed source record.
             |
             | If both contain values, we use the lower safe amount so that
             | billing can never consume more credit than the ledger contains.
             |
             */

            $customerCreditBalance = round(
                max(
                    0,
                    (float) $customer->credit_balance
                ),
                2
            );

            if ($creditRecords->isNotEmpty()) {

                $availableCredit = min(
                    $customerCreditBalance,
                    $ledgerCreditBalance
                );

            } else {

                /*
                 |----------------------------------------------------------------
                 | Legacy Compatibility
                 |----------------------------------------------------------------
                 |
                 | If a customer has credit_balance but no CustomerCredit
                 | ledger record, we do not silently invent a credit record
                 | here. The PayBill process will create proper ledger records
                 | for new credits.
                 |
                 | The existing balance remains available to avoid losing
                 | legitimate legacy credit.
                 |
                 */

                $availableCredit = $customerCreditBalance;
            }

            $availableCredit = round(
                max(
                    0,
                    $availableCredit
                ),
                2
            );

            /*
             |------------------------------------------------------------------
             | Apply Customer Credit
             |------------------------------------------------------------------
             */

            $creditApplied = round(
                min(
                    $availableCredit,
                    $grossAmountDue
                ),
                2
            );

            /*
             |------------------------------------------------------------------
             | Final Invoice Balance
             |------------------------------------------------------------------
             */

            $balance = round(
                max(
                    0,
                    $grossAmountDue - $creditApplied
                ),
                2
            );

            /*
             |------------------------------------------------------------------
             | Determine Initial Status
             |------------------------------------------------------------------
             */

            $status = $balance <= 0
                ? 'paid'
                : 'unpaid';

            /*
             |------------------------------------------------------------------
             | Create New Bill
             |------------------------------------------------------------------
             */

            $bill = Bill::create([
                'customer_id' => $customer->id,
                'meter_reading_id' => $reading->id,
                'billing_date' => $validated['billing_date'],
                'consumption' => $consumption,
                'rate_per_unit' => $ratePerUnit,
                'water_charge' => $waterCharge,
                'previous_balance' => $previousBalance,
                'credit_applied' => $creditApplied,
                'status' => $status,
                'amount_paid' => 0,
                'balance' => $balance,
            ]);

            /*
             |------------------------------------------------------------------
             | Consume Credit Ledger Records
             |------------------------------------------------------------------
             */

            $remainingToApply = $creditApplied;

            if ($remainingToApply > 0 && $creditRecords->isNotEmpty()) {

                foreach ($creditRecords as $credit) {

                    if ($remainingToApply <= 0) {
                        break;
                    }

                    $creditBalance = round(
                        (float) $credit->balance,
                        2
                    );

                    if ($creditBalance <= 0) {
                        continue;
                    }

                    $amountToUse = round(
                        min(
                            $creditBalance,
                            $remainingToApply
                        ),
                        2
                    );

                    $credit->amount_used = round(
                        (float) $credit->amount_used +
                        $amountToUse,
                        2
                    );

                    $credit->balance = round(
                        $creditBalance -
                        $amountToUse,
                        2
                    );

                    $credit->save();

                    $remainingToApply = round(
                        $remainingToApply -
                        $amountToUse,
                        2
                    );
                }
            }

            /*
             |------------------------------------------------------------------
             | Update Customer Available Credit
             |------------------------------------------------------------------
             */

            if ($creditApplied > 0) {

                $customer->credit_balance = round(
                    max(
                        0,
                        (float) $customer->credit_balance -
                        $creditApplied
                    ),
                    2
                );

                $customer->save();
            }

            return $bill;
        });

        /*
         |----------------------------------------------------------------------
         | Success Message
         |----------------------------------------------------------------------
         */

        $creditMessage = '';

        if ((float) $bill->credit_applied > 0) {

            $creditMessage =
                ' KSh ' .
                number_format(
                    (float) $bill->credit_applied,
                    2
                ) .
                ' customer credit was applied to this invoice.';
        }

        return redirect()
            ->route(
                'bills.show',
                $bill
            )
            ->with(
                'success',
                'Bill generated successfully. Previous invoices remain separate and were not carried forward.' .
                $creditMessage
            );
    }


    /**
     * Display one bill.
     */
    public function show(Bill $bill)
    {
        $bill->load(
            'customer',
            'meterReading.meter',
            'payments',
            'carriedForwardTo'
        );

        return view(
            'bills.show',
            compact('bill')
        );
    }


    /**
     * Download one bill as PDF.
     */
    public function pdf(Bill $bill)
    {
        $bill->load([
            'customer',
            'meterReading.meter',
            'payments',
            'carriedForwardTo',
        ]);

        $pdf = Pdf::loadView(
            'bills.pdf',
            compact('bill')
        )->setPaper(
            'a4',
            'portrait'
        );

        return $pdf->download(
            $bill->invoice_number . '.pdf'
        );
    }


    /**
     * Display all outstanding bills in the browser.
     *
     * Each invoice remains independent. No carried-forward invoice is
     * artificially combined with another invoice.
     */
    public function outstanding()
    {
        $report = $this->getOutstandingReportData();

        return view(
            'bills.outstanding',
            $report
        );
    }


    /**
     * Download all outstanding bills as a PDF report.
     */
    public function outstandingPdf()
    {
        $report = $this->getOutstandingReportData();

        $pdf = Pdf::loadView(
            'bills.outstanding-pdf',
            $report
        )->setPaper(
            'a4',
            'portrait'
        );

        return $pdf->download(
            'Outstanding-Bills-' .
            now()->format('Y-m-d') .
            '.pdf'
        );
    }


    /**
     * Prepare all data used by:
     * - Outstanding Bills browser report
     * - Outstanding Bills PDF report
     */
    private function getOutstandingReportData(): array
    {
        /*
         |----------------------------------------------------------------------
         | Get Active Outstanding Bills
         |----------------------------------------------------------------------
         |
         | We only include bills with an actual outstanding balance.
         |
         */

        $bills = Bill::with([
            'customer',
            'meterReading.meter',
            'payments',
            'carriedForwardTo',
        ])
            ->whereIn('status', [
                'unpaid',
                'partially_paid',
            ])
            ->where(
                'balance',
                '>',
                0
            )
            ->orderByDesc('billing_date')
            ->orderBy('customer_id')
            ->get();

        /*
         |----------------------------------------------------------------------
         | Group Bills By Customer
         |----------------------------------------------------------------------
         */

        $customersWithBalances = $bills
            ->groupBy('customer_id')
            ->map(function ($customerBills) {

                $customer = $customerBills
                    ->first()
                    ->customer;

                if (!$customer) {
                    return null;
                }

                /*
                 |----------------------------------------------------------------
                 | Customer Financial Totals
                 |----------------------------------------------------------------
                 */

                $totalBilled = round(
                    (float) $customerBills->sum(function ($bill) {

                        return
                            (float) $bill->previous_balance +
                            (float) $bill->water_charge;
                    }),
                    2
                );

                $totalPaid = round(
                    (float) $customerBills->sum('amount_paid'),
                    2
                );

                $totalCreditApplied = round(
                    (float) $customerBills->sum('credit_applied'),
                    2
                );

                $totalOutstanding = round(
                    (float) $customerBills->sum('balance'),
                    2
                );

                /*
                 |----------------------------------------------------------------
                 | Process Customer Bills
                 |----------------------------------------------------------------
                 */

                $processedBills = $customerBills
                    ->sortBy('billing_date')
                    ->values()
                    ->map(function ($bill) {

                        $bill->report_previous_balance = round(
                            (float) $bill->previous_balance,
                            2
                        );

                        $bill->report_current_charge = round(
                            (float) $bill->water_charge,
                            2
                        );

                        $bill->report_credit_applied = round(
                            (float) $bill->credit_applied,
                            2
                        );

                        $bill->report_total_due = round(
                            (float) $bill->previous_balance +
                            (float) $bill->water_charge,
                            2
                        );

                        $bill->report_outstanding = round(
                            (float) $bill->balance,
                            2
                        );

                        return $bill;
                    });

                /*
                 |----------------------------------------------------------------
                 | Attach Report Values To Customer
                 |----------------------------------------------------------------
                 */

                $customer->report_total_billed =
                    $totalBilled;

                $customer->report_total_paid =
                    $totalPaid;

                $customer->report_total_credit_applied =
                    $totalCreditApplied;

                $customer->report_outstanding =
                    $totalOutstanding;

                $customer->setRelation(
                    'bills',
                    $processedBills
                );

                return $customer;
            })
            ->filter()
            ->values();

        $outstandingBills = $bills;

        /*
         |----------------------------------------------------------------------
         | Numeric Summary Values
         |----------------------------------------------------------------------
         */

        $customerCount =
            $customersWithBalances->count();

        $outstandingBillCount =
            $outstandingBills->count();

        $totalBilled = round(
            (float) $bills->sum(function ($bill) {

                return
                    (float) $bill->previous_balance +
                    (float) $bill->water_charge;
            }),
            2
        );

        $totalPaid = round(
            (float) $bills->sum('amount_paid'),
            2
        );

        $totalCreditApplied = round(
            (float) $bills->sum('credit_applied'),
            2
        );

        $totalOutstanding = round(
            (float) $bills->sum('balance'),
            2
        );

        /*
         |----------------------------------------------------------------------
         | Collection Percentage
         |----------------------------------------------------------------------
         */

        $totalCollectedValue = round(
            $totalPaid + $totalCreditApplied,
            2
        );

        $collectionPercentage = $totalBilled > 0
            ? round(
                min(
                    100,
                    ($totalCollectedValue / $totalBilled) * 100
                ),
                1
            )
            : 0;

        /*
         |----------------------------------------------------------------------
         | Outstanding Percentage
         |----------------------------------------------------------------------
         */

        $outstandingPercentage = round(
            max(
                0,
                100 - $collectionPercentage
            ),
            1
        );

        return [
            'customers' => $customerCount,
            'customersWithBalances' => $customersWithBalances,
            'outstandingBills' => $outstandingBills,
            'outstandingBillCount' => $outstandingBillCount,
            'totalBilled' => $totalBilled,
            'totalPaid' => $totalPaid,
            'totalCreditApplied' => $totalCreditApplied,
            'totalOutstanding' => $totalOutstanding,
            'collectionPercentage' => $collectionPercentage,
            'outstandingPercentage' => $outstandingPercentage,
        ];
    }


    /**
     * Show the form for editing a bill.
     */
    public function edit(Bill $bill)
    {
        $bill->load(
            'customer',
            'meterReading.meter',
            'payments',
            'carriedForwardTo'
        );

        return view(
            'bills.edit',
            compact('bill')
        );
    }


    /**
     * Update a bill.
     *
     * Any credit previously applied to the bill is first returned to the
     * customer's available credit and the corresponding CustomerCredit
     * ledger records are restored.
     */
    public function update(Request $request, Bill $bill)
    {
        $validated = $request->validate([
            'billing_date' => 'required|date',
            'previous_balance' => 'nullable|numeric|min:0',
        ]);

        $result = DB::transaction(function () use (
            $validated,
            $bill
        ) {

            /*
             |------------------------------------------------------------------
             | Lock Bill
             |------------------------------------------------------------------
             */

            $bill = Bill::query()
                ->lockForUpdate()
                ->findOrFail($bill->id);

            /*
             |------------------------------------------------------------------
             | Lock Customer
             |------------------------------------------------------------------
             */

            $customer = $bill->customer;

            if (!$customer) {
                abort(
                    422,
                    'This bill is not linked to a customer.'
                );
            }

            $customer = $customer
                ->newQuery()
                ->lockForUpdate()
                ->findOrFail($customer->id);

            /*
             |------------------------------------------------------------------
             | Restore Previously Applied Credit
             |------------------------------------------------------------------
             */

            $previousCreditApplied = round(
                (float) $bill->credit_applied,
                2
            );

            if ($previousCreditApplied > 0) {

                $remainingToRestore = $previousCreditApplied;

                /*
                 |--------------------------------------------------------------
                 | Restore most recently consumed credit first.
                 |--------------------------------------------------------------
                 */

                $credits = CustomerCredit::query()
                    ->where('customer_id', $customer->id)
                    ->where('amount_used', '>', 0)
                    ->orderByDesc('created_at')
                    ->orderByDesc('id')
                    ->lockForUpdate()
                    ->get();

                foreach ($credits as $credit) {

                    if ($remainingToRestore <= 0) {
                        break;
                    }

                    $amountUsed = round(
                        (float) $credit->amount_used,
                        2
                    );

                    if ($amountUsed <= 0) {
                        continue;
                    }

                    $restoreAmount = round(
                        min(
                            $amountUsed,
                            $remainingToRestore
                        ),
                        2
                    );

                    $credit->amount_used = round(
                        $amountUsed - $restoreAmount,
                        2
                    );

                    $credit->balance = round(
                        (float) $credit->balance +
                        $restoreAmount,
                        2
                    );

                    $credit->save();

                    $remainingToRestore = round(
                        $remainingToRestore -
                        $restoreAmount,
                        2
                    );
                }

                $customer->credit_balance = round(
                    (float) $customer->credit_balance +
                    $previousCreditApplied,
                    2
                );

                $customer->save();
            }

            /*
             |------------------------------------------------------------------
             | Fixed Water Tariff
             |------------------------------------------------------------------
             */

            $ratePerUnit = 120.00;

            $consumption = round(
                (float) $bill->consumption,
                2
            );

            $waterCharge = round(
                $consumption * $ratePerUnit,
                2
            );

            /*
             |------------------------------------------------------------------
             | Previous Balance
             |------------------------------------------------------------------
             */

            $previousBalance = round(
                (float) ($validated['previous_balance'] ?? 0),
                2
            );

            /*
             |------------------------------------------------------------------
             | Gross Amount Due
             |------------------------------------------------------------------
             */

            $grossAmountDue = round(
                $previousBalance +
                $waterCharge,
                2
            );

            /*
             |------------------------------------------------------------------
             | Available Credit After Restoration
             |------------------------------------------------------------------
             */

            $availableCredit = round(
                max(
                    0,
                    (float) $customer->credit_balance
                ),
                2
            );

            /*
             |------------------------------------------------------------------
             | Apply Available Credit
             |------------------------------------------------------------------
             */

            $creditApplied = round(
                min(
                    $availableCredit,
                    $grossAmountDue
                ),
                2
            );

            /*
             |------------------------------------------------------------------
             | Final Balance Before Payments
             |------------------------------------------------------------------
             */

            $balanceBeforePayments = round(
                max(
                    0,
                    $grossAmountDue -
                    $creditApplied
                ),
                2
            );

            /*
             |------------------------------------------------------------------
             | Calculate Actual Payment History
             |------------------------------------------------------------------
             */

            $amountPaidFromPayments = round(
                (float) $bill->payments()->sum('amount'),
                2
            );

            $appliedAmount = round(
                min(
                    $amountPaidFromPayments,
                    $balanceBeforePayments
                ),
                2
            );

            /*
             |------------------------------------------------------------------
             | Final Remaining Balance
             |------------------------------------------------------------------
             */

            $balance = round(
                max(
                    0,
                    $balanceBeforePayments -
                    $appliedAmount
                ),
                2
            );

            /*
             |------------------------------------------------------------------
             | Determine Bill Status
             |------------------------------------------------------------------
             */

            if ($balance <= 0) {

                $status = 'paid';

            } elseif ($appliedAmount > 0) {

                $status = 'partially_paid';

            } else {

                $status = 'unpaid';
            }

            /*
             |------------------------------------------------------------------
             | Apply New Credit To Ledger
             |------------------------------------------------------------------
             */

            $remainingToApply = $creditApplied;

            $credits = CustomerCredit::query()
                ->where('customer_id', $customer->id)
                ->where('balance', '>', 0)
                ->orderBy('created_at')
                ->orderBy('id')
                ->lockForUpdate()
                ->get();

            foreach ($credits as $credit) {

                if ($remainingToApply <= 0) {
                    break;
                }

                $creditBalance = round(
                    (float) $credit->balance,
                    2
                );

                if ($creditBalance <= 0) {
                    continue;
                }

                $amountToUse = round(
                    min(
                        $creditBalance,
                        $remainingToApply
                    ),
                    2
                );

                $credit->amount_used = round(
                    (float) $credit->amount_used +
                    $amountToUse,
                    2
                );

                $credit->balance = round(
                    $creditBalance -
                    $amountToUse,
                    2
                );

                $credit->save();

                $remainingToApply = round(
                    $remainingToApply -
                    $amountToUse,
                    2
                );
            }

            /*
             |------------------------------------------------------------------
             | Update Customer Credit
             |------------------------------------------------------------------
             */

            $customer->credit_balance = round(
                max(
                    0,
                    (float) $customer->credit_balance -
                    $creditApplied
                ),
                2
            );

            $customer->save();

            /*
             |------------------------------------------------------------------
             | Update Bill
             |------------------------------------------------------------------
             */

            $bill->update([
                'billing_date' => $validated['billing_date'],
                'rate_per_unit' => $ratePerUnit,
                'water_charge' => $waterCharge,
                'previous_balance' => $previousBalance,
                'credit_applied' => $creditApplied,
                'amount_paid' => $appliedAmount,
                'balance' => $balance,
                'status' => $status,
            ]);

            return [
                'bill' => $bill->fresh(),
                'creditApplied' => $creditApplied,
                'previousCreditApplied' => $previousCreditApplied,
            ];
        });

        $creditMessage = '';

        if (
            $result['creditApplied'] > 0 ||
            $result['previousCreditApplied'] > 0
        ) {

            $creditMessage =
                ' Customer credit was recalculated for this bill.';
        }

        return redirect()
            ->route(
                'bills.show',
                $result['bill']
            )
            ->with(
                'success',
                'Bill updated successfully. Payment totals were recalculated from the payment history.' .
                $creditMessage
            );
    }


    /**
     * Delete a bill.
     *
     * Any credit used by the bill is returned to the customer and the
     * CustomerCredit ledger is restored.
     *
     * Existing bills are NOT deleted or merged as part of this operation.
     */
    public function destroy(Bill $bill)
    {
        if (
            !auth()->check() ||
            !in_array(
                auth()->user()->role,
                ['admin', 'manager'],
                true
            )
        ) {
            abort(
                403,
                'Only an Administrator or Manager can delete a bill.'
            );
        }

        DB::transaction(function () use ($bill) {

            $bill = Bill::query()
                ->lockForUpdate()
                ->findOrFail($bill->id);

            /*
             |------------------------------------------------------------------
             | Restore Credit Used By This Bill
             |------------------------------------------------------------------
             */

            $creditApplied = round(
                (float) $bill->credit_applied,
                2
            );

            if ($creditApplied > 0) {

                $customer = $bill->customer;

                if ($customer) {

                    $customer = $customer
                        ->newQuery()
                        ->lockForUpdate()
                        ->findOrFail($customer->id);

                    $remainingToRestore = $creditApplied;

                    $credits = CustomerCredit::query()
                        ->where('customer_id', $customer->id)
                        ->where('amount_used', '>', 0)
                        ->orderByDesc('created_at')
                        ->orderByDesc('id')
                        ->lockForUpdate()
                        ->get();

                    foreach ($credits as $credit) {

                        if ($remainingToRestore <= 0) {
                            break;
                        }

                        $amountUsed = round(
                            (float) $credit->amount_used,
                            2
                        );

                        if ($amountUsed <= 0) {
                            continue;
                        }

                        $restoreAmount = round(
                            min(
                                $amountUsed,
                                $remainingToRestore
                            ),
                            2
                        );

                        $credit->amount_used = round(
                            $amountUsed -
                            $restoreAmount,
                            2
                        );

                        $credit->balance = round(
                            (float) $credit->balance +
                            $restoreAmount,
                            2
                        );

                        $credit->save();

                        $remainingToRestore = round(
                            $remainingToRestore -
                            $restoreAmount,
                            2
                        );
                    }

                    $customer->credit_balance = round(
                        (float) $customer->credit_balance +
                        $creditApplied,
                        2
                    );

                    $customer->save();
                }
            }

            /*
             |------------------------------------------------------------------
             | Delete Bill
             |------------------------------------------------------------------
             */

            $bill->delete();
        });

        return redirect()
            ->route('bills.index')
            ->with(
                'success',
                'Bill deleted successfully. Any customer credit applied to the bill was restored.'
            );
    }
}

