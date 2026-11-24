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
                Edit Meter Reading
            </h2>

            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                Correct or update an existing water meter reading
            </p>
        </div>
     <?php $__env->endSlot(); ?>

    <div class="py-8 bg-gray-100 dark:bg-gray-950 min-h-screen">

        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

            
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
                            ✏️
                        </div>

                        <div>

                            <h3 class="text-lg font-semibold text-gray-800 dark:text-white">
                                Update Reading
                            </h3>

                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                Review the reading information before saving your changes.
                            </p>

                        </div>

                    </div>

                </div>


                
                <form method="POST" action="<?php echo e(route('meter-readings.update', $meterReading)); ?>">

                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>

                    <div class="p-6 space-y-6">


                        
                        <div>

                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Water Meter
                            </label>

                            <div class="w-full rounded-xl border border-gray-300 dark:border-gray-700 bg-gray-100 dark:bg-gray-800 px-4 py-3">

                                <p class="font-semibold text-gray-800 dark:text-white">
                                    <?php echo e($meterReading->meter->meter_number ?? 'N/A'); ?>

                                </p>

                                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                                    <?php echo e($meterReading->meter->customer->full_name ?? 'No customer'); ?>

                                </p>

                            </div>

                        </div>


                        
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
                                value="<?php echo e(old('reading_date', $meterReading->reading_date?->format('Y-m-d'))); ?>"
                                required
                                class="w-full rounded-xl border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white focus:border-blue-500 focus:ring-blue-500"
                            >

                        </div>


                        
                        <div>

                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Previous Reading
                            </label>

                            <div class="w-full rounded-xl border border-gray-300 dark:border-gray-700 bg-gray-100 dark:bg-gray-800 px-4 py-3">

                                <span class="font-semibold text-gray-800 dark:text-white">
                                    <?php echo e(number_format($meterReading->previous_reading, 2)); ?>

                                </span>

                                <span class="text-sm text-gray-500 dark:text-gray-400 ml-2">
                                    m³
                                </span>

                            </div>

                            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                                The previous reading is preserved so historical consumption remains traceable.
                            </p>

                        </div>


                        
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
                                value="<?php echo e(old('current_reading', $meterReading->current_reading)); ?>"
                                required
                                class="w-full rounded-xl border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white focus:border-blue-500 focus:ring-blue-500"
                            >

                        </div>


                        
                        <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-xl p-5">

                            <div class="flex items-center justify-between gap-4">

                                <div>

                                    <h4 class="font-semibold text-blue-800 dark:text-blue-300">
                                        Consumption
                                    </h4>

                                    <p class="text-sm text-blue-700 dark:text-blue-400 mt-1">
                                        Calculated from the previous and current readings.
                                    </p>

                                </div>

                                <div
                                    id="consumption-display"
                                    class="text-xl font-bold text-blue-700 dark:text-blue-300"
                                >
                                    <?php echo e(number_format($meterReading->consumption, 2)); ?> m³
                                </div>

                            </div>

                        </div>


                        
                        <div class="border border-gray-200 dark:border-gray-700 rounded-xl p-5">

                            <div class="flex items-start gap-3">

                                <input
                                    type="checkbox"
                                    id="is_exception"
                                    name="is_exception"
                                    value="1"
                                    <?php echo e(old('is_exception', $meterReading->exception_type) ? 'checked' : ''); ?>

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
                                        Select this if the reading was affected by replacement,
                                        rollover, a faulty meter or an incorrect previous reading.
                                    </p>

                                </div>

                            </div>


                            
                            <div
                                id="exception-options"
                                class="<?php echo e(old('is_exception', $meterReading->exception_type) ? '' : 'hidden'); ?> mt-5"
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
                                        <?php echo e(old('exception_type', $meterReading->exception_type) === 'meter_replaced' ? 'selected' : ''); ?>

                                    >
                                        Meter replaced
                                    </option>

                                    <option
                                        value="meter_rollover"
                                        <?php echo e(old('exception_type', $meterReading->exception_type) === 'meter_rollover' ? 'selected' : ''); ?>

                                    >
                                        Meter reset / rolled over
                                    </option>

                                    <option
                                        value="faulty_meter"
                                        <?php echo e(old('exception_type', $meterReading->exception_type) === 'faulty_meter' ? 'selected' : ''); ?>

                                    >
                                        Faulty meter
                                    </option>

                                    <option
                                        value="incorrect_previous_reading"
                                        <?php echo e(old('exception_type', $meterReading->exception_type) === 'incorrect_previous_reading' ? 'selected' : ''); ?>

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
                                        id="exception_notes"
                                        name="exception_notes"
                                        rows="4"
                                        maxlength="1000"
                                        placeholder="Explain what happened..."
                                        class="w-full rounded-xl border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white focus:border-blue-500 focus:ring-blue-500"
                                    ><?php echo e(old('exception_notes', $meterReading->exception_notes)); ?></textarea>

                                </div>

                            </div>

                        </div>


                        
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($meterReading->is_abnormal): ?>

                            <div class="bg-amber-50 dark:bg-amber-900/20 border border-amber-300 dark:border-amber-800 rounded-xl p-5">

                                <div class="flex gap-3">

                                    <div class="text-xl">
                                        ⚠️
                                    </div>

                                    <div>

                                        <h4 class="font-semibold text-amber-800 dark:text-amber-300">
                                            This Reading Was Flagged as Abnormal
                                        </h4>

                                        <p class="text-sm text-amber-700 dark:text-amber-400 mt-1">
                                            The recorded consumption exceeded the current abnormal-consumption threshold.
                                        </p>

                                    </div>

                                </div>

                            </div>

                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>


                        
                        <div class="bg-gray-50 dark:bg-gray-800/60 border border-gray-200 dark:border-gray-700 rounded-xl p-4">

                            <div class="flex gap-3">

                                <div class="text-xl">
                                    ℹ️
                                </div>

                                <div>

                                    <h4 class="font-semibold text-gray-800 dark:text-gray-200">
                                        Important
                                    </h4>

                                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                                        Updating this reading will recalculate its consumption
                                        and keep the meter's current reading synchronized.
                                    </p>

                                </div>

                            </div>

                        </div>

                    </div>


                    
                    <div class="px-6 py-5 bg-gray-50 dark:bg-gray-800/50 border-t border-gray-200 dark:border-gray-800 flex flex-col sm:flex-row justify-end gap-3">

                        <a
                            href="<?php echo e(route('meter-readings.show', $meterReading)); ?>"
                            class="inline-flex justify-center items-center px-5 py-2.5 rounded-xl border border-gray-300 dark:border-gray-700 text-gray-700 dark:text-gray-300 font-semibold hover:bg-gray-100 dark:hover:bg-gray-800 transition"
                        >
                            Cancel
                        </a>

                        <button
                            type="submit"
                            class="inline-flex justify-center items-center px-6 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-semibold transition shadow-sm"
                        >
                            Update Reading
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>


    
    <script>

        const previousReading =
            <?php echo e((float) $meterReading->previous_reading); ?>;

        const currentInput =
            document.getElementById('current_reading');

        const consumptionDisplay =
            document.getElementById('consumption-display');

        const exceptionCheckbox =
            document.getElementById('is_exception');

        const exceptionOptions =
            document.getElementById('exception-options');


        function updateConsumption()
        {
            const current =
                parseFloat(currentInput.value || 0);

            const consumption =
                current - previousReading;

            if (consumption >= 0)
            {
                consumptionDisplay.textContent =
                    consumption.toFixed(2) + ' m³';
            }
            else
            {
                consumptionDisplay.textContent =
                    'Reading decreased';
            }
        }


        currentInput.addEventListener(
            'input',
            updateConsumption
        );


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
                }
            }
        );

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
<?php endif; ?><?php /**PATH C:\Users\ADMIN\Downloads\maji-mazuri-deploy\resources\views\meter-readings\edit.blade.php ENDPATH**/ ?>