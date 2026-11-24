

<?php $__env->startSection('title', 'Outstanding Bills'); ?>

<?php $__env->startSection('content'); ?>
<div class="min-h-screen bg-slate-50">

    
    <div class="border-b border-slate-200 bg-white">
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">

            <div class="flex flex-col gap-5 lg:flex-row lg:items-center lg:justify-between">

                <div>
                    <div class="flex items-center gap-3">

                        <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-[#031B35] shadow-lg">
                            <svg class="h-6 w-6 text-cyan-300"
                                 fill="none"
                                 stroke="currentColor"
                                 viewBox="0 0 24 24">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="1.8"
                                      d="M12 8c-2.21 0-4 1.343-4 3s1.79 3 4 3 4 1.343 4 3-1.79 3-4 3m0-14v2m0 12v2m8-9a8 8 0 11-16 0 8 8 0 0116 0z"/>
                            </svg>
                        </div>

                        <div>
                            <p class="text-xs font-bold uppercase tracking-[0.18em] text-blue-600">
                                Pure Tide Mazuri Ltd
                            </p>

                            <h1 class="mt-1 text-2xl font-black tracking-tight text-slate-900 sm:text-3xl">
                                Outstanding Bills
                            </h1>
                        </div>

                    </div>

                    <p class="mt-3 max-w-2xl text-sm leading-6 text-slate-500">
                        Review unpaid and partially paid customer bills, outstanding balances,
                        and collection progress.
                    </p>
                </div>

                <div class="flex flex-wrap gap-3">

                    <a href="<?php echo e(route('bills.index')); ?>"
                       class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm font-bold text-slate-700 shadow-sm transition hover:border-slate-400 hover:bg-slate-50">

                        <svg class="h-4 w-4"
                             fill="none"
                             stroke="currentColor"
                             viewBox="0 0 24 24">
                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>

                        Back to Bills
                    </a>

                    <a href="<?php echo e(route('bills.outstanding.pdf')); ?>"
                       class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#031B35] px-4 py-2.5 text-sm font-bold text-white shadow-lg shadow-blue-900/20 transition hover:bg-[#06294F]">

                        <svg class="h-4 w-4"
                             fill="none"
                             stroke="currentColor"
                             viewBox="0 0 24 24">
                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h7l5 5v11a2 2 0 01-2 2z"/>
                        </svg>

                        Download PDF
                    </a>

                </div>
            </div>

        </div>
    </div>


    
    <main class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">

        
        <div class="relative mb-8 overflow-hidden rounded-3xl border border-white/20 bg-[#031B35] shadow-2xl shadow-slate-300/50">

            <div class="pointer-events-none absolute -right-16 -top-16 h-48 w-48 rounded-full bg-cyan-400/10 blur-2xl"></div>
            <div class="pointer-events-none absolute -bottom-20 -left-10 h-56 w-56 rounded-full bg-blue-500/10 blur-3xl"></div>

            <div class="relative px-6 py-7 sm:px-8 sm:py-9">

                <div class="flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">

                    <div class="max-w-3xl">

                        <div class="mb-3 inline-flex items-center gap-2 rounded-full border border-cyan-300/20 bg-white/10 px-3 py-1.5 text-xs font-bold uppercase tracking-wider text-cyan-200 backdrop-blur-xl">
                            <span class="h-2 w-2 rounded-full bg-cyan-300"></span>
                            Billing Overview
                        </div>

                        <h2 class="text-2xl font-black tracking-tight text-white sm:text-3xl">
                            Outstanding Bills Overview
                        </h2>

                        <p class="mt-3 text-sm leading-6 text-blue-100/80 sm:text-base">
                            A clear view of customer balances that still require collection.
                            Use this report to monitor unpaid bills and follow up with customers.
                        </p>

                    </div>

                    <div class="shrink-0 rounded-2xl border border-white/10 bg-white/10 px-5 py-4 text-left backdrop-blur-xl lg:text-right">

                        <p class="text-xs font-bold uppercase tracking-wider text-blue-200">
                            Report Date
                        </p>

                        <p class="mt-1 text-lg font-black text-white">
                            <?php echo e(now()->format('d M Y')); ?>

                        </p>

                    </div>

                </div>

            </div>
        </div>


        
        <div class="relative mb-8 overflow-hidden rounded-3xl border border-white/20 bg-gradient-to-br from-[#031B35] via-[#06294F] to-[#083B68] shadow-2xl shadow-blue-900/20">

            <div class="pointer-events-none absolute -right-24 -top-24 h-72 w-72 rounded-full bg-cyan-400/10 blur-3xl"></div>
            <div class="pointer-events-none absolute -bottom-32 -left-20 h-80 w-80 rounded-full bg-blue-500/10 blur-3xl"></div>

            <div class="relative p-6 sm:p-8">

                
                <div class="grid gap-6 lg:grid-cols-3">

                    <div class="lg:col-span-2">

                        <p class="text-sm font-semibold text-blue-200">
                            Total Outstanding
                        </p>

                        <div class="mt-2 flex flex-wrap items-end gap-3">

                            <h3 class="text-4xl font-black tracking-tight text-white sm:text-5xl">
                                KSh <?php echo e(number_format($totalOutstanding, 2)); ?>

                            </h3>

                            <span class="mb-1 rounded-full border border-red-300/20 bg-red-500/15 px-3 py-1 text-xs font-bold text-red-200 backdrop-blur-xl">
                                Outstanding
                            </span>

                        </div>

                        <p class="mt-3 max-w-xl text-sm leading-6 text-blue-100/75">
                            Amount currently remaining across all unpaid and partially paid bills.
                        </p>

                    </div>


                    <div class="rounded-2xl border border-white/10 bg-white/10 p-5 backdrop-blur-xl">

                        <div class="flex items-center justify-between">

                            <span class="text-sm font-semibold text-blue-100">
                                Customers with balances
                            </span>

                            <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-cyan-400/10">

                                <svg class="h-5 w-5 text-cyan-300"
                                     fill="none"
                                     stroke="currentColor"
                                     viewBox="0 0 24 24">
                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          stroke-width="1.8"
                                          d="M17 20h5v-2a4 4 0 00-4-4h-1m-3-4a4 4 0 100-8 4 4 0 000 8zM7 20H2v-2a4 4 0 014-4h1m3-4a4 4 0 100-8 4 4 0 000 8z"/>
                                </svg>

                            </div>

                        </div>

                        <p class="mt-3 text-3xl font-black text-white">
                            <?php echo e($customersWithBalances->count()); ?>

                        </p>

                        <p class="mt-1 text-xs text-blue-200/70">
                            Customers requiring follow-up
                        </p>

                    </div>

                </div>


                
                <div class="my-7 h-px bg-white/10"></div>


                
                <div class="grid grid-cols-2 gap-4 lg:grid-cols-4">

                    <div class="rounded-2xl border border-white/10 bg-white/5 p-4 backdrop-blur-xl">

                        <p class="text-xs font-semibold uppercase tracking-wider text-blue-200/70">
                            Customers
                        </p>

                        
                        <p class="mt-2 text-2xl font-black text-white">
                            <?php echo e($customers); ?>

                        </p>

                    </div>


                    <div class="rounded-2xl border border-white/10 bg-white/5 p-4 backdrop-blur-xl">

                        <p class="text-xs font-semibold uppercase tracking-wider text-blue-200/70">
                            Bills
                        </p>

                        <p class="mt-2 text-2xl font-black text-white">
                            <?php echo e($outstandingBills->count()); ?>

                        </p>

                    </div>


                    <div class="rounded-2xl border border-white/10 bg-white/5 p-4 backdrop-blur-xl">

                        <p class="text-xs font-semibold uppercase tracking-wider text-blue-200/70">
                            Total Billed
                        </p>

                        <p class="mt-2 text-xl font-black text-white">
                            KSh <?php echo e(number_format($totalBilled, 2)); ?>

                        </p>

                    </div>


                    <div class="rounded-2xl border border-white/10 bg-white/5 p-4 backdrop-blur-xl">

                        <p class="text-xs font-semibold uppercase tracking-wider text-blue-200/70">
                            Collected
                        </p>

                        <p class="mt-2 text-xl font-black text-emerald-300">
                            KSh <?php echo e(number_format($totalPaid, 2)); ?>

                        </p>

                    </div>

                </div>


                
                <div class="mt-7 rounded-2xl border border-white/10 bg-white/10 p-5 backdrop-blur-xl">

                    <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">

                        <div>

                            <p class="text-sm font-bold text-white">
                                Collection Progress
                            </p>

                            <p class="mt-1 text-xs text-blue-200/70">
                                Percentage of billed amount already collected
                            </p>

                        </div>

                        <p class="text-xl font-black text-cyan-300">
                            <?php echo e(number_format($collectionPercentage, 1)); ?>%
                        </p>

                    </div>


                    <div class="mt-4 h-3 overflow-hidden rounded-full bg-white/10">

                        <div class="h-full rounded-full bg-gradient-to-r from-cyan-400 to-blue-400 transition-all duration-500"
                             style="width: <?php echo e(min(max($collectionPercentage, 0), 100)); ?>%;">
                        </div>

                    </div>


                    <div class="mt-3 flex items-center justify-between text-xs">

                        <span class="text-emerald-300">
                            Collected: KSh <?php echo e(number_format($totalPaid, 2)); ?>

                        </span>

                        <span class="text-red-300">
                            Remaining: KSh <?php echo e(number_format($totalOutstanding, 2)); ?>

                        </span>

                    </div>

                </div>

            </div>
        </div>


        
        <div class="mb-8 grid gap-5 sm:grid-cols-2 lg:grid-cols-3">

            
            <div class="group rounded-3xl border border-white/30 bg-[#06294F] p-6 shadow-xl shadow-blue-900/10 backdrop-blur-2xl transition duration-300 hover:-translate-y-1 hover:shadow-2xl">

                <div class="flex items-start justify-between">

                    <div>

                        <p class="text-sm font-semibold text-blue-200">
                            Customers With Balances
                        </p>

                        <p class="mt-2 text-3xl font-black text-white">
                            <?php echo e($customersWithBalances->count()); ?>

                        </p>

                    </div>

                    <div class="flex h-12 w-12 items-center justify-center rounded-2xl border border-cyan-300/20 bg-cyan-400/10">

                        <svg class="h-6 w-6 text-cyan-300"
                             fill="none"
                             stroke="currentColor"
                             viewBox="0 0 24 24">
                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="1.8"
                                  d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2m6-10a4 4 0 100-8 4 4 0 000 8zm12 10v-2a4 4 0 00-3-3.87m-1-11a4 4 0 010 7.75"/>
                        </svg>

                    </div>

                </div>

                <p class="mt-4 text-xs text-blue-200/60">
                    Customers currently owing the company
                </p>

            </div>


            
            <div class="group rounded-3xl border border-white/30 bg-[#06294F] p-6 shadow-xl shadow-blue-900/10 backdrop-blur-2xl transition duration-300 hover:-translate-y-1 hover:shadow-2xl">

                <div class="flex items-start justify-between">

                    <div>

                        <p class="text-sm font-semibold text-blue-200">
                            Outstanding Bills
                        </p>

                        <p class="mt-2 text-3xl font-black text-white">
                            <?php echo e($outstandingBills->count()); ?>

                        </p>

                    </div>

                    <div class="flex h-12 w-12 items-center justify-center rounded-2xl border border-red-300/20 bg-red-500/10">

                        <svg class="h-6 w-6 text-red-300"
                             fill="none"
                             stroke="currentColor"
                             viewBox="0 0 24 24">
                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="1.8"
                                  d="M12 9v4m0 4h.01M10.29 3.86l-8.1 14A2 2 0 003.92 21h16.16a2 2 0 001.73-3.14l-8.1-14a2 2 0 00-3.42 0z"/>
                        </svg>

                    </div>

                </div>

                <p class="mt-4 text-xs text-blue-200/60">
                    Bills requiring payment
                </p>

            </div>


            
            <div class="group rounded-3xl border border-white/30 bg-[#06294F] p-6 shadow-xl shadow-blue-900/10 backdrop-blur-2xl transition duration-300 hover:-translate-y-1 hover:shadow-2xl sm:col-span-2 lg:col-span-1">

                <div class="flex items-start justify-between">

                    <div>

                        <p class="text-sm font-semibold text-blue-200">
                            Total Billed
                        </p>

                        <p class="mt-2 text-2xl font-black text-white">
                            KSh <?php echo e(number_format($totalBilled, 2)); ?>

                        </p>

                    </div>

                    <div class="flex h-12 w-12 items-center justify-center rounded-2xl border border-blue-300/20 bg-blue-400/10">

                        <svg class="h-6 w-6 text-blue-300"
                             fill="none"
                             stroke="currentColor"
                             viewBox="0 0 24 24">
                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="1.8"
                                  d="M9 14h6m-6-4h6m2 9H7a2 2 0 01-2-2V5a2 2 0 012-2h7l5 5v9a2 2 0 01-2 2z"/>
                        </svg>

                    </div>

                </div>

                <p class="mt-4 text-xs text-blue-200/60">
                    Total value of outstanding bill records
                </p>

            </div>

        </div>


        
        <div class="mb-4 flex flex-col gap-2 sm:flex-row sm:items-end sm:justify-between">

            <div>

                <p class="text-xs font-bold uppercase tracking-[0.18em] text-blue-600">
                    Customer Accounts
                </p>

                <h2 class="mt-1 text-2xl font-black tracking-tight text-slate-900">
                    Customers With Outstanding Balances
                </h2>

                <p class="mt-1 text-sm text-slate-500">
                    Review each customer's outstanding bills and available actions.
                </p>

            </div>

            <div class="text-sm font-semibold text-slate-500">

                <?php echo e($customersWithBalances->count()); ?>


                <?php echo e($customersWithBalances->count() === 1 ? 'customer' : 'customers'); ?>


            </div>

        </div>


        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($customersWithBalances->count()): ?>

            <div class="space-y-6">

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $customersWithBalances; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <?php
                        $customerOutstanding = $customer->report_outstanding ?? 0;
                        $customerBilled = $customer->report_total_billed ?? 0;
                        $customerPaid = $customer->report_total_paid ?? 0;
                    ?>


                    
                    <div class="overflow-hidden rounded-3xl border border-white/20 bg-[#031B35] shadow-xl shadow-slate-300/30">

                        
                        <div class="relative overflow-hidden border-b border-white/10 px-5 py-6 sm:px-7">

                            <div class="pointer-events-none absolute -right-16 -top-16 h-40 w-40 rounded-full bg-cyan-400/10 blur-3xl"></div>

                            <div class="relative flex flex-col gap-5 lg:flex-row lg:items-center lg:justify-between">

                                <div class="flex items-start gap-4">

                                    <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-white/10 text-lg font-black text-cyan-300 backdrop-blur-xl">
                                        <?php echo e(strtoupper(substr($customer->full_name ?? 'C', 0, 1))); ?>

                                    </div>

                                    <div>

                                        <h3 class="text-xl font-black text-white">
                                            <?php echo e($customer->full_name); ?>

                                        </h3>

                                        <div class="mt-2 flex flex-wrap gap-x-4 gap-y-1 text-xs text-blue-200/75">

                                            <span>
                                                Account:
                                                <strong class="text-white">
                                                    <?php echo e($customer->customer_number); ?>

                                                </strong>
                                            </span>

                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($customer->area): ?>

                                                <span>
                                                    Area:
                                                    <strong class="text-white">
                                                        <?php echo e($customer->area); ?>

                                                    </strong>
                                                </span>

                                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($customer->phone_number): ?>

                                                <span>
                                                    Phone:
                                                    <strong class="text-white">
                                                        <?php echo e($customer->phone_number); ?>

                                                    </strong>
                                                </span>

                                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                                        </div>

                                    </div>

                                </div>


                                <div class="rounded-2xl border border-red-300/20 bg-red-500/10 px-5 py-3 backdrop-blur-xl">

                                    <p class="text-xs font-bold uppercase tracking-wider text-red-200/80">
                                        Outstanding
                                    </p>

                                    <p class="mt-1 text-2xl font-black text-red-300">
                                        KSh <?php echo e(number_format($customerOutstanding, 2)); ?>

                                    </p>

                                </div>

                            </div>

                        </div>


                        
                        <div class="grid grid-cols-1 gap-px bg-white/10 sm:grid-cols-3">

                            <div class="bg-[#05223F] px-5 py-4 sm:px-7">

                                <p class="text-xs font-semibold uppercase tracking-wider text-blue-200/60">
                                    Total Billed
                                </p>

                                <p class="mt-1 text-lg font-black text-white">
                                    KSh <?php echo e(number_format($customerBilled, 2)); ?>

                                </p>

                            </div>


                            <div class="bg-[#05223F] px-5 py-4 sm:px-7">

                                <p class="text-xs font-semibold uppercase tracking-wider text-blue-200/60">
                                    Paid
                                </p>

                                <p class="mt-1 text-lg font-black text-emerald-300">
                                    KSh <?php echo e(number_format($customerPaid, 2)); ?>

                                </p>

                            </div>


                            <div class="bg-[#05223F] px-5 py-4 sm:px-7">

                                <p class="text-xs font-semibold uppercase tracking-wider text-blue-200/60">
                                    Bills
                                </p>

                                <p class="mt-1 text-lg font-black text-white">
                                    <?php echo e($customer->bills->count()); ?>

                                </p>

                            </div>

                        </div>


                        
                        <div class="p-5 sm:p-7">

                            <div class="mb-4 flex items-center justify-between">

                                <div>

                                    <h4 class="text-sm font-black uppercase tracking-wider text-white">
                                        Outstanding Bills
                                    </h4>

                                    <p class="mt-1 text-xs text-blue-200/60">
                                        Invoice details and payment status
                                    </p>

                                </div>

                            </div>


                            
                            <div class="hidden overflow-hidden rounded-2xl border border-white/10 md:block">

                                <div class="overflow-x-auto">

                                    <table class="min-w-full">

                                        <thead class="bg-white/10 backdrop-blur-xl">

                                            <tr>

                                                <th class="px-5 py-4 text-left text-xs font-bold uppercase tracking-wider text-blue-200">
                                                    Invoice
                                                </th>

                                                <th class="px-5 py-4 text-left text-xs font-bold uppercase tracking-wider text-blue-200">
                                                    Billing Date
                                                </th>

                                                <th class="px-5 py-4 text-right text-xs font-bold uppercase tracking-wider text-blue-200">
                                                    Amount
                                                </th>

                                                <th class="px-5 py-4 text-right text-xs font-bold uppercase tracking-wider text-blue-200">
                                                    Paid
                                                </th>

                                                <th class="px-5 py-4 text-right text-xs font-bold uppercase tracking-wider text-blue-200">
                                                    Balance
                                                </th>

                                                <th class="px-5 py-4 text-right text-xs font-bold uppercase tracking-wider text-blue-200">
                                                    Actions
                                                </th>

                                            </tr>

                                        </thead>


                                        <tbody class="divide-y divide-white/10">

                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $customer->bills; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                                <?php
                                                    $billBalance = (float) ($bill->balance ?? 0);
                                                    $billAmount = (float) ($bill->amount ?? 0);
                                                    $billPaid = max(0, $billAmount - $billBalance);
                                                ?>

                                                <tr class="transition hover:bg-white/5">

                                                    <td class="whitespace-nowrap px-5 py-4">

                                                        <span class="font-bold text-white">
                                                            <?php echo e($bill->invoice_number); ?>

                                                        </span>

                                                    </td>


                                                    <td class="whitespace-nowrap px-5 py-4 text-sm text-blue-100/75">

                                                        <?php echo e(optional($bill->billing_date)->format('d M Y') ?? '—'); ?>


                                                    </td>


                                                    <td class="whitespace-nowrap px-5 py-4 text-right text-sm font-semibold text-white">

                                                        KSh <?php echo e(number_format($billAmount, 2)); ?>


                                                    </td>


                                                    <td class="whitespace-nowrap px-5 py-4 text-right text-sm font-semibold text-emerald-300">

                                                        KSh <?php echo e(number_format($billPaid, 2)); ?>


                                                    </td>


                                                    <td class="whitespace-nowrap px-5 py-4 text-right">

                                                        <span class="inline-flex rounded-full border border-red-300/20 bg-red-500/10 px-3 py-1 text-sm font-black text-red-300">
                                                            KSh <?php echo e(number_format($billBalance, 2)); ?>

                                                        </span>

                                                    </td>


                                                    <td class="whitespace-nowrap px-5 py-4 text-right">

                                                        <div class="flex justify-end gap-2">

                                                            <a href="<?php echo e(route('bills.show', $bill)); ?>"
                                                               class="inline-flex items-center gap-1.5 rounded-lg border border-white/10 bg-white/10 px-3 py-2 text-xs font-bold text-white transition hover:bg-white/15">

                                                                <svg class="h-3.5 w-3.5"
                                                                     fill="none"
                                                                     stroke="currentColor"
                                                                     viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round"
                                                                          stroke-linejoin="round"
                                                                          stroke-width="2"
                                                                          d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                                    <path stroke-linecap="round"
                                                                          stroke-linejoin="round"
                                                                          stroke-width="2"
                                                                          d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7z"/>
                                                                </svg>

                                                                View

                                                            </a>


                                                            <a href="<?php echo e(route('bills.pdf', $bill)); ?>"
                                                               class="inline-flex items-center gap-1.5 rounded-lg bg-cyan-400 px-3 py-2 text-xs font-black text-[#031B35] transition hover:bg-cyan-300">

                                                                <svg class="h-3.5 w-3.5"
                                                                     fill="none"
                                                                     stroke="currentColor"
                                                                     viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round"
                                                                          stroke-linejoin="round"
                                                                          stroke-width="2"
                                                                          d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h7l5 5v11a2 2 0 01-2-2z"/>
                                                                </svg>

                                                                PDF

                                                            </a>

                                                        </div>

                                                    </td>

                                                </tr>

                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                                        </tbody>

                                    </table>

                                </div>

                            </div>


                            
                            <div class="space-y-3 md:hidden">

                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $customer->bills; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                    <?php
                                        $billBalance = (float) ($bill->balance ?? 0);
                                        $billAmount = (float) ($bill->amount ?? 0);
                                        $billPaid = max(0, $billAmount - $billBalance);
                                    ?>

                                    <div class="rounded-2xl border border-white/10 bg-white/5 p-4 backdrop-blur-xl">

                                        <div class="flex items-start justify-between gap-4">

                                            <div>

                                                <p class="text-xs font-semibold uppercase tracking-wider text-blue-200/60">
                                                    Invoice
                                                </p>

                                                <p class="mt-1 font-black text-white">
                                                    <?php echo e($bill->invoice_number); ?>

                                                </p>

                                            </div>

                                            <span class="rounded-full border border-red-300/20 bg-red-500/10 px-2.5 py-1 text-xs font-black text-red-300">
                                                KSh <?php echo e(number_format($billBalance, 2)); ?>

                                            </span>

                                        </div>


                                        <div class="mt-4 grid grid-cols-2 gap-3">

                                            <div>

                                                <p class="text-xs text-blue-200/60">
                                                    Billing Date
                                                </p>

                                                <p class="mt-1 text-sm font-bold text-white">
                                                    <?php echo e(optional($bill->billing_date)->format('d M Y') ?? '—'); ?>

                                                </p>

                                            </div>


                                            <div>

                                                <p class="text-xs text-blue-200/60">
                                                    Amount
                                                </p>

                                                <p class="mt-1 text-sm font-bold text-white">
                                                    KSh <?php echo e(number_format($billAmount, 2)); ?>

                                                </p>

                                            </div>


                                            <div>

                                                <p class="text-xs text-blue-200/60">
                                                    Paid
                                                </p>

                                                <p class="mt-1 text-sm font-bold text-emerald-300">
                                                    KSh <?php echo e(number_format($billPaid, 2)); ?>

                                                </p>

                                            </div>


                                            <div>

                                                <p class="text-xs text-blue-200/60">
                                                    Balance
                                                </p>

                                                <p class="mt-1 text-sm font-black text-red-300">
                                                    KSh <?php echo e(number_format($billBalance, 2)); ?>

                                                </p>

                                            </div>

                                        </div>


                                        <div class="mt-4 grid grid-cols-2 gap-2">

                                            <a href="<?php echo e(route('bills.show', $bill)); ?>"
                                               class="inline-flex items-center justify-center gap-1.5 rounded-xl border border-white/10 bg-white/10 px-3 py-2.5 text-xs font-bold text-white transition hover:bg-white/15">

                                                <svg class="h-4 w-4"
                                                     fill="none"
                                                     stroke="currentColor"
                                                     viewBox="0 0 24 24">
                                                    <path stroke-linecap="round"
                                                          stroke-linejoin="round"
                                                          stroke-width="2"
                                                          d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                    <path stroke-linecap="round"
                                                          stroke-linejoin="round"
                                                          stroke-width="2"
                                                          d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7z"/>
                                                </svg>

                                                View

                                            </a>


                                            <a href="<?php echo e(route('bills.pdf', $bill)); ?>"
                                               class="inline-flex items-center justify-center gap-1.5 rounded-xl bg-cyan-400 px-3 py-2.5 text-xs font-black text-[#031B35] transition hover:bg-cyan-300">

                                                <svg class="h-4 w-4"
                                                     fill="none"
                                                     stroke="currentColor"
                                                     viewBox="0 0 24 24">
                                                    <path stroke-linecap="round"
                                                          stroke-linejoin="round"
                                                          stroke-width="2"
                                                          d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h7l5 5v11a2 2 0 01-2-2z"/>
                                                </svg>

                                                PDF

                                            </a>

                                        </div>

                                    </div>

                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                            </div>

                        </div>

                    </div>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            </div>

        <?php else: ?>

            
            <div class="rounded-3xl border border-slate-200 bg-white px-6 py-16 text-center shadow-sm">

                <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-emerald-50">

                    <svg class="h-8 w-8 text-emerald-600"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="1.8"
                              d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>

                    </svg>

                </div>


                <h3 class="mt-5 text-xl font-black text-slate-900">
                    No Outstanding Bills
                </h3>


                <p class="mx-auto mt-2 max-w-md text-sm leading-6 text-slate-500">
                    All customer bills are currently settled. There are no unpaid
                    or partially paid balances to display.
                </p>


                <a href="<?php echo e(route('bills.index')); ?>"
                   class="mt-6 inline-flex items-center gap-2 rounded-xl bg-[#031B35] px-5 py-3 text-sm font-bold text-white shadow-lg shadow-blue-900/10 transition hover:bg-[#06294F]">

                    View All Bills

                    <svg class="h-4 w-4"
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

        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>


        
        <div class="mt-10 border-t border-slate-200 pt-6 text-center">

            <p class="text-sm font-bold text-slate-700">
                PURE TIDE MAZURI LTD
            </p>

            <p class="mt-1 text-xs font-medium text-slate-400">
                PURE WATER. PURE LIFE.
            </p>

            <p class="mt-2 text-xs text-slate-400">
                Maji Mazuri Water Billing & Customer Management System
            </p>

        </div>

    </main>

</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\ADMIN\Downloads\maji-mazuri-deploy\resources\views\bills\outstanding.blade.php ENDPATH**/ ?>