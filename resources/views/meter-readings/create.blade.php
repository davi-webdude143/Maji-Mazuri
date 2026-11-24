<x-app-layout>


<x-slot name="header">
    <div>
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-100">
            Record Meter Reading
        </h2>
        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
            Record the latest water meter reading
        </p>
    </div>
</x-slot>

<div class="py-8 bg-gray-100 dark:bg-gray-950 min-h-screen">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Validation Errors --}}
        @if ($errors->any())
            <div class="mb-6 bg-red-50 dark:bg-red-900/30 border border-red-200 dark:border-red-800 rounded-xl p-5">
                <h3 class="font-semibold text-red-700 dark:text-red-300 mb-2">
                    Please correct the following errors:
                </h3>

                <ul class="list-disc list-inside text-sm text-red-600 dark:text-red-300">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Main Card --}}
        <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-800 overflow-hidden">

            {{-- Header --}}
            <div class="p-6 border-b border-gray-200 dark:border-gray-800">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-xl bg-blue-100 dark:bg-blue-900/40 flex items-center justify-center text-2xl">
                        💧
                    </div>

                    <div>
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-white">
                            New Meter Reading
                        </h3>

                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            Search for a customer or meter, then enter its current reading.
                        </p>
                    </div>
                </div>
            </div>

            {{-- Form --}}
            <form method="POST" action="{{ route('meter-readings.store') }}">
                @csrf

                <div class="p-6 space-y-6">

                    {{-- Customer / Meter Search --}}
                    <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-xl p-5">

                        <div class="flex items-start gap-3 mb-4">
                            <div class="text-xl">
                                🔎
                            </div>

                            <div>
                                <h4 class="font-semibold text-blue-800 dark:text-blue-300">
                                    Find Customer or Meter
                                </h4>

                                <p class="text-sm text-blue-700 dark:text-blue-400 mt-1">
                                    Search using customer number, customer name, phone number or meter number.
                                </p>
                            </div>
                        </div>

                        <div class="flex flex-col sm:flex-row gap-3">

                            <input
                                type="text"
                                id="meter-search"
                                value="{{ $search ?? '' }}"
                                placeholder="e.g. M0576, customer name, 0756..., MTR-0030"
                                class="flex-1 rounded-xl border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white focus:border-blue-500 focus:ring-blue-500"
                                autocomplete="off"
                            >

                            <button
                                type="button"
                                id="search-meter-button"
                                class="inline-flex justify-center items-center px-5 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-semibold transition shadow-sm"
                            >
                                Search
                            </button>

                            <button
                                type="button"
                                id="clear-meter-search"
                                class="inline-flex justify-center items-center px-5 py-2.5 rounded-xl border border-gray-300 dark:border-gray-700 text-gray-700 dark:text-gray-300 font-semibold hover:bg-gray-100 dark:hover:bg-gray-800 transition"
                            >
                                Clear
                            </button>

                        </div>

                        {{-- Search Result Count --}}
                        <p
                            id="search-result-count"
                            class="text-xs text-gray-500 dark:text-gray-400 mt-3"
                        >
                            {{ $meters->count() }} active meter(s) available.
                        </p>

                        {{-- Search Results --}}
                        <div
                            id="search-results"
                            class="mt-4 space-y-3"
                        ></div>

                    </div>

                    {{-- Water Meter --}}
                    <div>
                        <label
                            for="meter_id"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2"
                        >
                            Water Meter
                            <span class="text-red-500">*</span>
                        </label>

                        <select
                            id="meter_id"
                            name="meter_id"
                            required
                            class="w-full rounded-xl border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white focus:border-blue-500 focus:ring-blue-500"
                        >

                            <option value="">
                                Select a meter
                            </option>

                            @foreach($meters as $meter)
                                <option
                                    value="{{ $meter->id }}"
                                    data-previous="{{ $meter->current_reading }}"
                                    data-maximum="{{ $meter->maximum_reading }}"
                                    data-customer-number="{{ $meter->customer->customer_number ?? '' }}"
                                    data-customer-name="{{ $meter->customer->full_name ?? '' }}"
                                    data-phone="{{ $meter->customer->phone_number ?? '' }}"
                                    data-meter-number="{{ $meter->meter_number }}"
                                    data-search="{{ strtolower(
                                        ($meter->meter_number ?? '') . ' ' .
                                        ($meter->customer->customer_number ?? '') . ' ' .
                                        ($meter->customer->full_name ?? '') . ' ' .
                                        ($meter->customer->phone_number ?? '')
                                    ) }}"
                                    {{ old('meter_id') == $meter->id ? 'selected' : '' }}
                                >
                                    {{ $meter->customer->customer_number ?? 'No customer number' }}
                                    —
                                    {{ $meter->customer->full_name ?? 'No customer' }}
                                    —
                                    {{ $meter->meter_number }}
                                </option>
                            @endforeach

                        </select>

                        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                            Select the customer found by the search above.
                        </p>
                    </div>

                    {{-- Selected Customer Confirmation --}}
                    <div
                        id="selected-customer-card"
                        class="hidden bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-xl p-5"
                    >

                        <div class="flex items-start gap-3">

                            <div class="text-xl">
                                ✅
                            </div>

                            <div class="flex-1">

                                <h4 class="font-semibold text-green-800 dark:text-green-300">
                                    Customer Selected
                                </h4>

                                <div class="mt-3 grid grid-cols-1 sm:grid-cols-2 gap-4">

                                    <div>
                                        <p class="text-xs text-green-600 dark:text-green-400">
                                            Customer Number
                                        </p>

                                        <p
                                            id="selected-customer-number"
                                            class="font-bold text-green-800 dark:text-green-200"
                                        >
                                            —
                                        </p>
                                    </div>

                                    <div>
                                        <p class="text-xs text-green-600 dark:text-green-400">
                                            Customer Name
                                        </p>

                                        <p
                                            id="selected-customer-name"
                                            class="font-bold text-green-800 dark:text-green-200"
                                        >
                                            —
                                        </p>
                                    </div>

                                    <div>
                                        <p class="text-xs text-green-600 dark:text-green-400">
                                            Phone Number
                                        </p>

                                        <p
                                            id="selected-customer-phone"
                                            class="font-bold text-green-800 dark:text-green-200"
                                        >
                                            —
                                        </p>
                                    </div>

                                    <div>
                                        <p class="text-xs text-green-600 dark:text-green-400">
                                            Meter Number
                                        </p>

                                        <p
                                            id="selected-meter-number"
                                            class="font-bold text-green-800 dark:text-green-200"
                                        >
                                            —
                                        </p>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>

                    {{-- Meter Information --}}
                    <div
                        id="meter-info"
                        class="hidden bg-gray-50 dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-5"
                    >

                        <h4 class="font-semibold text-gray-800 dark:text-white mb-4">
                            Meter Information
                        </h4>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">

                            <div>
                                <p class="text-xs text-gray-500 dark:text-gray-400">
                                    Previous Reading
                                </p>

                                <p
                                    id="previous-reading-display"
                                    class="text-lg font-bold text-gray-800 dark:text-white"
                                >
                                    0.00
                                </p>
                            </div>

                            <div>
                                <p class="text-xs text-gray-500 dark:text-gray-400">
                                    Maximum Meter Reading
                                </p>

                                <p
                                    id="maximum-reading-display"
                                    class="text-lg font-bold text-gray-800 dark:text-white"
                                >
                                    Not configured
                                </p>
                            </div>

                        </div>
                    </div>

                    {{-- Reading Date --}}
                    <div>
                        <label
                            for="reading_date"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2"
                        >
                            Reading Date
                            <span class="text-red-500">*</span>
                        </label>

                        <input
                            type="date"
                            id="reading_date"
                            name="reading_date"
                            value="{{ old('reading_date', date('Y-m-d')) }}"
                            required
                            class="w-full rounded-xl border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white focus:border-blue-500 focus:ring-blue-500"
                        >
                    </div>

                    {{-- Current Reading --}}
                    <div>
                        <label
                            for="current_reading"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2"
                        >
                            Current Meter Reading
                            <span class="text-red-500">*</span>
                        </label>

                        <input
                            type="number"
                            step="0.01"
                            min="0"
                            id="current_reading"
                            name="current_reading"
                            value="{{ old('current_reading') }}"
                            required
                            placeholder="Enter current meter reading"
                            class="w-full rounded-xl border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white focus:border-blue-500 focus:ring-blue-500"
                        >

                        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                            Enter the number currently displayed on the water meter.
                        </p>
                    </div>

                    {{-- Consumption Preview --}}
                    <div
                        id="consumption-preview"
                        class="hidden bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-xl p-5"
                    >

                        <h4 class="font-semibold text-blue-800 dark:text-blue-300 mb-4">
                            Consumption Preview
                        </h4>

                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">

                            <div>
                                <p class="text-xs text-gray-500 dark:text-gray-400">
                                    Previous
                                </p>

                                <p
                                    id="preview-previous"
                                    class="font-bold text-gray-800 dark:text-white"
                                >
                                    0.00
                                </p>
                            </div>

                            <div>
                                <p class="text-xs text-gray-500 dark:text-gray-400">
                                    Current
                                </p>

                                <p
                                    id="preview-current"
                                    class="font-bold text-gray-800 dark:text-white"
                                >
                                    0.00
                                </p>
                            </div>

                            <div>
                                <p class="text-xs text-gray-500 dark:text-gray-400">
                                    Consumption
                                </p>

                                <p
                                    id="preview-consumption"
                                    class="font-bold text-blue-600 dark:text-blue-400"
                                >
                                    0.00 units
                                </p>
                            </div>

                        </div>
                    </div>

                    {{-- Exceptional Reading --}}
                    <div class="border border-gray-200 dark:border-gray-700 rounded-xl p-5">

                        <div class="flex items-start gap-3">

                            <input
                                type="checkbox"
                                id="is_exception"
                                name="is_exception"
                                value="1"
                                {{ old('is_exception') ? 'checked' : '' }}
                                class="mt-1 rounded border-gray-300 text-blue-600 focus:ring-blue-500"
                            >

                            <div>

                                <label
                                    for="is_exception"
                                    class="font-semibold text-gray-800 dark:text-white cursor-pointer"
                                >
                                    Exceptional / Unusual Meter Reading
                                </label>

                                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                                    Use this when the reading is affected by a meter problem,
                                    replacement, reset or incorrect previous reading.
                                </p>

                            </div>

                        </div>

                        <div
                            id="exception-options"
                            class="hidden mt-5"
                        >

                            <label
                                for="exception_type"
                                class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2"
                            >
                                Reason for Exception
                            </label>

                            <select
                                name="exception_type"
                                id="exception_type"
                                class="w-full rounded-xl border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white focus:border-blue-500 focus:ring-blue-500"
                            >

                                <option value="">
                                    Select exception reason
                                </option>

                                <option
                                    value="meter_replaced"
                                    {{ old('exception_type') == 'meter_replaced' ? 'selected' : '' }}
                                >
                                    Meter replaced
                                </option>

                                <option
                                    value="meter_reset"
                                    {{ old('exception_type') == 'meter_reset' ? 'selected' : '' }}
                                >
                                    Meter reset / rolled over
                                </option>

                                <option
                                    value="faulty_meter"
                                    {{ old('exception_type') == 'faulty_meter' ? 'selected' : '' }}
                                >
                                    Faulty meter
                                </option>

                                <option
                                    value="incorrect_previous_reading"
                                    {{ old('exception_type') == 'incorrect_previous_reading' ? 'selected' : '' }}
                                >
                                    Incorrect previous reading
                                </option>

                            </select>

                            <div class="mt-5">

                                <label
                                    for="exception_notes"
                                    class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2"
                                >
                                    Exception Notes
                                </label>

                                <textarea
                                    name="exception_notes"
                                    id="exception_notes"
                                    rows="4"
                                    maxlength="1000"
                                    placeholder="Explain what happened or provide any relevant details..."
                                    class="w-full rounded-xl border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white focus:border-blue-500 focus:ring-blue-500"
                                >{{ old('exception_notes') }}</textarea>

                                <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                                    Required when selecting "Incorrect previous reading".
                                </p>

                            </div>

                        </div>
                    </div>

                    {{-- Abnormal Consumption Warning --}}
                    <div
                        id="abnormal-warning"
                        class="hidden bg-amber-50 dark:bg-amber-900/20 border border-amber-300 dark:border-amber-800 rounded-xl p-5"
                    >

                        <div class="flex gap-3">

                            <div class="text-2xl">
                                ⚠️
                            </div>

                            <div>

                                <h4 class="font-semibold text-amber-800 dark:text-amber-300">
                                    Unusual Consumption Detected
                                </h4>

                                <p class="text-sm text-amber-700 dark:text-amber-400 mt-1">
                                    The calculated consumption is unusually high compared
                                    with a normal monthly reading.
                                </p>

                                <p
                                    id="abnormal-message"
                                    class="text-sm font-semibold text-amber-800 dark:text-amber-300 mt-2"
                                ></p>

                                <p class="text-xs text-amber-700 dark:text-amber-400 mt-2">
                                    Please verify the meter reading before saving.
                                </p>

                            </div>

                        </div>
                    </div>

                    {{-- Rollover Information --}}
                    <div
                        id="rollover-info"
                        class="hidden bg-purple-50 dark:bg-purple-900/20 border border-purple-200 dark:border-purple-800 rounded-xl p-5"
                    >

                        <div class="flex gap-3">

                            <div class="text-xl">
                                🔄
                            </div>

                            <div>

                                <h4 class="font-semibold text-purple-800 dark:text-purple-300">
                                    Meter Rollover / Reset
                                </h4>

                                <p class="text-sm text-purple-700 dark:text-purple-400 mt-1">
                                    The current reading is lower than the previous reading.
                                    If the meter has rolled over or been reset, select
                                    <strong>Meter reset / rolled over</strong> above.
                                </p>

                            </div>

                        </div>
                    </div>

                    {{-- Information Box --}}
                    <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-xl p-4">

                        <div class="flex gap-3">

                            <div class="text-xl">
                                ℹ️
                            </div>

                            <div>

                                <h4 class="font-semibold text-blue-800 dark:text-blue-300">
                                    Consumption Calculation
                                </h4>

                                <p class="text-sm text-blue-700 dark:text-blue-400 mt-1">
                                    The system calculates normal consumption using:
                                </p>

                                <p class="text-sm font-semibold text-blue-800 dark:text-blue-300 mt-2">
                                    Current Reading − Previous Reading = Consumption
                                </p>

                            </div>

                        </div>
                    </div>

                </div>

                {{-- Buttons --}}
                <div class="px-6 py-5 bg-gray-50 dark:bg-gray-800/50 border-t border-gray-200 dark:border-gray-800 flex flex-col sm:flex-row justify-end gap-3">

                    <a
                        href="{{ route('meter-readings.index') }}"
                        class="inline-flex justify-center items-center px-5 py-2.5 rounded-xl border border-gray-300 dark:border-gray-700 text-gray-700 dark:text-gray-300 font-semibold hover:bg-gray-100 dark:hover:bg-gray-800 transition"
                    >
                        Cancel
                    </a>

                    <button
                        type="submit"
                        class="inline-flex justify-center items-center px-6 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-semibold transition shadow-sm"
                    >
                        Save Reading
                    </button>

                </div>

            </form>
        </div>
    </div>
