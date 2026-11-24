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
 <?php $__env->endSlot(); ?>

<div class="py-8 bg-gray-100 dark:bg-gray-950 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('success')): ?>
            <div class="mb-6 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-xl p-4">
                <div class="flex items-center gap-3">
                    <span class="text-green-600 dark:text-green-400 text-xl">
                        ✓
                    </span>
                    <p class="text-sm font-medium text-green-700 dark:text-green-300">
                        <?php echo e(session('success')); ?>

                    </p>
                </div>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($errors->any()): ?>
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
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 mb-8">

            
            <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 shadow-sm p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">
                            Total Payments
                        </p>

                        <p class="mt-2 text-3xl font-bold text-gray-900 dark:text-white">
                            <?php echo e(number_format($totalPayments)); ?>

                        </p>
                    </div>

                    <div class="w-12 h-12 rounded-xl bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center text-2xl">
                        💰
                    </div>
                </div>
            </div>

            
            <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 shadow-sm p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">
                            Total Amount Collected
                        </p>

                        <p class="mt-2 text-2xl sm:text-3xl font-bold text-green-700 dark:text-green-400">
                            KSh <?php echo e(number_format($totalCollected, 2)); ?>

                        </p>
                    </div>

                    <div class="w-12 h-12 rounded-xl bg-green-100 dark:bg-green-900/30 flex items-center justify-center text-2xl">
                        ✓
                    </div>
                </div>
            </div>

            
            <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 shadow-sm p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">
                            Today's Collection
                        </p>

                        <p class="mt-2 text-2xl sm:text-3xl font-bold text-purple-700 dark:text-purple-400">
                            KSh <?php echo e(number_format($todayCollected, 2)); ?>

                        </p>
                    </div>

                    <div class="w-12 h-12 rounded-xl bg-purple-100 dark:bg-purple-900/30 flex items-center justify-center text-2xl">
                        📅
                    </div>
                </div>
            </div>

        </div>

        
        <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 shadow-sm p-6 mb-8">

            <div class="mb-5">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white">
                    Search & Filter Payments
                </h3>

                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                    Search by customer, invoice or payment reference.
                </p>
            </div>

            <form method="GET" action="<?php echo e(route('payments.index')); ?>">

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">

                    
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
                            value="<?php echo e(request('search')); ?>"
                            placeholder="Customer, invoice or reference..."
                            class="w-full rounded-xl border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white focus:border-blue-500 focus:ring-blue-500"
                        >

                    </div>

                    
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
                                <?php echo e(request('payment_method') === 'cash' ? 'selected' : ''); ?>

                            >
                                Cash
                            </option>

                            <option
                                value="mpesa"
                                <?php echo e(request('payment_method') === 'mpesa' ? 'selected' : ''); ?>

                            >
                                M-PESA
                            </option>

                            <option
                                value="bank"
                                <?php echo e(request('payment_method') === 'bank' ? 'selected' : ''); ?>

                            >
                                Bank
                            </option>

                        </select>

                    </div>

                    
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
                            value="<?php echo e(request('date_from')); ?>"
                            class="w-full rounded-xl border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white focus:border-blue-500 focus:ring-blue-500"
                        >

                    </div>

                    
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
                            value="<?php echo e(request('date_to')); ?>"
                            class="w-full rounded-xl border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white focus:border-blue-500 focus:ring-blue-500"
                        >

                    </div>

                </div>

                
                <div class="flex flex-col sm:flex-row gap-3 mt-5">

                    <button
                        type="submit"
                        class="inline-flex items-center justify-center px-5 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-semibold transition"
                    >
                        🔎 Search Payments
                    </button>

                    <a
                        href="<?php echo e(route('payments.index')); ?>"
                        class="inline-flex items-center justify-center px-5 py-2.5 rounded-xl bg-gray-100 hover:bg-gray-200 dark:bg-gray-800 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-300 font-semibold transition"
                    >
                        ↻ Clear Filters
                    </a>

                </div>

            </form>

        </div>

        
        <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 shadow-sm overflow-hidden">

            
            <div class="px-6 py-5 border-b border-gray-200 dark:border-gray-800">

                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">

                    <div>

                        <h3 class="text-lg font-bold text-gray-900 dark:text-white">
                            Payment Records
                        </h3>

                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                            Showing
                            <?php echo e($payments->firstItem() ?? 0); ?>

                            -
                            <?php echo e($payments->lastItem() ?? 0); ?>

                            of
                            <?php echo e($payments->total()); ?>

                            payment records
                        </p>

                    </div>

                </div>

            </div>

            
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

                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/50 transition">

                                
                                <td class="px-6 py-5">

                                    <p class="font-bold text-gray-900 dark:text-white">
                                        #<?php echo e($payment->id); ?>

                                    </p>

                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($payment->reference_number): ?>

                                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                            Ref: <?php echo e($payment->reference_number); ?>

                                        </p>

                                    <?php else: ?>

                                        <p class="text-xs text-gray-400 dark:text-gray-500 mt-1">
                                            No reference
                                        </p>

                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                                </td>

                                
                                <td class="px-6 py-5">

                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($payment->bill && $payment->bill->customer): ?>

                                        <p class="font-semibold text-gray-900 dark:text-white">
                                            <?php echo e($payment->bill->customer->full_name); ?>

                                        </p>

                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($payment->bill->customer->customer_number): ?>

                                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                                <?php echo e($payment->bill->customer->customer_number); ?>

                                            </p>

                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                                    <?php else: ?>

                                        <span class="text-gray-500 dark:text-gray-400">
                                            N/A
                                        </span>

                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                                </td>

                                
                                <td class="px-6 py-5">

                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($payment->bill): ?>

                                        <a
                                            href="<?php echo e(route('bills.show', $payment->bill)); ?>"
                                            class="font-semibold text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300"
                                        >
                                            <?php echo e($payment->bill->invoice_number); ?>

                                        </a>

                                    <?php else: ?>

                                        <span class="text-gray-500 dark:text-gray-400">
                                            N/A
                                        </span>

                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                                </td>

                                
                                <td class="px-6 py-5">

                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($payment->payment_method === 'mpesa'): ?>

                                        <span class="inline-flex items-center px-3 py-1 rounded-full bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-300 text-xs font-bold">
                                            📱 M-PESA
                                        </span>

                                    <?php elseif($payment->payment_method === 'cash'): ?>

                                        <span class="inline-flex items-center px-3 py-1 rounded-full bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300 text-xs font-bold">
                                            💵 CASH
                                        </span>

                                    <?php elseif($payment->payment_method === 'bank'): ?>

                                        <span class="inline-flex items-center px-3 py-1 rounded-full bg-purple-100 dark:bg-purple-900/30 text-purple-700 dark:text-purple-300 text-xs font-bold">
                                            🏦 BANK
                                        </span>

                                    <?php else: ?>

                                        <span class="inline-flex items-center px-3 py-1 rounded-full bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300 text-xs font-bold">
                                            <?php echo e(strtoupper($payment->payment_method)); ?>

                                        </span>

                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                                </td>

                                
                                <td class="px-6 py-5 text-right">

                                    <p class="font-bold text-green-700 dark:text-green-400">
                                        KSh <?php echo e(number_format($payment->amount, 2)); ?>

                                    </p>

                                </td>

                                
                                <td class="px-6 py-5">

                                    <p class="text-sm text-gray-700 dark:text-gray-300">
                                        <?php echo e($payment->payment_date
                                            ? $payment->payment_date->format('d M Y')
                                            : 'N/A'); ?>

                                    </p>

                                </td>

                                
                                <td class="px-6 py-5 text-right">

                                    <div class="inline-flex items-center gap-2">

                                        
                                        <a
                                            href="<?php echo e(route('payments.show', $payment)); ?>"
                                            class="inline-flex items-center px-4 py-2 rounded-lg bg-gray-100 hover:bg-gray-200 dark:bg-gray-800 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-300 text-sm font-semibold transition"
                                        >
                                            View
                                        </a>

                                        
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(in_array(auth()->user()->role, ['admin', 'manager'], true)): ?>

                                            <form
                                                method="POST"
                                                action="<?php echo e(route('payments.destroy', $payment)); ?>"
                                                onsubmit="return confirm('Are you sure you want to delete this payment? This will restore the related bill or customer credit balance.');"
                                                class="inline"
                                            >

                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>

                                                <button
                                                    type="submit"
                                                    class="inline-flex items-center px-4 py-2 rounded-lg bg-red-100 hover:bg-red-200 dark:bg-red-900/30 dark:hover:bg-red-900/50 text-red-700 dark:text-red-300 text-sm font-semibold transition"
                                                >
                                                    Delete
                                                </button>

                                            </form>

                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                                    </div>

                                </td>

                            </tr>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

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

                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                    </tbody>

                </table>

            </div>

            
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($payments->hasPages()): ?>

                <div class="px-6 py-5 border-t border-gray-200 dark:border-gray-800">
                    <?php echo e($payments->links()); ?>

                </div>

            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        </div>

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
<?php /**PATH C:\Users\ADMIN\Downloads\maji-mazuri-deploy\resources\views\payments\index.blade.php ENDPATH**/ ?>