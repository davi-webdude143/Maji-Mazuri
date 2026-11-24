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
                Add Water Meter
            </h2>

            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                Register a water meter and connect it to a customer
            </p>
        </div>

     <?php $__env->endSlot(); ?>


    

    <?php
        $customerSearchData = $customers->map(function ($customer) {
            return [
                'id' => $customer->id,
                'name' => $customer->full_name,
                'customer_number' => $customer->customer_number,
                'phone' => $customer->phone_number,
            ];
        })->values();
    ?>


    

    <div class="py-8 bg-gray-100 dark:bg-gray-950 min-h-screen">

        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">


            

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($errors->any()): ?>

                <div class="mb-6 bg-red-50 dark:bg-red-900/30 border border-red-200 dark:border-red-800 rounded-xl p-5">

                    <h3 class="font-semibold text-red-700 dark:text-red-300 mb-2">
                        Please correct the following errors:
                    </h3>

                    <ul class="list-disc list-inside text-sm text-red-600 dark:text-red-300">

                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <li><?php echo e($error); ?></li>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                    </ul>

                </div>

            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>


            

            <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-800 overflow-hidden">


                

                <div class="p-6 border-b border-gray-200 dark:border-gray-800">

                    <div class="flex items-center gap-4">

                        <div class="w-12 h-12 rounded-xl bg-blue-100 dark:bg-blue-900/40 flex items-center justify-center text-2xl">
                            💧
                        </div>

                        <div>

                            <h3 class="text-lg font-semibold text-gray-800 dark:text-white">
                                Water Meter Information
                            </h3>

                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                Connect a meter to an active customer
                            </p>

                        </div>

                    </div>

                </div>


                

                <form method="POST" action="<?php echo e(route('meters.store')); ?>">

                    <?php echo csrf_field(); ?>

                    <div class="p-6 space-y-6">


                        

                        <div>

                            <label
                                for="customer-search"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2"
                            >
                                Search Customer
                                <span class="text-red-500">*</span>
                            </label>


                            <div class="flex flex-col sm:flex-row gap-3">

                                <div class="relative flex-1">

                                    <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400">
                                        🔎
                                    </span>

                                    <input
                                        type="text"
                                        id="customer-search"
                                        placeholder="Search by customer number, name or phone..."
                                        autocomplete="off"
                                        class="w-full pl-11 pr-4 py-3 rounded-xl border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white focus:border-blue-500 focus:ring-blue-500"
                                    >

                                </div>


                                <button
                                    type="button"
                                    id="search-customer-button"
                                    class="inline-flex items-center justify-center gap-2 px-5 py-3 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-semibold transition"
                                >
                                    🔎 Search
                                </button>


                                <button
                                    type="button"
                                    id="clear-customer-search"
                                    class="hidden inline-flex items-center justify-center gap-2 px-5 py-3 rounded-xl bg-gray-200 hover:bg-gray-300 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-800 dark:text-white font-semibold transition"
                                >
                                    Clear
                                </button>

                            </div>


                            <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">
                                Search using a customer number such as M0576, customer name, or phone number.
                            </p>


                            

                            <div
                                id="customer-search-results"
                                class="mt-4 space-y-3"
                            ></div>


                            

                            <div
                                id="no-customer-results"
                                class="hidden mt-4 bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800 rounded-xl p-4"
                            >

                                <div class="flex items-start gap-3">

                                    <span class="text-yellow-600 text-xl">
                                        ⚠️
                                    </span>

                                    <div>

                                        <p class="font-semibold text-yellow-800 dark:text-yellow-300">
                                            No customer found
                                        </p>

                                        <p class="text-sm text-yellow-700 dark:text-yellow-400 mt-1">
                                            Try a different customer number, name, or phone number.
                                        </p>

                                    </div>

                                </div>

                            </div>


                            

                            <div
                                id="selected-customer"
                                class="hidden mt-4 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-xl p-5"
                            >

                                <div class="flex items-start justify-between gap-4">

                                    <div class="flex items-start gap-3">

                                        <div class="w-10 h-10 rounded-lg bg-green-100 dark:bg-green-900/40 flex items-center justify-center text-lg">
                                            ✓
                                        </div>

                                        <div>

                                            <p class="text-xs uppercase tracking-wider font-bold text-green-600 dark:text-green-400">
                                                Selected Customer
                                            </p>

                                            <p
                                                id="selected-customer-name"
                                                class="mt-1 font-bold text-green-800 dark:text-green-200"
                                            ></p>

                                            <div class="mt-1 text-sm text-green-700 dark:text-green-300 space-y-0.5">

                                                <p>
                                                    Customer No:
                                                    <span
                                                        id="selected-customer-number"
                                                        class="font-semibold"
                                                    ></span>
                                                </p>

                                                <p>
                                                    Phone:
                                                    <span id="selected-customer-phone"></span>
                                                </p>

                                            </div>

                                        </div>

                                    </div>


                                    <button
                                        type="button"
                                        id="change-customer"
                                        class="text-sm font-semibold text-green-700 dark:text-green-300 hover:underline"
                                    >
                                        Change
                                    </button>

                                </div>

                            </div>


                            

                            <select
                                id="customer_id"
                                name="customer_id"
                                required
                                class="hidden"
                            >

                                <option value="">
                                    Select customer
                                </option>

                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                    <option
                                        value="<?php echo e($customer->id); ?>"
                                        <?php echo e(old('customer_id') == $customer->id ? 'selected' : ''); ?>

                                    >
                                        <?php echo e($customer->full_name); ?>

                                        — <?php echo e($customer->customer_number); ?>

                                    </option>

                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                            </select>


                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($customers->isEmpty()): ?>

                                <p class="mt-3 text-sm text-red-600 dark:text-red-400">
                                    No active customers are available. Please register an active customer first.
                                </p>

                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                        </div>


                        

                        <div>

                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Meter Number
                            </label>

                            <div class="w-full rounded-xl border border-blue-200 dark:border-blue-800 bg-blue-50 dark:bg-blue-900/20 px-4 py-4">

                                <div class="flex items-start gap-3">

                                    <span class="text-xl">
                                        🔢
                                    </span>

                                    <div>

                                        <p class="font-semibold text-blue-700 dark:text-blue-300">
                                            Automatically generated
                                        </p>

                                        <p class="text-xs text-blue-600 dark:text-blue-400 mt-1">
                                            The system will automatically assign a physical meter number such as
                                            <strong>MTR-0001</strong>.
                                        </p>

                                        <p class="text-xs text-blue-600 dark:text-blue-400 mt-1">
                                            The customer's M-PESA account reference remains their customer number,
                                            such as <strong>M0001</strong>.
                                        </p>

                                    </div>

                                </div>

                            </div>

                        </div>


                        

                        <div>

                            <label
                                for="installation_date"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2"
                            >
                                Installation Date
                            </label>

                            <input
                                type="date"
                                id="installation_date"
                                name="installation_date"
                                value="<?php echo e(old('installation_date')); ?>"
                                class="w-full rounded-xl border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white focus:border-blue-500 focus:ring-blue-500"
                            >

                        </div>


                        

                        <div>

                            <label
                                for="initial_reading"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2"
                            >
                                Initial Meter Reading
                                <span class="text-red-500">*</span>
                            </label>

                            <input
                                type="number"
                                step="0.01"
                                min="0"
                                id="initial_reading"
                                name="initial_reading"
                                value="<?php echo e(old('initial_reading', 0)); ?>"
                                required
                                class="w-full rounded-xl border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white focus:border-blue-500 focus:ring-blue-500"
                            >

                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                Enter the meter reading when the meter is installed.
                            </p>

                        </div>


                        

                        <div>

                            <label
                                for="status"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2"
                            >
                                Meter Status
                                <span class="text-red-500">*</span>
                            </label>

                            <select
                                id="status"
                                name="status"
                                required
                                class="w-full rounded-xl border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white focus:border-blue-500 focus:ring-blue-500"
                            >

                                <option
                                    value="active"
                                    <?php echo e(old('status', 'active') === 'active' ? 'selected' : ''); ?>

                                >
                                    Active
                                </option>

                                <option
                                    value="inactive"
                                    <?php echo e(old('status') === 'inactive' ? 'selected' : ''); ?>

                                >
                                    Inactive
                                </option>

                            </select>

                        </div>

                    </div>


                    

                    <div class="px-6 py-5 bg-gray-50 dark:bg-gray-800/50 border-t border-gray-200 dark:border-gray-800 flex flex-col sm:flex-row justify-end gap-3">

                        <a
                            href="<?php echo e(route('meters.index')); ?>"
                            class="inline-flex justify-center items-center px-5 py-2.5 rounded-xl border border-gray-300 dark:border-gray-700 text-gray-700 dark:text-gray-300 font-semibold hover:bg-gray-100 dark:hover:bg-gray-800 transition"
                        >
                            Cancel
                        </a>

                        <button
                            type="submit"
                            class="inline-flex justify-center items-center px-6 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-semibold transition shadow-sm"
                        >
                            💧 Register Meter
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>


    

    <script>

        document.addEventListener('DOMContentLoaded', function () {

            const searchInput = document.getElementById('customer-search');
            const searchButton = document.getElementById('search-customer-button');
            const clearButton = document.getElementById('clear-customer-search');

            const resultsContainer =
                document.getElementById('customer-search-results');

            const noResults =
                document.getElementById('no-customer-results');

            const selectedCustomerBox =
                document.getElementById('selected-customer');

            const selectedCustomerName =
                document.getElementById('selected-customer-name');

            const selectedCustomerNumber =
                document.getElementById('selected-customer-number');

            const selectedCustomerPhone =
                document.getElementById('selected-customer-phone');

            const customerSelect =
                document.getElementById('customer_id');

            const changeCustomerButton =
                document.getElementById('change-customer');


            const customers = <?php echo json_encode($customerSearchData, 15, 512) ?>;


            function normalize(value) {

                return String(value ?? '')
                    .toLowerCase()
                    .trim();

            }


            function escapeHtml(value) {

                const div = document.createElement('div');

                div.textContent = value ?? '';

                return div.innerHTML;

            }


            function clearResults() {

                resultsContainer.innerHTML = '';

                noResults.classList.add('hidden');

            }


            function selectCustomer(customer) {

                customerSelect.value = customer.id;

                selectedCustomerName.textContent =
                    customer.name || 'N/A';

                selectedCustomerNumber.textContent =
                    customer.customer_number || 'N/A';

                selectedCustomerPhone.textContent =
                    customer.phone || 'N/A';

                resultsContainer.innerHTML = '';

                noResults.classList.add('hidden');

                selectedCustomerBox.classList.remove('hidden');

                clearButton.classList.add('hidden');

            }


            function createCustomerCard(customer) {

                const card = document.createElement('div');

                card.className =
                    'border border-gray-200 dark:border-gray-700 rounded-xl p-4 bg-gray-50 dark:bg-gray-800 hover:border-blue-300 dark:hover:border-blue-700 transition';


                const phone = customer.phone || 'N/A';


                card.innerHTML = `

                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

                        <div>

                            <p class="font-bold text-gray-900 dark:text-white">
                                ${escapeHtml(customer.name || 'Unnamed Customer')}
                            </p>

                            <div class="mt-1 text-sm text-gray-600 dark:text-gray-300 space-y-0.5">

                                <p>
                                    Customer No:
                                    <span class="font-semibold">
                                        ${escapeHtml(customer.customer_number || 'N/A')}
                                    </span>
                                </p>

                                <p>
                                    Phone:
                                    ${escapeHtml(phone)}
                                </p>

                            </div>

                        </div>

                        <button
                            type="button"
                            class="select-customer-button inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-green-600 hover:bg-green-700 text-white font-semibold transition"
                        >
                            ✓ Select Customer
                        </button>

                    </div>

                `;


                card
                    .querySelector('.select-customer-button')
                    .addEventListener('click', function () {

                        selectCustomer(customer);

                    });


                return card;

            }


            function performSearch() {

                const query = normalize(searchInput.value);

                clearResults();


                if (!query) {

                    clearButton.classList.add('hidden');

                    return;

                }


                const matches = customers.filter(function (customer) {

                    const name =
                        normalize(customer.name);

                    const number =
                        normalize(customer.customer_number);

                    const phone =
                        normalize(customer.phone);


                    return (
                        name.includes(query) ||
                        number.includes(query) ||
                        phone.includes(query)
                    );

                });


                if (matches.length === 0) {

                    noResults.classList.remove('hidden');

                    clearButton.classList.remove('hidden');

                    return;

                }


                matches.forEach(function (customer) {

                    resultsContainer.appendChild(
                        createCustomerCard(customer)
                    );

                });


                clearButton.classList.remove('hidden');

            }


            searchButton.addEventListener(
                'click',
                performSearch
            );


            searchInput.addEventListener(
                'keydown',
                function (event) {

                    if (event.key === 'Enter') {

                        event.preventDefault();

                        performSearch();

                    }

                }
            );


            searchInput.addEventListener(
                'input',
                function () {

                    if (!searchInput.value.trim()) {

                        clearResults();

                        clearButton.classList.add('hidden');

                    }

                }
            );


            clearButton.addEventListener(
                'click',
                function () {

                    searchInput.value = '';

                    clearResults();

                    clearButton.classList.add('hidden');

                    searchInput.focus();

                }
            );


            changeCustomerButton.addEventListener(
                'click',
                function () {

                    customerSelect.value = '';

                    selectedCustomerBox.classList.add('hidden');

                    searchInput.value = '';

                    clearResults();

                    clearButton.classList.add('hidden');

                    searchInput.focus();

                }
            );


            /*
             * Restore the previously selected customer after
             * a validation error.
             */

            const oldCustomerId =
                customerSelect.value;


            if (oldCustomerId) {

                const existingCustomer =
                    customers.find(function (customer) {

                        return String(customer.id) ===
                            String(oldCustomerId);

                    });


                if (existingCustomer) {

                    selectCustomer(existingCustomer);

                }

            }

        });

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

<?php /**PATH C:\Users\ADMIN\Downloads\maji-mazuri-deploy\resources\views\meters\create.blade.php ENDPATH**/ ?>