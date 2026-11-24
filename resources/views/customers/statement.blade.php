<x-app-layout>

    <x-slot name="header">

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

            <div>
                <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-100">
                    Customer Statement
                </h2>

                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                    Account statement and payment history
                </p>
            </div>

            <div class="flex items-center gap-3">

                <a
                    href="{{ route('customers.show', $customer) }}"
                    class="inline-flex items-center px-4 py-2 rounded-lg bg-gray-100 hover:bg-gray-200 dark:bg-gray-800 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-300 text-sm font-semibold transition"
                >
                    ← Customer
                </a>

                <button
                    onclick="window.print()"
                    class="inline-flex items-center px-4 py-2 rounded-lg bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold transition"
                >
                    🖨 Print
                </button>

            </div>

        </div>

    </x-slot>


    <div class="py-8 bg-gray-100 dark:bg-gray-950 min-h-screen">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">


            {{-- CUSTOMER INFORMATION --}}

            <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 shadow-sm p-6 mb-6">

                <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-6">

                    <div>

                        <p class="text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400">
                            Customer
                        </p>

                        <h3 class="mt-1 text-2xl font-bold text-gray-900 dark:text-white">
                            {{ $customer->full_name }}
                        </h3>

                        <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                            Customer No:
                            <span class="font-semibold text-gray-900 dark:text-gray-200">
                                {{ $customer->customer_number }}
                            </span>
                        </p>

                    </div>


                    <div class="text-left md:text-right">

                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            Phone
                        </p>

                        <p class="font-semibold text-gray-900 dark:text-white">
                            {{ $customer->phone_number }}
                        </p>

                        @if($customer->email)

                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">
                                {{ $customer->email }}
                            </p>

                        @endif

                    </div>

                </div>


                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mt-6 pt-6 border-t border-gray-200 dark:border-gray-800">

                    <div>

                        <p class="text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400">
                            Area
                        </p>

                        <p class="mt-1 text-sm font-medium text-gray-900 dark:text-white">
                            {{ $customer->area ?: '—' }}
                        </p>

                    </div>


                    <div>

                        <p class="text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400">
                            Address
                        </p>

                        <p class="mt-1 text-sm font-medium text-gray-900 dark:text-white">
                            {{ $customer->address ?: '—' }}
                        </p>

                    </div>


                    <div>

                        <p class="text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400">
                            Account Status
                        </p>

                        <p class="mt-1">

                            @if($customer->status === 'active')

                                <span class="inline-flex items-center px-3 py-1 rounded-full bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-300 text-xs font-bold">
                                    ACTIVE
                                </span>

                            @else

                                <span class="inline-flex items-center px-3 py-1 rounded-full bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300 text-xs font-bold">
                                    INACTIVE
                                </span>

                            @endif

                        </p>

                    </div>

                </div>

            </div>


            {{-- SUMMARY CARDS --}}

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-5 mb-6">


                {{-- TOTAL BILLED --}}

                <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 shadow-sm p-6">

                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">
                        Total Billed
                    </p>

                    <p class="mt-2 text-2xl font-bold text-gray-900 dark:text-white">
                        KSh {{ number_format($totalBilled, 2) }}
                    </p>

                </div>


                {{-- TOTAL PAID --}}

                <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 shadow-sm p-6">

                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">
                        Total Paid
                    </p>

                    <p class="mt-2 text-2xl font-bold text-green-700 dark:text-green-400">
                        KSh {{ number_format($totalPaid, 2) }}
                    </p>

                </div>


                {{-- BALANCE --}}

                <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 shadow-sm p-6">

                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">
                        Outstanding Balance
                    </p>

                    <p class="mt-2 text-2xl font-bold
                        {{ $balance > 0
                            ? 'text-red-600 dark:text-red-400'
                            : 'text-green-700 dark:text-green-400'
                        }}"
                    >
                        KSh {{ number_format(max(0, $balance), 2) }}
                    </p>

                </div>

            </div>


            {{-- BILLING HISTORY --}}

            <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 shadow-sm overflow-hidden">

                <div class="px-6 py-5 border-b border-gray-200 dark:border-gray-800">

                    <h3 class="text-lg font-bold text-gray-900 dark:text-white">
                        Billing & Payment History
                    </h3>

                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                        Complete account activity for this customer
                    </p>

                </div>


                <div class="overflow-x-auto">

                    <table class="w-full">

                        <thead class="bg-gray-50 dark:bg-gray-800/50">

                            <tr>

                                <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                    Date
                                </th>

                                <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                    Description
                                </th>

                                <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                    Invoice / Reference
                                </th>

                                <th class="px-6 py-4 text-right text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                    Billed
                                </th>

                                <th class="px-6 py-4 text-right text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                    Paid
                                </th>

                                <th class="px-6 py-4 text-right text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                    Balance
                                </th>

                            </tr>

                        </thead>


                        <tbody class="divide-y divide-gray-200 dark:divide-gray-800">

                            @forelse($customer->bills as $bill)

                                {{-- BILL ROW --}}

                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/50">

                                    <td class="px-6 py-5 text-sm text-gray-700 dark:text-gray-300">

                                        {{ $bill->billing_date
                                            ? $bill->billing_date->format('d M Y')
                                            : 'N/A'
                                        }}

                                    </td>


                                    <td class="px-6 py-5">

                                        <p class="font-semibold text-gray-900 dark:text-white">
                                            Water Bill
                                        </p>

                                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                            {{ number_format($bill->consumption, 2) }} units
                                        </p>

                                    </td>


                                    <td class="px-6 py-5">

                                        <a
                                            href="{{ route('bills.show', $bill) }}"
                                            class="font-semibold text-blue-600 hover:text-blue-800 dark:text-blue-400"
                                        >
                                            {{ $bill->invoice_number }}
                                        </a>

                                    </td>


                                    <td class="px-6 py-5 text-right font-semibold text-gray-900 dark:text-white">

                                        KSh {{ number_format($bill->water_charge, 2) }}

                                    </td>


                                    <td class="px-6 py-5 text-right font-semibold text-green-700 dark:text-green-400">

                                        KSh {{ number_format($bill->amount_paid, 2) }}

                                    </td>


                                    <td class="px-6 py-5 text-right font-semibold
                                        {{ $bill->balance > 0
                                            ? 'text-red-600 dark:text-red-400'
                                            : 'text-green-700 dark:text-green-400'
                                        }}"
                                    >

                                        KSh {{ number_format($bill->balance, 2) }}

                                    </td>

                                </tr>


                                {{-- PAYMENT ROWS --}}

                                @foreach($bill->payments as $payment)

                                    <tr class="bg-gray-50/50 dark:bg-gray-950/30">

                                        <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400">

                                            {{ $payment->payment_date
                                                ? $payment->payment_date->format('d M Y')
                                                : 'N/A'
                                            }}

                                        </td>


                                        <td class="px-6 py-4">

                                            <p class="text-sm font-medium text-green-700 dark:text-green-400">

                                                Payment

                                            </p>

                                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">

                                                {{ strtoupper($payment->payment_method) }}

                                            </p>

                                        </td>


                                        <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400">

                                            {{ $payment->reference_number ?: '—' }}

                                        </td>


                                        <td class="px-6 py-4 text-right text-gray-400">

                                            —

                                        </td>


                                        <td class="px-6 py-4 text-right font-semibold text-green-700 dark:text-green-400">

                                            KSh {{ number_format($payment->amount, 2) }}

                                        </td>


                                        <td class="px-6 py-4 text-right text-gray-400">

                                            —

                                        </td>

                                    </tr>

                                @endforeach


                            @empty

                                <tr>

                                    <td colspan="6" class="px-6 py-12 text-center">

                                        <div class="text-4xl">
                                            📄
                                        </div>

                                        <p class="mt-3 font-semibold text-gray-900 dark:text-white">
                                            No billing history
                                        </p>

                                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                            This customer does not have any bills yet.
                                        </p>

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>


                        <tfoot class="bg-gray-50 dark:bg-gray-800/50 border-t border-gray-200 dark:border-gray-800">

                            <tr>

                                <td colspan="3" class="px-6 py-5 text-right font-bold text-gray-900 dark:text-white">
                                    TOTAL
                                </td>

                                <td class="px-6 py-5 text-right font-bold text-gray-900 dark:text-white">
                                    KSh {{ number_format($totalBilled, 2) }}
                                </td>

                                <td class="px-6 py-5 text-right font-bold text-green-700 dark:text-green-400">
                                    KSh {{ number_format($totalPaid, 2) }}
                                </td>

                                <td class="px-6 py-5 text-right font-bold
                                    {{ $balance > 0
                                        ? 'text-red-600 dark:text-red-400'
                                        : 'text-green-700 dark:text-green-400'
                                    }}"
                                >
                                    KSh {{ number_format(max(0, $balance), 2) }}
                                </td>

                            </tr>

                        </tfoot>

                    </table>

                </div>

            </div>

        </div>

    </div>


    {{-- PRINT STYLING --}}

    <style>

        @media print {

            body {
                background: white !important;
            }

            nav,
            header,
            button,
            a {
                display: none !important;
            }

            .py-8 {
                padding-top: 0 !important;
            }

            .shadow-sm {
                box-shadow: none !important;
            }

            .border {
                border-color: #ddd !important;
            }

        }

    </style>

</x-app-layout>