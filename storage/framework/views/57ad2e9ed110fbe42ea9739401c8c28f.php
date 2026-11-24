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
                    Meter Details
                </h2>

                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                    View water meter information
                </p>
            </div>

            <a href="<?php echo e(route('meters.index')); ?>"
               class="inline-flex items-center justify-center px-5 py-2.5 rounded-xl border border-gray-300 dark:border-gray-700 text-gray-700 dark:text-gray-300 font-semibold hover:bg-gray-100 dark:hover:bg-gray-800 transition">
                ← Back to Meters
            </a>
        </div>
     <?php $__env->endSlot(); ?>

    <div class="py-8 bg-gray-100 dark:bg-gray-950 min-h-screen">

        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('success')): ?>
                <div class="mb-6 bg-green-50 dark:bg-green-900/30 border border-green-200 dark:border-green-800 rounded-xl p-4">
                    <p class="text-sm font-medium text-green-700 dark:text-green-300">
                        ✓ <?php echo e(session('success')); ?>

                    </p>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-800 overflow-hidden">

                
                <div class="p-6 border-b border-gray-200 dark:border-gray-800">

                    <div class="flex items-center gap-4">

                        <div class="w-14 h-14 rounded-xl bg-blue-100 dark:bg-blue-900/40 flex items-center justify-center text-3xl">
                            💧
                        </div>

                        <div>

                            <h3 class="text-xl font-semibold text-gray-800 dark:text-white">
                                <?php echo e($meter->meter_number); ?>

                            </h3>

                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                Water Meter
                            </p>

                        </div>

                    </div>

                </div>

                
                <div class="p-6">

                    <h4 class="text-lg font-semibold text-gray-800 dark:text-white mb-5">
                        Meter Information
                    </h4>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <div class="bg-gray-50 dark:bg-gray-800/50 rounded-xl p-5">
                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                Meter Number
                            </p>

                            <p class="mt-1 font-semibold text-gray-800 dark:text-white">
                                <?php echo e($meter->meter_number); ?>

                            </p>
                        </div>

                        <div class="bg-gray-50 dark:bg-gray-800/50 rounded-xl p-5">
                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                Status
                            </p>

                            <div class="mt-2">

                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($meter->status === 'active'): ?>

                                    <span class="inline-flex items-center px-3 py-1 rounded-full bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-300 text-xs font-semibold">
                                        ● Active
                                    </span>

                                <?php else: ?>

                                    <span class="inline-flex items-center px-3 py-1 rounded-full bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-300 text-xs font-semibold">
                                        ● Inactive
                                    </span>

                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                            </div>
                        </div>

                        <div class="bg-gray-50 dark:bg-gray-800/50 rounded-xl p-5">
                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                Installation Date
                            </p>

                            <p class="mt-1 font-semibold text-gray-800 dark:text-white">
                                <?php echo e($meter->installation_date ? \Carbon\Carbon::parse($meter->installation_date)->format('d M Y') : 'Not provided'); ?>

                            </p>
                        </div>

                        <div class="bg-gray-50 dark:bg-gray-800/50 rounded-xl p-5">
                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                Initial Reading
                            </p>

                            <p class="mt-1 font-semibold text-gray-800 dark:text-white">
                                <?php echo e(number_format($meter->initial_reading, 2)); ?>

                            </p>
                        </div>

                        <div class="bg-gray-50 dark:bg-gray-800/50 rounded-xl p-5">
                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                Current Reading
                            </p>

                            <p class="mt-1 font-semibold text-blue-600 dark:text-blue-400 text-xl">
                                <?php echo e(number_format($meter->current_reading, 2)); ?>

                            </p>
                        </div>

                    </div>

                </div>

                
                <div class="p-6 border-t border-gray-200 dark:border-gray-800">

                    <h4 class="text-lg font-semibold text-gray-800 dark:text-white mb-5">
                        Connected Customer
                    </h4>

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($meter->customer): ?>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                    Customer Name
                                </p>

                                <p class="mt-1 font-semibold text-gray-800 dark:text-white">
                                    <?php echo e($meter->customer->full_name); ?>

                                </p>
                            </div>

                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                    Customer Number
                                </p>

                                <p class="mt-1 font-semibold text-gray-800 dark:text-white">
                                    <?php echo e($meter->customer->customer_number); ?>

                                </p>
                            </div>

                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                    Phone Number
                                </p>

                                <p class="mt-1 text-gray-800 dark:text-gray-300">
                                    <?php echo e($meter->customer->phone_number); ?>

                                </p>
                            </div>

                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                    Location
                                </p>

                                <p class="mt-1 text-gray-800 dark:text-gray-300">
                                    <?php echo e($meter->customer->area ?: 'Not provided'); ?>

                                </p>
                            </div>

                        </div>

                    <?php else: ?>

                        <p class="text-gray-500 dark:text-gray-400">
                            No customer is connected to this meter.
                        </p>

                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                </div>

                
                <div class="px-6 py-5 bg-gray-50 dark:bg-gray-800/50 border-t border-gray-200 dark:border-gray-800 flex flex-col sm:flex-row justify-end gap-3">

                    <a href="<?php echo e(route('meters.edit', $meter)); ?>"
                       class="inline-flex justify-center items-center px-5 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-semibold transition">
                        ✏️ Edit Meter
                    </a>

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($meter->status === 'active'): ?>

                        <form method="POST"
                              action="<?php echo e(route('meters.destroy', $meter)); ?>"
                              onsubmit="return confirm('Are you sure you want to deactivate this meter?');">

                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>

                            <button type="submit"
                                    class="w-full sm:w-auto inline-flex justify-center items-center px-5 py-2.5 rounded-xl bg-red-600 hover:bg-red-700 text-white font-semibold transition">
                                ⛔ Deactivate Meter
                            </button>

                        </form>

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
<?php endif; ?><?php /**PATH C:\Users\ADMIN\Downloads\maji-mazuri-deploy\resources\views\meters\show.blade.php ENDPATH**/ ?>