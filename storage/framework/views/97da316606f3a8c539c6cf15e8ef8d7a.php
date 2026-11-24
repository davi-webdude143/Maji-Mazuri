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
                    Meter Reading Details
                </h2>

                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                    View the details and status of this meter reading
                </p>

            </div>

            <a
                href="<?php echo e(route('meter-readings.index')); ?>"
                class="inline-flex items-center justify-center px-5 py-2.5 rounded-xl border border-gray-300 dark:border-gray-700 text-gray-700 dark:text-gray-300 font-semibold hover:bg-gray-100 dark:hover:bg-gray-800 transition"
            >
                ← Back to Readings
            </a>

        </div>

     <?php $__env->endSlot(); ?>


    <div class="py-8 bg-gray-100 dark:bg-gray-950 min-h-screen">

        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">


            

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($meterReading->is_abnormal): ?>

                <div class="mb-6 bg-amber-50 dark:bg-amber-900/30 border border-amber-300 dark:border-amber-800 rounded-2xl p-5">

                    <div class="flex items-start gap-4">

                        <div class="text-2xl">
                            ⚠️
                        </div>

                        <div>

                            <h3 class="font-semibold text-amber-800 dark:text-amber-300">
                                Abnormal Consumption Detected
                            </h3>

                            <p class="text-sm text-amber-700 dark:text-amber-400 mt-1">
                                This reading has been flagged because the recorded consumption
                                is unusually high.
                            </p>

                        </div>

                    </div>

                </div>

            <?php elseif($meterReading->exception_type): ?>

                <div class="mb-6 bg-purple-50 dark:bg-purple-900/30 border border-purple-200 dark:border-purple-800 rounded-2xl p-5">

                    <div class="flex items-start gap-4">

                        <div class="text-2xl">
                            ℹ️
                        </div>

                        <div>

                            <h3 class="font-semibold text-purple-800 dark:text-purple-300">
                                Exceptional Meter Reading
                            </h3>

                            <p class="text-sm text-purple-700 dark:text-purple-400 mt-1">
                                This reading was recorded with an exception.
                            </p>

                        </div>

                    </div>

                </div>

            <?php else: ?>

                <div class="mb-6 bg-green-50 dark:bg-green-900/30 border border-green-200 dark:border-green-800 rounded-2xl p-5">

                    <div class="flex items-center gap-4">

                        <div class="text-2xl">
                            ✓
                        </div>

                        <div>

                            <h3 class="font-semibold text-green-800 dark:text-green-300">
                                Normal Meter Reading
                            </h3>

                            <p class="text-sm text-green-700 dark:text-green-400 mt-1">
                                This reading was recorded without an exception.
                            </p>

                        </div>

                    </div>

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
                                Reading Information
                            </h3>

                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                Meter <?php echo e($meterReading->meter->meter_number ?? 'N/A'); ?>

                            </p>

                        </div>

                    </div>

                </div>


                

                <div class="p-6">

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">


                        

                        <div class="bg-gray-50 dark:bg-gray-800 rounded-xl p-5">

                            <p class="text-xs uppercase tracking-wider font-semibold text-gray-500 dark:text-gray-400">
                                Customer
                            </p>

                            <p class="mt-2 text-lg font-semibold text-gray-800 dark:text-white">
                                <?php echo e($meterReading->meter->customer->full_name ?? 'N/A'); ?>

                            </p>

                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($meterReading->meter->customer->customer_number ?? false): ?>

                                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                                    <?php echo e($meterReading->meter->customer->customer_number); ?>

                                </p>

                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                        </div>


                        

                        <div class="bg-gray-50 dark:bg-gray-800 rounded-xl p-5">

                            <p class="text-xs uppercase tracking-wider font-semibold text-gray-500 dark:text-gray-400">
                                Reading Date
                            </p>

                            <p class="mt-2 text-lg font-semibold text-gray-800 dark:text-white">
                                <?php echo e(\Carbon\Carbon::parse($meterReading->reading_date)->format('d M Y')); ?>

                            </p>

                        </div>


                        

                        <div class="bg-gray-50 dark:bg-gray-800 rounded-xl p-5">

                            <p class="text-xs uppercase tracking-wider font-semibold text-gray-500 dark:text-gray-400">
                                Previous Reading
                            </p>

                            <p class="mt-2 text-2xl font-bold text-gray-800 dark:text-white">
                                <?php echo e(number_format($meterReading->previous_reading, 2)); ?>

                            </p>

                        </div>


                        

                        <div class="bg-gray-50 dark:bg-gray-800 rounded-xl p-5">

                            <p class="text-xs uppercase tracking-wider font-semibold text-gray-500 dark:text-gray-400">
                                Current Reading
                            </p>

                            <p class="mt-2 text-2xl font-bold text-gray-800 dark:text-white">
                                <?php echo e(number_format($meterReading->current_reading, 2)); ?>

                            </p>

                        </div>


                        

                        <div class="sm:col-span-2 bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-xl p-5">

                            <p class="text-xs uppercase tracking-wider font-semibold text-blue-600 dark:text-blue-400">
                                Water Consumption
                            </p>

                            <p class="mt-2 text-3xl font-bold text-blue-700 dark:text-blue-300">
                                <?php echo e(number_format($meterReading->consumption, 2)); ?> m³
                            </p>

                            <p class="text-sm text-blue-600 dark:text-blue-400 mt-1">
                                Current reading − previous reading
                            </p>

                        </div>

                    </div>


                    

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($meterReading->exception_type): ?>

                        <div class="mt-8 border-t border-gray-200 dark:border-gray-800 pt-8">

                            <h3 class="text-lg font-semibold text-gray-800 dark:text-white">
                                Exception Details
                            </h3>

                            <div class="mt-4 bg-purple-50 dark:bg-purple-900/20 border border-purple-200 dark:border-purple-800 rounded-xl p-5">

                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">

                                    

                                    <div>

                                        <p class="text-xs uppercase tracking-wider font-semibold text-purple-600 dark:text-purple-400">
                                            Exception Type
                                        </p>

                                        <p class="mt-2 font-semibold text-purple-800 dark:text-purple-300">
                                            <?php echo e(ucwords(str_replace('_', ' ', $meterReading->exception_type))); ?>

                                        </p>

                                    </div>


                                    

                                    <div>

                                        <p class="text-xs uppercase tracking-wider font-semibold text-purple-600 dark:text-purple-400">
                                            Consumption Status
                                        </p>

                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($meterReading->is_abnormal): ?>

                                            <span class="inline-flex mt-2 items-center px-3 py-1 rounded-full bg-amber-100 dark:bg-amber-900/30 text-amber-700 dark:text-amber-300 text-sm font-bold">
                                                ⚠️ Abnormal
                                            </span>

                                        <?php else: ?>

                                            <span class="inline-flex mt-2 items-center px-3 py-1 rounded-full bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-300 text-sm font-bold">
                                                ✓ Within Normal Range
                                            </span>

                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                                    </div>

                                </div>


                                

                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($meterReading->exception_notes): ?>

                                    <div class="mt-5 pt-5 border-t border-purple-200 dark:border-purple-800">

                                        <p class="text-xs uppercase tracking-wider font-semibold text-purple-600 dark:text-purple-400">
                                            Operator Notes
                                        </p>

                                        <p class="mt-2 text-sm text-purple-800 dark:text-purple-300 whitespace-pre-line">
                                            <?php echo e($meterReading->exception_notes); ?>

                                        </p>

                                    </div>

                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                            </div>

                        </div>

                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                </div>


                

                <div class="px-6 py-5 bg-gray-50 dark:bg-gray-800/50 border-t border-gray-200 dark:border-gray-800 flex flex-col sm:flex-row justify-end gap-3">

                    <a
                        href="<?php echo e(route('meter-readings.index')); ?>"
                        class="inline-flex justify-center items-center px-5 py-2.5 rounded-xl border border-gray-300 dark:border-gray-700 text-gray-700 dark:text-gray-300 font-semibold hover:bg-gray-100 dark:hover:bg-gray-800 transition"
                    >
                        ← Back
                    </a>

                    <a
                        href="<?php echo e(route('meter-readings.edit', $meterReading)); ?>"
                        class="inline-flex justify-center items-center px-6 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-semibold transition shadow-sm"
                    >
                        ✏️ Edit Reading
                    </a>

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
<?php endif; ?><?php /**PATH C:\Users\ADMIN\Downloads\maji-mazuri-deploy\resources\views\meter-readings\show.blade.php ENDPATH**/ ?>