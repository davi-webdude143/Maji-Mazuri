<x-app-layout>

    <x-slot name="header">
        <div>
            <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-100">
                Generate Water Bill
            </h2>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                Generate a bill from a customer's meter reading
            </p>
        </div>
    </x-slot>

    <div class="py-8 bg-gray-100 dark:bg-gray-950 min-h-screen">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Validation Errors --}}
            @if($errors->any())
                <div class="mb-6 bg-red-50 dark:bg-red-900/30 border border-red-200 dark:border-red-800 rounded-xl p-5">
                    <h3 class="font-semibold text-red-700 dark:text-red-300 mb-2">
                        Please correct the following:
                    </h3>

                    <ul class="list-disc list-inside text-sm text-red-600 dark:text-red-400">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Form Container --}}
            <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-800">

                {{-- Header --}}
                <div class="p-6 border-b border-gray-200 dark:border-gray-800">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white">
                        Billing Information
                    </h3>

                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                        Select a meter reading and enter any previous balance before generating the bill.
                    </p>
                </div>

                {{-- Form --}}
                <form method="POST" action="{{ route('bills.store') }}" class="p-6 space-y-6">
                    @csrf

                    {{-- Meter Reading --}}
                    <div>
                        <label
                            for="meter_reading_id"
                            class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                            Meter Reading
                        </label>

                        <select
                            name="meter_reading_id"
                            id="meter_reading_id"
                            required
                            class="w-full rounded-xl border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white focus:border-blue-500 focus:ring-blue-500">

                            <option value="">
                                -- Select Meter Reading --
                            </option>

                            @forelse($readings as $reading)

                                <option
                                    value="{{ $reading->id }}"
                                    data-consumption="{{ $reading->consumption }}"
                                    data-customer="{{ $reading->meter->customer->full_name }}"
                                    data-meter="{{ $reading->meter->meter_number }}"
                                    {{ old('meter_reading_id') == $reading->id ? 'selected' : '' }}>

                                    {{ $reading->meter->customer->full_name }}
                                    —
                                    Meter {{ $reading->meter->meter_number }}
                                    —
                                    {{ \Carbon\Carbon::parse($reading->reading_date)->format('d M Y') }}
                                    —
                                    {{ number_format($reading->consumption, 2) }} units

                                </option>

                            @empty

                                <option value="" disabled>
                                    No unbilled meter readings available
                                </option>

                            @endforelse

                        </select>
                    </div>


                    {{-- Selected Reading Information --}}
                    <div
                        id="reading-info"
                        class="hidden bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-xl p-5">

                        <h4 class="font-semibold text-blue-800 dark:text-blue-300 mb-4">
                            Selected Reading
                        </h4>

                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">

                            {{-- Customer --}}
                            <div>
                                <p class="text-xs text-gray-500 dark:text-gray-400">
                                    Customer
                                </p>

                                <p
                                    id="customer-name"
                                    class="font-semibold text-gray-800 dark:text-white">
                                </p>
                            </div>

                            {{-- Meter --}}
                            <div>
                                <p class="text-xs text-gray-500 dark:text-gray-400">
                                    Meter Number
                                </p>

                                <p
                                    id="meter-number"
                                    class="font-semibold text-gray-800 dark:text-white">
                                </p>
                            </div>

                            {{-- Consumption --}}
                            <div>
                                <p class="text-xs text-gray-500 dark:text-gray-400">
                                    Consumption
                                </p>

                                <p class="font-semibold text-gray-800 dark:text-white">
                                    <span id="consumption-display">
                                        0
                                    </span>
                                    units
                                </p>
                            </div>

                        </div>
                    </div>


                    {{-- Billing Date --}}
                    <div>
                        <label
                            for="billing_date"
                            class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                            Billing Date
                        </label>

                        <input
                            type="date"
                            name="billing_date"
                            id="billing_date"
                            value="{{ old('billing_date', date('Y-m-d')) }}"
                            required
                            class="w-full rounded-xl border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white focus:border-blue-500 focus:ring-blue-500">
                    </div>


                    {{-- Previous Balance --}}
                    <div>
                        <label
                            for="previous_balance"
                            class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">

                            Previous Balance

                        </label>

                        <div class="relative">

                            <span
                                class="absolute left-4 top-1/2 -translate-y-1/2 text-sm font-semibold text-gray-500 dark:text-gray-400">
                                KSh
                            </span>

                            <input
                                type="number"
                                name="previous_balance"
                                id="previous_balance"
                                value="{{ old('previous_balance', '0.00') }}"
                                min="0"
                                step="0.01"
                                placeholder="0.00"
                                class="w-full pl-16 pr-4 py-3 rounded-xl border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white focus:border-blue-500 focus:ring-blue-500">

                        </div>

                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-2">
                            Enter any unpaid balance carried forward from previous bills.
                        </p>
                    </div>


                    {{-- Fixed Water Rate --}}
                    <div>

                        <label
                            class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">

                            Water Rate

                        </label>

                        <div
                            class="rounded-xl border border-blue-200 dark:border-blue-800 bg-blue-50 dark:bg-blue-900/20 px-5 py-4">

                            <div class="flex items-center justify-between">

                                <div>

                                    <p class="text-base font-bold text-blue-900 dark:text-blue-200">
                                        KSh 120.00 per unit
                                    </p>

                                    <p class="text-xs text-blue-600 dark:text-blue-300 mt-1">
                                        Fixed water billing rate
                                    </p>

                                </div>

                                <div class="text-2xl font-extrabold text-blue-600 dark:text-blue-400">
                                    120
                                </div>

                            </div>

                        </div>

                    </div>


                    {{-- Calculation Preview --}}
                    <div class="bg-gray-50 dark:bg-gray-800 rounded-xl p-5">

                        <h4 class="font-semibold text-gray-800 dark:text-white mb-4">
                            Bill Preview
                        </h4>

                        <div class="space-y-3">

                            {{-- Consumption --}}
                            <div class="flex justify-between">

                                <span class="text-gray-600 dark:text-gray-400">
                                    Consumption
                                </span>

                                <span
                                    id="preview-consumption"
                                    class="font-semibold text-gray-800 dark:text-white">
                                    0 units
                                </span>

                            </div>


                            {{-- Fixed Rate --}}
                            <div class="flex justify-between">

                                <span class="text-gray-600 dark:text-gray-400">
                                    Rate per unit
                                </span>

                                <span
                                    id="preview-rate"
                                    class="font-semibold text-gray-800 dark:text-white">
                                    KSh 120.00
                                </span>

                            </div>


                            {{-- Current Water Charge --}}
                            <div class="flex justify-between">

                                <span class="text-gray-600 dark:text-gray-400">
                                    Current Water Charge
                                </span>

                                <span
                                    id="preview-water-charge"
                                    class="font-semibold text-gray-800 dark:text-white">
                                    KSh 0.00
                                </span>

                            </div>


                            {{-- Previous Balance --}}
                            <div class="flex justify-between">

                                <span class="text-gray-600 dark:text-gray-400">
                                    Previous Balance
                                </span>

                                <span
                                    id="preview-previous-balance"
                                    class="font-semibold text-gray-800 dark:text-white">
                                    KSh 0.00
                                </span>

                            </div>


                            {{-- Total Amount Due --}}
                            <div
                                class="border-t border-gray-200 dark:border-gray-700 pt-4 mt-2 flex justify-between items-center">

                                <span class="font-bold text-gray-800 dark:text-white">
                                    Total Amount Due
                                </span>

                                <span
                                    id="preview-total"
                                    class="text-xl font-extrabold text-blue-600 dark:text-blue-400">
                                    KSh 0.00
                                </span>

                            </div>

                        </div>

                    </div>


                    {{-- Explanation --}}
                    <div class="rounded-xl border border-amber-200 dark:border-amber-800 bg-amber-50 dark:bg-amber-900/20 p-4">

                        <div class="flex gap-3">

                            <div class="text-amber-600 dark:text-amber-400 text-lg">
                                ℹ️
                            </div>

                            <div>

                                <p class="font-semibold text-amber-800 dark:text-amber-300">
                                    How the total is calculated
                                </p>

                                <p class="text-sm text-amber-700 dark:text-amber-400 mt-1">
                                    Previous Balance + Current Water Charge = Total Amount Due
                                </p>

                            </div>

                        </div>

                    </div>


                    {{-- Buttons --}}
                    <div class="flex flex-col sm:flex-row gap-3 pt-2">

                        <a
                            href="{{ route('bills.index') }}"
                            class="flex-1 inline-flex justify-center items-center px-5 py-3 rounded-xl border border-gray-300 dark:border-gray-700 text-gray-700 dark:text-gray-300 font-semibold hover:bg-gray-50 dark:hover:bg-gray-800 transition">

                            Cancel

                        </a>

                        <button
                            type="submit"
                            class="flex-1 inline-flex justify-center items-center px-5 py-3 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-semibold transition shadow-sm">

                            💧 Generate Bill

                        </button>

                    </div>

                </form>

            </div>

        </div>
    </div>


    {{-- Bill Calculation JavaScript --}}
    <script>

        const readingSelect =
            document.getElementById('meter_reading_id');

        const readingInfo =
            document.getElementById('reading-info');

        const customerName =
            document.getElementById('customer-name');

        const meterNumber =
            document.getElementById('meter-number');

        const consumptionDisplay =
            document.getElementById('consumption-display');

        const previousBalanceInput =
            document.getElementById('previous_balance');

        const previewConsumption =
            document.getElementById('preview-consumption');

        const previewRate =
            document.getElementById('preview-rate');

        const previewWaterCharge =
            document.getElementById('preview-water-charge');

        const previewPreviousBalance =
            document.getElementById('preview-previous-balance');

        const previewTotal =
            document.getElementById('preview-total');


        // Fixed water rate
        const WATER_RATE = 120.00;


        function formatCurrency(amount)
        {
            return 'KSh ' + amount.toFixed(2);
        }


        function calculateBill()
        {
            const selectedOption =
                readingSelect.options[readingSelect.selectedIndex];


            const consumption =
                parseFloat(
                    selectedOption?.dataset.consumption || 0
                );


            const previousBalance =
                Math.max(
                    0,
                    parseFloat(
                        previousBalanceInput.value || 0
                    )
                );


            const waterCharge =
                consumption * WATER_RATE;


            const totalAmountDue =
                waterCharge + previousBalance;


            previewConsumption.textContent =
                consumption.toFixed(2) + ' units';


            previewRate.textContent =
                formatCurrency(WATER_RATE);


            previewWaterCharge.textContent =
                formatCurrency(waterCharge);


            previewPreviousBalance.textContent =
                formatCurrency(previousBalance);


            previewTotal.textContent =
                formatCurrency(totalAmountDue);
        }


        readingSelect.addEventListener(
            'change',
            function()
            {
                const selectedOption =
                    this.options[this.selectedIndex];


                if (!selectedOption.value)
                {
                    readingInfo.classList.add('hidden');

                    calculateBill();

                    return;
                }


                customerName.textContent =
                    selectedOption.dataset.customer;


                meterNumber.textContent =
                    selectedOption.dataset.meter;


                consumptionDisplay.textContent =
                    parseFloat(
                        selectedOption.dataset.consumption
                    ).toFixed(2);


                readingInfo.classList.remove('hidden');


                calculateBill();
            }
        );


        previousBalanceInput.addEventListener(
            'input',
            calculateBill
        );


        // Show correct preview if a reading
        // was already selected after validation.
        if (readingSelect.value)
        {
            readingSelect.dispatchEvent(
                new Event('change')
            );
        }
        else
        {
            calculateBill();
        }

    </script>

</x-app-layout>