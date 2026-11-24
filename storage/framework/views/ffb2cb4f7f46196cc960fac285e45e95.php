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
            <h2 class="font-bold text-2xl text-gray-800 dark:text-gray-100">
                Bills
            </h2>

            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                Manage customer water bills
            </p>
        </div>


        
        <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3">

            
            <a href="<?php echo e(route('bills.outstanding')); ?>"
               title="View Outstanding Bills Report"
               class="inline-flex items-center justify-center gap-2
                      px-5 py-2.5 rounded-xl
                      bg-red-600 hover:bg-red-700
                      text-white text-sm font-semibold
                      shadow-sm hover:shadow-md
                      transition">

                <svg class="w-5 h-5"
                     fill="none"
                     stroke="currentColor"
                     viewBox="0 0 24 24">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M7 3h10a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2Z"/>

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M9 8h6M9 12h6M9 16h4"/>

                </svg>

                Outstanding Bills

            </a>


            
            <a href="<?php echo e(route('bills.create')); ?>"
               class="inline-flex items-center justify-center gap-2
                      px-5 py-2.5 rounded-xl
                      bg-blue-600 hover:bg-blue-700
                      text-white text-sm font-semibold
                      shadow-sm hover:shadow-md
                      transition">

                <svg class="w-5 h-5"
                     fill="none"
                     stroke="currentColor"
                     viewBox="0 0 24 24">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M12 4v16m8-8H4"/>

                </svg>

                Generate Bill

            </a>

        </div>

    </div>

 <?php $__env->endSlot(); ?>


