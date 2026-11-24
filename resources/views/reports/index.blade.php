<x-app-layout>

    <x-slot name="header">

        <div>
            <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-100">
                Reports
            </h2>

            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                Billing, payment and collection reports
            </p>
        </div>

    </x-slot>


    <div class="py-8 bg-gray-100 dark:bg-gray-950 min-h-screen">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">


            {{-- =========================================================
                 EXISTING REPORT FILTERS
                 ========================================================= --}}

            <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 shadow-sm p-6 mb-8">

                <div class="mb-5">

                    <h3 class="text-lg font-bold text-gray-900 dark:text-white">
                        Report Filters
                    </h3>

                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                        Select a date range to filter billing and payment information.
                    </p>

                </div>


                <form method="GET" action="{{ route('reports.index') }}">

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">


                        {{-- START DATE --}}

                        <div>

                            <label
                                for="start_date"
                                class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2"
                            >
                                Start Date
                            </label>

                            <input
                                type="date"
                                id="start_date"
                                name="start_date"
                                value="{{ $startDate }}"
                                class="w-full rounded-xl border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white focus:border-blue-500 focus:ring-blue-500"
                            >

                        </div>


                        {{-- END DATE --}}

                        <div>

                            <label
                                for="end_date"
                                class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2"
                            >
                                End Date
                            </label>

                            <input
                                type="date"
                                id="end_date"
                                name="end_date"
                                value="{{ $endDate }}"
                                class="w-full rounded-xl border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white focus:border-blue-500 focus:ring-blue-500"
                            >

                        </div>


                        {{-- BUTTONS --}}

                        <div class="flex items-end gap-3">

                            <button
                                type="submit"
                                class="inline-flex items-center justify-center px-5 py-3 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-semibold transition"
                            >
                                Generate Report
                            </button>

                            <a
                                href="{{ route('reports.index') }}"
                                class="inline-flex items-center justify-center px-5 py-3 rounded-xl bg-gray-100 hover:bg-gray-200 dark:bg-gray-800 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-300 font-semibold transition"
                            >
                                Clear
                            </a>

                        </div>

                    </div>

                </form>

            </div>


            {{-- =========================================================
                 BILLING SUMMARY
                 ========================================================= --}}

            <div class="mb-4">

                <h3 class="text-xl font-bold text-gray-900 dark:text-white">
                    Billing Summary
                </h3>

            </div>


            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">


                {{-- TOTAL BILLS --}}

                <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 shadow-sm p-6">

                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">
                        Total Bills
                    </p>

                    <p class="mt-2 text-3xl font-bold text-gray-900 dark:text-white">
                        {{ number_format($totalBills) }}
                    </p>

                </div>


                {{-- TOTAL BILLED --}}

                <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 shadow-sm p-6">

                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">
                        Total Billed
                    </p>

                    <p class="mt-2 text-2xl font-bold text-gray-900 dark:text-white">
                        KSh {{ number_format($totalBilled, 2) }}
                    </p>

                </div>


                {{-- TOTAL COLLECTED --}}

                <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 shadow-sm p-6">

                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">
                        Total Collected
                    </p>

                    <p class="mt-2 text-2xl font-bold text-green-600 dark:text-green-400">
                        KSh {{ number_format($totalCollected, 2) }}
                    </p>

                </div>


                {{-- OUTSTANDING --}}

                <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 shadow-sm p-6">

                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">
                        Outstanding
                    </p>

                    <p class="mt-2 text-2xl font-bold text-red-600 dark:text-red-400">
                        KSh {{ number_format($totalOutstanding, 2) }}
                    </p>

                </div>

            </div>


            {{-- =========================================================
                 BILL STATUS
                 ========================================================= --}}

            <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-10">


                {{-- PAID --}}

                <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 shadow-sm p-6">

                    <div class="flex items-center justify-between">

                        <div>

                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">
                                Paid Bills
                            </p>

                            <p class="mt-2 text-3xl font-bold text-green-600 dark:text-green-400">
                                {{ number_format($paidBills) }}
                            </p>

                        </div>

                        <div class="w-12 h-12 rounded-xl bg-green-100 dark:bg-green-900/30 flex items-center justify-center text-xl">
                            ✓
                        </div>

                    </div>

                </div>


                {{-- PARTIALLY PAID --}}

                <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 shadow-sm p-6">

                    <div class="flex items-center justify-between">

                        <div>

                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">
                                Partially Paid
                            </p>

                            <p class="mt-2 text-3xl font-bold text-yellow-600 dark:text-yellow-400">
                                {{ number_format($partiallyPaidBills) }}
                            </p>

                        </div>

                        <div class="w-12 h-12 rounded-xl bg-yellow-100 dark:bg-yellow-900/30 flex items-center justify-center text-xl">
                            ◐
                        </div>

                    </div>

                </div>


                {{-- UNPAID --}}

                <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 shadow-sm p-6">

                    <div class="flex items-center justify-between">

                        <div>

                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">
                                Unpaid Bills
                            </p>

                            <p class="mt-2 text-3xl font-bold text-red-600 dark:text-red-400">
                                {{ number_format($unpaidBills) }}
                            </p>

                        </div>

                        <div class="w-12 h-12 rounded-xl bg-red-100 dark:bg-red-900/30 flex items-center justify-center text-xl">
                            !
                        </div>

                    </div>

                </div>

            </div>


            {{-- =========================================================
                 PAYMENT SUMMARY
                 ========================================================= --}}

            <div class="mb-4">

                <h3 class="text-xl font-bold text-gray-900 dark:text-white">
                    Payment & Collection Summary
                </h3>

            </div>


            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-10">


                {{-- PAYMENT COUNT --}}

                <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 shadow-sm p-6">

                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">
                        Payment Records
                    </p>

                    <p class="mt-2 text-3xl font-bold text-gray-900 dark:text-white">
                        {{ number_format($totalPayments) }}
                    </p>

                </div>


                {{-- CASH --}}

                <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 shadow-sm p-6">

                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">
                        Cash Collection
                    </p>

                    <p class="mt-2 text-2xl font-bold text-blue-600 dark:text-blue-400">
                        KSh {{ number_format($cashCollected, 2) }}
                    </p>

                </div>


                {{-- MPESA --}}

                <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 shadow-sm p-6">

                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">
                        M-PESA Collection
                    </p>

                    <p class="mt-2 text-2xl font-bold text-green-600 dark:text-green-400">
                        KSh {{ number_format($mpesaCollected, 2) }}
                    </p>

                </div>


                {{-- BANK --}}

                <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 shadow-sm p-6">

                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">
                        Bank Collection
                    </p>

                    <p class="mt-2 text-2xl font-bold text-purple-600 dark:text-purple-400">
                        KSh {{ number_format($bankCollected, 2) }}
                    </p>

                </div>

            </div>


            {{-- =========================================================
                 BILLING RECORDS
                 ========================================================= --}}

            <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 shadow-sm overflow-hidden mb-10">

                <div class="px-6 py-5 border-b border-gray-200 dark:border-gray-800">

                    <h3 class="text-lg font-bold text-gray-900 dark:text-white">
                        Billing Records
                    </h3>

                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                        Bills included in this report
                    </p>

                </div>


                <div class="overflow-x-auto">

                    <table class="w-full">

                        <thead class="bg-gray-50 dark:bg-gray-800/50">

                            <tr>

                                <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                    Invoice
                                </th>

                                <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                    Customer
                                </th>

                                <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                    Date
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

                                <th class="px-6 py-4 text-center text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                    Status
                                </th>

                            </tr>

                        </thead>


                        <tbody class="divide-y divide-gray-200 dark:divide-gray-800">

                            @forelse($bills as $bill)

                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/50 transition">

                                    <td class="px-6 py-5">

                                        <a
                                            href="{{ route('bills.show', $bill) }}"
                                            class="font-semibold text-blue-600 hover:text-blue-800 dark:text-blue-400"
                                        >
                                            {{ $bill->invoice_number }}
                                        </a>

                                    </td>


                                    <td class="px-6 py-5">

                                        <p class="font-semibold text-gray-900 dark:text-white">
                                            {{ $bill->customer->full_name ?? 'N/A' }}
                                        </p>

                                        @if($bill->customer)

                                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                                {{ $bill->customer->customer_number }}
                                            </p>

                                        @endif

                                    </td>


                                    <td class="px-6 py-5 text-sm text-gray-700 dark:text-gray-300">

                                        {{ $bill->billing_date
                                            ? $bill->billing_date->format('d M Y')
                                            : 'N/A'
                                        }}

                                    </td>


                                    <td class="px-6 py-5 text-right font-semibold text-gray-900 dark:text-white">

                                        KSh {{ number_format($bill->water_charge, 2) }}

                                    </td>


                                    <td class="px-6 py-5 text-right font-semibold text-green-600 dark:text-green-400">

                                        KSh {{ number_format($bill->amount_paid, 2) }}

                                    </td>


                                    <td class="px-6 py-5 text-right font-semibold text-red-600 dark:text-red-400">

                                        KSh {{ number_format($bill->balance, 2) }}

                                    </td>


                                    <td class="px-6 py-5 text-center">

                                        @if($bill->status === 'paid')

                                            <span class="inline-flex px-3 py-1 rounded-full bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-300 text-xs font-bold">
                                                PAID
                                            </span>

                                        @elseif($bill->status === 'partially_paid')

                                            <span class="inline-flex px-3 py-1 rounded-full bg-yellow-100 dark:bg-yellow-900/30 text-yellow-700 dark:text-yellow-300 text-xs font-bold">
                                                PARTIAL
                                            </span>

                                        @else

                                            <span class="inline-flex px-3 py-1 rounded-full bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-300 text-xs font-bold">
                                                UNPAID
                                            </span>

                                        @endif

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="7" class="px-6 py-12 text-center">

                                        <p class="font-semibold text-gray-900 dark:text-white">
                                            No billing records found.
                                        </p>

                                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                                            Try changing the selected date range.
                                        </p>

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>


            {{-- =========================================================
                 PAYMENT RECORDS
                 ========================================================= --}}

            <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 shadow-sm overflow-hidden mb-10">

                <div class="px-6 py-5 border-b border-gray-200 dark:border-gray-800">

                    <h3 class="text-lg font-bold text-gray-900 dark:text-white">
                        Payment Records
                    </h3>

                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                        Payments included in this report
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
                                    Customer
                                </th>

                                <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                    Invoice
                                </th>

                                <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                    Method
                                </th>

                                <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                    Reference
                                </th>

                                <th class="px-6 py-4 text-right text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                    Amount
                                </th>

                            </tr>

                        </thead>


                        <tbody class="divide-y divide-gray-200 dark:divide-gray-800">

                            @forelse($payments as $payment)

                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/50 transition">

                                    <td class="px-6 py-5 text-sm text-gray-700 dark:text-gray-300">

                                        {{ $payment->payment_date
                                            ? $payment->payment_date->format('d M Y')
                                            : 'N/A'
                                        }}

                                    </td>


                                    <td class="px-6 py-5">

                                        <p class="font-semibold text-gray-900 dark:text-white">
                                            {{ $payment->customer->full_name ?? 'N/A' }}
                                        </p>

                                    </td>


                                    <td class="px-6 py-5">

                                        @if($payment->bill)

                                            <a
                                                href="{{ route('bills.show', $payment->bill) }}"
                                                class="font-semibold text-blue-600 hover:text-blue-800 dark:text-blue-400"
                                            >
                                                {{ $payment->bill->invoice_number }}
                                            </a>

                                        @else

                                            <span class="text-gray-500">
                                                N/A
                                            </span>

                                        @endif

                                    </td>


                                    <td class="px-6 py-5">

                                        <span class="inline-flex px-3 py-1 rounded-full text-xs font-bold
                                            @if($payment->payment_method === 'mpesa')
                                                bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-300
                                            @elseif($payment->payment_method === 'cash')
                                                bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-300
                                            @elseif($payment->payment_method === 'bank')
                                                bg-purple-100 text-purple-700 dark:bg-purple-900/30 dark:text-purple-300
                                            @else
                                                bg-gray-100 text-gray-700 dark:bg-gray-800 dark:text-gray-300
                                            @endif
                                        ">

                                            {{ strtoupper($payment->payment_method) }}

                                        </span>

                                    </td>


                                    <td class="px-6 py-5 text-sm text-gray-600 dark:text-gray-400">

                                        {{ $payment->reference_number ?? '—' }}

                                    </td>


                                    <td class="px-6 py-5 text-right font-bold text-green-600 dark:text-green-400">

                                        KSh {{ number_format($payment->amount, 2) }}

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="6" class="px-6 py-12 text-center">

                                        <p class="font-semibold text-gray-900 dark:text-white">
                                            No payment records found.
                                        </p>

                                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                                            Try changing the selected date range.
                                        </p>

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>


            {{-- =========================================================
                 INCOME REPORT
                 
                 This is a separate Blade component:
                 resources/views/reports/income.blade.php
                 ========================================================= --}}

            @include('reports.income')


        </div>

    </div>


</x-app-layout>

