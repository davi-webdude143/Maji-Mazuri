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
                Edit Water Meter
            </h2>

            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                Update water meter information
            </p>
        </div>
     <?php $__env->endSlot(); ?>

    <div class="py-8 bg-gray-100 dark:bg-gray-950 min-h-screen">

        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

            
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($errors->any()): ?>
                <div class="mb-6 bg-red-50 dark:bg-red-900/30 border border-red-200 dark:border-red-800 rounded-xl p-4">

                    <p class="font-semibold text-red-700 dark:text-red-300 mb-2">
                        Please correct the following errors:
                    </p>

                    <ul class="list-disc list-inside text-sm text-red-600 dark:text-red-400 space-y-1">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </ul>

                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>


            
            <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-800">

                
                <div class="p-6 border-b border-gray-200 dark:border-gray-800">

                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">

                        <div>
                            <h3 class="text-lg font-semibold text-gray-800 dark:text-white">
                                Meter Information
                            </h3>

                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                                Update the details for meter
                                <span class="font-semibold text-gray-700 dark:text-gray-200">
                                    <?php echo e($meter->meter_number); ?>

                                </span>
                            </p>
                        </div>

                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isAdmin): ?>
                            <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-semibold bg-blue-100 text-blue-700 dark:bg-blue-900/40 dark:text-blue-300">
                                Administrator — Full Access
                            </span>
                        <?php else: ?>
                            <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-semibold bg-gray-100 text-gray-600 dark:bg-gray-800 dark:text-gray-400">
                                Restricted Access
                            </span>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                    </div>

                </div>


                <form method="POST"
                      action="<?php echo e(route('meters.update', $meter)); ?>"
                      class="p-6 space-y-6">

                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>


                    
                    
                    

                    <div>

                        <label for="customer_id"
                               class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">

                            Customer

                        </label>

                        <select id="customer_id"
                                name="customer_id"
                                required
                                class="w-full rounded-xl border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white focus:border-blue-500 focus:ring-blue-500">

                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                <option value="<?php echo e($customer->id); ?>"
                                    <?php echo e(old('customer_id', $meter->customer_id) == $customer->id ? 'selected' : ''); ?>>

                                    <?php echo e($customer->full_name); ?>

                                    — <?php echo e($customer->customer_number); ?>


                                </option>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                        </select>

                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                            The customer assigned to this water meter.
                        </p>

                    </div>


                    
                    
                    

                    <div>

                        <div class="flex items-center justify-between mb-2">

                            <label for="meter_number"
                                   class="block text-sm font-semibold text-gray-700 dark:text-gray-300">

                                Meter Number

                            </label>

                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isAdmin): ?>

                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-700 dark:bg-blue-900/40 dark:text-blue-300">
                                    Admin Editable
                                </span>

                            <?php else: ?>

                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-600 dark:bg-gray-800 dark:text-gray-400">
                                    Locked
                                </span>

                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                        </div>


                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isAdmin): ?>

                            <input type="text"
                                   id="meter_number"
                                   name="meter_number"
                                   value="<?php echo e(old('meter_number', $meter->meter_number)); ?>"
                                   required
                                   class="w-full rounded-xl border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white focus:border-blue-500 focus:ring-blue-500">

                        <?php else: ?>

                            <input type="text"
                                   id="meter_number"
                                   value="<?php echo e($meter->meter_number); ?>"
                                   readonly
                                   class="w-full rounded-xl border-gray-300 dark:border-gray-700 bg-gray-100 dark:bg-gray-800/70 text-gray-600 dark:text-gray-400 cursor-not-allowed rounded-xl">

                            
                            <input type="hidden"
                                   name="meter_number"
                                   value="<?php echo e($meter->meter_number); ?>">

                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>


                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">

                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isAdmin): ?>
                                The unique number printed on the physical water meter.
                            <?php else: ?>
                                Only an Administrator can change the meter number.
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                        </p>

                    </div>


                    
                    
                    

                    <div>

                        <label for="installation_date"
                               class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">

                            Installation Date

                        </label>

                        <input type="date"
                               id="installation_date"
                               name="installation_date"
                               value="<?php echo e(old('installation_date', optional($meter->installation_date)->format('Y-m-d'))); ?>"
                               class="w-full rounded-xl border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white focus:border-blue-500 focus:ring-blue-500">

                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                            Date when the meter was installed.
                        </p>

                    </div>


                    
                    
                    

                    <div>

                        <div class="flex items-center justify-between mb-2">

                            <label for="initial_reading"
                                   class="block text-sm font-semibold text-gray-700 dark:text-gray-300">

                                Initial Reading

                            </label>


                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isAdmin): ?>

                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-700 dark:bg-blue-900/40 dark:text-blue-300">
                                    Admin Editable
                                </span>

                            <?php else: ?>

                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-600 dark:bg-gray-800 dark:text-gray-400">
                                    Admin Only
                                </span>

                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                        </div>


                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isAdmin): ?>

                            <input type="number"
                                   step="0.01"
                                   min="0"
                                   id="initial_reading"
                                   name="initial_reading"
                                   value="<?php echo e(old('initial_reading', $meter->initial_reading)); ?>"
                                   required
                                   class="w-full rounded-xl border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white focus:border-blue-500 focus:ring-blue-500">

                        <?php else: ?>

                            <input type="number"
                                   step="0.01"
                                   id="initial_reading"
                                   value="<?php echo e($meter->initial_reading); ?>"
                                   readonly
                                   class="w-full rounded-xl border-gray-300 dark:border-gray-700 bg-gray-100 dark:bg-gray-800/70 text-gray-600 dark:text-gray-400 cursor-not-allowed">

                            
                            <input type="hidden"
                                   name="initial_reading"
                                   value="<?php echo e($meter->initial_reading); ?>">

                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>


                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">

                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isAdmin): ?>

                                You can correct the original reading recorded when this meter was registered.

                            <?php else: ?>

                                Only an Administrator can edit the original meter reading.

                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                        </p>

                    </div>


                    
                    
                    

                    <div>

                        <div class="flex items-center justify-between mb-2">

                            <label for="current_reading"
                                   class="block text-sm font-semibold text-gray-700 dark:text-gray-300">

                                Current Reading

                            </label>


                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isAdmin): ?>

                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-700 dark:bg-blue-900/40 dark:text-blue-300">
                                    Admin Editable
                                </span>

                            <?php else: ?>

                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-600 dark:bg-gray-800 dark:text-gray-400">
                                    Locked
                                </span>

                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                        </div>


                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isAdmin): ?>

                            <input type="number"
                                   step="0.01"
                                   min="0"
                                   id="current_reading"
                                   name="current_reading"
                                   value="<?php echo e(old('current_reading', $meter->current_reading)); ?>"
                                   required
                                   class="w-full rounded-xl border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white focus:border-blue-500 focus:ring-blue-500">

                        <?php else: ?>

                            <input type="number"
                                   step="0.01"
                                   id="current_reading"
                                   value="<?php echo e($meter->current_reading); ?>"
                                   readonly
                                   class="w-full rounded-xl border-gray-300 dark:border-gray-700 bg-gray-100 dark:bg-gray-800/70 text-gray-600 dark:text-gray-400 cursor-not-allowed">

                            
                            <input type="hidden"
                                   name="current_reading"
                                   value="<?php echo e($meter->current_reading); ?>">

                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>


                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">

                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isAdmin): ?>

                                Administrator can correct the current meter reading if necessary.

                            <?php else: ?>

                                Only an Administrator can change the current reading from this page.

                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                        </p>

                    </div>


                    
                    
                    

                    <div>

                        <div class="flex items-center justify-between mb-2">

                            <label for="maximum_reading"
                                   class="block text-sm font-semibold text-gray-700 dark:text-gray-300">

                                Maximum Reading

                                <span class="text-gray-400 font-normal">
                                    (Optional)
                                </span>

                            </label>


                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isAdmin): ?>

                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-700 dark:bg-blue-900/40 dark:text-blue-300">
                                    Admin Editable
                                </span>

                            <?php else: ?>

                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-600 dark:bg-gray-800 dark:text-gray-400">
                                    Locked
                                </span>

                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                        </div>


                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isAdmin): ?>

                            <input type="number"
                                   step="0.01"
                                   min="0"
                                   id="maximum_reading"
                                   name="maximum_reading"
                                   value="<?php echo e(old('maximum_reading', $meter->maximum_reading)); ?>"
                                   class="w-full rounded-xl border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white focus:border-blue-500 focus:ring-blue-500">

                        <?php else: ?>

                            <input type="number"
                                   step="0.01"
                                   id="maximum_reading"
                                   value="<?php echo e($meter->maximum_reading); ?>"
                                   readonly
                                   class="w-full rounded-xl border-gray-300 dark:border-gray-700 bg-gray-100 dark:bg-gray-800/70 text-gray-600 dark:text-gray-400 cursor-not-allowed">

                            
                            <input type="hidden"
                                   name="maximum_reading"
                                   value="<?php echo e($meter->maximum_reading); ?>">

                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>


                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">

                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isAdmin): ?>

                                Maximum reading allowed for this meter, if applicable.

                            <?php else: ?>

                                Only an Administrator can change the maximum meter reading.

                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                        </p>

                    </div>


                    
                    
                    

                    <div>

                        <div class="flex items-center justify-between mb-2">

                            <label for="status"
                                   class="block text-sm font-semibold text-gray-700 dark:text-gray-300">

                                Status

                            </label>

                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isAdmin): ?>

                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-700 dark:bg-blue-900/40 dark:text-blue-300">
                                    Full Access
                                </span>

                            <?php elseif(auth()->user()->role === 'manager'): ?>

                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700 dark:bg-green-900/40 dark:text-green-300">
                                    Manager Access
                                </span>

                            <?php else: ?>

                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-600 dark:bg-gray-800 dark:text-gray-400">
                                    Restricted
                                </span>

                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                        </div>


                        <select id="status"
                                name="status"
                                required
                                class="w-full rounded-xl border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white focus:border-blue-500 focus:ring-blue-500">

                            <option value="active"
                                <?php echo e(old('status', $meter->status) === 'active' ? 'selected' : ''); ?>>
                                Active
                            </option>

                            <option value="inactive"
                                <?php echo e(old('status', $meter->status) === 'inactive' ? 'selected' : ''); ?>>
                                Inactive
                            </option>

                        </select>


                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">

                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isAdmin): ?>

                                Administrator has full control over meter status.

                            <?php elseif(auth()->user()->role === 'manager'): ?>

                                Manager can activate or deactivate the meter.

                            <?php else: ?>

                                Operator cannot deactivate an active meter.

                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                        </p>

                    </div>


                    
                    
                    

                    <div class="rounded-xl border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800/50 p-4">

                        <div class="flex items-start gap-3">

                            <div class="flex-shrink-0 mt-0.5">

                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isAdmin): ?>

                                    <div class="w-8 h-8 rounded-full bg-blue-100 dark:bg-blue-900/40 flex items-center justify-center text-blue-600 dark:text-blue-300">
                                        ✓
                                    </div>

                                <?php else: ?>

                                    <div class="w-8 h-8 rounded-full bg-gray-200 dark:bg-gray-700 flex items-center justify-center text-gray-600 dark:text-gray-300">
                                        🔒
                                    </div>

                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                            </div>


                            <div>

                                <p class="text-sm font-semibold text-gray-800 dark:text-gray-200">

                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isAdmin): ?>

                                        Administrator Access

                                    <?php else: ?>

                                        Restricted Meter Fields

                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                                </p>


                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">

                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isAdmin): ?>

                                        You have full permission to update all meter information.

                                    <?php else: ?>

                                        Meter Number, Initial Reading, Current Reading, and Maximum Reading
                                        are protected and can only be changed by an Administrator.

                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                                </p>

                            </div>

                        </div>

                    </div>


                    
                    
                    

                    <div class="flex flex-col sm:flex-row gap-3 pt-4 border-t border-gray-200 dark:border-gray-800">

                        <a href="<?php echo e(route('meters.index')); ?>"
                           class="inline-flex items-center justify-center px-5 py-2.5 rounded-xl border border-gray-300 dark:border-gray-700 text-gray-700 dark:text-gray-300 font-semibold hover:bg-gray-100 dark:hover:bg-gray-800 transition">

                            Cancel

                        </a>


                        <button type="submit"
                                class="inline-flex items-center justify-center px-5 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-semibold transition shadow-sm">

                            Update Meter

                        </button>

                    </div>

                </form>

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

<?php /**PATH C:\Users\ADMIN\Downloads\maji-mazuri-deploy\resources\views\meters\edit.blade.php ENDPATH**/ ?>