<div class="py-8 bg-gray-100 dark:bg-gray-950 min-h-screen">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">


        
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('success')): ?>

            <div class="mb-6 flex items-start gap-3
                        bg-green-50 dark:bg-green-900/20
                        border border-green-200 dark:border-green-800
                        rounded-xl px-4 py-3 shadow-sm">

                <div class="flex-shrink-0 mt-0.5">

                    <div class="w-7 h-7 rounded-full
                                bg-green-100 dark:bg-green-900/40
                                flex items-center justify-center">

                        <svg class="w-4 h-4 text-green-600 dark:text-green-400"
                             fill="none"
                             stroke="currentColor"
                             viewBox="0 0 24 24">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M5 13l4 4L19 7"/>

                        </svg>

                    </div>

                </div>


                <div>

                    <p class="text-sm font-semibold text-green-800 dark:text-green-300">
                        Success
                    </p>

                    <p class="text-sm text-green-700 dark:text-green-400 mt-0.5">
                        <?php echo e(session('success')); ?>

                    </p>

                </div>

            </div>

        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>


        
        <div class="bg-white dark:bg-gray-900
                    rounded-2xl shadow-sm
                    border border-gray-200 dark:border-gray-800
                    overflow-hidden">


            
            <div class="p-6 border-b border-gray-200 dark:border-gray-800">

                <div class="flex flex-col lg:flex-row lg:items-start lg:justify-between gap-5">


                    
                    <div class="flex items-center gap-3">

                        <div class="w-10 h-10 rounded-xl
                                    bg-blue-100 dark:bg-blue-900/30
                                    flex items-center justify-center">

                            <svg class="w-5 h-5 text-blue-600 dark:text-blue-400"
                                 fill="none"
                                 stroke="currentColor"
                                 viewBox="0 0 24 24">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M7 3h10a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2Z"/>

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M9 7h6M9 11h6M9 15h4"/>

                            </svg>

                        </div>


                        <div>

                            <h3 class="text-lg font-bold text-gray-800 dark:text-white">
                                Billing Management
                            </h3>

                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-0.5">

                                <?php echo e($bills->total()); ?>

                                bill(s)
                                <?php echo e(!empty($search) ? 'found' : 'registered'); ?>


                            </p>

                        </div>

                    </div>


                    
                    <form method="GET"
                          action="<?php echo e(route('bills.index')); ?>"
                          class="w-full lg:w-[430px]">

                        <div class="relative">

                            
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4">

                                <svg class="w-5 h-5 text-gray-400"
                                     fill="none"
                                     stroke="currentColor"
                                     viewBox="0 0 24 24">

                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          stroke-width="2"
                                          d="m21 21-4.35-4.35m2.35-5.65a8 8 0 1 1-16 0 8 8 0 0 1 16 0Z"/>

                                </svg>

                            </div>


                            
                            <input
                                type="text"
                                name="search"
                                value="<?php echo e($search ?? ''); ?>"
                                placeholder="Search invoice, customer, meter..."
                                autocomplete="off"
                                class="w-full rounded-xl
                                       border border-gray-300 dark:border-gray-700
                                       bg-white dark:bg-gray-800
                                       text-gray-800 dark:text-gray-100
                                       placeholder-gray-400 dark:placeholder-gray-500
                                       pl-11
                                       pr-11
                                       py-3
                                       text-sm
                                       shadow-sm
                                       focus:border-blue-500
                                       focus:ring-2
                                       focus:ring-blue-500/20
                                       outline-none
                                       transition"
                            />


                            
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($search)): ?>

                                <a href="<?php echo e(route('bills.index')); ?>"
                                   title="Clear search"
                                   aria-label="Clear search"
                                   class="absolute inset-y-0 right-0
                                          flex items-center
                                          pr-3
                                          text-gray-400
                                          hover:text-gray-700
                                          dark:hover:text-gray-200
                                          transition">

                                    <span class="flex items-center justify-center
                                                 w-6 h-6 rounded-full
                                                 hover:bg-gray-100
                                                 dark:hover:bg-gray-700">

                                        <svg class="w-4 h-4"
                                             fill="none"
                                             stroke="currentColor"
                                             viewBox="0 0 24 24">

                                            <path stroke-linecap="round"
                                                  stroke-linejoin="round"
                                                  stroke-width="2"
                                                  d="M6 6l12 12M18 6 6 18"/>

                                        </svg>

                                    </span>

                                </a>

                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                        </div>


                        <p class="mt-1.5 text-xs text-gray-400 dark:text-gray-500">

                            Search by invoice, customer, account number, meter or status.

                        </p>

                    </form>

                </div>

            </div>


            
            <div class="overflow-x-auto">

                <table class="w-full">

                    <thead class="bg-gray-50 dark:bg-gray-800/70">

                        <tr>

                            <th class="px-6 py-4 text-left text-xs font-bold
                                       text-gray-500 dark:text-gray-400
                                       uppercase tracking-wider">
                                Invoice No.
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-bold
                                       text-gray-500 dark:text-gray-400
                                       uppercase tracking-wider">
                                Customer
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-bold
                                       text-gray-500 dark:text-gray-400
                                       uppercase tracking-wider">
                                Billing Date
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-bold
                                       text-gray-500 dark:text-gray-400
                                       uppercase tracking-wider">
                                Consumption
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-bold
                                       text-gray-500 dark:text-gray-400
                                       uppercase tracking-wider">
                                Amount
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-bold
                                       text-gray-500 dark:text-gray-400
                                       uppercase tracking-wider">
                                Balance
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-bold
                                       text-gray-500 dark:text-gray-400
                                       uppercase tracking-wider">
                                Status
                            </th>

                            <th class="px-6 py-4 text-right text-xs font-bold
                                       text-gray-500 dark:text-gray-400
                                       uppercase tracking-wider">
                                Actions
                            </th>

                        </tr>

                    </thead>


                    <tbody class="divide-y divide-gray-200 dark:divide-gray-800">

                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $bills; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                            <tr class="hover:bg-blue-50/40
                                       dark:hover:bg-gray-800/50
                                       transition">


                                
                                <td class="px-6 py-5">

                                    <span class="inline-flex items-center
                                                 px-2.5 py-1 rounded-lg
                                                 bg-gray-100 dark:bg-gray-800
                                                 text-sm font-bold
                                                 text-blue-600 dark:text-blue-400">

                                        <?php echo e($bill->invoice_number ?? 'Not Assigned'); ?>


                                    </span>

                                </td>


                                
                                <td class="px-6 py-5">

                                    <div>

                                        <p class="font-semibold text-gray-800 dark:text-white">
                                            <?php echo e($bill->customer->full_name); ?>

                                        </p>

                                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-0.5">
                                            <?php echo e($bill->customer->customer_number); ?>

                                        </p>

                                    </div>

                                </td>


                                
                                <td class="px-6 py-5">

                                    <div class="flex items-center gap-2
                                                text-sm text-gray-700 dark:text-gray-300">

                                        <svg class="w-4 h-4 text-gray-400"
                                             fill="none"
                                             stroke="currentColor"
                                             viewBox="0 0 24 24">

                                            <path stroke-linecap="round"
                                                  stroke-linejoin="round"
                                                  stroke-width="2"
                                                  d="M8 2v4M16 2v4M3 10h18"/>

                                            <rect x="3"
                                                  y="4"
                                                  width="18"
                                                  height="17"
                                                  rx="2"
                                                  stroke-width="2"/>

                                        </svg>

                                        <span class="font-medium">
                                            <?php echo e($bill->billing_date->format('d M Y')); ?>

                                        </span>

                                    </div>

                                </td>


                                
                                <td class="px-6 py-5">

                                    <div class="flex items-center gap-2">

                                        <svg class="w-4 h-4 text-blue-500"
                                             fill="none"
                                             stroke="currentColor"
                                             viewBox="0 0 24 24">

                                            <path stroke-linecap="round"
                                                  stroke-linejoin="round"
                                                  stroke-width="2"
                                                  d="M12 3C12 3 6 10 6 14.5A6 6 0 0 0 18 14.5C18 10 12 3 12 3Z"/>

                                        </svg>

                                        <span class="font-bold text-gray-700 dark:text-gray-300">
                                            <?php echo e(number_format($bill->consumption, 2)); ?>

                                        </span>

                                        <span class="text-xs text-gray-400">
                                            units
                                        </span>

                                    </div>

                                </td>


                                
                                <td class="px-6 py-5">

                                    <span class="font-semibold text-gray-800 dark:text-white">
                                        KSh <?php echo e(number_format($bill->water_charge, 2)); ?>

                                    </span>

                                </td>


                                
                                <td class="px-6 py-5">

                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($bill->balance > 0): ?>

                                        <span class="font-semibold text-red-600 dark:text-red-400">
                                            KSh <?php echo e(number_format($bill->balance, 2)); ?>

                                        </span>

                                    <?php else: ?>

                                        <span class="font-semibold text-green-600 dark:text-green-400">
                                            KSh 0.00
                                        </span>

                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                                </td>


                                
                                <td class="px-6 py-5">

                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($bill->status === 'paid'): ?>

                                        <span class="inline-flex items-center gap-1.5
                                                     px-3 py-1.5 rounded-full
                                                     bg-green-100 dark:bg-green-900/30
                                                     text-green-700 dark:text-green-300
                                                     text-xs font-bold">

                                            <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>

                                            Paid

                                        </span>


                                    <?php elseif($bill->status === 'partially_paid'): ?>

                                        <span class="inline-flex items-center gap-1.5
                                                     px-3 py-1.5 rounded-full
                                                     bg-yellow-100 dark:bg-yellow-900/30
                                                     text-yellow-700 dark:text-yellow-300
                                                     text-xs font-bold">

                                            <span class="w-1.5 h-1.5 rounded-full bg-yellow-500"></span>

                                            Partially Paid

                                        </span>


                                    <?php elseif($bill->status === 'overdue'): ?>

                                        <span class="inline-flex items-center gap-1.5
                                                     px-3 py-1.5 rounded-full
                                                     bg-red-100 dark:bg-red-900/30
                                                     text-red-700 dark:text-red-300
                                                     text-xs font-bold">

                                            <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span>

                                            Overdue

                                        </span>


                                    <?php else: ?>

                                        <span class="inline-flex items-center gap-1.5
                                                     px-3 py-1.5 rounded-full
                                                     bg-gray-100 dark:bg-gray-800
                                                     text-gray-700 dark:text-gray-300
                                                     text-xs font-bold">

                                            <span class="w-1.5 h-1.5 rounded-full bg-gray-500"></span>

                                            Unpaid

                                        </span>

                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                                </td>


                                
                                <td class="px-6 py-5">

                                    <div class="flex items-center justify-end gap-2">


                                        
                                        <a href="<?php echo e(route('bills.show', $bill)); ?>"
                                           title="View Invoice"
                                           class="inline-flex items-center justify-center
                                                  w-9 h-9 rounded-lg
                                                  bg-gray-100 dark:bg-gray-800
                                                  text-gray-600 dark:text-gray-300
                                                  hover:bg-gray-200 dark:hover:bg-gray-700
                                                  transition">

                                            <svg class="w-4 h-4"
                                                 fill="none"
                                                 stroke="currentColor"
                                                 viewBox="0 0 24 24">

                                                <path stroke-linecap="round"
                                                      stroke-linejoin="round"
                                                      stroke-width="2"
                                                      d="M2.5 12s3.5-6 9.5-6 9.5 6 9.5 6-3.5 6-9.5 6-9.5-6-9.5-6Z"/>

                                                <circle cx="12"
                                                        cy="12"
                                                        r="2.5"
                                                        stroke-width="2"/>

                                            </svg>

                                        </a>


                                        
                                        <a href="<?php echo e(route('bills.pdf', $bill)); ?>"
                                           title="Download PDF"
                                           class="inline-flex items-center justify-center
                                                  w-9 h-9 rounded-lg
                                                  bg-green-100 dark:bg-green-900/30
                                                  text-green-700 dark:text-green-300
                                                  hover:bg-green-200 dark:hover:bg-green-900/50
                                                  transition">

                                            <svg class="w-4 h-4"
                                                 fill="none"
                                                 stroke="currentColor"
                                                 viewBox="0 0 24 24">

                                                <path stroke-linecap="round"
                                                      stroke-linejoin="round"
                                                      stroke-width="2"
                                                      d="M12 3v12m0 0 4-4m-4 4-4-4"/>

                                                <path stroke-linecap="round"
                                                      stroke-linejoin="round"
                                                      stroke-width="2"
                                                      d="M5 21h14"/>

                                            </svg>

                                        </a>


                                        
                                        <a href="<?php echo e(route('bills.edit', $bill)); ?>"
                                           title="Edit Bill"
                                           class="inline-flex items-center justify-center
                                                  w-9 h-9 rounded-lg
                                                  bg-blue-100 dark:bg-blue-900/30
                                                  text-blue-700 dark:text-blue-300
                                                  hover:bg-blue-200 dark:hover:bg-blue-900/50
                                                  transition">

                                            <svg class="w-4 h-4"
                                                 fill="none"
                                                 stroke="currentColor"
                                                 viewBox="0 0 24 24">

                                                <path stroke-linecap="round"
                                                      stroke-linejoin="round"
                                                      stroke-width="2"
                                                      d="M12 20h9"/>

                                                <path stroke-linecap="round"
                                                      stroke-linejoin="round"
                                                      stroke-width="2"
                                                      d="M16.5 3.5a2.121 2.121 0 0 1 3 3L8 18l-4 1 1-4 11.5-11.5Z"/>

                                            </svg>

                                        </a>


                                        
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(in_array(auth()->user()->role, ['admin', 'manager'], true)): ?>

                                            <form method="POST"
                                                  action="<?php echo e(route('bills.destroy', $bill)); ?>"
                                                  onsubmit="return confirm('Are you sure you want to delete this bill?');">

                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>

                                                <button type="submit"
                                                        title="Delete Bill"
                                                        class="inline-flex items-center justify-center
                                                               w-9 h-9 rounded-lg
                                                               bg-red-100 dark:bg-red-900/30
                                                               text-red-700 dark:text-red-300
                                                               hover:bg-red-200 dark:hover:bg-red-900/50
                                                               transition">

                                                    <svg class="w-4 h-4"
                                                         fill="none"
                                                         stroke="currentColor"
                                                         viewBox="0 0 24 24">

                                                        <path stroke-linecap="round"
                                                              stroke-linejoin="round"
                                                              stroke-width="2"
                                                              d="M18 6 6 18M6 6l12 12"/>

                                                    </svg>

                                                </button>

                                            </form>

                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                                    </div>

                                </td>

                            </tr>


                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                            
                            <tr>

                                <td colspan="8" class="px-6 py-16 text-center">

                                    <div class="mx-auto w-16 h-16 rounded-2xl
                                                bg-blue-100 dark:bg-blue-900/30
                                                flex items-center justify-center">

                                        <svg class="w-8 h-8 text-blue-600 dark:text-blue-400"
                                             fill="none"
                                             stroke="currentColor"
                                             viewBox="0 0 24 24">

                                            <path stroke-linecap="round"
                                                  stroke-linejoin="round"
                                                  stroke-width="1.8"
                                                  d="M7 3h10a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2Z"/>

                                            <path stroke-linecap="round"
                                                  stroke-linejoin="round"
                                                  stroke-width="1.8"
                                                  d="M9 7h6M9 11h6M9 15h4"/>

                                        </svg>

                                    </div>


                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($search)): ?>

                                        <h3 class="mt-5 text-lg font-bold
                                                   text-gray-800 dark:text-white">

                                            No bills found

                                        </h3>


                                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">

                                            No bills matched
                                            <span class="font-semibold text-gray-700 dark:text-gray-300">
                                                "<?php echo e($search); ?>"
                                            </span>.

                                            Try another search.

                                        </p>


                                        <a href="<?php echo e(route('bills.index')); ?>"
                                           class="inline-flex items-center gap-2
                                                  mt-5 px-5 py-2.5 rounded-xl
                                                  border border-gray-300 dark:border-gray-700
                                                  bg-white dark:bg-gray-800
                                                  text-gray-700 dark:text-gray-200
                                                  text-sm font-semibold
                                                  hover:bg-gray-50 dark:hover:bg-gray-700
                                                  transition shadow-sm">

                                            <svg class="w-4 h-4"
                                                 fill="none"
                                                 stroke="currentColor"
                                                 viewBox="0 0 24 24">

                                                <path stroke-linecap="round"
                                                      stroke-linejoin="round"
                                                      stroke-width="2"
                                                      d="M6 18 18 6M6 6l12 12"/>

                                            </svg>

                                            Clear Search

                                        </a>


                                    <?php else: ?>

                                        <h3 class="mt-5 text-lg font-bold
                                                   text-gray-800 dark:text-white">

                                            No bills found

                                        </h3>


                                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">

                                            Start by generating a water bill from a meter reading.

                                        </p>


                                        <a href="<?php echo e(route('bills.create')); ?>"
                                           class="inline-flex items-center gap-2
                                                  mt-5 px-5 py-2.5 rounded-xl
                                                  bg-blue-600 hover:bg-blue-700
                                                  text-white text-sm font-semibold
                                                  transition shadow-sm">

                                            <svg class="w-4 h-4"
                                                 fill="none"
                                                 stroke="currentColor"
                                                 viewBox="0 0 24 24">

                                                <path stroke-linecap="round"
                                                      stroke-linejoin="round"
                                                      stroke-width="2"
                                                      d="M12 4v16m8-8H4"/>

                                            </svg>

                                            Generate Bill

                                        </a>

                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                                </td>

                            </tr>

                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                    </tbody>

                </table>

            </div>


            
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($bills->hasPages()): ?>

                <div class="px-6 py-5
                            border-t border-gray-200 dark:border-gray-800">

                    <?php echo e($bills->links()); ?>


                </div>

            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        </div>


        
        <div class="text-center py-6">

            <p class="text-xs text-gray-400 dark:text-gray-500">

                Maji Mazuri Water Billing & Customer Management System

            </p>

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
<?php /**PATH C:\Users\ADMIN\Downloads\maji-mazuri-deploy\resources\views/bills/index.blade.php ENDPATH**/ ?>