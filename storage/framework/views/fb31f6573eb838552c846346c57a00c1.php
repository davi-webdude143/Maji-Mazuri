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
    <div class="min-h-screen bg-[#F7F9FC]">

        
        <div class="border-b border-[#E2E8F0] bg-white">
            <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

                    <div>
                        <div class="mb-1 text-sm font-medium text-[#1D63D8]">
                            Water Management
                        </div>

                        <h1 class="text-2xl font-bold tracking-tight text-[#0B1F4D] sm:text-3xl">
                            Meter Readings
                        </h1>

                        <p class="mt-1 text-sm text-gray-500">
                            Record, monitor and manage customer meter readings.
                        </p>
                    </div>

                    <a
                        href="<?php echo e(route('meter-readings.create')); ?>"
                        class="inline-flex items-center justify-center gap-2 rounded-lg bg-[#1D63D8] px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-200"
                    >
                        <svg
                            class="h-5 w-5"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M12 4v16m8-8H4"
                            />
                        </svg>

                        Record Reading
                    </a>

                </div>
            </div>
        </div>


        
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">

            
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('success')): ?>
                <div class="mb-6 rounded-xl border border-green-200 bg-green-50 px-4 py-4">
                    <div class="flex items-start gap-3">
                        <div class="mt-0.5 flex-shrink-0">
                            <svg
                                class="h-5 w-5 text-green-600"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M5 13l4 4L19 7"
                                />
                            </svg>
                        </div>

                        <div>
                            <p class="text-sm font-semibold text-green-800">
                                Success
                            </p>

                            <p class="mt-1 text-sm text-green-700">
                                <?php echo e(session('success')); ?>

                            </p>
                        </div>
                    </div>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>


            
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('warning')): ?>
                <div class="mb-6 rounded-xl border border-amber-200 bg-amber-50 px-4 py-4">
                    <div class="flex items-start gap-3">
                        <div class="mt-0.5 flex-shrink-0">
                            <svg
                                class="h-5 w-5 text-amber-600"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M12 9v4m0 4h.01M10.29 3.86l-7.82 13.5A2 2 0 004.2 20.36h15.6a2 2 0 001.73-3L13.71 3.86a2 2 0 00-3.42 0z"
                                />
                            </svg>
                        </div>

                        <div>
                            <p class="text-sm font-semibold text-amber-800">
                                Attention
                            </p>

                            <p class="mt-1 text-sm text-amber-700">
                                <?php echo e(session('warning')); ?>

                            </p>
                        </div>
                    </div>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>


            
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($errors->any()): ?>
                <div class="mb-6 rounded-xl border border-red-200 bg-red-50 px-4 py-4">
                    <div class="flex items-start gap-3">
                        <div class="mt-0.5 flex-shrink-0">
                            <svg
                                class="h-5 w-5 text-red-600"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M12 8v4m0 4h.01M10.29 3.86l-7.82 13.5A2 2 0 004.2 20.36h15.6a2 2 0 001.73-3L13.71 3.86a2 2 0 00-3.42 0z"
                                />
                            </svg>
                        </div>

                        <div>
                            <p class="text-sm font-semibold text-red-800">
                                Please check the following:
                            </p>

                            <ul class="mt-2 list-disc space-y-1 pl-5 text-sm text-red-700">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><?php echo e($error); ?></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>


            
            <div class="overflow-hidden rounded-2xl border border-[#E2E8F0] bg-white shadow-sm">

                
                <div class="border-b border-[#E2E8F0] px-5 py-5 sm:px-6">

                    <div class="flex flex-col gap-5 lg:flex-row lg:items-center lg:justify-between">

                        
                        <div>
                            <div class="flex items-center gap-3">

                                <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-blue-50">
                                    <svg
                                        class="h-5 w-5 text-[#1D63D8]"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h10a2 2 0 012 2v10a2 2 0 01-2 2v0a2 2 0 01-2 2z"
                                        />
                                    </svg>
                                </div>

                                <div>
                                    <h2 class="text-lg font-bold text-[#0B1F4D]">
                                        Reading History
                                    </h2>

                                    <p class="text-sm text-gray-500">
                                        <?php echo e($readings->total()); ?>

                                        <?php echo e($readings->total() === 1 ? 'reading' : 'readings'); ?>

                                        recorded
                                    </p>
                                </div>

                            </div>
                        </div>


                        
                        <form
                            method="GET"
                            action="<?php echo e(route('meter-readings.index')); ?>"
                            class="w-full lg:w-auto"
                        >
                            <div class="flex flex-col gap-3 sm:flex-row">

                                
                                <div class="relative w-full sm:w-80">

                                    
                                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                        <svg
                                            class="h-5 w-5 text-gray-400"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="m21 21-4.35-4.35m1.35-5.65a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z"
                                            />
                                        </svg>
                                    </div>


                                    
                                    <input
                                        type="text"
                                        name="search"
                                        value="<?php echo e($search); ?>"
                                        placeholder="Search customer, account or meter..."
                                        autocomplete="off"
                                        class="w-full rounded-lg border border-gray-300 bg-white py-2.5 pl-10 pr-10 text-sm text-gray-700 placeholder-gray-400 transition focus:border-[#1D63D8] focus:outline-none focus:ring-2 focus:ring-blue-100"
                                    >


                                    
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($search !== ''): ?>
                                        <button
                                            type="button"
                                            onclick="this.previousElementSibling.value=''; this.closest('form').submit();"
                                            title="Clear search"
                                            aria-label="Clear search"
                                            class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 transition hover:text-gray-700 focus:outline-none"
                                        >
                                            <svg
                                                class="h-5 w-5"
                                                fill="none"
                                                stroke="currentColor"
                                                viewBox="0 0 24 24"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M6 18L18 6M6 6l12 12"
                                                />
                                            </svg>
                                        </button>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                                </div>


                                
                                <button
                                    type="submit"
                                    class="inline-flex items-center justify-center gap-2 rounded-lg bg-[#1D63D8] px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-200"
                                >
                                    <svg
                                        class="h-4 w-4"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="m21 21-4.35-4.35m1.35-5.65a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z"
                                        />
                                    </svg>

                                    Search
                                </button>

                            </div>
                        </form>

                    </div>


                    
                    <div class="mt-4">

                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($search !== ''): ?>
                            <div class="flex items-center gap-2 text-sm text-gray-500">

                                <svg
                                    class="h-4 w-4 text-[#1D63D8]"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="m21 21-4.35-4.35m1.35-5.65a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z"
                                    />
                                </svg>

                                <span>
                                    Showing results matching
                                    <span class="font-semibold text-gray-700">
                                        "<?php echo e($search); ?>"
                                    </span>
                                </span>

                            </div>
                        <?php else: ?>
                            <p class="text-sm text-gray-500">
                                Search by customer name, account number, meter number or exception type.
                            </p>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                    </div>

                </div>


                
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($readings->count() > 0): ?>

                    <div class="overflow-x-auto">

                        <table class="min-w-full divide-y divide-[#E2E8F0]">

                            <thead class="bg-[#F7F9FC]">
                                <tr>

                                    <th
                                        scope="col"
                                        class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500 sm:px-6"
                                    >
                                        Meter
                                    </th>

                                    <th
                                        scope="col"
                                        class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500 sm:px-6"
                                    >
                                        Customer
                                    </th>

                                    <th
                                        scope="col"
                                        class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500 sm:px-6"
                                    >
                                        Date
                                    </th>

                                    <th
                                        scope="col"
                                        class="px-5 py-3 text-right text-xs font-semibold uppercase tracking-wider text-gray-500 sm:px-6"
                                    >
                                        Previous
                                    </th>

                                    <th
                                        scope="col"
                                        class="px-5 py-3 text-right text-xs font-semibold uppercase tracking-wider text-gray-500 sm:px-6"
                                    >
                                        Current
                                    </th>

                                    <th
                                        scope="col"
                                        class="px-5 py-3 text-right text-xs font-semibold uppercase tracking-wider text-gray-500 sm:px-6"
                                    >
                                        Consumption
                                    </th>

                                    <th
                                        scope="col"
                                        class="px-5 py-3 text-center text-xs font-semibold uppercase tracking-wider text-gray-500 sm:px-6"
                                    >
                                        Status
                                    </th>

                                    <th
                                        scope="col"
                                        class="px-5 py-3 text-right text-xs font-semibold uppercase tracking-wider text-gray-500 sm:px-6"
                                    >
                                        Actions
                                    </th>

                                </tr>
                            </thead>


                            <tbody class="divide-y divide-[#E2E8F0] bg-white">

                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $readings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reading): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                    <tr class="transition hover:bg-[#F8FAFC]">

                                        
                                        <td class="whitespace-nowrap px-5 py-4 sm:px-6">
                                            <div class="text-sm font-semibold text-[#0B1F4D]">
                                                <?php echo e($reading->meter?->meter_number ?? 'N/A'); ?>

                                            </div>

                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($reading->meter?->customer?->customer_number): ?>
                                                <div class="mt-0.5 text-xs text-gray-500">
                                                    <?php echo e($reading->meter->customer->customer_number); ?>

                                                </div>
                                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                        </td>


                                        
                                        <td class="px-5 py-4 sm:px-6">
                                            <div class="max-w-xs truncate text-sm font-medium text-gray-800">
                                                <?php echo e($reading->meter?->customer?->full_name ?? 'N/A'); ?>

                                            </div>

                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($reading->meter?->customer?->phone_number): ?>
                                                <div class="mt-0.5 text-xs text-gray-500">
                                                    <?php echo e($reading->meter->customer->phone_number); ?>

                                                </div>
                                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                        </td>


                                        
                                        <td class="whitespace-nowrap px-5 py-4 sm:px-6">
                                            <div class="text-sm text-gray-700">
                                                <?php echo e(\Carbon\Carbon::parse($reading->reading_date)->format('d M Y')); ?>

                                            </div>
                                        </td>


                                        
                                        <td class="whitespace-nowrap px-5 py-4 text-right sm:px-6">
                                            <span class="text-sm text-gray-700">
                                                <?php echo e(number_format($reading->previous_reading, 2)); ?>

                                            </span>
                                        </td>


                                        
                                        <td class="whitespace-nowrap px-5 py-4 text-right sm:px-6">
                                            <span class="text-sm font-semibold text-gray-800">
                                                <?php echo e(number_format($reading->current_reading, 2)); ?>

                                            </span>
                                        </td>


                                        
                                        <td class="whitespace-nowrap px-5 py-4 text-right sm:px-6">
                                            <span class="text-sm font-semibold text-[#1D63D8]">
                                                <?php echo e(number_format($reading->consumption, 2)); ?>

                                            </span>
                                        </td>


                                        
                                        <td class="whitespace-nowrap px-5 py-4 text-center sm:px-6">

                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($reading->is_abnormal): ?>

                                                <span class="inline-flex items-center gap-1.5 rounded-full bg-amber-100 px-2.5 py-1 text-xs font-semibold text-amber-700">
                                                    <span class="h-1.5 w-1.5 rounded-full bg-amber-500"></span>
                                                    Abnormal
                                                </span>

                                            <?php elseif($reading->exception_type): ?>

                                                <span class="inline-flex items-center gap-1.5 rounded-full bg-blue-100 px-2.5 py-1 text-xs font-semibold text-blue-700">
                                                    <span class="h-1.5 w-1.5 rounded-full bg-blue-500"></span>
                                                    Exception
                                                </span>

                                            <?php else: ?>

                                                <span class="inline-flex items-center gap-1.5 rounded-full bg-green-100 px-2.5 py-1 text-xs font-semibold text-green-700">
                                                    <span class="h-1.5 w-1.5 rounded-full bg-green-500"></span>
                                                    Normal
                                                </span>

                                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                                        </td>


                                        
                                        <td class="whitespace-nowrap px-5 py-4 text-right sm:px-6">

                                            <div class="flex items-center justify-end gap-2">

                                                <a
                                                    href="<?php echo e(route('meter-readings.show', $reading)); ?>"
                                                    class="inline-flex items-center gap-1.5 rounded-lg border border-[#E2E8F0] bg-white px-3 py-2 text-xs font-semibold text-gray-700 transition hover:border-gray-300 hover:bg-gray-50 hover:text-[#0B1F4D] focus:outline-none focus:ring-2 focus:ring-blue-100"
                                                >
                                                    <svg
                                                        class="h-4 w-4"
                                                        fill="none"
                                                        stroke="currentColor"
                                                        viewBox="0 0 24 24"
                                                    >
                                                        <path
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"
                                                        />

                                                        <circle
                                                            cx="12"
                                                            cy="12"
                                                            r="3"
                                                        />
                                                    </svg>

                                                    View
                                                </a>


                                                <a
                                                    href="<?php echo e(route('meter-readings.edit', $reading)); ?>"
                                                    class="inline-flex items-center gap-1.5 rounded-lg bg-[#0B1F4D] px-3 py-2 text-xs font-semibold text-white transition hover:bg-[#142d68] focus:outline-none focus:ring-2 focus:ring-blue-100"
                                                >
                                                    <svg
                                                        class="h-4 w-4"
                                                        fill="none"
                                                        stroke="currentColor"
                                                        viewBox="0 0 24 24"
                                                    >
                                                        <path
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.5-8.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 8.5-8.5z"
                                                        />
                                                    </svg>

                                                    Edit
                                                </a>

                                            </div>

                                        </td>

                                    </tr>

                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                            </tbody>

                        </table>

                    </div>

                <?php else: ?>

                    
                    <div class="px-6 py-16 text-center">

                        <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-blue-50">

                            <svg
                                class="h-8 w-8 text-[#1D63D8]"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.8"
                                    d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h10a2 2 0 012 2v10a2 2 0 01-2 2v0a2 2 0 01-2 2z"
                                />
                            </svg>

                        </div>


                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($search !== ''): ?>

                            <h3 class="mt-5 text-base font-semibold text-[#0B1F4D]">
                                No matching readings found
                            </h3>

                            <p class="mx-auto mt-2 max-w-md text-sm text-gray-500">
                                No meter readings matched
                                <span class="font-medium text-gray-700">
                                    "<?php echo e($search); ?>"
                                </span>.
                                Try another customer name, account number, meter number or exception type.
                            </p>

                            <a
                                href="<?php echo e(route('meter-readings.index')); ?>"
                                class="mt-5 inline-flex items-center gap-2 rounded-lg border border-[#E2E8F0] bg-white px-4 py-2.5 text-sm font-semibold text-gray-700 shadow-sm transition hover:bg-gray-50"
                            >
                                <svg
                                    class="h-4 w-4"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"
                                    />
                                </svg>

                                Clear Search
                            </a>

                        <?php else: ?>

                            <h3 class="mt-5 text-base font-semibold text-[#0B1F4D]">
                                No meter readings found
                            </h3>

                            <p class="mx-auto mt-2 max-w-md text-sm text-gray-500">
                                No meter readings have been recorded yet.
                                Start by recording the first customer meter reading.
                            </p>

                            <a
                                href="<?php echo e(route('meter-readings.create')); ?>"
                                class="mt-5 inline-flex items-center gap-2 rounded-lg bg-[#1D63D8] px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700"
                            >
                                <svg
                                    class="h-4 w-4"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M12 4v16m8-8H4"
                                    />
                                </svg>

                                Record First Reading
                            </a>

                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                    </div>

                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>


                
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($readings->hasPages()): ?>

                    <div class="border-t border-[#E2E8F0] bg-white px-5 py-4 sm:px-6">
                        <?php echo e($readings->links()); ?>

                    </div>

                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            </div>

        </div>


        
        <footer class="border-t border-[#E2E8F0] bg-white">
            <div class="mx-auto max-w-7xl px-4 py-6 text-center sm:px-6 lg:px-8">

                <p class="text-sm font-medium text-[#0B1F4D]">
                    Maji Mazuri Water Billing & Customer Management System
                </p>

                <p class="mt-1 text-xs text-gray-500">
                    Pure Tide Mazuri Ltd
                </p>

            </div>
        </footer>

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

<?php /**PATH C:\Users\ADMIN\Downloads\maji-mazuri-deploy\resources\views/meter-readings/index.blade.php ENDPATH**/ ?>