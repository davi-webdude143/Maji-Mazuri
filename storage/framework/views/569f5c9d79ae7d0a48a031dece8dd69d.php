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
                Reports
            </h2>

            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                Billing, payment and collection reports
            </p>
        </div>

     <?php $__env->endSlot(); ?>


    <div class="py-8 bg-gray-100 dark:bg-gray-950 min-h-screen">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">


            

            <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 shadow-sm p-6 mb-8">

                <div class="mb-5">

                    <h3 class="text-lg font-bold text-gray-900 dark:text-white">
                        Report Filters
                    </h3>

                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                        Select a date range to filter billing and payment information.
                    </p>

                </div>


                <form method="GET" action="<?php echo e(route('reports.index')); ?>">

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">


                        

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
                                value="<?php echo e($startDate); ?>"
                                class="w-full rounded-xl border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white focus:border-blue-500 focus:ring-blue-500"
                            >

                        </div>


                        

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
                                value="<?php echo e($endDate); ?>"
                                class="w-full rounded-xl border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white focus:border-blue-500 focus:ring-blue-500"
                            >

                        </div>


                        

                        <div class="flex items-end gap-3">

                            <button
                                type="submit"
                                class="inline-flex items-center justify-center px-5 py-3 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-semibold transition"
                            >
                                Generate Report
                            </button>

                            <a
                                href="<?php echo e(route('reports.index')); ?>"
                                class="inline-flex items-center justify-center px-5 py-3 rounded-xl bg-gray-100 hover:bg-gray-200 dark:bg-gray-800 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-300 font-semibold transition"
                            >
                                Clear
                            </a>

                        </div>

                    </div>

                </form>

            </div>


            

            <div class="mb-4">

                <h3 class="text-xl font-bold text-gray-900 dark:text-white">
                    Billing Summary
                </h3>

            </div>


            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">


                

                <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 shadow-sm p-6">

                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">
                        Total Bills
                    </p>

                    <p class="mt-2 text-3xl font-bold text-gray-900 dark:text-white">
                        <?php echo e(number_format($totalBills)); ?>

                    </p>

                </div>


                

                <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 shadow-sm p-6">

                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">
                        Total Billed
                    </p>

                    <p class="mt-2 text-2xl font-bold text-gray-900 dark:text-white">
                        KSh <?php echo e(number_format($totalBilled, 2)); ?>

                    </p>

                </div>


                

                <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 shadow-sm p-6">

                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">
                        Total Collected
                    </p>

                    <p class="mt-2 text-2xl font-bold text-green-600 dark:text-green-400">
                        KSh <?php echo e(number_format($totalCollected, 2)); ?>

                    </p>

                </div>


                

                <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 shadow-sm p-6">

                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">
                        Outstanding
                    </p>

                    <p class="mt-2 text-2xl font-bold text-red-600 dark:text-red-400">
                        KSh <?php echo e(number_format($totalOutstanding, 2)); ?>

                    </p>

                </div>

            </div>


            

            <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-10">


                

                <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 shadow-sm p-6">

                    <div class="flex items-center justify-between">

                        <div>

                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">
                                Paid Bills
                            </p>

                            <p class="mt-2 text-3xl font-bold text-green-600 dark:text-green-400">
                                <?php echo e(number_format($paidBills)); ?>

                            </p>

                        </div>

                        <div class="w-12 h-12 rounded-xl bg-green-100 dark:bg-green-900/30 flex items-center justify-center text-xl">
                            ✓
                        </div>

                    </div>

                </div>


                

                <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 shadow-sm p-6">

                    <div class="flex items-center justify-between">

                        <div>

                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">
                                Partially Paid
                            </p>

                            <p class="mt-2 text-3xl font-bold text-yellow-600 dark:text-yellow-400">
                                <?php echo e(number_format($partiallyPaidBills)); ?>

                            </p>

                        </div>

                        <div class="w-12 h-12 rounded-xl bg-yellow-100 dark:bg-yellow-900/30 flex items-center justify-center text-xl">
                            ◐
                        </div>

                    </div>

                </div>


                

                <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 shadow-sm p-6">

                    <div class="flex items-center justify-between">

                        <div>

                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">
                                Unpaid Bills
                            </p>

                            <p class="mt-2 text-3xl font-bold text-red-600 dark:text-red-400">
                                <?php echo e(number_format($unpaidBills)); ?>

                            </p>

                        </div>

                        <div class="w-12 h-12 rounded-xl bg-red-100 dark:bg-red-900/30 flex items-center justify-center text-xl">
                            !
                        </div>

                    </div>

                </div>

            </div>


            

            <div class="mb-4">

                <h3 class="text-xl font-bold text-gray-900 dark:text-white">
                    Payment & Collection Summary
                </h3>

            </div>


            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-10">


                

                <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 shadow-sm p-6">

                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">
                        Payment Records
                    </p>

                    <p class="mt-2 text-3xl font-bold text-gray-900 dark:text-white">
                        <?php echo e(number_format($totalPayments)); ?>

                    </p>

                </div>


                

                <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 shadow-sm p-6">

                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">
                        Cash Collection
                    </p>

                    <p class="mt-2 text-2xl font-bold text-blue-600 dark:text-blue-400">
                        KSh <?php echo e(number_format($cashCollected, 2)); ?>

                    </p>

                </div>


                

                <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 shadow-sm p-6">

                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">
                        M-PESA Collection
                    </p>

                    <p class="mt-2 text-2xl font-bold text-green-600 dark:text-green-400">
                        KSh <?php echo e(number_format($mpesaCollected, 2)); ?>

                    </p>

                </div>


                

                <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 shadow-sm p-6">

                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">
                        Bank Collection
                    </p>

                    <p class="mt-2 text-2xl font-bold text-purple-600 dark:text-purple-400">
                        KSh <?php echo e(number_format($bankCollected, 2)); ?>

                    </p>

                </div>

            </div>


            

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

                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $bills; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/50 transition">

                                    <td class="px-6 py-5">

                                        <a
                                            href="<?php echo e(route('bills.show', $bill)); ?>"
                                            class="font-semibold text-blue-600 hover:text-blue-800 dark:text-blue-400"
                                        >
                                            <?php echo e($bill->invoice_number); ?>

                                        </a>

                                    </td>


                                    <td class="px-6 py-5">

                                        <p class="font-semibold text-gray-900 dark:text-white">
                                            <?php echo e($bill->customer->full_name ?? 'N/A'); ?>

                                        </p>

                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($bill->customer): ?>

                                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                                <?php echo e($bill->customer->customer_number); ?>

                                            </p>

                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                                    </td>


                                    <td class="px-6 py-5 text-sm text-gray-700 dark:text-gray-300">

                                        <?php echo e($bill->billing_date
                                            ? $bill->billing_date->format('d M Y')
                                            : 'N/A'); ?>


                                    </td>


                                    <td class="px-6 py-5 text-right font-semibold text-gray-900 dark:text-white">

                                        KSh <?php echo e(number_format($bill->water_charge, 2)); ?>


                                    </td>


                                    <td class="px-6 py-5 text-right font-semibold text-green-600 dark:text-green-400">

                                        KSh <?php echo e(number_format($bill->amount_paid, 2)); ?>


                                    </td>


                                    <td class="px-6 py-5 text-right font-semibold text-red-600 dark:text-red-400">

                                        KSh <?php echo e(number_format($bill->balance, 2)); ?>


                                    </td>


                                    <td class="px-6 py-5 text-center">

                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($bill->status === 'paid'): ?>

                                            <span class="inline-flex px-3 py-1 rounded-full bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-300 text-xs font-bold">
                                                PAID
                                            </span>

                                        <?php elseif($bill->status === 'partially_paid'): ?>

                                            <span class="inline-flex px-3 py-1 rounded-full bg-yellow-100 dark:bg-yellow-900/30 text-yellow-700 dark:text-yellow-300 text-xs font-bold">
                                                PARTIAL
                                            </span>

                                        <?php else: ?>

                                            <span class="inline-flex px-3 py-1 rounded-full bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-300 text-xs font-bold">
                                                UNPAID
                                            </span>

                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                                    </td>

                                </tr>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

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

                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                        </tbody>

                    </table>

                </div>

            </div>


            

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

                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/50 transition">

                                    <td class="px-6 py-5 text-sm text-gray-700 dark:text-gray-300">

                                        <?php echo e($payment->payment_date
                                            ? $payment->payment_date->format('d M Y')
                                            : 'N/A'); ?>


                                    </td>


                                    <td class="px-6 py-5">

                                        <p class="font-semibold text-gray-900 dark:text-white">
                                            <?php echo e($payment->customer->full_name ?? 'N/A'); ?>

                                        </p>

                                    </td>


                                    <td class="px-6 py-5">

                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($payment->bill): ?>

                                            <a
                                                href="<?php echo e(route('bills.show', $payment->bill)); ?>"
                                                class="font-semibold text-blue-600 hover:text-blue-800 dark:text-blue-400"
                                            >
                                                <?php echo e($payment->bill->invoice_number); ?>

                                            </a>

                                        <?php else: ?>

                                            <span class="text-gray-500">
                                                N/A
                                            </span>

                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                                    </td>


                                    <td class="px-6 py-5">

                                        <span class="inline-flex px-3 py-1 rounded-full text-xs font-bold
                                            <?php if($payment->payment_method === 'mpesa'): ?>
                                                bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-300
                                            <?php elseif($payment->payment_method === 'cash'): ?>
                                                bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-300
                                            <?php elseif($payment->payment_method === 'bank'): ?>
                                                bg-purple-100 text-purple-700 dark:bg-purple-900/30 dark:text-purple-300
                                            <?php else: ?>
                                                bg-gray-100 text-gray-700 dark:bg-gray-800 dark:text-gray-300
                                            <?php endif; ?>
                                        ">

                                            <?php echo e(strtoupper($payment->payment_method)); ?>


                                        </span>

                                    </td>


                                    <td class="px-6 py-5 text-sm text-gray-600 dark:text-gray-400">

                                        <?php echo e($payment->reference_number ?? '—'); ?>


                                    </td>


                                    <td class="px-6 py-5 text-right font-bold text-green-600 dark:text-green-400">

                                        KSh <?php echo e(number_format($payment->amount, 2)); ?>


                                    </td>

                                </tr>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

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

                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                        </tbody>

                    </table>

                </div>

            </div>


            

            <?php echo $__env->make('reports.income', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>


        </div>

    </div>


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

<?php /**PATH C:\Users\ADMIN\Downloads\maji-mazuri-deploy\resources\views\reports\index.blade.php ENDPATH**/ ?>