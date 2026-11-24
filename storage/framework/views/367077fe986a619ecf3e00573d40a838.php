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

        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">

            <div>

                <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100">
                    User Management
                </h2>

                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Manage administrators, managers, and system operators.
                </p>

            </div>

            <a
                href="<?php echo e(route('users.create')); ?>"
                class="inline-flex items-center justify-center rounded-lg bg-blue-600 px-4 py-2.5
                       text-sm font-semibold text-white shadow-sm transition
                       hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500
                       focus:ring-offset-2"
            >
                + Add New User
            </a>

        </div>

     <?php $__env->endSlot(); ?>


    <div class="py-8">

        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

            
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('success')): ?>

                <div class="mb-6 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
                    <?php echo e(session('success')); ?>

                </div>

            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>


            
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($errors->any()): ?>

                <div class="mb-6 rounded-lg border border-red-200 bg-red-50 px-4 py-3">

                    <p class="text-sm font-semibold text-red-700">
                        Please correct the following:
                    </p>

                    <ul class="mt-2 list-inside list-disc text-sm text-red-600">

                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <li><?php echo e($error); ?></li>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                    </ul>

                </div>

            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>


            
            <div class="mb-8 grid grid-cols-1 gap-6 sm:grid-cols-3">

                
                <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">

                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">
                        Total Users
                    </p>

                    <p class="mt-2 text-3xl font-bold text-gray-900 dark:text-white">
                        <?php echo e($users->count()); ?>

                    </p>

                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                        Registered system accounts
                    </p>

                </div>


                
                <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">

                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">
                        Administrators
                    </p>

                    <p class="mt-2 text-3xl font-bold text-gray-900 dark:text-white">
                        <?php echo e($users->where('role', 'admin')->count()); ?>

                    </p>

                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                        Full system access
                    </p>

                </div>


                
                <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">

                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">
                        Managers
                    </p>

                    <p class="mt-2 text-3xl font-bold text-gray-900 dark:text-white">
                        <?php echo e($users->where('role', 'manager')->count()); ?>

                    </p>

                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                        Operational and financial management
                    </p>

                </div>

            </div>


            
            <div class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800">

                <div class="border-b border-gray-200 px-6 py-5 dark:border-gray-700">

                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        System Users
                    </h3>

                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                        View and manage accounts registered in the system.
                    </p>

                </div>


                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($users->isEmpty()): ?>

                    <div class="px-6 py-12 text-center">

                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            No users have been registered yet.
                        </p>

                    </div>

                <?php else: ?>

                    <div class="overflow-x-auto">

                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">

                            <thead class="bg-gray-50 dark:bg-gray-900">

                                <tr>

                                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                        User
                                    </th>

                                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                        Email
                                    </th>

                                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                        Role
                                    </th>

                                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                        Created
                                    </th>

                                    <th class="px-6 py-3 text-right text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                        Actions
                                    </th>

                                </tr>

                            </thead>


                            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">

                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                    <tr class="transition hover:bg-gray-50 dark:hover:bg-gray-700/40">

                                        
                                        <td class="whitespace-nowrap px-6 py-4">

                                            <div class="flex items-center">

                                                <div class="flex h-10 w-10 items-center justify-center rounded-full bg-blue-100 dark:bg-blue-900/40">

                                                    <span class="font-semibold text-blue-700 dark:text-blue-300">
                                                        <?php echo e(strtoupper(substr($user->name, 0, 1))); ?>

                                                    </span>

                                                </div>

                                                <div class="ml-4">

                                                    <div class="font-semibold text-gray-900 dark:text-white">
                                                        <?php echo e($user->name); ?>

                                                    </div>

                                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($user->id === auth()->id()): ?>

                                                        <span class="text-xs text-gray-500 dark:text-gray-400">
                                                            Currently logged in
                                                        </span>

                                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                                                </div>

                                            </div>

                                        </td>


                                        
                                        <td class="whitespace-nowrap px-6 py-4">

                                            <span class="text-sm text-gray-600 dark:text-gray-300">
                                                <?php echo e($user->email); ?>

                                            </span>

                                        </td>


                                        
                                        <td class="whitespace-nowrap px-6 py-4">

                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($user->role === 'admin'): ?>

                                                <span class="inline-flex rounded-full bg-purple-100 px-3 py-1 text-xs font-semibold text-purple-800 dark:bg-purple-900/40 dark:text-purple-300">
                                                    Administrator
                                                </span>

                                            <?php elseif($user->role === 'manager'): ?>

                                                <span class="inline-flex rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-800 dark:bg-green-900/40 dark:text-green-300">
                                                    Manager
                                                </span>

                                            <?php elseif($user->role === 'operator'): ?>

                                                <span class="inline-flex rounded-full bg-blue-100 px-3 py-1 text-xs font-semibold text-blue-800 dark:bg-blue-900/40 dark:text-blue-300">
                                                    Operator
                                                </span>

                                            <?php else: ?>

                                                <span class="inline-flex rounded-full bg-gray-100 px-3 py-1 text-xs font-semibold text-gray-800 dark:bg-gray-700 dark:text-gray-300">
                                                    <?php echo e(ucfirst($user->role)); ?>

                                                </span>

                                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                                        </td>


                                        
                                        <td class="whitespace-nowrap px-6 py-4">

                                            <span class="text-sm text-gray-600 dark:text-gray-300">
                                                <?php echo e($user->created_at?->format('d M Y')); ?>

                                            </span>

                                        </td>


                                        
                                        <td class="whitespace-nowrap px-6 py-4 text-right">

                                            <div class="inline-flex items-center gap-2">

                                                <a
                                                    href="<?php echo e(route('users.edit', $user)); ?>"
                                                    class="rounded-lg bg-blue-50 px-3 py-1.5 text-xs font-semibold
                                                           text-blue-700 transition hover:bg-blue-100
                                                           dark:bg-blue-900/30 dark:text-blue-300
                                                           dark:hover:bg-blue-900/50"
                                                >
                                                    Edit
                                                </a>


                                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($user->id !== auth()->id()): ?>

                                                    <form
                                                        action="<?php echo e(route('users.destroy', $user)); ?>"
                                                        method="POST"
                                                        onsubmit="return confirm('Are you sure you want to delete this user?');"
                                                    >

                                                        <?php echo csrf_field(); ?>

                                                        <?php echo method_field('DELETE'); ?>

                                                        <button
                                                            type="submit"
                                                            class="rounded-lg bg-red-50 px-3 py-1.5 text-xs font-semibold
                                                                   text-red-700 transition hover:bg-red-100
                                                                   dark:bg-red-900/30 dark:text-red-300
                                                                   dark:hover:bg-red-900/50"
                                                        >
                                                            Delete
                                                        </button>

                                                    </form>

                                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                                            </div>

                                        </td>

                                    </tr>

                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                            </tbody>

                        </table>

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
<?php endif; ?><?php /**PATH C:\Users\ADMIN\Downloads\maji-mazuri-deploy\resources\views/users/index.blade.php ENDPATH**/ ?>