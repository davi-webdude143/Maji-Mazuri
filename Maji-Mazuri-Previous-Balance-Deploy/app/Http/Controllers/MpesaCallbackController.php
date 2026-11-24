<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Customer;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MpesaCallbackController extends Controller
{
    /**
     * Receive M-PESA STK Push callback.
     *
     * NOTE:
     * The main customer payment method is PayBill.
     * This STK callback is preserved and is not changed by the
     * PayBill allocation correction.
     */
    public function callback(Request $request)
    {
        Log::info('M-PESA STK Callback Received', [
            'payload' => $request->all(),
        ]);

        $callback = $request->input('Body.stkCallback');

        if (!$callback) {
            Log::warning('Invalid M-PESA STK callback received.');

            return response()->json([
                'ResultCode' => 1,
                'ResultDesc' => 'Invalid callback data.',
            ]);
        }

        $resultCode = $callback['ResultCode'] ?? null;
        $resultDesc = $callback['ResultDesc'] ?? null;
        $checkoutRequestId = $callback['CheckoutRequestID'] ?? null;

        /*
        |--------------------------------------------------------------------------
        | Failed / Cancelled STK Push
        |--------------------------------------------------------------------------
        */

        if ((int) $resultCode !== 0) {
            Log::warning('M-PESA STK Push failed or cancelled.', [
                'result_code' => $resultCode,
                'result_description' => $resultDesc,
                'checkout_request_id' => $checkoutRequestId,
            ]);

            return response()->json([
                'ResultCode' => 0,
                'ResultDesc' => 'Callback received.',
            ]);
        }

        if (!$checkoutRequestId) {
            Log::error(
                'Successful M-PESA callback did not contain CheckoutRequestID.'
            );

            return response()->json([
                'ResultCode' => 0,
                'ResultDesc' => 'Callback received.',
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Find Bill
        |--------------------------------------------------------------------------
        */

        $bill = Bill::where(
            'mpesa_checkout_request_id',
            $checkoutRequestId
        )->first();

        if (!$bill) {
            Log::error('M-PESA callback could not find invoice.', [
                'checkout_request_id' => $checkoutRequestId,
            ]);

            return response()->json([
                'ResultCode' => 0,
                'ResultDesc' => 'Callback received.',
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Extract Callback Metadata
        |--------------------------------------------------------------------------
        */

        $metadata = collect(
            $callback['CallbackMetadata']['Item'] ?? []
        )->mapWithKeys(function ($item) {
            return [
                $item['Name'] => $item['Value'] ?? null,
            ];
        });

        $mpesaReceiptNumber = $metadata->get('MpesaReceiptNumber');
        $amount = $metadata->get('Amount');
        $phoneNumber = $metadata->get('PhoneNumber');

        if (
            !$mpesaReceiptNumber ||
            $amount === null ||
            !is_numeric($amount)
        ) {
            Log::error(
                'M-PESA STK callback did not contain valid payment details.',
                [
                    'bill_id' => $bill->id,
                    'invoice_number' => $bill->invoice_number,
                    'checkout_request_id' => $checkoutRequestId,
                    'metadata' => $metadata->toArray(),
                ]
            );

            return response()->json([
                'ResultCode' => 0,
                'ResultDesc' => 'Callback received.',
            ]);
        }

        $amount = round((float) $amount, 2);

        if ($amount <= 0) {
            Log::warning(
                'M-PESA STK callback contained zero/negative amount.',
                [
                    'bill_id' => $bill->id,
                    'amount' => $amount,
                    'receipt' => $mpesaReceiptNumber,
                ]
            );

            return response()->json([
                'ResultCode' => 0,
                'ResultDesc' => 'Callback received.',
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Prevent Duplicate STK Payment
        |--------------------------------------------------------------------------
        */

        if (
            Payment::where(
                'transaction_reference',
                $mpesaReceiptNumber
            )->exists()
        ) {
            Log::warning(
                'Duplicate M-PESA STK callback ignored.',
                [
                    'receipt' => $mpesaReceiptNumber,
                    'checkout_request_id' => $checkoutRequestId,
                ]
            );

            return response()->json([
                'ResultCode' => 0,
                'ResultDesc' => 'Callback already processed.',
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Process STK Payment
        |--------------------------------------------------------------------------
        */

        DB::transaction(function () use (
            $bill,
            $amount,
            $mpesaReceiptNumber,
            $phoneNumber,
            $checkoutRequestId
        ) {
            $bill = Bill::where('id', $bill->id)
                ->lockForUpdate()
                ->first();

            if (!$bill) {
                throw new \RuntimeException(
                    'Bill could not be found while processing M-PESA payment.'
                );
            }

            $customer = Customer::where(
                'id',
                $bill->customer_id
            )
                ->lockForUpdate()
                ->first();

            if (!$customer) {
                throw new \RuntimeException(
                    'Customer could not be found while processing M-PESA payment.'
                );
            }

            $remainingBalance = round(
                max(0, (float) $bill->balance),
                2
            );

            $paymentAmount = round(
                min($amount, $remainingBalance),
                2
            );

            $overpayment = round(
                max(0, $amount - $paymentAmount),
                2
            );

            /*
            |--------------------------------------------------------------------------
            | Apply Payment To Bill
            |--------------------------------------------------------------------------
            */

            if ($paymentAmount > 0) {
                $newAmountPaid = round(
                    (float) $bill->amount_paid + $paymentAmount,
                    2
                );

                /*
                |--------------------------------------------------------------------------
                | STK calculation intentionally preserved.
                |--------------------------------------------------------------------------
                */

                $newBalance = round(
                    max(
                        0,
                        (float) $bill->water_charge - $newAmountPaid
                    ),
                    2
                );

                if ($newBalance <= 0) {
                    $status = 'paid';
                    $newBalance = 0;
                } elseif ($newAmountPaid > 0) {
                    $status = 'partially_paid';
                } else {
                    $status = 'unpaid';
                }

                Payment::create([
                    'bill_id' => $bill->id,
                    'customer_id' => $customer->id,
                    'amount' => $paymentAmount,
                    'payment_date' => now(),
                    'payment_method' => 'mpesa',
                    'reference_number' => $mpesaReceiptNumber,
                    'transaction_reference' => $mpesaReceiptNumber,
                    'notes' => $phoneNumber
                        ? 'M-PESA Express payment from ' . $phoneNumber
                        : 'M-PESA Express payment',
                ]);

                $bill->update([
                    'amount_paid' => $newAmountPaid,
                    'balance' => $newBalance,
                    'status' => $status,
                    'mpesa_checkout_request_id' => null,
                ]);

                Log::info(
                    'M-PESA STK payment recorded successfully.',
                    [
                        'bill_id' => $bill->id,
                        'invoice_number' => $bill->invoice_number,
                        'amount_received' => $amount,
                        'amount_applied' => $paymentAmount,
                        'new_amount_paid' => $newAmountPaid,
                        'new_balance' => $newBalance,
                        'status' => $status,
                        'receipt' => $mpesaReceiptNumber,
                        'phone_number' => $phoneNumber,
                        'checkout_request_id' => $checkoutRequestId,
                    ]
                );
            }

            /*
            |--------------------------------------------------------------------------
            | Add STK Overpayment To Customer Credit
            |--------------------------------------------------------------------------
            */

            if ($overpayment > 0) {
                $previousCredit = round(
                    (float) $customer->credit_balance,
                    2
                );

                $newCreditBalance = round(
                    $previousCredit + $overpayment,
                    2
                );

                $customer->update([
                    'credit_balance' => $newCreditBalance,
                ]);

                Log::info(
                    'M-PESA STK excess payment added to customer credit.',
                    [
                        'customer_id' => $customer->id,
                        'customer_number' => $customer->customer_number,
                        'bill_id' => $bill->id,
                        'invoice_number' => $bill->invoice_number,
                        'transaction_reference' => $mpesaReceiptNumber,
                        'amount_received' => $amount,
                        'amount_applied_to_bill' => $paymentAmount,
                        'credit_added' => $overpayment,
                        'previous_credit' => $previousCredit,
                        'new_credit_balance' => $newCreditBalance,
                        'phone_number' => $phoneNumber,
                    ]
                );
            }

            $bill->update([
                'mpesa_checkout_request_id' => null,
            ]);
        });

        return response()->json([
            'ResultCode' => 0,
            'ResultDesc' => 'Callback received successfully.',
        ]);
    }

    /**
     * Receive M-PESA PayBill confirmation callback.
     *
     * Customer pays:
     *
     * PayBill: Client PayBill number
     * Account: M0001
     * Amount: KSh XXX
     */
    public function confirmation(Request $request)
    {
        Log::info('M-PESA PayBill Confirmation Received', [
            'payload' => $request->all(),
        ]);

        $transactionType = $request->input('TransactionType');

        $transactionId = trim(
            (string) $request->input('TransID')
        );

        $transactionTime = $request->input('TransTime');

        $transactionAmount = $request->input('TransAmount');

        $businessShortCode = $request->input('BusinessShortCode');

        $billReferenceNumber = trim(
            (string) $request->input('BillRefNumber')
        );

        $phoneNumber = $request->input('MSISDN');

        $firstName = $request->input('FirstName');

        $middleName = $request->input('MiddleName');

        $lastName = $request->input('LastName');

        /*
        |--------------------------------------------------------------------------
        | Validate Transaction
        |--------------------------------------------------------------------------
        */

        if (
            !$transactionId ||
            $transactionAmount === null ||
            !is_numeric($transactionAmount) ||
            !$billReferenceNumber
        ) {
            Log::error(
                'M-PESA PayBill callback is missing required information.',
                [
                    'transaction_id' => $transactionId,
                    'amount' => $transactionAmount,
                    'account_number' => $billReferenceNumber,
                ]
            );

            return response()->json([
                'ResultCode' => 0,
                'ResultDesc' => 'Callback received.',
            ]);
        }

        $transactionAmount = round(
            (float) $transactionAmount,
            2
        );

        if ($transactionAmount <= 0) {
            return response()->json([
                'ResultCode' => 0,
                'ResultDesc' => 'Callback received.',
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Prevent Duplicate PayBill Transaction
        |--------------------------------------------------------------------------
        |
        | IMPORTANT:
        |
        | reference_number stores the REAL M-PESA transaction ID.
        |
        | One PayBill transaction may create several Payment rows because
        | the money can be distributed across several outstanding bills.
        |
        | Therefore duplicate protection must use reference_number,
        | not transaction_reference.
        |--------------------------------------------------------------------------
        */

        if (
            Payment::where(
                'reference_number',
                $transactionId
            )->exists()
        ) {
            Log::warning(
                'Duplicate M-PESA PayBill transaction ignored.',
                [
                    'transaction_id' => $transactionId,
                    'account_number' => $billReferenceNumber,
                ]
            );

            return response()->json([
                'ResultCode' => 0,
                'ResultDesc' => 'Transaction already processed.',
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Find Customer
        |--------------------------------------------------------------------------
        */

        $customer = Customer::where(
            'customer_number',
            $billReferenceNumber
        )->first();

        if (!$customer) {
            Log::error(
                'M-PESA PayBill payment could not identify customer.',
                [
                    'transaction_id' => $transactionId,
                    'account_number' => $billReferenceNumber,
                    'amount' => $transactionAmount,
                    'phone_number' => $phoneNumber,
                ]
            );

            /*
            |--------------------------------------------------------------------------
            | Invalid Account
            |--------------------------------------------------------------------------
            |
            | Acknowledge Safaricom but do not create a payment against
            | a customer that does not exist.
            |--------------------------------------------------------------------------
            */

            return response()->json([
                'ResultCode' => 0,
                'ResultDesc' => 'Callback received.',
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Build M-PESA Customer Name
        |--------------------------------------------------------------------------
        */

        $mpesaName = trim(
            implode(
                ' ',
                array_filter([
                    $firstName,
                    $middleName,
                    $lastName,
                ])
            )
        );

        /*
        |--------------------------------------------------------------------------
        | Process PayBill
        |--------------------------------------------------------------------------
        */

        DB::transaction(function () use (
            $customer,
            $transactionAmount,
            $transactionId,
            $phoneNumber,
            $transactionTime,
            $businessShortCode,
            $transactionType,
            $mpesaName
        ) {
            /*
            |--------------------------------------------------------------------------
            | Lock Customer
            |--------------------------------------------------------------------------
            */

            $customer = Customer::where(
                'id',
                $customer->id
            )
                ->lockForUpdate()
                ->first();

            if (!$customer) {
                throw new \RuntimeException(
                    'Customer could not be found while processing M-PESA payment.'
                );
            }

            /*
            |--------------------------------------------------------------------------
            | IMPORTANT DUPLICATE CHECK INSIDE TRANSACTION
            |--------------------------------------------------------------------------
            |
            | This protects against two PayBill callbacks arriving at nearly
            | the same time.
            |--------------------------------------------------------------------------
            */

            if (
                Payment::where(
                    'reference_number',
                    $transactionId
                )->exists()
            ) {
                Log::warning(
                    'Duplicate M-PESA PayBill transaction detected inside transaction.',
                    [
                        'transaction_id' => $transactionId,
                        'customer_id' => $customer->id,
                        'customer_number' => $customer->customer_number,
                    ]
                );

                return;
            }

            /*
            |--------------------------------------------------------------------------
            | Get Outstanding Bills
            |--------------------------------------------------------------------------
            |
            | Oldest outstanding bill first.
            |--------------------------------------------------------------------------
            */

            $bills = Bill::where(
                'customer_id',
                $customer->id
            )
                ->where('balance', '>', 0)
                ->whereIn(
                    'status',
                    [
                        'unpaid',
                        'partially_paid',
                    ]
                )
                ->orderBy('billing_date', 'asc')
                ->orderBy('id', 'asc')
                ->lockForUpdate()
                ->get();

            $remainingPayment = round(
                $transactionAmount,
                2
            );

            $totalApplied = 0;

            /*
            |--------------------------------------------------------------------------
            | Allocate Payment Across Bills
            |--------------------------------------------------------------------------
            */

            foreach ($bills as $bill) {
                if ($remainingPayment <= 0) {
                    break;
                }

                /*
                |--------------------------------------------------------------------------
                | Read the ACTUAL outstanding bill balance.
                |--------------------------------------------------------------------------
                */

                $billBalance = round(
                    max(0, (float) $bill->balance),
                    2
                );

                if ($billBalance <= 0) {
                    continue;
                }

                /*
                |--------------------------------------------------------------------------
                | Determine how much belongs to this bill.
                |--------------------------------------------------------------------------
                */

                $paymentAmount = round(
                    min(
                        $remainingPayment,
                        $billBalance
                    ),
                    2
                );

                if ($paymentAmount <= 0) {
                    continue;
                }

                /*
                |--------------------------------------------------------------------------
                | Update Amount Paid
                |--------------------------------------------------------------------------
                */

                $newAmountPaid = round(
                    (float) $bill->amount_paid
                    + $paymentAmount,
                    2
                );

                /*
                |--------------------------------------------------------------------------
                | Reduce Actual Outstanding Balance
                |--------------------------------------------------------------------------
                */

                $newBalance = round(
                    max(
                        0,
                        $billBalance - $paymentAmount
                    ),
                    2
                );

                /*
                |--------------------------------------------------------------------------
                | Determine Bill Status
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
                    'amount_paid' => $newAmountPaid,
                    'balance' => $newBalance,
                    'status' => $status,
                ]);

                /*
                |--------------------------------------------------------------------------
                | Create Unique Internal Payment Reference
                |--------------------------------------------------------------------------
                |
                | IMPORTANT:
                |
                | The database has a UNIQUE constraint on
                | payments.transaction_reference.
                |
                | A single PayBill transaction can pay several bills.
                |
                | Therefore:
                |
                | reference_number
                |     = actual M-PESA transaction ID
                |
                | transaction_reference
                |     = unique internal allocation reference
                |
                | Example:
                |
                | ABC123-BILL-10
                | ABC123-BILL-11
                |--------------------------------------------------------------------------
                */

                $allocationReference =
                    $transactionId
                    . '-BILL-'
                    . $bill->id;

                $notes =
                    'M-PESA PayBill payment'
                    . ' - Account: '
                    . $customer->customer_number
                    . ' - Phone: '
                    . ($phoneNumber ?: 'N/A');

                if ($mpesaName) {
                    $notes .=
                        ' - Name: '
                        . $mpesaName;
                }

                $notes .=
                    ' - Transaction: '
                    . $transactionId;

                Payment::create([
                    'bill_id' => $bill->id,
                    'customer_id' => $customer->id,
                    'amount' => $paymentAmount,
                    'payment_date' => now(),
                    'payment_method' => 'mpesa',

                    /*
                    |--------------------------------------------------------------------------
                    | Real Safaricom transaction ID
                    |--------------------------------------------------------------------------
                    */
                    'reference_number' => $transactionId,

                    /*
                    |--------------------------------------------------------------------------
                    | Unique internal allocation reference
                    |--------------------------------------------------------------------------
                    */
                    'transaction_reference' => $allocationReference,

                    'notes' => $notes,
                ]);

                /*
                |--------------------------------------------------------------------------
                | Reduce Remaining Incoming Payment
                |--------------------------------------------------------------------------
                */

                $remainingPayment = round(
                    $remainingPayment - $paymentAmount,
                    2
                );

                $totalApplied = round(
                    $totalApplied + $paymentAmount,
                    2
                );

                /*
                |--------------------------------------------------------------------------
                | Log Allocation
                |--------------------------------------------------------------------------
                */

                Log::info(
                    'M-PESA PayBill payment allocated to bill.',
                    [
                        'customer_id' => $customer->id,
                        'customer_number' => $customer->customer_number,
                        'bill_id' => $bill->id,
                        'invoice_number' => $bill->invoice_number,
                        'amount_received' => $transactionAmount,
                        'original_bill_balance' => $billBalance,
                        'amount_applied' => $paymentAmount,
                        'new_amount_paid' => $newAmountPaid,
                        'remaining_payment' => max(
                            0,
                            $remainingPayment
                        ),
                        'new_balance' => $newBalance,
                        'status' => $status,
                        'transaction_id' => $transactionId,
                        'allocation_reference' => $allocationReference,
                        'phone_number' => $phoneNumber,
                    ]
                );
            }

            /*
            |--------------------------------------------------------------------------
            | Remaining Amount Becomes Customer Credit
            |--------------------------------------------------------------------------
            */

            $creditAdded = round(
                max(0, $remainingPayment),
                2
            );

            if ($creditAdded > 0) {
                $previousCredit = round(
                    (float) $customer->credit_balance,
                    2
                );

                $newCreditBalance = round(
                    $previousCredit + $creditAdded,
                    2
                );

                $customer->update([
                    'credit_balance' => $newCreditBalance,
                ]);

                /*
                |--------------------------------------------------------------------------
                | Unique Credit Payment Reference
                |--------------------------------------------------------------------------
                */

                $creditReference =
                    $transactionId
                    . '-CREDIT';

                /*
                |--------------------------------------------------------------------------
                | Record Unallocated / Credit Payment
                |--------------------------------------------------------------------------
                */

                $notes =
                    'M-PESA PayBill payment'
                    . ' - Account: '
                    . $customer->customer_number
                    . ' - Phone: '
                    . ($phoneNumber ?: 'N/A');

                if ($mpesaName) {
                    $notes .=
                        ' - Name: '
                        . $mpesaName;
                }

                $notes .=
                    ' - Transaction: '
                    . $transactionId
                    . ' - Customer credit';

                Payment::create([
                    'bill_id' => null,
                    'customer_id' => $customer->id,
                    'amount' => $creditAdded,
                    'payment_date' => now(),
                    'payment_method' => 'mpesa',

                    /*
                    |--------------------------------------------------------------------------
                    | Real Safaricom transaction ID
                    |--------------------------------------------------------------------------
                    */
                    'reference_number' => $transactionId,

                    /*
                    |--------------------------------------------------------------------------
                    | Unique internal credit reference
                    |--------------------------------------------------------------------------
                    */
                    'transaction_reference' => $creditReference,

                    'notes' => $notes,
                ]);

                Log::info(
                    'M-PESA PayBill excess payment added to customer credit.',
                    [
                        'customer_id' => $customer->id,
                        'customer_number' => $customer->customer_number,
                        'transaction_id' => $transactionId,
                        'credit_reference' => $creditReference,
                        'amount_received' => $transactionAmount,
                        'amount_applied_to_bills' => $totalApplied,
                        'credit_added' => $creditAdded,
                        'previous_credit' => $previousCredit,
                        'new_credit_balance' => $newCreditBalance,
                        'phone_number' => $phoneNumber,
                    ]
                );
            }

            /*
            |--------------------------------------------------------------------------
            | Final PayBill Transaction Log
            |--------------------------------------------------------------------------
            */

            Log::info(
                'M-PESA PayBill transaction processed successfully.',
                [
                    'customer_id' => $customer->id,
                    'customer_number' => $customer->customer_number,
                    'transaction_id' => $transactionId,
                    'amount_received' => $transactionAmount,
                    'amount_applied_to_bills' => $totalApplied,
                    'credit_added' => $creditAdded,
                    'final_credit_balance' =>
                        $customer->fresh()->credit_balance,
                    'phone_number' => $phoneNumber,
                    'transaction_time' => $transactionTime,
                    'business_shortcode' => $businessShortCode,
                    'transaction_type' => $transactionType,
                ]
            );
        });

        /*
        |--------------------------------------------------------------------------
        | Acknowledge Safaricom
        |--------------------------------------------------------------------------
        */

        return response()->json([
            'ResultCode' => 0,
            'ResultDesc' =>
                'Confirmation received successfully.',
        ]);
    }

    /**
     * Receive M-PESA PayBill validation callback.
     */
    public function validation(Request $request)
    {
        Log::info(
            'M-PESA PayBill Validation Received',
            [
                'payload' => $request->all(),
            ]
        );

        $accountNumber = trim(
            (string) $request->input('BillRefNumber')
        );

        /*
        |--------------------------------------------------------------------------
        | Check Customer
        |--------------------------------------------------------------------------
        */

        $customer = Customer::where(
            'customer_number',
            $accountNumber
        )->first();

        if (!$customer) {
            Log::warning(
                'M-PESA PayBill validation: customer not found.',
                [
                    'account_number' => $accountNumber,
                ]
            );

            return response()->json([
                'ResultCode' => 1,
                'ResultDesc' =>
                    'Invalid account number. Customer not found.',
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Accept Transaction
        |--------------------------------------------------------------------------
        */

        return response()->json([
            'ResultCode' => 0,
            'ResultDesc' => 'Accepted',
        ]);
    }
}