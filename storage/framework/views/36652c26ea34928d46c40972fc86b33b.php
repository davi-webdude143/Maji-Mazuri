<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>

     <?php $__env->slot('header', null, []); ?> 
        <div>
            <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-100">
                Generate Water Bill
            </h2>

            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                Generate a bill from a customer's meter reading
            </p>
        </div>
     <?php $__env->endSlot(); ?>


    <div class="py-8 bg-gray-100 dark:bg-gray-950 min-h-screen">

        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($errors->any()): ?>
                <div
                    class="mb-6 bg-red-50 dark:bg-red-900/30 border border-red-200 dark:border-red-800 rounded-xl p-5">

                    <h3 class="font-semibold text-red-700 dark:text-red-300 mb-2">
                        Please correct the following:
                    </h3>

                    <ul class="list-disc list-inside text-sm text-red-600 dark:text-red-400">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </ul>

                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>


            
            <div
                class="bg-white dark:bg-gray-900 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-800">

                
                <div class="p-6 border-b border-gray-200 dark:border-gray-800">

                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white">
                        Billing Information
                    </h3>

                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                        Search for a customer, account number, or meter and select the reading to generate the bill.
                    </p>

                </div>


                
                <form
                    method="POST"
                    action="<?php echo e(route('bills.store')); ?>"
                    class="p-6 space-y-6">

                    <?php echo csrf_field(); ?>


                    
                    <div>

                        <label
                            for="reading-search"
                            class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">

                            Customer / Meter Reading

                        </label>


                        
                        <input
                            type="hidden"
                            name="meter_reading_id"
                            id="meter_reading_id"
                            value="<?php echo e(old('meter_reading_id')); ?>">


                        
                        <div class="relative">

                            <div
                                class="flex items-center w-full overflow-hidden rounded-xl border border-gray-300 bg-white shadow-sm transition focus-within:border-blue-500 focus-within:ring-2 focus-within:ring-blue-500/30 dark:border-gray-700 dark:bg-gray-800">

                                
                                <div
                                    class="pointer-events-none flex items-center justify-center pl-4 text-gray-400 dark:text-gray-500">

                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="h-5 w-5"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                        stroke-width="2">

                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="m21 21-4.35-4.35m1.35-5.15a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0Z" />

                                    </svg>

                                </div>


                                
                                <input
                                    type="text"
                                    id="reading-search"
                                    autocomplete="off"
                                    spellcheck="false"
                                    placeholder="Search customer name, account number or meter..."
                                    aria-controls="reading-results"
                                    class="min-w-0 flex-1 border-0 bg-white px-3 py-3 text-sm font-medium text-gray-900 placeholder-gray-400 placeholder:font-normal focus:border-transparent focus:outline-none focus:ring-0 dark:bg-gray-800 dark:text-white dark:placeholder-gray-500">


                                
                                <button
                                    type="button"
                                    id="clear-reading"
                                    class="hidden mr-2 rounded-lg p-2 text-gray-400 transition hover:bg-gray-100 hover:text-gray-600 dark:hover:bg-gray-700 dark:hover:text-gray-200"
                                    aria-label="Clear customer selection">

                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="h-5 w-5"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor">

                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M6 18 18 6M6 6l12 12" />

                                    </svg>

                                </button>

                            </div>


                            
                            <div
                                id="reading-results"
                                class="hidden absolute z-50 mt-2 w-full max-h-80 overflow-y-auto overflow-hidden rounded-xl border border-gray-200 bg-white shadow-xl dark:border-gray-700 dark:bg-gray-800">

                            </div>

                        </div>


                        
                        <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">

                            Search by customer name, account number such as
                            <span class="font-semibold">M0565</span>,
                            or meter number such as
                            <span class="font-semibold">MTR-0001</span>.

                        </p>


                        
                        <div
                            id="no-reading-results"
                            class="hidden mt-3 rounded-xl border border-amber-200 bg-amber-50 px-4 py-3 text-sm text-amber-700 dark:border-amber-800 dark:bg-amber-900/20 dark:text-amber-300">

                            No matching unbilled meter reading found.

                        </div>

                    </div>


                    
                    <div
                        id="reading-info"
                        class="hidden bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-xl p-5">

                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-4">

                            <h4 class="font-semibold text-blue-800 dark:text-blue-300">
                                Selected Reading
                            </h4>

                            <span
                                class="inline-flex w-fit items-center rounded-full bg-blue-100 px-3 py-1 text-xs font-semibold text-blue-700 dark:bg-blue-900/40 dark:text-blue-300">

                                Ready for Billing

                            </span>

                        </div>


                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">

                            
                            <div>

                                <p class="text-xs text-gray-500 dark:text-gray-400">
                                    Customer
                                </p>

                                <p
                                    id="customer-name"
                                    class="font-semibold text-gray-800 dark:text-white mt-1">
                                </p>

                            </div>


                            
                            <div>

                                <p class="text-xs text-gray-500 dark:text-gray-400">
                                    Account Number
                                </p>

                                <p
                                    id="customer-number"
                                    class="font-semibold text-gray-800 dark:text-white mt-1">
                                </p>

                            </div>


                            
                            <div>

                                <p class="text-xs text-gray-500 dark:text-gray-400">
                                    Meter Number
                                </p>

                                <p
                                    id="meter-number"
                                    class="font-semibold text-gray-800 dark:text-white mt-1">
                                </p>

                            </div>


                            
                            <div>

                                <p class="text-xs text-gray-500 dark:text-gray-400">
                                    Consumption
                                </p>

                                <p class="font-semibold text-gray-800 dark:text-white mt-1">

                                    <span id="consumption-display">
                                        0
                                    </span>

                                    units

                                </p>

                            </div>

                        </div>

                    </div>


                    
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
                            value="<?php echo e(old('billing_date', date('Y-m-d'))); ?>"
                            required
                            class="w-full rounded-xl border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white focus:border-blue-500 focus:ring-blue-500">

                    </div>


                    
                    <div>

                        <label
                            for="previous_balance"
                            class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">

                            Previous Balance

                        </label>


                        <div
                            class="flex w-full overflow-hidden rounded-xl border border-gray-300 bg-white shadow-sm transition focus-within:border-blue-500 focus-within:ring-2 focus-within:ring-blue-500/30 dark:border-gray-700 dark:bg-gray-800">

                            
                            <div
                                class="flex items-center border-r border-gray-300 bg-gray-50 px-4 text-sm font-semibold text-gray-600 dark:border-gray-700 dark:bg-gray-700 dark:text-gray-200">

                                KSh

                            </div>


                            
                            <input
                                type="number"
                                name="previous_balance"
                                id="previous_balance"
                                value="<?php echo e(old('previous_balance', '0.00')); ?>"
                                min="0"
                                step="0.01"
                                inputmode="decimal"
                                placeholder="0.00"
                                class="min-w-0 flex-1 border-0 bg-white px-4 py-3 text-base font-medium tabular-nums text-gray-900 placeholder-gray-400 focus:border-transparent focus:outline-none focus:ring-0 dark:bg-gray-800 dark:text-white dark:placeholder-gray-500 dark:[color-scheme:dark] [appearance:textfield] [&::-webkit-inner-spin-button]:appearance-none [&::-webkit-outer-spin-button]:appearance-none">

                        </div>


                        <div
                            class="mt-3 rounded-lg border border-blue-200 bg-blue-50 px-3 py-3 dark:border-blue-800 dark:bg-blue-900/20">

                            <p class="text-xs leading-5 text-blue-700 dark:text-blue-300">

                                <span class="font-semibold">
                                    Automatic carry-forward:
                                </span>

                                If this customer already has unpaid or partially paid bills,
                                the system will automatically carry their outstanding balance
                                into this new bill.

                            </p>

                            <p class="text-xs leading-5 text-blue-600 dark:text-blue-400 mt-1">

                                This field is only used as a manual fallback when the customer
                                has no active outstanding bills.

                            </p>

                        </div>

                    </div>


                    
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


                                <div
                                    class="text-2xl font-extrabold text-blue-600 dark:text-blue-400">

                                    120

                                </div>

                            </div>

                        </div>

                    </div>


                    
                    <div class="bg-gray-50 dark:bg-gray-800 rounded-xl p-5">

                        <h4 class="font-semibold text-gray-800 dark:text-white mb-4">
                            Bill Preview
                        </h4>


                        <div class="space-y-3">

                            
                            <div class="flex justify-between gap-4">

                                <span class="text-gray-600 dark:text-gray-400">
                                    Consumption
                                </span>

                                <span
                                    id="preview-consumption"
                                    class="font-semibold text-gray-800 dark:text-white">

                                    0 units

                                </span>

                            </div>


                            
                            <div class="flex justify-between gap-4">

                                <span class="text-gray-600 dark:text-gray-400">
                                    Rate per unit
                                </span>

                                <span
                                    id="preview-rate"
                                    class="font-semibold text-gray-800 dark:text-white">

                                    KSh 120.00

                                </span>

                            </div>


                            
                            <div class="flex justify-between gap-4">

                                <span class="text-gray-600 dark:text-gray-400">
                                    Current Water Charge
                                </span>

                                <span
                                    id="preview-water-charge"
                                    class="font-semibold text-gray-800 dark:text-white">

                                    KSh 0.00

                                </span>

                            </div>


                            
                            <div class="flex justify-between gap-4">

                                <span class="text-gray-600 dark:text-gray-400">
                                    Previous Balance
                                </span>

                                <span
                                    id="preview-previous-balance"
                                    class="font-semibold text-gray-800 dark:text-white">

                                    KSh 0.00

                                </span>

                            </div>


                            
                            <div
                                class="border-t border-gray-200 dark:border-gray-700 pt-4 mt-2 flex justify-between items-center gap-4">

                                <div>

                                    <span class="font-bold text-gray-800 dark:text-white">
                                        Total Before Credit
                                    </span>

                                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                        Previous Balance + Current Water Charge
                                    </p>

                                </div>

                                <span
                                    id="preview-total"
                                    class="text-xl font-extrabold text-blue-600 dark:text-blue-400">

                                    KSh 0.00

                                </span>

                            </div>

                        </div>

                    </div>


                    
                    <div
                        class="rounded-xl border border-green-200 dark:border-green-800 bg-green-50 dark:bg-green-900/20 p-4">

                        <div class="flex gap-3">

                            <div class="text-green-600 dark:text-green-400 text-lg">
                                💳
                            </div>

                            <div>

                                <p class="font-semibold text-green-800 dark:text-green-300">
                                    Customer Credit
                                </p>

                                <p class="text-sm text-green-700 dark:text-green-400 mt-1">

                                    If the customer has an existing M-PESA credit balance,
                                    the system will automatically apply it to this bill.
                                    The applied amount will be recorded on the bill and the
                                    customer's remaining credit will be updated.

                                </p>

                            </div>

                        </div>

                    </div>


                    
                    <div
                        class="rounded-xl border border-amber-200 dark:border-amber-800 bg-amber-50 dark:bg-amber-900/20 p-4">

                        <div class="flex gap-3">

                            <div class="text-amber-600 dark:text-amber-400 text-lg">
                                ℹ️
                            </div>

                            <div>

                                <p class="font-semibold text-amber-800 dark:text-amber-300">
                                    How the bill is calculated
                                </p>

                                <p class="text-sm text-amber-700 dark:text-amber-400 mt-1">

                                    Previous Balance + Current Water Charge =
                                    Total Before Credit.

                                    Any available customer credit is then applied
                                    automatically.

                                </p>

                            </div>

                        </div>

                    </div>


                    
                    <div class="flex flex-col sm:flex-row gap-3 pt-2">

                        <a
                            href="<?php echo e(route('bills.index')); ?>"
                            class="flex-1 inline-flex justify-center items-center px-5 py-3 rounded-xl border border-gray-300 dark:border-gray-700 text-gray-700 dark:text-gray-300 font-semibold hover:bg-gray-50 dark:hover:bg-gray-800 transition">

                            Cancel

                        </a>


                        <button
                            type="submit"
                            id="generate-bill-button"
                            disabled
                            class="flex-1 inline-flex justify-center items-center px-5 py-3 rounded-xl bg-blue-600 hover:bg-blue-700 disabled:bg-gray-400 disabled:hover:bg-gray-400 disabled:cursor-not-allowed text-white font-semibold transition shadow-sm">

                            💧 Generate Bill

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>


    
    <script>

        /*
        |--------------------------------------------------------------------------
        | Elements
        |--------------------------------------------------------------------------
        */

        const readingIdInput =
            document.getElementById('meter_reading_id');

        const readingSearch =
            document.getElementById('reading-search');

        const readingResults =
            document.getElementById('reading-results');

        const noReadingResults =
            document.getElementById('no-reading-results');

        const clearReadingButton =
            document.getElementById('clear-reading');

        const generateBillButton =
            document.getElementById('generate-bill-button');

        const readingInfo =
            document.getElementById('reading-info');

        const customerName =
            document.getElementById('customer-name');

        const customerNumber =
            document.getElementById('customer-number');

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


        /*
        |--------------------------------------------------------------------------
        | Fixed Water Rate
        |--------------------------------------------------------------------------
        */

        const WATER_RATE = 120.00;


        /*
        |--------------------------------------------------------------------------
        | Reading Data
        |--------------------------------------------------------------------------
        */

        const readings = [

            <?php $__currentLoopData = $readings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reading): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                {
                    id: <?php echo json_encode($reading->id, 15, 512) ?>,

                    customer:
                        <?php echo json_encode($reading->meter->customer->full_name, 15, 512) ?>,

                    customerNumber:
                        <?php echo json_encode($reading->meter->customer->customer_number, 15, 512) ?>,

                    meter:
                        <?php echo json_encode($reading->meter->meter_number, 15, 512) ?>,

                    readingDate:
                        <?php echo json_encode(\Carbon\Carbon::parse($reading->reading_date)->format('d M Y'), 15, 512) ?>,

                    consumption:
                        <?php echo json_encode((float) $reading->consumption, 15, 512) ?>
                },

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        ];


        /*
        |--------------------------------------------------------------------------
        | Currency Formatting
        |--------------------------------------------------------------------------
        */

        function formatCurrency(amount)
        {
            return 'KSh ' + Number(amount).toFixed(2);
        }


        /*
        |--------------------------------------------------------------------------
        | Bill Calculation
        |--------------------------------------------------------------------------
        |
        | This is a front-end preview only.
        |
        | The BillController remains the authoritative source for:
        | - automatic outstanding balance carry-forward
        | - customer credit
        | - final bill balance
        | - database calculations
        |
        */

        function calculateBill()
        {
            const selectedReading =
                readings.find(
                    reading =>
                        String(reading.id) ===
                        String(readingIdInput.value)
                );


            const consumption =
                selectedReading
                    ? Number(selectedReading.consumption || 0)
                    : 0;


            const previousBalance =
                Math.max(
                    0,
                    Number(previousBalanceInput.value || 0)
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


        /*
        |--------------------------------------------------------------------------
        | Display Selected Reading
        |--------------------------------------------------------------------------
        */

        function displaySelectedReading(reading)
        {
            if (!reading)
            {
                readingIdInput.value = '';

                readingSearch.value = '';

                readingInfo.classList.add('hidden');

                clearReadingButton.classList.add('hidden');

                generateBillButton.disabled = true;

                calculateBill();

                return;
            }


            readingIdInput.value =
                reading.id;


            readingSearch.value =
                `${reading.customer} — ${reading.customerNumber}`;


            customerName.textContent =
                reading.customer;


            customerNumber.textContent =
                reading.customerNumber;


            meterNumber.textContent =
                reading.meter;


            consumptionDisplay.textContent =
                Number(reading.consumption).toFixed(2);


            readingInfo.classList.remove('hidden');

            clearReadingButton.classList.remove('hidden');

            generateBillButton.disabled = false;


            readingResults.classList.add('hidden');

            noReadingResults.classList.add('hidden');


            calculateBill();
        }


        /*
        |--------------------------------------------------------------------------
        | Create Search Result
        |--------------------------------------------------------------------------
        */

        function createReadingResult(reading)
        {
            const button =
                document.createElement('button');


            button.type = 'button';

            button.className =
                'w-full text-left px-4 py-4 border-b border-gray-100 last:border-b-0 hover:bg-blue-50 dark:border-gray-700 dark:hover:bg-gray-700 transition';


            button.innerHTML = `

                <div class="flex items-start justify-between gap-4">

                    <div class="min-w-0">

                        <p class="font-semibold text-gray-800 dark:text-white truncate">

                            ${escapeHtml(reading.customer)}

                        </p>

                        <div class="flex flex-wrap gap-x-3 gap-y-1 mt-1 text-xs text-gray-500 dark:text-gray-400">

                            <span>
                                Account:
                                <strong class="text-gray-700 dark:text-gray-300">
                                    ${escapeHtml(reading.customerNumber)}
                                </strong>
                            </span>

                            <span>
                                Meter:
                                <strong class="text-gray-700 dark:text-gray-300">
                                    ${escapeHtml(reading.meter)}
                                </strong>
                            </span>

                        </div>

                        <p class="text-xs text-gray-400 dark:text-gray-500 mt-1">

                            Reading:
                            ${escapeHtml(reading.readingDate)}

                        </p>

                    </div>


                    <div class="flex-shrink-0 text-right">

                        <p class="font-bold text-blue-600 dark:text-blue-400">

                            ${Number(reading.consumption).toFixed(2)}

                        </p>

                        <p class="text-xs text-gray-500 dark:text-gray-400">

                            units

                        </p>

                    </div>

                </div>

            `;


            button.addEventListener(
                'click',
                function()
                {
                    displaySelectedReading(reading);
                }
            );


            return button;
        }


        /*
        |--------------------------------------------------------------------------
        | HTML Escape Helper
        |--------------------------------------------------------------------------
        */

        function escapeHtml(value)
        {
            return String(value)
                .replace(/&/g, '&amp;')
                .replace(/</g, '&lt;')
                .replace(/>/g, '&gt;')
                .replace(/"/g, '&quot;')
                .replace(/'/g, '&#039;');
        }


        /*
        |--------------------------------------------------------------------------
        | Search Readings
        |--------------------------------------------------------------------------
        */

        function searchReadings()
        {
            const query =
                readingSearch.value
                    .trim()
                    .toLowerCase();


            readingResults.innerHTML = '';

            noReadingResults.classList.add('hidden');


            if (!query)
            {
                readingResults.classList.add('hidden');

                return;
            }


            const matches =
                readings.filter(
                    reading =>
                        reading.customer
                            .toLowerCase()
                            .includes(query)

                        ||

                        reading.customerNumber
                            .toLowerCase()
                            .includes(query)

                        ||

                        reading.meter
                            .toLowerCase()
                            .includes(query)
                );


            if (matches.length === 0)
            {
                readingResults.classList.add('hidden');

                noReadingResults.classList.remove('hidden');

                return;
            }


            matches.forEach(
                reading =>
                {
                    readingResults.appendChild(
                        createReadingResult(reading)
                    );
                }
            );


            readingResults.classList.remove('hidden');
        }


        /*
        |--------------------------------------------------------------------------
        | Search Events
        |--------------------------------------------------------------------------
        */

        readingSearch.addEventListener(
            'input',
            function()
            {
                const selectedReading =
                    readings.find(
                        reading =>
                            String(reading.id) ===
                            String(readingIdInput.value)
                    );


                /*
                | If the selected value is edited,
                | clear the previous selection.
                */

                if (
                    selectedReading &&
                    this.value !==
                    `${selectedReading.customer} — ${selectedReading.customerNumber}`
                )
                {
                    readingIdInput.value = '';

                    readingInfo.classList.add('hidden');

                    clearReadingButton.classList.add('hidden');

                    generateBillButton.disabled = true;
                }


                searchReadings();
            }
        );


        /*
        |--------------------------------------------------------------------------
        | Focus Search
        |--------------------------------------------------------------------------
        */

        readingSearch.addEventListener(
            'focus',
            function()
            {
                if (this.value.trim())
                {
                    searchReadings();
                }
            }
        );


        /*
        |--------------------------------------------------------------------------
        | Clear Selection
        |--------------------------------------------------------------------------
        */

        clearReadingButton.addEventListener(
            'click',
            function()
            {
                displaySelectedReading(null);

                noReadingResults.classList.add('hidden');

                readingSearch.focus();
            }
        );


        /*
        |--------------------------------------------------------------------------
        | Close Search Results When Clicking Outside
        |--------------------------------------------------------------------------
        */

        document.addEventListener(
            'click',
            function(event)
            {
                const searchContainer =
                    readingSearch.closest('.relative');


                if (
                    searchContainer &&
                    !searchContainer.contains(event.target)
                )
                {
                    readingResults.classList.add('hidden');
                }
            }
        );


        /*
        |--------------------------------------------------------------------------
        | Previous Balance Calculation
        |--------------------------------------------------------------------------
        */

        previousBalanceInput.addEventListener(
            'input',
            calculateBill
        );


        /*
        |--------------------------------------------------------------------------
        | Restore Previous Selection After Validation Error
        |--------------------------------------------------------------------------
        */

        const oldReadingId =
            <?php echo json_encode(old('meter_reading_id'), 15, 512) ?>;


        if (oldReadingId)
        {
            const oldReading =
                readings.find(
                    reading =>
                        String(reading.id) ===
                        String(oldReadingId)
                );


            if (oldReading)
            {
                displaySelectedReading(oldReading);
            }
        }
        else
        {
            calculateBill();
        }

    </script>

 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>

<?php /**PATH C:\Users\ADMIN\Downloads\maji-mazuri-deploy\resources\views/bills/create.blade.php ENDPATH**/ ?>