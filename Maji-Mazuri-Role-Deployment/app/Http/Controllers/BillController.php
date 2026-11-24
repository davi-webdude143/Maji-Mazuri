<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\MeterReading;
use Illuminate\Http\Request;
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
        ]);

        /*
         |----------------------------------------------------------------------
         | Search Bills
         |----------------------------------------------------------------------
         */

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

        /*
         |----------------------------------------------------------------------
         | Filtered Summary Counts
         |----------------------------------------------------------------------
         */

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

        /*
         |----------------------------------------------------------------------
         | Paginated Bills
         |----------------------------------------------------------------------
         */

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
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'meter_reading_id' => 'required|exists:meter_readings,id',
            'billing_date' => 'required|date',
            'previous_balance' => 'nullable|numeric|min:0',
        ]);

        $reading = MeterReading::with('meter.customer')
            ->findOrFail(
                $validated['meter_reading_id']
            );

        if ($reading->bill) {
            return back()
                ->withErrors([
                    'meter_reading_id' =>
                        'A bill has already been generated for this meter reading.',
                ])
                ->withInput();
        }

        /*
         |----------------------------------------------------------------------
         | Current Water Charge
         |----------------------------------------------------------------------
         */

        $consumption = round(
            (float) $reading->consumption,
            2
        );

        $ratePerUnit = 120.00;

        $waterCharge = round(
            $consumption * $ratePerUnit,
            2
        );

        /*
         |----------------------------------------------------------------------
         | Previous Balance
         |----------------------------------------------------------------------
         |
         | This is manually entered when generating the bill.
         |
         */

        $previousBalance = round(
            (float) ($validated['previous_balance'] ?? 0),
            2
        );

        /*
         |----------------------------------------------------------------------
         | Total Amount Due
         |----------------------------------------------------------------------
         */

        $totalAmountDue = round(
            $previousBalance + $waterCharge,
            2
        );

        /*
         |----------------------------------------------------------------------
         | Initial Bill Status
         |----------------------------------------------------------------------
         */

        $status = $totalAmountDue > 0
            ? 'unpaid'
            : 'paid';

        /*
         |----------------------------------------------------------------------
         | Create Bill
         |----------------------------------------------------------------------
         */

        $bill = Bill::create([
            'customer_id' => $reading->meter->customer_id,
            'meter_reading_id' => $reading->id,
            'billing_date' => $validated['billing_date'],
            'consumption' => $consumption,
            'rate_per_unit' => $ratePerUnit,
            'water_charge' => $waterCharge,
            'previous_balance' => $previousBalance,
            'status' => $status,
            'amount_paid' => 0,
            'balance' => $totalAmountDue,
        ]);

        return redirect()
            ->route(
                'bills.show',
                $bill
            )
            ->with(
                'success',
                'Bill generated successfully. Your invoice is ready to view or download.'
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
            'payments'
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
         | Get Outstanding Bills
         |----------------------------------------------------------------------
         */

        $bills = Bill::with([
            'customer',
            'meterReading.meter',
            'payments',
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
                 |------------------------------------------------------------------
                 | Customer Financial Totals
                 |------------------------------------------------------------------
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

                $totalOutstanding = round(
                    (float) $customerBills->sum('balance'),
                    2
                );

                /*
                 |------------------------------------------------------------------
                 | Process Customer Bills
                 |------------------------------------------------------------------
                 |
                 | previous_balance is now stored directly on each bill.
                 |
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
                 |------------------------------------------------------------------
                 | Attach Report Values To Customer
                 |------------------------------------------------------------------
                 */

                $customer->report_total_billed = $totalBilled;

                $customer->report_total_paid = $totalPaid;

                $customer->report_outstanding = $totalOutstanding;

                /*
                 |------------------------------------------------------------------
                 | Make Processed Bills Available As $customer->bills
                 |------------------------------------------------------------------
                 */

                $customer->setRelation(
                    'bills',
                    $processedBills
                );

                return $customer;
            })
            ->filter()
            ->values();


        /*
         |----------------------------------------------------------------------
         | Outstanding Bills Collection
         |----------------------------------------------------------------------
         */

        $outstandingBills = $bills;


        /*
         |----------------------------------------------------------------------
         | Numeric Summary Values
         |----------------------------------------------------------------------
         */

        $customerCount = $customersWithBalances->count();

        $outstandingBillCount = $outstandingBills->count();

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

        $totalOutstanding = round(
            (float) $bills->sum('balance'),
            2
        );


        /*
         |----------------------------------------------------------------------
         | Collection Percentage
         |----------------------------------------------------------------------
         */

        $collectionPercentage = $totalBilled > 0
            ? round(
                min(
                    100,
                    ($totalPaid / $totalBilled) * 100
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


        /*
         |----------------------------------------------------------------------
         | Return Report Data
         |----------------------------------------------------------------------
         */

        return [
            'customers' => $customerCount,
            'customersWithBalances' => $customersWithBalances,
            'outstandingBills' => $outstandingBills,
            'outstandingBillCount' => $outstandingBillCount,
            'totalBilled' => $totalBilled,
            'totalPaid' => $totalPaid,
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
            'payments'
        );

        return view(
            'bills.edit',
            compact('bill')
        );
    }


    /**
     * Update a bill.
     */
    public function update(Request $request, Bill $bill)
    {
        $validated = $request->validate([
            'billing_date' => 'required|date',
            'previous_balance' => 'nullable|numeric|min:0',
        ]);

        /*
         |----------------------------------------------------------------------
         | Fixed Water Tariff
         |----------------------------------------------------------------------
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
         |----------------------------------------------------------------------
         | Previous Balance
         |----------------------------------------------------------------------
         */

        $previousBalance = round(
            (float) ($validated['previous_balance'] ?? 0),
            2
        );

        /*
         |----------------------------------------------------------------------
         | Total Amount Due
         |----------------------------------------------------------------------
         */

        $totalAmountDue = round(
            $previousBalance + $waterCharge,
            2
        );

        /*
         |----------------------------------------------------------------------
         | Calculate Actual Amount Paid
         |----------------------------------------------------------------------
         */

        $amountPaid = round(
            (float) $bill->payments()->sum('amount'),
            2
        );

        /*
         |----------------------------------------------------------------------
         | Payment Cannot Exceed Total Bill
         |----------------------------------------------------------------------
         */

        $appliedAmount = min(
            $amountPaid,
            $totalAmountDue
        );

        /*
         |----------------------------------------------------------------------
         | Calculate Remaining Balance
         |----------------------------------------------------------------------
         */

        $balance = round(
            max(
                0,
                $totalAmountDue - $appliedAmount
            ),
            2
        );

        /*
         |----------------------------------------------------------------------
         | Determine Bill Status
         |----------------------------------------------------------------------
         */

        if (
            $balance <= 0 &&
            $totalAmountDue > 0
        ) {
            $status = 'paid';

        } elseif ($appliedAmount > 0) {
            $status = 'partially_paid';

        } elseif ($totalAmountDue <= 0) {
            $status = 'paid';

        } else {
            $status = 'unpaid';
        }

        /*
         |----------------------------------------------------------------------
         | Update Bill
         |----------------------------------------------------------------------
         */

        $bill->update([
            'billing_date' => $validated['billing_date'],
            'rate_per_unit' => $ratePerUnit,
            'water_charge' => $waterCharge,
            'previous_balance' => $previousBalance,
            'amount_paid' => $appliedAmount,
            'balance' => $balance,
            'status' => $status,
        ]);

        return redirect()
            ->route(
                'bills.show',
                $bill
            )
            ->with(
                'success',
                'Bill updated successfully. Payment totals were recalculated from the payment history.'
            );
    }


    /**
     * Delete a bill.
     *
     * Only Administrators and Managers may delete bills.
     */
    public function destroy(Bill $bill)
    {
        if (!in_array(auth()->user()->role, ['admin', 'manager'], true)) {
            abort(
                403,
                'Only an Administrator or Manager can delete a bill.'
            );
        }

        $bill->delete();

        return redirect()
            ->route('bills.index')
            ->with(
                'success',
                'Bill deleted successfully.'
            );
    }
}

