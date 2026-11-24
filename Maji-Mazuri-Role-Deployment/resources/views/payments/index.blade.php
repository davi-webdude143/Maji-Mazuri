<x-app-layout>


<x-slot name="header">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-100">
                Payments Dashboard
            </h2>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                View, search and manage all recorded customer payments
            </p>
        </div>
    </div>
</x-slot>

<div class="py-8 bg-gray-100 dark:bg-gray-950 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- SUCCESS MESSAGE --}}
        @if(session('success'))
            <div class="mb-6 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-xl p-4">
                <div class="flex items-center gap-3">
                    <span class="text-green-600 dark:text-green-400 text-xl">
                        ✓
                    </span>
                    <p class="text-sm font-medium text-green-700 dark:text-green-300">
                        {{ session('success') }}
                    </p>
                </div>
            </div>
        @endif

        {{-- VALIDATION / ERROR MESSAGES --}}
        @if($errors->any())
            <div class="mb-6 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-xl p-4">
                <div class="flex items-start gap-3">
                    <span class="text-red-600 dark:text-red-400 text-xl">
                        !
                    </span>

                    <div>
                        <p class="text-sm font-semibold text-red-700 dark:text-red-300">
                            Please check the following:
                        </p>

                        <ul class="mt-2 text-sm text-red-600 dark:text-red-400 list-disc list-inside">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        {{-- SUMMARY CARDS --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 mb-8">

            {{-- TOTAL PAYMENTS --}}
            <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 shadow-sm p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">
                            Total Payments
                        </p>

                        <p class="mt-2 text-3xl font-bold text-gray-900 dark:text-white">
                            {{ number_format($totalPayments) }}
                        </p>
                    </div>

                    <div class="w-12 h-12 rounded-xl bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center text-2xl">
                        💰
                    </div>
                </div>
            </div>

            {{-- TOTAL COLLECTED --}}
            <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 shadow-sm p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">
                            Total Amount Collected
                        </p>

                        <p class="mt-2 text-2xl sm:text-3xl font-bold text-green-700 dark:text-green-400">
                            KSh {{ number_format($totalCollected, 2) }}
                        </p>
                    </div>

                    <div class="w-12 h-12 rounded-xl bg-green-100 dark:bg-green-900/30 flex items-center justify-center text-2xl">
                        ✓
                    </div>
                </div>
            </div>

            {{-- TODAY'S COLLECTION --}}
            <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 shadow-sm p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">
                            Today's Collection
                        </p>

                        <p class="mt-2 text-2xl sm:text-3xl font-bold text-purple-700 dark:text-purple-400">
                            KSh {{ number_format($todayCollected, 2) }}
                        </p>
                    </div>

                    <div class="w-12 h-12 rounded-xl bg-purple-100 dark:bg-purple-900/30 flex items-center justify-center text-2xl">
                        📅
                    </div>
                </div>
            </div>

        </div>

        {{-- SEARCH AND FILTERS --}}
        <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 shadow-sm p-6 mb-8">

            <div class="mb-5">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white">
                    Search & Filter Payments
                </h3>

                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                    Search by customer, invoice or payment reference.
                </p>
            </div>

            <form method="GET" action="{{ route('payments.index') }}">

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">

                    {{-- SEARCH --}}
                    <div class="lg:col-span-2">

                        <label
                            for="search"
                            class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2"
                        >
                            Search
                        </label>

                        <input
                            type="text"
                            name="search"
                            id="search"
                            value="{{ request('search') }}"
                            placeholder="Customer, invoice or reference..."
                            class="w-full rounded-xl border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white focus:border-blue-500 focus:ring-blue-500"
                        >

                    </div>

                    {{-- PAYMENT METHOD --}}
                    <div>

                        <label
                            for="payment_method"
                            class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2"
                        >
                            Payment Method
                        </label>

                        <select
                            name="payment_method"
                            id="payment_method"
                            class="w-full rounded-xl border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white focus:border-blue-500 focus:ring-blue-500"
                        >

                            <option value="">
                                All Methods
                            </option>

                            <option
                                value="cash"
                                {{ request('payment_method') === 'cash' ? 'selected' : '' }}
                            >
                                Cash
                            </option>

                            <option
                                value="mpesa"
                                {{ request('payment_method') === 'mpesa' ? 'selected' : '' }}
                            >
                                M-PESA
                            </option>

                            <option
                                value="bank"
                                {{ request('payment_method') === 'bank' ? 'selected' : '' }}
                            >
                                Bank
                            </option>

                        </select>

                    </div>

                    {{-- DATE FROM --}}
                    <div>

                        <label
                            for="date_from"
                            class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2"
                        >
                            From Date
                        </label>

                        <input
                            type="date"
                            name="date_from"
                            id="date_from"
                            value="{{ request('date_from') }}"
                            class="w-full rounded-xl border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white focus:border-blue-500 focus:ring-blue-500"
                        >

                    </div>

                    {{-- DATE TO --}}
                    <div>

                        <label
                            for="date_to"
                            class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2"
                        >
                            To Date
                        </label>

                        <input
                            type="date"
                            name="date_to"
                            id="date_to"
                            value="{{ request('date_to') }}"
                            class="w-full rounded-xl border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white focus:border-blue-500 focus:ring-blue-500"
                        >

                    </div>

                </div>

                {{-- FILTER BUTTONS --}}
                <div class="flex flex-col sm:flex-row gap-3 mt-5">

                    <button
                        type="submit"
                        class="inline-flex items-center justify-center px-5 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-semibold transition"
                    >
                        🔎 Search Payments
                    </button>

                    <a
                        href="{{ route('payments.index') }}"
                        class="inline-flex items-center justify-center px-5 py-2.5 rounded-xl bg-gray-100 hover:bg-gray-200 dark:bg-gray-800 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-300 font-semibold transition"
                    >
                        ↻ Clear Filters
                    </a>

                </div>

            </form>

        </div>

        {{-- PAYMENTS TABLE --}}
        <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 shadow-sm overflow-hidden">

            {{-- TABLE HEADER --}}
            <div class="px-6 py-5 border-b border-gray-200 dark:border-gray-800">

                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">

                    <div>

                        <h3 class="text-lg font-bold text-gray-900 dark:text-white">
                            Payment Records
                        </h3>

                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                            Showing
                            {{ $payments->firstItem() ?? 0 }}
                            -
                            {{ $payments->lastItem() ?? 0 }}
                            of
                            {{ $payments->total() }}
                            payment records
                        </p>

                    </div>

                </div>

            </div>

            {{-- TABLE --}}
            <div class="overflow-x-auto">

                <table class="w-full">

                    <thead class="bg-gray-50 dark:bg-gray-800/50">

                        <tr>

                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                Payment
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

                            <th class="px-6 py-4 text-right text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                Amount
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                Date
                            </th>

                            <th class="px-6 py-4 text-right text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                Action
                            </th>

                        </tr>

                    </thead>

                    <tbody class="divide-y divide-gray-200 dark:divide-gray-800">

                        @forelse($payments as $payment)

                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/50 transition">

                                {{-- PAYMENT --}}
                                <td class="px-6 py-5">

                                    <p class="font-bold text-gray-900 dark:text-white">
                                        #{{ $payment->id }}
                                    </p>

                                    @if($payment->reference_number)

                                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                            Ref: {{ $payment->reference_number }}
                                        </p>

                                    @else

                                        <p class="text-xs text-gray-400 dark:text-gray-500 mt-1">
                                            No reference
                                        </p>

                                    @endif

                                </td>

                                {{-- CUSTOMER --}}
                                <td class="px-6 py-5">

                                    @if($payment->bill && $payment->bill->customer)

                                        <p class="font-semibold text-gray-900 dark:text-white">
                                            {{ $payment->bill->customer->full_name }}
                                        </p>

                                        @if($payment->bill->customer->customer_number)

                                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                                {{ $payment->bill->customer->customer_number }}
                                            </p>

                                        @endif

                                    @else

                                        <span class="text-gray-500 dark:text-gray-400">
                                            N/A
                                        </span>

                                    @endif

                                </td>

                                {{-- INVOICE --}}
                                <td class="px-6 py-5">

                                    @if($payment->bill)

                                        <a
                                            href="{{ route('bills.show', $payment->bill) }}"
                                            class="font-semibold text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300"
                                        >
                                            {{ $payment->bill->invoice_number }}
                                        </a>

                                    @else

                                        <span class="text-gray-500 dark:text-gray-400">
                                            N/A
                                        </span>

                                    @endif

                                </td>

                                {{-- METHOD --}}
                                <td class="px-6 py-5">

                                    @if($payment->payment_method === 'mpesa')

                                        <span class="inline-flex items-center px-3 py-1 rounded-full bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-300 text-xs font-bold">
                                            📱 M-PESA
                                        </span>

                                    @elseif($payment->payment_method === 'cash')

                                        <span class="inline-flex items-center px-3 py-1 rounded-full bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300 text-xs font-bold">
                                            💵 CASH
                                        </span>

                                    @elseif($payment->payment_method === 'bank')

                                        <span class="inline-flex items-center px-3 py-1 rounded-full bg-purple-100 dark:bg-purple-900/30 text-purple-700 dark:text-purple-300 text-xs font-bold">
                                            🏦 BANK
                                        </span>

                                    @else

                                        <span class="inline-flex items-center px-3 py-1 rounded-full bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300 text-xs font-bold">
                                            {{ strtoupper($payment->payment_method) }}
                                        </span>

                                    @endif

                                </td>

                                {{-- AMOUNT --}}
                                <td class="px-6 py-5 text-right">

                                    <p class="font-bold text-green-700 dark:text-green-400">
                                        KSh {{ number_format($payment->amount, 2) }}
                                    </p>

                                </td>

                                {{-- DATE --}}
                                <td class="px-6 py-5">

                                    <p class="text-sm text-gray-700 dark:text-gray-300">
                                        {{ $payment->payment_date
                                            ? $payment->payment_date->format('d M Y')
                                            : 'N/A'
                                        }}
                                    </p>

                                </td>

                                {{-- ACTION --}}
                                <td class="px-6 py-5 text-right">

                                    <div class="inline-flex items-center gap-2">

                                        {{-- VIEW --}}
                                        <a
                                            href="{{ route('payments.show', $payment) }}"
                                            class="inline-flex items-center px-4 py-2 rounded-lg bg-gray-100 hover:bg-gray-200 dark:bg-gray-800 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-300 text-sm font-semibold transition"
                                        >
                                            View
                                        </a>

                                        {{-- DELETE --}}
                                        @if(in_array(auth()->user()->role, ['admin', 'manager'], true))

                                            <form
                                                method="POST"
                                                action="{{ route('payments.destroy', $payment) }}"
                                                onsubmit="return confirm('Are you sure you want to delete this payment? This will restore the related bill or customer credit balance.');"
                                                class="inline"
                                            >

                                                @csrf
                                                @method('DELETE')

                                                <button
                                                    type="submit"
                                                    class="inline-flex items-center px-4 py-2 rounded-lg bg-red-100 hover:bg-red-200 dark:bg-red-900/30 dark:hover:bg-red-900/50 text-red-700 dark:text-red-300 text-sm font-semibold transition"
                                                >
                                                    Delete
                                                </button>

                                            </form>

                                        @endif

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="7" class="px-6 py-12 text-center">

                                    <div class="text-4xl">
                                        💰
                                    </div>

                                    <p class="mt-3 font-semibold text-gray-900 dark:text-white">
                                        No payments found
                                    </p>

                                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                        Try changing your search or filter options.
                                    </p>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

            {{-- PAGINATION --}}
            @if($payments->hasPages())

                <div class="px-6 py-5 border-t border-gray-200 dark:border-gray-800">
                    {{ $payments->links() }}
                </div>

            @endif

        </div>

    </div>
</div>


</x-app-layout>
