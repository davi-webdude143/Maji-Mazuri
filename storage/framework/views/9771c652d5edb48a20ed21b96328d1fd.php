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

            <p class="text-sm font-medium text-[#1D63D8] mb-1">
                Overview
            </p>

            <h2 class="text-2xl sm:text-3xl font-bold text-[#0B1F4D] leading-tight">
                Dashboard
            </h2>

            <p class="text-sm text-[#4A5568] mt-1">
                Welcome back, <?php echo e(auth()->user()->name); ?>

            </p>

        </div>

        

        <div class="flex items-center gap-3">

            <div class="hidden sm:block text-right">

                <p class="text-xs text-[#4A5568]">
                    Signed in as
                </p>

                <p class="text-sm font-semibold text-[#0B1F4D]">
                    <?php echo e(auth()->user()->name); ?>

                </p>

            </div>

            <div class="w-11 h-11 rounded-full bg-[#EAF2FF] border border-[#D7E6FF] flex items-center justify-center">

                <span class="text-sm font-bold text-[#1D63D8]">
                    <?php echo e(strtoupper(substr(auth()->user()->name, 0, 2))); ?>

                </span>

            </div>

        </div>

    </div>

 <?php $__env->endSlot(); ?>




<div class="min-h-screen bg-[#F7F9FC] py-6 sm:py-8">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">


        

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('success')): ?>

            <div class="flex items-center gap-3 bg-[#ECF8F0] border border-[#CBEBD4] text-[#216E34] rounded-xl px-4 py-3">

                <div class="w-8 h-8 rounded-full bg-[#DDF3E3] flex items-center justify-center">

                    <svg class="w-4 h-4"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M5 13l4 4L19 7"/>

                    </svg>

                </div>

                <span class="text-sm font-medium">
                    <?php echo e(session('success')); ?>

                </span>

            </div>

        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>


        

        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-5">


            

            <div class="bg-white border border-[#E2E8F0] rounded-2xl p-5 shadow-sm">

                <div class="flex items-start justify-between">

                    <div>

                        <p class="text-sm font-medium text-[#4A5568]">
                            Total Customers
                        </p>

                        <p class="text-3xl font-bold text-[#0B1F4D] mt-2">
                            <?php echo e(number_format($totalCustomers)); ?>

                        </p>

                        <p class="text-xs text-[#2E9E4A] font-semibold mt-2">
                            <?php echo e(number_format($activeCustomers)); ?> active
                        </p>

                    </div>

                    <div class="w-11 h-11 rounded-xl bg-[#EAF2FF] flex items-center justify-center">

                        <svg class="w-5 h-5 text-[#1D63D8]"
                             fill="none"
                             stroke="currentColor"
                             viewBox="0 0 24 24">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M17 20h5V4H2v16h5m10 0v-6H7v6m10 0H7M8 8h8M8 12h4"/>

                        </svg>

                    </div>

                </div>

            </div>


            

            <div class="bg-white border border-[#E2E8F0] rounded-2xl p-5 shadow-sm">

                <div class="flex items-start justify-between">

                    <div>

                        <p class="text-sm font-medium text-[#4A5568]">
                            Active Customers
                        </p>

                        <p class="text-3xl font-bold text-[#0B1F4D] mt-2">
                            <?php echo e(number_format($activeCustomers)); ?>

                        </p>

                        <p class="text-xs text-[#2E9E4A] font-semibold mt-2">
                            Currently active
                        </p>

                    </div>

                    <div class="w-11 h-11 rounded-xl bg-[#ECF8F0] flex items-center justify-center">

                        <svg class="w-5 h-5 text-[#2E9E4A]"
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

            </div>


            

            <div class="bg-white border border-[#E2E8F0] rounded-2xl p-5 shadow-sm">

                <div class="flex items-start justify-between">

                    <div>

                        <p class="text-sm font-medium text-[#4A5568]">
                            Inactive Customers
                        </p>

                        <p class="text-3xl font-bold text-[#0B1F4D] mt-2">
                            <?php echo e(number_format($inactiveCustomers)); ?>

                        </p>

                        <p class="text-xs text-[#4A5568] mt-2">
                            Customer accounts
                        </p>

                    </div>

                    <div class="w-11 h-11 rounded-xl bg-[#F1F5F9] flex items-center justify-center">

                        <svg class="w-5 h-5 text-[#4A5568]"
                             fill="none"
                             stroke="currentColor"
                             viewBox="0 0 24 24">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M17 20h5V4H2v16h5m10 0v-6H7v6m10 0H7"/>

                        </svg>

                    </div>

                </div>

            </div>


            

            <div class="bg-white border border-[#E2E8F0] rounded-2xl p-5 shadow-sm">

                <div class="flex items-start justify-between">

                    <div>

                        <p class="text-sm font-medium text-[#4A5568]">
                            Total Meters
                        </p>

                        <p class="text-3xl font-bold text-[#0B1F4D] mt-2">
                            <?php echo e(number_format($totalMeters)); ?>

                        </p>

                        <p class="text-xs text-[#2E9E4A] font-semibold mt-2">
                            <?php echo e(number_format($activeMeters)); ?> active
                        </p>

                    </div>

                    <div class="w-11 h-11 rounded-xl bg-[#EAF2FF] flex items-center justify-center">

                        <svg class="w-5 h-5 text-[#1D63D8]"
                             fill="none"
                             stroke="currentColor"
                             viewBox="0 0 24 24">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M9 17v-2a4 4 0 014-4h0a4 4 0 014 4v2m-8 0H5a2 2 0 01-2-2V7a2 2 0 012-2h14a2 2 0 012 2v8h-4m-6 0v2m6-2v2"/>

                        </svg>

                    </div>

                </div>

            </div>


            

            <div class="bg-[#F0FAF3] border border-[#D5EEDC] rounded-2xl p-5 shadow-sm">

                <p class="text-sm font-semibold text-[#2E9E4A]">
                    Paid Bills
                </p>

                <p class="text-3xl font-bold text-[#23823B] mt-2">
                    <?php echo e(number_format($paidBills)); ?>

                </p>

                <p class="text-xs text-[#4A5568] mt-2">
                    Fully settled invoices
                </p>

            </div>


            

            <div class="bg-[#FFF5F5] border border-[#F3D0D0] rounded-2xl p-5 shadow-sm">

                <p class="text-sm font-semibold text-[#C53030]">
                    Unpaid Bills
                </p>

                <p class="text-3xl font-bold text-[#B42318] mt-2">
                    <?php echo e(number_format($unpaidBills)); ?>

                </p>

                <p class="text-xs text-[#4A5568] mt-2">
                    Bills with outstanding balance
                </p>

            </div>

        </div>


        

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isFinancialUser): ?>

            

            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">


                

                <div class="bg-[#FFF8E8] border border-[#F3E0B3] rounded-2xl p-6">

                    <p class="text-sm font-semibold text-[#A66A00]">
                        Outstanding Amount
                    </p>

                    <p class="text-3xl font-bold text-[#9A6700] mt-2">
                        KSh <?php echo e(number_format($outstandingBalance, 2)); ?>

                    </p>

                    <p class="text-xs text-[#6B7280] mt-2">
                        Amount still owed
                    </p>

                </div>


                

                <div class="bg-white border border-[#E2E8F0] rounded-2xl p-6 shadow-sm">

                    <p class="text-sm font-medium text-[#4A5568]">
                        This Month Revenue
                    </p>

                    <p class="text-3xl font-bold text-[#0B1F4D] mt-2">
                        KSh <?php echo e(number_format($thisMonthRevenue, 2)); ?>

                    </p>

                    <p class="text-xs text-[#4A5568] mt-2">
                        <?php echo e(now()->format('F Y')); ?>

                    </p>

                </div>


                

                <div class="bg-[#EAF2FF] border border-[#CFE0FA] rounded-2xl p-6">

                    <p class="text-sm font-semibold text-[#1D63D8]">
                        Total Revenue
                    </p>

                    <p class="text-3xl font-bold text-[#0B1F4D] mt-2">
                        KSh <?php echo e(number_format($totalPaid, 2)); ?>

                    </p>

                    <p class="text-xs text-[#4A5568] mt-2">
                        Total payments collected
                    </p>

                </div>

            </div>


            

            <div class="bg-white border border-[#E2E8F0] rounded-2xl shadow-sm overflow-hidden">

                <div class="p-6 border-b border-[#E2E8F0] flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">

                    <div>

                        <h3 class="text-lg font-bold text-[#0B1F4D]">
                            Monthly Revenue
                        </h3>

                        <p class="text-sm text-[#4A5568] mt-1">
                            Payment collections for <?php echo e($currentYear); ?>

                        </p>

                    </div>

                    <div class="px-4 py-2 border border-[#E2E8F0] rounded-xl text-sm font-semibold text-[#0B1F4D]">
                        <?php echo e($currentYear); ?>

                    </div>

                </div>


                <div class="p-5 sm:p-7">

                    <div class="h-64 flex items-end gap-2 sm:gap-4">

                        <?php
                            $maxRevenue = max($monthlyRevenue ?: [0]);
                        ?>

                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $monthlyRevenue; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $revenue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <?php
                                $height = $maxRevenue > 0
                                    ? max(($revenue / $maxRevenue) * 100, 3)
                                    : 3;

                                $monthName = \Carbon\Carbon::create()
                                    ->month($index + 1)
                                    ->format('M');
                            ?>

                            <div class="flex-1 h-full flex flex-col justify-end items-center gap-2">

                                <div class="w-full flex justify-center items-end h-full">

                                    <div
                                        class="w-full max-w-[70px] rounded-t-lg bg-gradient-to-t from-[#1D63D8] to-[#5BA3E8] transition-all duration-300 hover:opacity-80"
                                        style="height: <?php echo e($height); ?>%;"
                                        title="KSh <?php echo e(number_format($revenue, 2)); ?>"
                                    ></div>

                                </div>

                                <span class="text-xs font-medium text-[#718096]">
                                    <?php echo e($monthName); ?>

                                </span>

                            </div>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                    </div>

                </div>

            </div>


            

            <div class="bg-white border border-[#E2E8F0] rounded-2xl shadow-sm overflow-hidden">

                <div class="p-6 border-b border-[#E2E8F0] flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">

                    <div>

                        <h3 class="text-lg font-bold text-[#0B1F4D]">
                            Recent Unpaid Bills
                        </h3>

                        <p class="text-sm text-[#4A5568] mt-1">
                            Customers with outstanding balances
                        </p>

                    </div>

                    <a href="<?php echo e(route('bills.index')); ?>"
                       class="inline-flex items-center justify-center px-4 py-2 rounded-xl bg-[#EAF2FF] text-[#1D63D8] text-sm font-semibold hover:bg-[#DCEBFF] transition">

                        View All

                        <svg class="w-4 h-4 ml-2"
                             fill="none"
                             stroke="currentColor"
                             viewBox="0 0 24 24">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M9 5l7 7-7 7"/>

                        </svg>

                    </a>

                </div>


                <div class="overflow-x-auto">

                    <table class="min-w-full">

                        <thead>

                            <tr class="border-b border-[#E2E8F0]">

                                <th class="px-6 py-4 text-left text-xs font-bold text-[#4A5568] uppercase tracking-wider">
                                    Customer
                                </th>

                                <th class="px-6 py-4 text-left text-xs font-bold text-[#4A5568] uppercase tracking-wider">
                                    Meter
                                </th>

                                <th class="px-6 py-4 text-left text-xs font-bold text-[#4A5568] uppercase tracking-wider">
                                    Balance
                                </th>

                                <th class="px-6 py-4 text-left text-xs font-bold text-[#4A5568] uppercase tracking-wider">
                                    Status
                                </th>

                            </tr>

                        </thead>


                        <tbody class="divide-y divide-[#E2E8F0]">

                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $recentUnpaidBills; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                                <tr class="hover:bg-[#F7F9FC] transition">

                                    <td class="px-6 py-4">

                                        <a href="<?php echo e(route('bills.show', $bill)); ?>"
                                           class="font-semibold text-[#0B1F4D] hover:text-[#1D63D8]">

                                            <?php echo e($bill->customer->full_name ?? 'N/A'); ?>


                                        </a>

                                        <p class="text-xs text-[#718096] mt-1">
                                            <?php echo e($bill->invoice_number); ?>

                                        </p>

                                    </td>

                                    <td class="px-6 py-4 text-sm text-[#4A5568]">

                                        <?php echo e($bill->meterReading->meter->meter_number ?? 'N/A'); ?>


                                    </td>

                                    <td class="px-6 py-4 text-sm font-bold text-[#0B1F4D]">

                                        KSh <?php echo e(number_format($bill->balance, 2)); ?>


                                    </td>

                                    <td class="px-6 py-4">

                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($bill->amount_paid > 0): ?>

                                            <span class="inline-flex px-3 py-1 rounded-full text-xs font-bold bg-[#FFF4CC] text-[#946200]">
                                                Partial
                                            </span>

                                        <?php else: ?>

                                            <span class="inline-flex px-3 py-1 rounded-full text-xs font-bold bg-[#FEE2E2] text-[#B42318]">
                                                Unpaid
                                            </span>

                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                                    </td>

                                </tr>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                                <tr>

                                    <td colspan="4" class="px-6 py-12 text-center">

                                        <div class="w-12 h-12 mx-auto rounded-full bg-[#ECF8F0] flex items-center justify-center mb-3">

                                            <svg class="w-6 h-6 text-[#2E9E4A]"
                                                 fill="none"
                                                 stroke="currentColor"
                                                 viewBox="0 0 24 24">

                                                <path stroke-linecap="round"
                                                      stroke-linejoin="round"
                                                      stroke-width="2"
                                                      d="M5 13l4 4L19 7"/>

                                            </svg>

                                        </div>

                                        <p class="text-sm font-semibold text-[#4A5568]">
                                            No outstanding bills.
                                        </p>

                                    </td>

                                </tr>

                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                        </tbody>

                    </table>

                </div>

            </div>


            

            <div class="bg-white border border-[#E2E8F0] rounded-2xl shadow-sm overflow-hidden">

                <div class="p-6 border-b border-[#E2E8F0] flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">

                    <div>

                        <h3 class="text-lg font-bold text-[#0B1F4D]">
                            Recent Payments
                        </h3>

                        <p class="text-sm text-[#4A5568] mt-1">
                            Latest customer payments
                        </p>

                    </div>

                    <a href="<?php echo e(route('payments.index')); ?>"
                       class="inline-flex items-center justify-center px-4 py-2 rounded-xl bg-[#ECF8F0] text-[#2E9E4A] text-sm font-semibold hover:bg-[#DDF3E3] transition">

                        View All

                    </a>

                </div>


                <div class="overflow-x-auto">

                    <table class="min-w-full">

                        <thead>

                            <tr class="border-b border-[#E2E8F0]">

                                <th class="px-6 py-4 text-left text-xs font-bold text-[#4A5568] uppercase tracking-wider">
                                    Customer
                                </th>

                                <th class="px-6 py-4 text-left text-xs font-bold text-[#4A5568] uppercase tracking-wider">
                                    Amount
                                </th>

                                <th class="px-6 py-4 text-left text-xs font-bold text-[#4A5568] uppercase tracking-wider">
                                    Method
                                </th>

                                <th class="px-6 py-4 text-left text-xs font-bold text-[#4A5568] uppercase tracking-wider">
                                    Reference
                                </th>

                                <th class="px-6 py-4 text-left text-xs font-bold text-[#4A5568] uppercase tracking-wider">
                                    Date
                                </th>

                            </tr>

                        </thead>


                        <tbody class="divide-y divide-[#E2E8F0]">

                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $recentPayments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                                <tr class="hover:bg-[#F7F9FC] transition">

                                    <td class="px-6 py-4 text-sm font-semibold text-[#0B1F4D]">

                                        <?php echo e($payment->customer->full_name ?? $payment->bill->customer->full_name ?? 'N/A'); ?>


                                    </td>

                                    <td class="px-6 py-4 text-sm font-bold text-[#2E9E4A]">

                                        KSh <?php echo e(number_format($payment->amount, 2)); ?>


                                    </td>

                                    <td class="px-6 py-4 text-sm text-[#4A5568]">

                                        <?php echo e(ucfirst($payment->payment_method ?? 'N/A')); ?>


                                    </td>

                                    <td class="px-6 py-4 text-sm text-[#718096]">

                                        <?php echo e($payment->reference_number ?? '—'); ?>


                                    </td>

                                    <td class="px-6 py-4 text-sm text-[#718096] whitespace-nowrap">

                                        <?php echo e(optional($payment->payment_date)->format('d M Y') ?? 'N/A'); ?>


                                    </td>

                                </tr>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                                <tr>

                                    <td colspan="5"
                                        class="px-6 py-12 text-center text-sm text-[#718096]">

                                        No payments have been recorded yet.

                                    </td>

                                </tr>

                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                        </tbody>

                    </table>

                </div>

            </div>

        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>


        

        <div>

            <div class="mb-4">

                <h3 class="text-lg font-bold text-[#0B1F4D]">
                    Quick Actions
                </h3>

                <p class="text-sm text-[#4A5568] mt-1">
                    Frequently used system functions.
                </p>

            </div>


            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">


                <a href="<?php echo e(route('customers.create')); ?>"
                   class="bg-white border border-[#E2E8F0] rounded-2xl p-5 hover:border-[#1D63D8] hover:shadow-md transition group">

                    <div class="w-10 h-10 rounded-xl bg-[#EAF2FF] flex items-center justify-center mb-4">

                        <svg class="w-5 h-5 text-[#1D63D8]"
                             fill="none"
                             stroke="currentColor"
                             viewBox="0 0 24 24">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M12 4v16m8-8H4"/>

                        </svg>

                    </div>

                    <p class="font-semibold text-[#0B1F4D]">
                        Add Customer
                    </p>

                    <p class="text-xs text-[#718096] mt-1">
                        Register a new customer
                    </p>

                </a>


                <a href="<?php echo e(route('meter-readings.create')); ?>"
                   class="bg-white border border-[#E2E8F0] rounded-2xl p-5 hover:border-[#1D63D8] hover:shadow-md transition group">

                    <div class="w-10 h-10 rounded-xl bg-[#EAF2FF] flex items-center justify-center mb-4">

                        <svg class="w-5 h-5 text-[#1D63D8]"
                             fill="none"
                             stroke="currentColor"
                             viewBox="0 0 24 24">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M9 17v-2a4 4 0 014-4h0a4 4 0 014 4v2M7 7h10M7 11h4"/>

                        </svg>

                    </div>

                    <p class="font-semibold text-[#0B1F4D]">
                        Record Reading
                    </p>

                    <p class="text-xs text-[#718096] mt-1">
                        Enter a meter reading
                    </p>

                </a>


                <a href="<?php echo e(route('bills.create')); ?>"
                   class="bg-white border border-[#E2E8F0] rounded-2xl p-5 hover:border-[#1D63D8] hover:shadow-md transition group">

                    <div class="w-10 h-10 rounded-xl bg-[#EAF2FF] flex items-center justify-center mb-4">

                        <svg class="w-5 h-5 text-[#1D63D8]"
                             fill="none"
                             stroke="currentColor"
                             viewBox="0 0 24 0">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M9 14h6m-6 4h6M7 3h10a2 2 0 012 2v14a2 2 0 01-2 2H7a2 2 0 01-2-2V5a2 2 0 012-2z"/>

                        </svg>

                    </div>

                    <p class="font-semibold text-[#0B1F4D]">
                        Create Bill
                    </p>

                    <p class="text-xs text-[#718096] mt-1">
                        Generate a new invoice
                    </p>

                </a>


                <a href="<?php echo e(route('payments.index')); ?>"
                   class="bg-white border border-[#E2E8F0] rounded-2xl p-5 hover:border-[#2E9E4A] hover:shadow-md transition group">

                    <div class="w-10 h-10 rounded-xl bg-[#ECF8F0] flex items-center justify-center mb-4">

                        <svg class="w-5 h-5 text-[#2E9E4A]"
                             fill="none"
                             stroke="currentColor"
                             viewBox="0 0 24 24">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M12 8c-2.21 0-4 1.343-4 3s1.79 3 4 3 4 1.343 4 3-1.79 3-4 3m0-14v2m0 10v2"/>

                        </svg>

                    </div>

                    <p class="font-semibold text-[#0B1F4D]">
                        Payments
                    </p>

                    <p class="text-xs text-[#718096] mt-1">
                        View customer payments
                    </p>

                </a>

            </div>

        </div>


        

        <div class="border-t border-[#E2E8F0] pt-5 pb-2 flex flex-col sm:flex-row items-center justify-between gap-2">

            <p class="text-xs text-[#718096]">
                Maji Mazuri Water Billing & Customer Management System
            </p>

            <p class="text-xs font-medium text-[#1D63D8]">
                Pure Tide Mazuri Ltd
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
<?php /**PATH C:\Users\ADMIN\Downloads\maji-mazuri-deploy\resources\views/dashboard.blade.php ENDPATH**/ ?>