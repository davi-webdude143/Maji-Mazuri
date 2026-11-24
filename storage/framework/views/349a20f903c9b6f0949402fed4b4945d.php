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
                Add Customer
            </h2>

            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                Register a new Maji Mazuri water customer
            </p>
        </div>
     <?php $__env->endSlot(); ?>

    <div class="py-8 bg-gray-100 dark:bg-gray-950 min-h-screen">

        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Validation Errors -->
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

            <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-800">

                <!-- Header -->
                <div class="p-6 border-b border-gray-200 dark:border-gray-800">

                    <div class="flex items-center gap-4">

                        <div class="w-12 h-12 rounded-xl bg-blue-100 dark:bg-blue-900/40 flex items-center justify-center text-2xl">
                            👤
                        </div>

                        <div>
                            <h3 class="text-lg font-semibold text-gray-800 dark:text-white">
                                Customer Information
                            </h3>

                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                Enter the customer's details below.
                            </p>
                        </div>

                    </div>

                </div>

                <!-- Form -->
                <form method="POST" action="<?php echo e(route('customers.store')); ?>">

                    <?php echo csrf_field(); ?>

                    <div class="p-6 space-y-6">

                        <!-- Full Name -->
                        <div>
                            <label for="full_name"
                                   class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Full Name <span class="text-red-500">*</span>
                            </label>

                            <input
                                type="text"
                                id="full_name"
                                name="full_name"
                                value="<?php echo e(old('full_name')); ?>"
                                required
                                placeholder="e.g. John Kamau"
                                class="w-full rounded-xl border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white focus:border-blue-500 focus:ring-blue-500"
                            >
                        </div>

                        <!-- ID + Phone -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                            <div>
                                <label for="id_number"
                                       class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    ID Number
                                </label>

                                <input
                                    type="text"
                                    id="id_number"
                                    name="id_number"
                                    value="<?php echo e(old('id_number')); ?>"
                                    placeholder="e.g. 12345678"
                                    class="w-full rounded-xl border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white focus:border-blue-500 focus:ring-blue-500"
                                >
                            </div>

                            <div>
                                <label for="phone_number"
                                       class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Phone Number <span class="text-red-500">*</span>
                                </label>

                                <input
                                    type="text"
                                    id="phone_number"
                                    name="phone_number"
                                    value="<?php echo e(old('phone_number')); ?>"
                                    required
                                    placeholder="e.g. 0712345678"
                                    class="w-full rounded-xl border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white focus:border-blue-500 focus:ring-blue-500"
                                >
                            </div>

                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email"
                                   class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Email Address
                            </label>

                            <input
                                type="email"
                                id="email"
                                name="email"
                                value="<?php echo e(old('email')); ?>"
                                placeholder="e.g. customer@example.com"
                                class="w-full rounded-xl border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white focus:border-blue-500 focus:ring-blue-500"
                            >
                        </div>

                        <!-- Area -->
                        <div>
                            <label for="area"
                                   class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Area / Location
                            </label>

                            <input
                                type="text"
                                id="area"
                                name="area"
                                value="<?php echo e(old('area')); ?>"
                                placeholder="e.g. Maji Mazuri Estate"
                                class="w-full rounded-xl border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white focus:border-blue-500 focus:ring-blue-500"
                            >
                        </div>

                        <!-- Address -->
                        <div>
                            <label for="address"
                                   class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Physical Address
                            </label>

                            <textarea
                                id="address"
                                name="address"
                                rows="3"
                                placeholder="Enter the customer's physical address"
                                class="w-full rounded-xl border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white focus:border-blue-500 focus:ring-blue-500"
                            ><?php echo e(old('address')); ?></textarea>
                        </div>

                        <!-- Status -->
                        <div>
                            <label for="status"
                                   class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Account Status <span class="text-red-500">*</span>
                            </label>

                            <select
                                id="status"
                                name="status"
                                required
                                class="w-full rounded-xl border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white focus:border-blue-500 focus:ring-blue-500"
                            >
                                <option value="active" <?php echo e(old('status', 'active') === 'active' ? 'selected' : ''); ?>>
                                    Active
                                </option>

                                <option value="inactive" <?php echo e(old('status') === 'inactive' ? 'selected' : ''); ?>>
                                    Inactive
                                </option>
                            </select>
                        </div>

                    </div>

                    <!-- Buttons -->
                    <div class="px-6 py-5 bg-gray-50 dark:bg-gray-800/50 border-t border-gray-200 dark:border-gray-800 flex flex-col sm:flex-row justify-end gap-3">

                        <a
                            href="<?php echo e(route('customers.index')); ?>"
                            class="inline-flex justify-center items-center px-5 py-2.5 rounded-xl border border-gray-300 dark:border-gray-700 text-gray-700 dark:text-gray-300 font-semibold hover:bg-gray-100 dark:hover:bg-gray-800 transition"
                        >
                            Cancel
                        </a>

                        <button
                            type="submit"
                            class="inline-flex justify-center items-center px-6 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-semibold transition shadow-sm"
                        >
                            Register Customer
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
<?php endif; ?><?php /**PATH C:\Users\ADMIN\Downloads\maji-mazuri-deploy\resources\views\customers\create.blade.php ENDPATH**/ ?>