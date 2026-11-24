<x-app-layout>

    <x-slot name="header">

        <div>
            <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-100">
                Edit Bill
            </h2>

            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                Update billing and payment information
            </p>
        </div>

    </x-slot>


    <div class="py-8">

        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Success Message --}}
            @if (session('success'))
                <div class="mb-6 rounded-lg bg-green-50 border border-green-200 px-4 py-3 text-green-700">
                    {{ session('success') }}
                </div>
            @endif


            {{-- Validation Errors --}}
            @if ($errors->any())

                <div class="mb-6 rounded-lg bg-red-50 border border-red-200 px-4 py-3 text-red-700">

                    <p class="font-semibold mb-2">
                        Please correct the following:
                    </p>

                    <ul class="list-disc ml-5 text-sm">

                        @foreach ($errors->all() as $error)

                            <li>{{ $error }}</li>

                        @endforeach

                    </ul>

                </div>

            @endif


            {{-- Bill Information --}}
            <div class="bg-white dark:bg-gray-800 shadow-sm rounded-xl border border-gray-200 dark:border-gray-700 overflow-hidden">

                <div class="px-6 py-5 border-b border-gray-200 dark:border-gray-700">

                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">

                        <div>

                            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                                {{ $bill->invoice_number }}
                            </h3>

                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                                Customer: {{ $bill->customer->full_name }}
                            </p>

                        </div>

                        <div class="text-sm text-gray-500 dark:text-gray-400">

                            Meter:
                            <span class="font-medium text-gray-800 dark:text-gray-200">
                                {{ $bill->meterReading->meter->meter_number }}
                            </span>

                        </div>

                    </div>

                </div>


                <form
                    method="POST"
                    action="{{ route('bills.update', $bill) }}"
                    class="p-6"
                >

                    @csrf

                    @method('PUT')


                    {{-- Billing Information --}}
                    <div class="mb-8">

                        <h4 class="text-base font-semibold text-gray-900 dark:text-gray-100 mb-4">
                            Billing Information
                        </h4>


                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                            {{-- Billing Date --}}
                            <div>

                                <label
                                    for="billing_date"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2"
                                >
                                    Billing Date
                                </label>

                                <input
                                    type="date"
                                    id="billing_date"
                                    name="billing_date"
                                    value="{{ old('billing_date', $bill->billing_date->format('Y-m-d')) }}"
                                    required
                                    class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-blue-500 focus:ring-blue-500"
                                >

                            </div>


                            {{-- Water Rate --}}
                            <div>

                                <label
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2"
                                >
                                    Water Rate
                                </label>

                                <div class="w-full rounded-lg bg-gray-100 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 px-4 py-2.5 text-gray-800 dark:text-gray-100">

                                    KSh 120.00 per unit

                                </div>

                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                    The water rate is fixed by the system.
                                </p>

                            </div>

                        </div>

                    </div>


                    {{-- Meter Reading --}}
                    <div class="mb-8">

                        <h4 class="text-base font-semibold text-gray-900 dark:text-gray-100 mb-4">
                            Meter Reading
                        </h4>


                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                            <div class="rounded-lg bg-gray-50 dark:bg-gray-700/50 p-4">

                                <p class="text-xs text-gray-500 dark:text-gray-400">
                                    Previous Reading
                                </p>

                                <p class="text-lg font-semibold text-gray-900 dark:text-gray-100 mt-1">
                                    {{ number_format($bill->meterReading->previous_reading, 2) }}
                                </p>

                            </div>


                            <div class="rounded-lg bg-gray-50 dark:bg-gray-700/50 p-4">

                                <p class="text-xs text-gray-500 dark:text-gray-400">
                                    Current Reading
                                </p>

                                <p class="text-lg font-semibold text-gray-900 dark:text-gray-100 mt-1">
                                    {{ number_format($bill->meterReading->current_reading, 2) }}
                                </p>

                            </div>


                            <div class="rounded-lg bg-blue-50 dark:bg-blue-900/20 p-4">

                                <p class="text-xs text-blue-600 dark:text-blue-300">
                                    Consumption
                                </p>

                                <p class="text-lg font-semibold text-blue-700 dark:text-blue-200 mt-1">
                                    {{ number_format($bill->consumption, 2) }} units
                                </p>

                            </div>

                        </div>

                    </div>


                    {{-- Payment Information --}}
                    <div class="mb-8">

                        <h4 class="text-base font-semibold text-gray-900 dark:text-gray-100 mb-4">
                            Payment Information
                        </h4>


                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                            {{-- Amount Paid --}}
                            <div>

                                <label
                                    for="amount_paid"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2"
                                >
                                    Amount Paid (KSh)
                                </label>

                                <input
                                    type="number"
                                    step="0.01"
                                    min="0"
                                    max="{{ $bill->water_charge }}"
                                    id="amount_paid"
                                    name="amount_paid"
                                    value="{{ old('amount_paid', $bill->amount_paid) }}"
                                    required
                                    class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-blue-500 focus:ring-blue-500"
                                >

                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                    Maximum allowed:
                                    KSh {{ number_format($bill->water_charge, 2) }}
                                </p>

                            </div>


                            {{-- Status --}}
                            <div>

                                <label
                                    for="status"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2"
                                >
                                    Payment Status
                                </label>

                                <select
                                    id="status"
                                    name="status"
                                    required
                                    class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-blue-500 focus:ring-blue-500"
                                >

                                    <option
                                        value="unpaid"
                                        {{ old('status', $bill->status) === 'unpaid' ? 'selected' : '' }}
                                    >
                                        Unpaid
                                    </option>

                                    <option
                                        value="partially_paid"
                                        {{ old('status', $bill->status) === 'partially_paid' ? 'selected' : '' }}
                                    >
                                        Partially Paid
                                    </option>

                                    <option
                                        value="paid"
                                        {{ old('status', $bill->status) === 'paid' ? 'selected' : '' }}
                                    >
                                        Paid
                                    </option>

                                    <option
                                        value="overdue"
                                        {{ old('status', $bill->status) === 'overdue' ? 'selected' : '' }}
                                    >
                                        Overdue
                                    </option>

                                </select>

                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                    The system automatically determines the final status from the amount paid.
                                </p>

                            </div>

                        </div>

                    </div>


                    {{-- Current Totals --}}
                    <div class="rounded-xl bg-gray-50 dark:bg-gray-700/50 border border-gray-200 dark:border-gray-600 p-5 mb-8">

                        <h4 class="text-base font-semibold text-gray-900 dark:text-gray-100 mb-4">
                            Current Bill Summary
                        </h4>


                        <div class="space-y-3">

                            <div class="flex justify-between items-center">

                                <span class="text-sm text-gray-600 dark:text-gray-300">
                                    Consumption
                                </span>

                                <span class="font-medium text-gray-900 dark:text-gray-100">
                                    {{ number_format($bill->consumption, 2) }} units
                                </span>

                            </div>


                            <div class="flex justify-between items-center">

                                <span class="text-sm text-gray-600 dark:text-gray-300">
                                    Rate
                                </span>

                                <span class="font-medium text-gray-900 dark:text-gray-100">
                                    KSh {{ number_format($bill->rate_per_unit, 2) }}
                                </span>

                            </div>


                            <div class="flex justify-between items-center">

                                <span class="text-sm text-gray-600 dark:text-gray-300">
                                    Water Charge
                                </span>

                                <span class="font-medium text-gray-900 dark:text-gray-100">
                                    KSh {{ number_format($bill->water_charge, 2) }}
                                </span>

                            </div>


                            <div class="border-t border-gray-200 dark:border-gray-600 pt-3 flex justify-between items-center">

                                <span class="font-semibold text-gray-900 dark:text-gray-100">
                                    Current Balance
                                </span>

                                <span class="text-lg font-bold text-blue-600 dark:text-blue-400">
                                    KSh {{ number_format($bill->balance, 2) }}
                                </span>

                            </div>

                        </div>

                    </div>


                    {{-- Actions --}}
                    <div class="flex flex-col sm:flex-row sm:justify-between gap-3">

                        <a
                            href="{{ route('bills.show', $bill) }}"
                            class="inline-flex justify-center items-center px-5 py-2.5 rounded-lg border border-gray-300 dark:border-gray-600 text-sm font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700"
                        >
                            Cancel
                        </a>


                        <button
                            type="submit"
                            class="inline-flex justify-center items-center px-5 py-2.5 rounded-lg bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold shadow-sm"
                        >
                            Save Changes
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</x-app-layout>