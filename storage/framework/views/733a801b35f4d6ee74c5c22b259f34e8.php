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
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <p class="text-sm font-medium text-blue-600">Management</p>

                <h2 class="mt-1 text-2xl font-bold tracking-tight text-gray-900">
                    Water Meters
                </h2>

                <p class="mt-1 text-sm text-gray-500">
                    Manage customer water meters and their current status.
                </p>
            </div>

            <a
                href="<?php echo e(route('meters.create')); ?>"
                class="inline-flex items-center justify-center gap-2 rounded-lg bg-blue-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-5 w-5"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="2"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M12 4v16m8-8H4"
                    />
                </svg>

                Add Meter
            </a>
        </div>
     <?php $__env->endSlot(); ?>

    <div class="min-h-screen bg-[#F7F9FC] py-8">
        <div class="mx-auto max-w-7xl space-y-6 px-4 sm:px-6 lg:px-8">

            
            <div class="grid grid-cols-1 gap-5 sm:grid-cols-3">

                
                <div class="rounded-2xl border border-gray-100 bg-white p-5 shadow-sm">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">
                                Total Meters
                            </p>

                            <p class="mt-2 text-3xl font-bold text-gray-900">
                                <?php echo e($totalMeters); ?>

                            </p>
                        </div>

                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-blue-50 text-blue-600">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-6 w-6"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="2"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M9 17v-2a4 4 0 014-4h4m0 0V7m0 4l-3-3m3 3l3-3M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"
                                />
                            </svg>
                        </div>
                    </div>
                </div>

                
                <div class="rounded-2xl border border-gray-100 bg-white p-5 shadow-sm">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">
                                Active Meters
                            </p>

                            <p class="mt-2 text-3xl font-bold text-green-600">
                                <?php echo e($activeMeters); ?>

                            </p>
                        </div>

                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-green-50 text-green-600">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-6 w-6"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="2"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M5 13l4 4L19 7"
                                />
                            </svg>
                        </div>
                    </div>
                </div>

                
                <div class="rounded-2xl border border-gray-100 bg-white p-5 shadow-sm">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">
                                Inactive Meters
                            </p>

                            <p class="mt-2 text-3xl font-bold text-gray-700">
                                <?php echo e($inactiveMeters); ?>

                            </p>
                        </div>

                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-gray-100 text-gray-600">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-6 w-6"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="2"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"
                                />
                            </svg>
                        </div>
                    </div>
                </div>

            </div>

            
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('success')): ?>
                <div class="rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm font-medium text-green-700 shadow-sm">
                    <?php echo e(session('success')); ?>

                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            
            <div class="overflow-hidden rounded-2xl border border-gray-100 bg-white shadow-sm">

                
                <div class="border-b border-gray-100 px-5 py-5 sm:px-6">

                    
                    <div class="flex flex-col gap-3 sm:flex-row sm:items-start sm:justify-between">

                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">
                                Meter Register
                            </h3>

                            <p class="mt-1 text-sm text-gray-500">
                                View and manage registered customer water meters.
                            </p>
                        </div>

                        
                        <a
                            href="<?php echo e(route('meters.create')); ?>"
                            class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-lg border border-blue-200 bg-blue-50 px-4 py-2.5 text-sm font-semibold text-blue-700 transition hover:bg-blue-100 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="2"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M12 4v16m8-8H4"
                                />
                            </svg>

                            Register Meter
                        </a>

                    </div>

                    
                    <form
                        method="GET"
                        action="<?php echo e(route('meters.index')); ?>"
                        class="mt-5"
                    >
                        <div class="flex items-center gap-2">

                            <div class="relative flex-1">

                                
                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="h-5 w-5 text-gray-400"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                        stroke-width="2"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M21 21l-4.35-4.35m1.35-5.65a7 7 0 11-14 0 7 7 0 0114 0z"
                                        />
                                    </svg>
                                </div>

                                <input
                                    type="text"
                                    name="search"
                                    value="<?php echo e($search); ?>"
                                    placeholder="Search by meter, customer, account, phone, or area"
                                    autocomplete="off"
                                    class="block w-full rounded-lg border border-gray-300 bg-white py-2.5 pl-10 pr-12 text-sm text-gray-900 placeholder-gray-400 shadow-sm outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                                >

                                
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($search !== ''): ?>
                                    <a
                                        href="<?php echo e(route('meters.index')); ?>"
                                        class="absolute inset-y-0 right-0 flex items-center pr-2"
                                        aria-label="Clear search"
                                        title="Clear search"
                                    >
                                        <span class="flex h-7 w-7 items-center justify-center rounded-full bg-gray-100 text-lg leading-none text-gray-500 transition hover:bg-gray-200 hover:text-gray-800">
                                            &times;
                                        </span>
                                    </a>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                            </div>

                            
                            <button
                                type="submit"
                                class="inline-flex items-center justify-center gap-2 rounded-lg bg-gray-900 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-4 w-4"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                    stroke-width="2"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M21 21l-4.35-4.35m1.35-5.65a7 7 0 11-14 0 7 7 0 0114 0z"
                                    />
                                </svg>

                                <span class="hidden sm:inline">
                                    Search
                                </span>
                            </button>

                        </div>
                    </form>

                    
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($search !== ''): ?>
                        <div class="mt-4 rounded-lg bg-blue-50 px-4 py-3 text-sm text-blue-700">
                            Showing results for
                            <span class="font-semibold">
                                "<?php echo e($search); ?>"
                            </span>

                            <span class="text-blue-600">
                                — <?php echo e($totalMeters); ?> result<?php echo e($totalMeters === 1 ? '' : 's'); ?> found.
                            </span>
                        </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                </div>

                
                <div class="overflow-x-auto">

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($meters->count()): ?>

                        <table class="min-w-full divide-y divide-gray-100">

                            <thead class="bg-gray-50">
                                <tr>

                                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                                        Meter
                                    </th>

                                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                                        Customer
                                    </th>

                                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                                        Initial Reading
                                    </th>

                                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                                        Current Reading
                                    </th>

                                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                                        Status
                                    </th>

                                    <th class="px-6 py-3 text-right text-xs font-semibold uppercase tracking-wider text-gray-500">
                                        Actions
                                    </th>

                                </tr>
                            </thead>

                            <tbody class="divide-y divide-gray-100 bg-white">

                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $meters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $meter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                    <tr class="transition hover:bg-gray-50">

                                        
                                        <td class="whitespace-nowrap px-6 py-4">

                                            <div class="font-semibold text-gray-900">
                                                <?php echo e($meter->meter_number); ?>

                                            </div>

                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($meter->installation_date): ?>
                                                <div class="mt-1 text-xs text-gray-500">
                                                    Installed:
                                                    <?php echo e(\Carbon\Carbon::parse($meter->installation_date)->format('d M Y')); ?>

                                                </div>
                                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                                        </td>

                                        
                                        <td class="px-6 py-4">

                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($meter->customer): ?>

                                                <div class="font-medium text-gray-900">
                                                    <?php echo e($meter->customer->full_name); ?>

                                                </div>

                                                <div class="mt-1 text-xs text-gray-500">
                                                    <?php echo e($meter->customer->customer_number); ?>

                                                </div>

                                            <?php else: ?>

                                                <span class="text-sm text-gray-400">
                                                    Customer unavailable
                                                </span>

                                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                                        </td>

                                        
                                        <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-700">
                                            <?php echo e(number_format((float) $meter->initial_reading, 0)); ?>

                                        </td>

                                        
                                        <td class="whitespace-nowrap px-6 py-4 text-sm font-semibold text-gray-900">
                                            <?php echo e(number_format((float) $meter->current_reading, 0)); ?>

                                        </td>

                                        
                                        <td class="whitespace-nowrap px-6 py-4">

                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($meter->status === 'active'): ?>

                                                <span class="inline-flex items-center gap-1.5 rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">
                                                    <span class="h-1.5 w-1.5 rounded-full bg-green-500"></span>
                                                    Active
                                                </span>

                                            <?php else: ?>

                                                <span class="inline-flex items-center gap-1.5 rounded-full bg-gray-100 px-3 py-1 text-xs font-semibold text-gray-600">
                                                    <span class="h-1.5 w-1.5 rounded-full bg-gray-400"></span>
                                                    Inactive
                                                </span>

                                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                                        </td>

                                        
                                        <td class="whitespace-nowrap px-6 py-4 text-right">

                                            <div class="flex items-center justify-end gap-2">

                                                
                                                <a
                                                    href="<?php echo e(route('meters.show', $meter)); ?>"
                                                    class="inline-flex items-center gap-2 rounded-lg border border-gray-200 bg-white px-3.5 py-2 text-sm font-semibold text-gray-700 transition hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-300 focus:ring-offset-1"
                                                >
                                                    <svg
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        class="h-4 w-4"
                                                        fill="none"
                                                        viewBox="0 0 24 24"
                                                        stroke="currentColor"
                                                        stroke-width="2"
                                                    >
                                                        <path
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"
                                                        />
                                                        <path
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                                                        />
                                                    </svg>

                                                    View
                                                </a>

                                                
                                                <a
                                                    href="<?php echo e(route('meters.edit', $meter)); ?>"
                                                    class="inline-flex items-center gap-2 rounded-lg bg-[#0B1F4B] px-3.5 py-2 text-sm font-semibold text-white transition hover:bg-[#0a1a3f] focus:outline-none focus:ring-2 focus:ring-[#0B1F4B] focus:ring-offset-1"
                                                >
                                                    <svg
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        class="h-4 w-4"
                                                        fill="none"
                                                        viewBox="0 0 24 24"
                                                        stroke="currentColor"
                                                        stroke-width="2"
                                                    >
                                                        <path
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"
                                                        />
                                                    </svg>

                                                    Edit
                                                </a>

                                                
                                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(
                                                    $meter->status === 'active' &&
                                                    in_array(auth()->user()->role, ['admin', 'manager'], true)
                                                ): ?>

                                                    <form
                                                        method="POST"
                                                        action="<?php echo e(route('meters.destroy', $meter)); ?>"
                                                        onsubmit="return confirm('Are you sure you want to deactivate this water meter?');"
                                                    >
                                                        <?php echo csrf_field(); ?>
                                                        <?php echo method_field('DELETE'); ?>

                                                        <button
                                                            type="submit"
                                                            class="inline-flex items-center gap-2 rounded-lg border border-red-200 bg-red-50 px-3.5 py-2 text-sm font-semibold text-red-700 transition hover:bg-red-100 focus:outline-none focus:ring-2 focus:ring-red-300 focus:ring-offset-1"
                                                        >
                                                            <svg
                                                                xmlns="http://www.w3.org/2000/svg"
                                                                class="h-4 w-4"
                                                                fill="none"
                                                                viewBox="0 0 24 24"
                                                                stroke="currentColor"
                                                                stroke-width="2"
                                                            >
                                                                <path
                                                                    stroke-linecap="round"
                                                                    stroke-linejoin="round"
                                                                    d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"
                                                                />
                                                            </svg>

                                                            Deactivate
                                                        </button>
                                                    </form>

                                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                                            </div>

                                        </td>

                                    </tr>

                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                            </tbody>

                        </table>

                    <?php else: ?>

                        
                        <div class="px-6 py-16 text-center">

                            <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-full bg-gray-100 text-gray-400">

                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-7 w-7"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                    stroke-width="2"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M9 17v-2a4 4 0 014-4h4m0 0V7m0 4l-3-3m3 3l3-3M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"
                                    />
                                </svg>

                            </div>

                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($search !== ''): ?>

                                <h3 class="mt-4 text-base font-semibold text-gray-900">
                                    No matching meters found
                                </h3>

                                <p class="mt-1 text-sm text-gray-500">
                                    No water meters matched your search for
                                    <span class="font-medium text-gray-700">
                                        "<?php echo e($search); ?>"
                                    </span>.
                                </p>

                                <a
                                    href="<?php echo e(route('meters.index')); ?>"
                                    class="mt-5 inline-flex items-center rounded-lg bg-gray-900 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-gray-800"
                                >
                                    Clear Search
                                </a>

                            <?php else: ?>

                                <h3 class="mt-4 text-base font-semibold text-gray-900">
                                    No water meters found
                                </h3>

                                <p class="mt-1 text-sm text-gray-500">
                                    Start by registering the first water meter.
                                </p>

                                <a
                                    href="<?php echo e(route('meters.create')); ?>"
                                    class="mt-5 inline-flex items-center gap-2 rounded-lg bg-blue-600 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-blue-700"
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="h-5 w-5"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                        stroke-width="2"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M12 4v16m8-8H4"
                                        />
                                    </svg>

                                    Register Meter
                                </a>

                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                        </div>

                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                </div>

                
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($meters->hasPages()): ?>
                    <div class="border-t border-gray-100 px-5 py-4 sm:px-6">
                        <?php echo e($meters->links()); ?>

                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            </div>

            
            <div class="pb-4 text-center text-xs text-gray-400">
                Maji Mazuri Water Billing & Customer Management System

                <span class="mx-1">•</span>

                Pure Tide Mazuri Ltd
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

<?php /**PATH C:\Users\ADMIN\Downloads\maji-mazuri-deploy\resources\views\meters\index.blade.php ENDPATH**/ ?>