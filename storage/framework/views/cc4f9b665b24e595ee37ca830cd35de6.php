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
                Customer Details
            </h2>

            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                View customer account information
            </p>
        </div>

        <div class="flex gap-3">
            <a href="<?php echo e(route('customers.index')); ?>"
               class="inline-flex items-center px-4 py-2 rounded-xl border border-gray-300 dark:border-gray-700 text-gray-700 dark:text-gray-300 font-semibold hover:bg-gray-100 dark:hover:bg-gray-800 transition">
                ← Back
            </a>

            <a href="<?php echo e(route('customers.edit', $customer)); ?>"
               class="inline-flex items-center px-4 py-2 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-semibold transition">
                ✏️ Edit Customer
            </a>
        </div>
    </div>
 <?php $__env->endSlot(); ?>

<div class="py-8 bg-gray-100 dark:bg-gray-950 min-h-screen">

    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Customer Header Card -->
        <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-800 overflow-hidden mb-6">

            <div class="p-6 bg-gradient-to-r from-blue-600 to-blue-700 text-white">

                <div class="flex flex-col sm:flex-row sm:items-center gap-5">

                    <div class="w-16 h-16 rounded-2xl bg-white/20 flex items-center justify-center text-3xl">
                        👤
                    </div>

                    <div class="flex-1">
                        <h3 class="text-2xl font-bold">
                            <?php echo e($customer->full_name); ?>

                        </h3>

                        <p class="text-blue-100 mt-1">
                            Customer No:
                            <span class="font-semibold">
                                <?php echo e($customer->customer_number); ?>

                            </span>
                        </p>
                    </div>

                    <div>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($customer->status === 'active'): ?>
                            <span class="inline-flex items-center px-3 py-1.5 rounded-full bg-green-100 text-green-700 text-sm font-semibold">
                                ● Active
                            </span>
                        <?php else: ?>
                            <span class="inline-flex items-center px-3 py-1.5 rounded-full bg-red-100 text-red-700 text-sm font-semibold">
                                ● Inactive
                            </span>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>

                </div>

            </div>

            <!-- Customer Information -->
            <div class="p-6">

                <h4 class="text-lg font-semibold text-gray-800 dark:text-white mb-5">
                    Customer Information
                </h4>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <!-- Full Name -->
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            Full Name
                        </p>

                        <p class="mt-1 text-base font-semibold text-gray-800 dark:text-white">
                            <?php echo e($customer->full_name); ?>

                        </p>
                    </div>

                    <!-- Customer Number -->
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            Customer Number
                        </p>

                        <p class="mt-1 text-base font-semibold text-gray-800 dark:text-white">
                            <?php echo e($customer->customer_number); ?>

                        </p>
                    </div>

                    <!-- ID Number -->
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            ID Number
                        </p>

                        <p class="mt-1 text-base font-semibold text-gray-800 dark:text-white">
                            <?php echo e($customer->id_number ?: 'Not provided'); ?>

                        </p>
                    </div>

                    <!-- Phone -->
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            Phone Number
                        </p>

                        <p class="mt-1 text-base font-semibold text-gray-800 dark:text-white">
                            <?php echo e($customer->phone_number); ?>

                        </p>
                    </div>

                    <!-- Email -->
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            Email Address
                        </p>

                        <p class="mt-1 text-base font-semibold text-gray-800 dark:text-white">
                            <?php echo e($customer->email ?: 'Not provided'); ?>

                        </p>
                    </div>

                    <!-- Area -->
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            Area / Location
                        </p>

                        <p class="mt-1 text-base font-semibold text-gray-800 dark:text-white">
                            <?php echo e($customer->area ?: 'Not provided'); ?>

                        </p>
                    </div>

                    <!-- Address -->
                    <div class="md:col-span-2">
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            Physical Address
                        </p>

                        <p class="mt-1 text-base font-semibold text-gray-800 dark:text-white">
                            <?php echo e($customer->address ?: 'Not provided'); ?>

                        </p>
                    </div>

                </div>

            </div>

        </div>

        <!-- Account Information -->
        <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-800 p-6 mb-6">

            <h4 class="text-lg font-semibold text-gray-800 dark:text-white mb-5">
                Account Information
            </h4>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                <div>
                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        Account Status
                    </p>

                    <p class="mt-1 font-semibold text-gray-800 dark:text-white capitalize">
                        <?php echo e($customer->status); ?>

                    </p>
                </div>

                <div>
                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        Registered On
                    </p>

                    <p class="mt-1 font-semibold text-gray-800 dark:text-white">
                        <?php echo e($customer->created_at?->format('d M Y, H:i')); ?>

                    </p>
                </div>

                <div>
                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        Last Updated
                    </p>

                    <p class="mt-1 font-semibold text-gray-800 dark:text-white">
                        <?php echo e($customer->updated_at?->format('d M Y, H:i')); ?>

                    </p>
                </div>

            </div>

        </div>

        <!-- Credit Balance -->
        <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-800 overflow-hidden mb-6">

            <div class="p-6">

                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">

                    <div>
                        <h4 class="text-lg font-semibold text-gray-800 dark:text-white">
                            Credit Balance
                        </h4>

                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                            Available customer credit that can be applied to future bills.
                        </p>
                    </div>

                    <div class="inline-flex items-center gap-3 px-5 py-3 rounded-2xl bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800">
                        <span class="text-2xl">💰</span>

                        <div>
                            <p class="text-xs font-medium text-green-700 dark:text-green-400 uppercase tracking-wide">
                                Available Credit
                            </p>

                            <p class="text-2xl font-bold text-green-700 dark:text-green-300">
                                KSh <?php echo e(number_format((float) ($customer->credit_balance ?? 0), 2)); ?>

                            </p>
                        </div>
                    </div>

                </div>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($customer->credits->count()): ?>

                    <div class="overflow-x-auto border border-gray-200 dark:border-gray-800 rounded-xl">

                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-800">

                            <thead class="bg-gray-50 dark:bg-gray-800/60">

                                <tr>
                                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        Date
                                    </th>

                                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        Reference
                                    </th>

                                    <th class="px-4 py-3 text-right text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        Credit
                                    </th>

                                    <th class="px-4 py-3 text-right text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        Used
                                    </th>

                                    <th class="px-4 py-3 text-right text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        Remaining
                                    </th>
                                </tr>

                            </thead>

                            <tbody class="divide-y divide-gray-200 dark:divide-gray-800">

                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $customer->credits->sortByDesc('created_at'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $credit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/40 transition">

                                        <td class="px-4 py-4 text-sm text-gray-700 dark:text-gray-300 whitespace-nowrap">
                                            <?php echo e($credit->created_at?->format('d M Y, H:i')); ?>

                                        </td>

                                        <td class="px-4 py-4 text-sm font-medium text-gray-800 dark:text-gray-200">
                                            <?php echo e($credit->reference_number ?: '—'); ?>

                                        </td>

                                        <td class="px-4 py-4 text-sm font-semibold text-right text-gray-800 dark:text-gray-200 whitespace-nowrap">
                                            KSh <?php echo e(number_format((float) $credit->amount, 2)); ?>

                                        </td>

                                        <td class="px-4 py-4 text-sm font-semibold text-right text-gray-700 dark:text-gray-300 whitespace-nowrap">
                                            KSh <?php echo e(number_format((float) $credit->amount_used, 2)); ?>

                                        </td>

                                        <td class="px-4 py-4 text-sm font-bold text-right text-green-700 dark:text-green-400 whitespace-nowrap">
                                            KSh <?php echo e(number_format((float) $credit->balance, 2)); ?>

                                        </td>

                                    </tr>

                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                            </tbody>

                        </table>

                    </div>

                <?php else: ?>

                    <div class="rounded-xl border border-dashed border-gray-300 dark:border-gray-700 p-6 text-center">

                        <div class="text-3xl mb-2">
                            💳
                        </div>

                        <p class="font-semibold text-gray-700 dark:text-gray-300">
                            No credit available
                        </p>

                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                            This customer currently has no credit ledger entries.
                        </p>

                    </div>

                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            </div>

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
<?php /**PATH C:\Users\ADMIN\Downloads\maji-mazuri-deploy\resources\views\customers\show.blade.php ENDPATH**/ ?>