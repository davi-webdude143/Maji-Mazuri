<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Payment;
use App\Services\Mpesa\MpesaService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    /**
     * Display all payments.
     */
    public function index(Request $request)
    {
        $query = Payment::with([
            'bill.customer',
            'customer',
        ])->latest('payment_date');

        /*
        |--------------------------------------------------------------------------
        | Search
        |--------------------------------------------------------------------------
        */

        if ($request->filled('search')) {

            $search = $request->search;

            $query->where(function ($q) use ($search) {

                $q->where(
                    'reference_number',
                    'like',
                    '%' . $search . '%'
                )

                ->orWhereHas('bill', function ($billQuery) use ($search) {

                    $billQuery->where(
                        'invoice_number',
                        'like',
                        '%' . $search . '%'
                    )

                    ->orWhereHas(
                        'customer',
                        function ($customerQuery) use ($search) {

                            $customerQuery->where(
                                'full_name',
                                'like',
                                '%' . $search . '%'
                            );
                        }
                    );
                })

                ->orWhereHas('customer', function ($customerQuery) use ($search) {

                    $customerQuery->where(
                        'full_name',
                        'like',
                        '%' . $search . '%'
                    )

                    ->orWhere(
                        'customer_number',
                        'like',
                        '%' . $search . '%'
                    );
                });
            });
        }

        /*
        |--------------------------------------------------------------------------
        | Payment Method Filter
        |--------------------------------------------------------------------------
        */

        if ($request->filled('payment_method')) {

            $query->where(
                'payment_method',
                $request->payment_method
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Date From
        |--------------------------------------------------------------------------
        */

        if ($request->filled('date_from')) {

            $query->whereDate(
                'payment_date',
                '>=',
                $request->date_from
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Date To
        |--------------------------------------------------------------------------
        */

        if ($request->filled('date_to')) {

            $query->whereDate(
                'payment_date',
                '<=',
                $request->date_to
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Dashboard Statistics
        |--------------------------------------------------------------------------
        */

        $filteredQuery = clone $query;

        $totalPayments = $filteredQuery->count();

        $totalCollected = (clone $filteredQuery)
            ->sum('amount');

        $todayCollected = (clone $filteredQuery)
            ->whereDate('payment_date', today())
            ->sum('amount');

        /*
        |--------------------------------------------------------------------------
        | Payment Records
        |--------------------------------------------------------------------------
        */

        $payments = $query
            ->paginate(10)
            ->withQueryString();

        return view(
            'payments.index',
            compact(
                'payments',
                'totalPayments',
                'totalCollected',
                'todayCollected'
            )
        );
    }


    /**
     * Show payment form.
     */
    public function create(Bill $bill)
    {
        $bill->load(
            'customer',
            'meterReading.meter'
        );

        return view(
            'payments.create',
            compact('bill')
        );
    }


    /**
     * Initiate an M-PESA STK Push.
     *
     * The payment is NOT recorded here.
     *
     * Safaricom sends the actual payment result
     * to MpesaCallbackController.
     */
    public function mpesa(
        Request $request,
        Bill $bill,
        MpesaService $mpesaService
    ) {
        /*
        |--------------------------------------------------------------------------
        | Load Customer
        |--------------------------------------------------------------------------
        */

        $bill->load('customer');

        /*
        |--------------------------------------------------------------------------
        | Check Outstanding Balance
        |--------------------------------------------------------------------------
        */

        $balance = (float) $bill->balance;

        if ($balance <= 0) {

            return back()->withErrors([
                'mpesa' =>
                    'This invoice has no outstanding balance.',
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Prevent Multiple Pending STK Pushes
        |--------------------------------------------------------------------------
        */

        if (!empty($bill->mpesa_checkout_request_id)) {

            return back()->withErrors([
                'mpesa' =>
                    'There is already an M-PESA payment request pending for this invoice. Please complete it on the customer phone before sending another request.',
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Validate STK Push Details
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([

            'amount' => [
                'required',
                'numeric',
                'min:1',
                'max:' . $balance,
            ],

            'phone_number' => [
                'required',
                'string',
                'regex:/^(?:0|\+?254)7\d{8}$/',
            ],

        ], [

            'amount.required' =>
                'Please enter the M-PESA payment amount.',

            'amount.min' =>
                'The M-PESA payment amount must be at least KSh 1.',

            'amount.max' =>
                'The M-PESA payment cannot be greater than the outstanding balance.',

            'phone_number.required' =>
                'Please enter the customer M-PESA phone number.',

            'phone_number.regex' =>
                'Please enter a valid Kenyan M-PESA number, e.g. 0712345678.',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Convert Amount
        |--------------------------------------------------------------------------
        */

        $amount = (float) $validated['amount'];

        /*
        |--------------------------------------------------------------------------
        | Initiate STK Push
        |--------------------------------------------------------------------------
        */

        try {

            $response = $mpesaService->stkPush(
                $amount,
                $validated['phone_number'],
                $bill->invoice_number,
                'Payment for ' . $bill->invoice_number
            );

        } catch (\Throwable $e) {

            Log::error(
                'M-PESA STK Push failed.',
                [
                    'bill_id' => $bill->id,
                    'invoice_number' => $bill->invoice_number,
                    'phone_number' => $validated['phone_number'],
                    'amount' => $amount,
                    'error' => $e->getMessage(),
                ]
            );

            return back()
                ->withErrors([
                    'mpesa' =>
                        'Unable to initiate M-PESA payment. Please check the phone number and try again.',
                ])
                ->withInput();
        }

        /*
        |--------------------------------------------------------------------------
        | Check Safaricom Response
        |--------------------------------------------------------------------------
        */

        if (
            !isset($response['ResponseCode']) ||
            (string) $response['ResponseCode'] !== '0'
        ) {

            Log::error(
                'M-PESA STK Push was rejected.',
                [
                    'bill_id' => $bill->id,
                    'invoice_number' => $bill->invoice_number,
                    'response' => $response,
                ]
            );

            return back()
                ->withErrors([
                    'mpesa' =>
                        $response['ResponseDescription']
                        ?? 'M-PESA payment request was not accepted.',
                ])
                ->withInput();
        }

        /*
        |--------------------------------------------------------------------------
        | Get Checkout Request ID
        |--------------------------------------------------------------------------
        */

        $checkoutRequestId =
            $response['CheckoutRequestID'] ?? null;

        if (!$checkoutRequestId) {

            Log::error(
                'M-PESA STK Push succeeded but CheckoutRequestID was missing.',
                [
                    'bill_id' => $bill->id,
                    'invoice_number' => $bill->invoice_number,
                    'response' => $response,
                ]
            );

            return back()
                ->withErrors([
                    'mpesa' =>
                        'M-PESA request was sent, but the transaction reference could not be saved. Please check the M-PESA status before trying again.',
                ])
                ->withInput();
        }

        /*
        |--------------------------------------------------------------------------
        | Save Checkout Request ID
        |--------------------------------------------------------------------------
        */

        $bill->update([
            'mpesa_checkout_request_id' => $checkoutRequestId,
        ]);

        /*
        |--------------------------------------------------------------------------
        | Log Successful STK Push
        |--------------------------------------------------------------------------
        */

        Log::info(
            'M-PESA STK Push initiated successfully.',
            [
                'bill_id' => $bill->id,
                'invoice_number' => $bill->invoice_number,
                'amount' => $amount,
                'phone_number' => $validated['phone_number'],
                'checkout_request_id' => $checkoutRequestId,
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | Return To Invoice
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('bills.show', $bill)
            ->with(
                'success',
                'M-PESA payment request sent successfully. Please enter your M-PESA PIN on the customer phone.'
            );
    }


    /**
     * Record a manual payment.
     *
     * Used for:
     * - Cash
     * - Bank
     * - Manual M-PESA entry
     */
    public function store(
        Request $request,
        Bill $bill
    ) {
        /*
        |--------------------------------------------------------------------------
        | Validate Payment
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([

            'amount' =>
                'required|numeric|min:0.01',

            'payment_date' =>
                'required|date',

            'payment_method' =>
                'required|in:cash,mpesa,bank',

            'reference_number' => [
                'nullable',
                'string',
                'max:100',

                function ($attribute, $value, $fail) use ($request) {

                    if (
                        $request->payment_method === 'mpesa' &&
                        $value &&
                        Payment::where(
                            'reference_number',
                            $value
                        )->exists()
                    ) {

                        $fail(
                            'This M-PESA reference number has already been used.'
                        );
                    }
                },
            ],

            'notes' =>
                'nullable|string|max:1000',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Check Outstanding Balance
        |--------------------------------------------------------------------------
        */

        $remainingBalance = (float) $bill->balance;

        $amount = (float) $validated['amount'];

        /*
        |--------------------------------------------------------------------------
        | Prevent Overpayment
        |--------------------------------------------------------------------------
        */

        if ($amount > $remainingBalance) {

            return back()
                ->withErrors([
                    'amount' =>
                        'Payment cannot be greater than the outstanding balance of KSh '
                        . number_format(
                            $remainingBalance,
                            2
                        ),
                ])
                ->withInput();
        }

        /*
        |--------------------------------------------------------------------------
        | Save Payment + Update Bill
        |--------------------------------------------------------------------------
        */

        DB::transaction(function () use (
            $bill,
            $validated,
            $amount,
            $remainingBalance
        ) {

            Payment::create([

                'bill_id' =>
                    $bill->id,

                'customer_id' =>
                    $bill->customer_id,

                'amount' =>
                    $amount,

                'payment_date' =>
                    $validated['payment_date'],

                'payment_method' =>
                    $validated['payment_method'],

                'reference_number' =>
                    $validated['reference_number'] ?? null,

                'transaction_reference' =>
                    null,

                'notes' =>
                    $validated['notes'] ?? null,
            ]);

            /*
            |--------------------------------------------------------------------------
            | Calculate New Amount Paid
            |--------------------------------------------------------------------------
            */

            $newAmountPaid =
                (float) $bill->amount_paid + $amount;

            /*
            |--------------------------------------------------------------------------
            | Calculate New Balance
            |--------------------------------------------------------------------------
            */

            $newBalance =
                $remainingBalance - $amount;

            /*
            |--------------------------------------------------------------------------
            | Determine Status
            |--------------------------------------------------------------------------
            */

            if ($newBalance <= 0) {

                $status = 'paid';

                $newBalance = 0;

            } else {

                $status = 'partially_paid';
            }

            /*
            |--------------------------------------------------------------------------
            | Update Bill
            |--------------------------------------------------------------------------
            */

            $bill->update([

                'amount_paid' =>
                    $newAmountPaid,

                'balance' =>
                    $newBalance,

                'status' =>
                    $status,
            ]);
        });

        /*
        |--------------------------------------------------------------------------
        | Return To Invoice
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route(
                'bills.show',
                $bill
            )
            ->with(
                'success',
                'Payment recorded successfully.'
            );
    }


    /**
     * Display one payment.
     */
    public function show(Payment $payment)
    {
        $payment->load([
            'bill.customer',
            'customer',
        ]);

        return view(
            'payments.show',
            compact('payment')
        );
    }


    /**
     * Delete a payment.
     *
     * Only Administrators and Managers may delete payments.
     *
     * Normal bill payment:
     * - Restores the invoice balance.
     *
     * Customer credit payment:
     * - Restores the customer's credit balance.
     *
     * PayBill credit payments have bill_id = null.
     */
    public function destroy(Payment $payment)
    {
        /*
        |--------------------------------------------------------------------------
        | Role Protection
        |--------------------------------------------------------------------------
        |
        | Deleting a payment changes financial records because it can:
        |
        | - Increase an invoice balance.
        | - Reduce the customer's recorded payment total.
        | - Restore customer credit balance.
        |
        | Therefore only Administrators and Managers may perform this action.
        |
        */

        if (!in_array(auth()->user()->role, ['admin', 'manager'], true)) {

            abort(
                403,
                'Only an Administrator or Manager can delete a payment.'
            );
        }

        DB::transaction(function () use ($payment) {

            /*
            |--------------------------------------------------------------------------
            | CUSTOMER CREDIT PAYMENT
            |--------------------------------------------------------------------------
            |
            | A PayBill transaction that exceeds all outstanding bills is
            | stored as a payment with bill_id = null and its amount is
            | added to customers.credit_balance.
            |
            */

            if (is_null($payment->bill_id)) {

                $customer = $payment->customer;

                if (!$customer) {

                    throw new \RuntimeException(
                        'The customer associated with this credit payment could not be found.'
                    );
                }

                /*
                |--------------------------------------------------------------------------
                | Lock Customer
                |--------------------------------------------------------------------------
                */

                $customer = $customer
                    ->newQuery()
                    ->whereKey($customer->id)
                    ->lockForUpdate()
                    ->first();

                if (!$customer) {

                    throw new \RuntimeException(
                        'The customer associated with this credit payment could not be found.'
                    );
                }

                /*
                |--------------------------------------------------------------------------
                | Restore Customer Credit
                |--------------------------------------------------------------------------
                */

                $currentCredit =
                    (float) ($customer->credit_balance ?? 0);

                $creditToRemove =
                    (float) $payment->amount;

                $newCredit = max(
                    0,
                    $currentCredit - $creditToRemove
                );

                $customer->update([
                    'credit_balance' => $newCredit,
                ]);

                /*
                |--------------------------------------------------------------------------
                | Delete Credit Payment
                |--------------------------------------------------------------------------
                */

                $payment->delete();

                return;
            }

            /*
            |--------------------------------------------------------------------------
            | NORMAL BILL PAYMENT
            |--------------------------------------------------------------------------
            */

            $bill = $payment->bill;

            if (!$bill) {

                throw new \RuntimeException(
                    'The bill associated with this payment could not be found.'
                );
            }

            /*
            |--------------------------------------------------------------------------
            | Lock Bill
            |--------------------------------------------------------------------------
            */

            $bill = $bill
                ->newQuery()
                ->whereKey($bill->id)
                ->lockForUpdate()
                ->first();

            if (!$bill) {

                throw new \RuntimeException(
                    'The bill associated with this payment could not be found.'
                );
            }

            /*
            |--------------------------------------------------------------------------
            | Calculate New Amount Paid
            |--------------------------------------------------------------------------
            */

            $newAmountPaid = max(
                0,
                (float) $bill->amount_paid
                - (float) $payment->amount
            );

            /*
            |--------------------------------------------------------------------------
            | Recalculate Invoice Balance
            |--------------------------------------------------------------------------
            |
            | Invoice total =
            |
            | Previous Balance + Current Water Charge
            |
            */

            $originalTotalDue =
                (float) $bill->previous_balance
                + (float) $bill->water_charge;

            $newBalance = max(
                0,
                $originalTotalDue - $newAmountPaid
            );

            /*
            |--------------------------------------------------------------------------
            | Determine Status
            |--------------------------------------------------------------------------
            */

            if ($newAmountPaid <= 0) {

                $status = 'unpaid';

            } elseif ($newBalance <= 0) {

                $status = 'paid';

            } else {

                $status = 'partially_paid';
            }

            /*
            |--------------------------------------------------------------------------
            | Update Bill
            |--------------------------------------------------------------------------
            */

            $bill->update([

                'amount_paid' =>
                    $newAmountPaid,

                'balance' =>
                    $newBalance,

                'status' =>
                    $status,
            ]);

            /*
            |--------------------------------------------------------------------------
            | Delete Payment
            |--------------------------------------------------------------------------
            */

            $payment->delete();
        });

        /*
        |--------------------------------------------------------------------------
        | Return To Payments Dashboard
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('payments.index')
            ->with(
                'success',
                'Payment deleted successfully and the related balance has been restored.'
            );
    }
}