</div>

{{-- Meter Reading JavaScript --}}
<script>

    const meterSelect =
        document.getElementById('meter_id');

    const currentInput =
        document.getElementById('current_reading');

    const meterInfo =
        document.getElementById('meter-info');

    const previousDisplay =
        document.getElementById('previous-reading-display');

    const maximumDisplay =
        document.getElementById('maximum-reading-display');

    const consumptionPreview =
        document.getElementById('consumption-preview');

    const previewPrevious =
        document.getElementById('preview-previous');

    const previewCurrent =
        document.getElementById('preview-current');

    const previewConsumption =
        document.getElementById('preview-consumption');

    const exceptionCheckbox =
        document.getElementById('is_exception');

    const exceptionOptions =
        document.getElementById('exception-options');

    const exceptionType =
        document.getElementById('exception_type');

    const abnormalWarning =
        document.getElementById('abnormal-warning');

    const abnormalMessage =
        document.getElementById('abnormal-message');

    const rolloverInfo =
        document.getElementById('rollover-info');

    const meterSearch =
        document.getElementById('meter-search');

    const searchButton =
        document.getElementById('search-meter-button');

    const clearSearchButton =
        document.getElementById('clear-meter-search');

    const searchResultCount =
        document.getElementById('search-result-count');

    const searchResults =
        document.getElementById('search-results');

    const selectedCustomerCard =
        document.getElementById('selected-customer-card');

    const selectedCustomerNumber =
        document.getElementById('selected-customer-number');

    const selectedCustomerName =
        document.getElementById('selected-customer-name');

    const selectedCustomerPhone =
        document.getElementById('selected-customer-phone');

    const selectedMeterNumber =
        document.getElementById('selected-meter-number');

    const allMeterOptions =
        Array.from(meterSelect.options).filter(function(option) {
            return option.value !== '';
        });

    const ABNORMAL_THRESHOLD = 100;


    /*
    |--------------------------------------------------------------------------
    | Escape HTML
    |--------------------------------------------------------------------------
    */

    function escapeHtml(value)
    {
        return String(value ?? '')
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;')
            .replace(/'/g, '&#039;');
    }


    /*
    |--------------------------------------------------------------------------
    | Search Customers / Meters
    |--------------------------------------------------------------------------
    */

    function searchMeters()
    {
        const searchTerm =
            meterSearch.value.trim().toLowerCase();

        searchResults.innerHTML = '';

        if (searchTerm === '')
        {
            searchResultCount.textContent =
                allMeterOptions.length +
                ' active meter(s) available.';

            return;
        }

        const matches =
            allMeterOptions.filter(function(option)
            {
                const searchableText =
                    option.dataset.search || '';

                return searchableText.includes(searchTerm);
            });


        searchResultCount.textContent =
            matches.length +
            ' matching active meter(s) found.';


        if (matches.length === 0)
        {
            searchResults.innerHTML = `
                <div class="bg-white dark:bg-gray-900 border border-red-200 dark:border-red-800 rounded-xl p-4">
                    <div class="flex items-center gap-3">
                        <div class="text-xl">❌</div>

                        <div>
                            <p class="font-semibold text-red-700 dark:text-red-300">
                                Customer or meter not found
                            </p>

                            <p class="text-sm text-red-600 dark:text-red-400 mt-1">
                                Try the customer number, customer name,
                                phone number or meter number.
                            </p>
                        </div>
                    </div>
                </div>
            `;

            return;
        }


        matches.forEach(function(option)
        {
            const customerNumber =
                option.dataset.customerNumber || 'No customer number';

            const customerName =
                option.dataset.customerName || 'No customer';

            const phone =
                option.dataset.phone || 'No phone number';

            const meterNumber =
                option.dataset.meterNumber || 'No meter number';

            const previous =
                parseFloat(option.dataset.previous || 0);


            const resultCard =
                document.createElement('div');

            resultCard.className =
                'bg-white dark:bg-gray-900 border border-blue-200 dark:border-blue-800 rounded-xl p-4 shadow-sm';


            resultCard.innerHTML = `
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

                    <div class="flex-1">

                        <div class="flex items-center gap-2">
                            <span class="text-lg">👤</span>

                            <p class="font-bold text-gray-800 dark:text-white">
                                ${escapeHtml(customerNumber)}
                                —
                                ${escapeHtml(customerName)}
                            </p>
                        </div>

                        <div class="mt-3 grid grid-cols-1 sm:grid-cols-3 gap-3">

                            <div>
                                <p class="text-xs text-gray-500 dark:text-gray-400">
                                    Phone
                                </p>

                                <p class="text-sm font-semibold text-gray-700 dark:text-gray-300">
                                    ${escapeHtml(phone)}
                                </p>
                            </div>

                            <div>
                                <p class="text-xs text-gray-500 dark:text-gray-400">
                                    Meter
                                </p>

                                <p class="text-sm font-semibold text-gray-700 dark:text-gray-300">
                                    ${escapeHtml(meterNumber)}
                                </p>
                            </div>

                            <div>
                                <p class="text-xs text-gray-500 dark:text-gray-400">
                                    Previous Reading
                                </p>

                                <p class="text-sm font-semibold text-gray-700 dark:text-gray-300">
                                    ${previous.toFixed(2)}
                                </p>
                            </div>

                        </div>

                    </div>

                    <button
                        type="button"
                        class="select-customer-button inline-flex justify-center items-center px-4 py-2.5 rounded-xl bg-green-600 hover:bg-green-700 text-white font-semibold transition"
                    >
                        Select Customer
                    </button>

                </div>
            `;


            const selectButton =
                resultCard.querySelector('.select-customer-button');


            selectButton.addEventListener(
                'click',
                function()
                {
                    meterSelect.value =
                        option.value;

                    updateSelectedCustomer();

                    updateMeterInformation();

                    searchResults.innerHTML = `
                        <div class="bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-xl p-4">
                            <div class="flex items-center gap-3">
                                <div class="text-xl">✅</div>

                                <div>
                                    <p class="font-semibold text-green-700 dark:text-green-300">
                                        Customer selected successfully.
                                    </p>

                                    <p class="text-sm text-green-600 dark:text-green-400 mt-1">
                                        You can now enter the current meter reading below.
                                    </p>
                                </div>
                            </div>
                        </div>
                    `;

                    meterSelect.scrollIntoView({
                        behavior: 'smooth',
                        block: 'center'
                    });
                }
            );


            searchResults.appendChild(resultCard);
        });
    }


    /*
    |--------------------------------------------------------------------------
    | Clear Search
    |--------------------------------------------------------------------------
    */

    function clearSearch()
    {
        meterSearch.value = '';

        searchResults.innerHTML = '';

        searchResultCount.textContent =
            allMeterOptions.length +
            ' active meter(s) available.';

        meterSelect.value = '';

        selectedCustomerCard.classList.add('hidden');

        updateMeterInformation();
    }


    /*
    |--------------------------------------------------------------------------
    | Selected Customer Information
    |--------------------------------------------------------------------------
    */

    function updateSelectedCustomer()
    {
        const option =
            meterSelect.options[meterSelect.selectedIndex];


        if (!option || !option.value)
        {
            selectedCustomerCard.classList.add('hidden');

            return;
        }


        selectedCustomerNumber.textContent =
            option.dataset.customerNumber ||
            'No customer number';

        selectedCustomerName.textContent =
            option.dataset.customerName ||
            'No customer';

        selectedCustomerPhone.textContent =
            option.dataset.phone ||
            'No phone number';

        selectedMeterNumber.textContent =
            option.dataset.meterNumber ||
            'No meter number';


        selectedCustomerCard.classList.remove('hidden');
    }


    /*
    |--------------------------------------------------------------------------
    | Meter Information
    |--------------------------------------------------------------------------
    */

    function getMeterData()
    {
        const option =
            meterSelect.options[meterSelect.selectedIndex];


        if (!option || !option.value)
        {
            return {
                previous: 0,
                maximum: null
            };
        }


        return {
            previous:
                parseFloat(option.dataset.previous || 0),

            maximum:
                option.dataset.maximum
                    ? parseFloat(option.dataset.maximum)
                    : null
        };
    }


    function updateMeterInformation()
    {
        const data =
            getMeterData();


        if (!meterSelect.value)
        {
            meterInfo.classList.add('hidden');

            selectedCustomerCard.classList.add('hidden');

            return;
        }


        meterInfo.classList.remove('hidden');


        previousDisplay.textContent =
            data.previous.toFixed(2);


        if (data.maximum !== null)
        {
            maximumDisplay.textContent =
                data.maximum.toFixed(2) +
                ' units';
        }
        else
        {
            maximumDisplay.textContent =
                'Not configured';
        }


        updateSelectedCustomer();

        calculateConsumption();
    }


    /*
    |--------------------------------------------------------------------------
    | Consumption Calculation
    |--------------------------------------------------------------------------
    */

    function calculateConsumption()
    {
        const data =
            getMeterData();


        const current =
            parseFloat(currentInput.value || 0);


        if (!meterSelect.value || !currentInput.value)
        {
            consumptionPreview.classList.add('hidden');

            abnormalWarning.classList.add('hidden');

            rolloverInfo.classList.add('hidden');

            return;
        }


        const previous =
            data.previous;


        const consumption =
            current - previous;


        consumptionPreview.classList.remove('hidden');


        previewPrevious.textContent =
            previous.toFixed(2);


        previewCurrent.textContent =
            current.toFixed(2);


        if (consumption >= 0)
        {
            previewConsumption.textContent =
                consumption.toFixed(2) +
                ' units';
        }
        else
        {
            previewConsumption.textContent =
                'Reading decreased';
        }


        if (consumption < 0)
        {
            rolloverInfo.classList.remove('hidden');
        }
        else
        {
            rolloverInfo.classList.add('hidden');
        }


        if (consumption >= ABNORMAL_THRESHOLD)
        {
            abnormalWarning.classList.remove('hidden');

            abnormalMessage.textContent =
                'Calculated consumption: ' +
                consumption.toFixed(2) +
                ' units.';
        }
        else
        {
            abnormalWarning.classList.add('hidden');
        }


        if (
            exceptionCheckbox.checked &&
            exceptionType.value === 'meter_reset'
        )
        {
            rolloverInfo.classList.add('hidden');
        }
    }


    /*
    |--------------------------------------------------------------------------
    | Search Events
    |--------------------------------------------------------------------------
    */

    searchButton.addEventListener(
        'click',
        searchMeters
    );


    clearSearchButton.addEventListener(
        'click',
        clearSearch
    );


    meterSearch.addEventListener(
        'keydown',
        function(event)
        {
            if (event.key === 'Enter')
            {
                event.preventDefault();

                searchMeters();
            }
        }
    );


    /*
    |--------------------------------------------------------------------------
    | Meter Selection
    |--------------------------------------------------------------------------
    */

    meterSelect.addEventListener(
        'change',
        function()
        {
            updateSelectedCustomer();

            updateMeterInformation();
        }
    );


    /*
    |--------------------------------------------------------------------------
    | Current Reading
    |--------------------------------------------------------------------------
    */

    currentInput.addEventListener(
        'input',
        calculateConsumption
    );


    /*
    |--------------------------------------------------------------------------
    | Exceptional Reading
    |--------------------------------------------------------------------------
    */

    exceptionCheckbox.addEventListener(
        'change',
        function()
        {
            if (this.checked)
            {
                exceptionOptions.classList.remove('hidden');
            }
            else
            {
                exceptionOptions.classList.add('hidden');

                exceptionType.value = '';
            }

            calculateConsumption();
        }
    );


    /*
    |--------------------------------------------------------------------------
    | Exception Type
    |--------------------------------------------------------------------------
    */

    exceptionType.addEventListener(
        'change',
        calculateConsumption
    );


    /*
    |--------------------------------------------------------------------------
    | Restore Values After Validation Error
    |--------------------------------------------------------------------------
    */

    if (meterSelect.value)
    {
        updateSelectedCustomer();

        updateMeterInformation();
    }


    if (exceptionCheckbox.checked)
    {
        exceptionOptions.classList.remove('hidden');
    }


    if (currentInput.value)
    {
        calculateConsumption();
    }


    /*
    |--------------------------------------------------------------------------
    | Initial Search
    |--------------------------------------------------------------------------
    */

    if (meterSearch.value.trim() !== '')
    {
        searchMeters();
    }

</script>


</x-app-layout>
