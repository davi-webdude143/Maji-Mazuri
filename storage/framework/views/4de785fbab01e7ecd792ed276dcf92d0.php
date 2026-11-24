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

    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">

        
        <div>
            <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-100">
                Invoice
            </h2>

            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                <?php echo e($bill->invoice_number); ?>

            </p>
        </div>


        

        <div class="flex flex-wrap items-center gap-3 no-print">

            
            <a
                href="<?php echo e(route('bills.pdf', ['bill' => $bill->id])); ?>"
                class="inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-xl bg-red-600 hover:bg-red-700 active:bg-red-800 text-white font-semibold shadow-sm transition duration-200"
            >
                <span class="text-lg">
                    📄
                </span>

                <span>
                    Download PDF
                </span>
            </a>


            
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($bill->balance > 0): ?>

                <a
                    href="<?php echo e(route('payments.create', ['bill' => $bill->id])); ?>"
                    class="inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-xl bg-green-600 hover:bg-green-700 active:bg-green-800 text-white font-semibold shadow-sm transition duration-200"
                >
                    <span class="text-lg">
                        💰
                    </span>

                    <span>
                        Record Payment
                    </span>
                </a>

            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>


            
            <button
                type="button"
                onclick="window.print()"
                class="inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-700 active:bg-blue-800 text-white font-semibold shadow-sm transition duration-200"
            >
                <span class="text-lg">
                    🖨
                </span>

                <span>
                    Print Invoice
                </span>
            </button>


            
            <a
                href="<?php echo e(route('bills.index')); ?>"
                class="inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-xl bg-gray-200 hover:bg-gray-300 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-800 dark:text-white font-semibold shadow-sm transition duration-200"
            >
                <span class="text-lg">
                    ←
                </span>

                <span>
                    Back
                </span>
            </a>

        </div>

    </div>

 <?php $__env->endSlot(); ?>




<div class="py-8 bg-gray-100 dark:bg-gray-950 min-h-screen">

    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

        
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('success')): ?>

            <div class="mb-6 bg-green-50 border border-green-200 rounded-xl p-4 no-print">

                <div class="flex items-center gap-3">

                    <span class="text-green-600 text-xl">
                        ✓
                    </span>

                    <p class="text-sm font-medium text-green-700">
                        <?php echo e(session('success')); ?>

                    </p>

                </div>

            </div>

        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>


        
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($errors->any()): ?>

            <div class="mb-6 bg-red-50 border border-red-200 rounded-xl p-4 no-print">

                <div class="flex items-start gap-3">

                    <span class="text-red-600 text-xl">
                        ⚠️
                    </span>

                    <div>

                        <p class="font-semibold text-red-700">
                            Please check the following:
                        </p>

                        <ul class="mt-2 text-sm text-red-600 list-disc list-inside">

                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                <li>
                                    <?php echo e($error); ?>

                                </li>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                        </ul>

                    </div>

                </div>

            </div>

        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>


        

        <div class="invoice-paper bg-white shadow-xl rounded-2xl overflow-hidden">


            

            <div class="px-8 sm:px-12 py-8 border-b-4 border-blue-600">

                <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-8">

                    

                    <div>

                        <div class="mb-4">

                            <img
                                src="<?php echo e(asset('images/pure-tide-mazuri-logo.png')); ?>"
                                alt="Pure Tide Mazuri Ltd"
                                class="w-auto h-24 object-contain object-left"
                            >

                        </div>


                        <h1 class="text-2xl font-extrabold tracking-wide text-gray-900">
                            PURE TIDE MAZURI LTD
                        </h1>


                        <p class="mt-1 text-sm font-semibold text-blue-600 tracking-wide">
                            PURE WATER. PURE LIFE.
                        </p>


                        <div class="mt-4 space-y-1 text-sm text-gray-600">

                            <p>
                                <span class="font-semibold">
                                    Phone:
                                </span>

                                0723 875 395
                            </p>


                            <p>
                                <span class="font-semibold">
                                    Email:
                                </span>

                                puretidemazuri@gmail.com
                            </p>

                        </div>

                    </div>


                    

                    <div class="md:text-right">

                        <p class="text-sm font-bold uppercase tracking-widest text-gray-400">
                            Invoice
                        </p>


                        <h2 class="mt-1 text-3xl sm:text-4xl font-extrabold text-gray-900">
                            <?php echo e($bill->invoice_number); ?>

                        </h2>


                        <div class="mt-4 text-sm text-gray-600 space-y-1">

                            <p>
                                <span class="font-semibold">
                                    Invoice Date:
                                </span>

                                <?php echo e($bill->billing_date->format('d M Y')); ?>

                            </p>


                            <p>
                                <span class="font-semibold">
                                    Reading Date:
                                </span>

                                <?php echo e($bill->meterReading->reading_date->format('d M Y')); ?>

                            </p>

                        </div>

                    </div>

                </div>

            </div>


            

            <div class="px-8 sm:px-12 py-8">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                    

                    <div>

                        <p class="text-xs font-bold uppercase tracking-widest text-gray-400">
                            Bill To
                        </p>


                        <h3 class="mt-2 text-xl font-bold text-gray-900">
                            <?php echo e($bill->customer->full_name); ?>

                        </h3>


                        <div class="mt-3 space-y-1 text-sm text-gray-600">

                            <p>
                                <span class="font-semibold">
                                    Customer No:
                                </span>

                                <?php echo e($bill->customer->customer_number); ?>

                            </p>


                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($bill->customer->phone_number): ?>

                                <p>
                                    <span class="font-semibold">
                                        Phone:
                                    </span>

                                    <?php echo e($bill->customer->phone_number); ?>

                                </p>

                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>


                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($bill->customer->email): ?>

                                <p>
                                    <span class="font-semibold">
                                        Email:
                                    </span>

                                    <?php echo e($bill->customer->email); ?>

                                </p>

                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                        </div>

                    </div>


                    

                    <div class="md:text-right">

                        <p class="text-xs font-bold uppercase tracking-widest text-gray-400">
                            Meter Details
                        </p>


                        <h3 class="mt-2 text-xl font-bold text-gray-900">
                            <?php echo e($bill->meterReading->meter->meter_number); ?>

                        </h3>


                        <div class="mt-3 space-y-1 text-sm text-gray-600">

                            <p>
                                <span class="font-semibold">
                                    Previous Reading:
                                </span>

                                <?php echo e(number_format($bill->meterReading->previous_reading, 2)); ?>

                            </p>


                            <p>
                                <span class="font-semibold">
                                    Current Reading:
                                </span>

                                <?php echo e(number_format($bill->meterReading->current_reading, 2)); ?>

                            </p>


                            <p>
                                <span class="font-semibold">
                                    Consumption:
                                </span>

                                <?php echo e(number_format($bill->consumption, 2)); ?> m³
                            </p>

                        </div>

                    </div>

                </div>

            </div>


            

            <div class="px-8 sm:px-12">

                <div class="border border-gray-200 rounded-xl overflow-hidden">

                    <table class="w-full">

                        <thead class="bg-gray-50">

                            <tr>

                                <th class="px-5 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-500">
                                    Description
                                </th>

                                <th class="px-5 py-4 text-right text-xs font-bold uppercase tracking-wider text-gray-500">
                                    Units
                                </th>

                                <th class="px-5 py-4 text-right text-xs font-bold uppercase tracking-wider text-gray-500">
                                    Rate
                                </th>

                                <th class="px-5 py-4 text-right text-xs font-bold uppercase tracking-wider text-gray-500">
                                    Amount
                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            <tr class="border-t border-gray-200">

                                <td class="px-5 py-5">

                                    <p class="font-semibold text-gray-900">
                                        Water Consumption
                                    </p>

                                    <p class="text-sm text-gray-500 mt-1">
                                        Water usage for the billing period
                                    </p>

                                </td>


                                <td class="px-5 py-5 text-right text-gray-700">

                                    <?php echo e(number_format($bill->consumption, 2)); ?>


                                </td>


                                <td class="px-5 py-5 text-right text-gray-700">

                                    KSh <?php echo e(number_format($bill->rate_per_unit, 2)); ?>


                                </td>


                                <td class="px-5 py-5 text-right font-semibold text-gray-900">

                                    KSh <?php echo e(number_format($bill->water_charge, 2)); ?>


                                </td>

                            </tr>

                        </tbody>

                    </table>

                </div>

            </div>


            

            <div class="px-8 sm:px-12 py-8">

                <div class="flex justify-end">

                    <div class="w-full sm:w-96 space-y-4">

                        

                        <div class="flex justify-between text-sm">

                            <span class="text-gray-500">
                                Water Charge
                            </span>

                            <span class="font-semibold text-gray-800">

                                KSh <?php echo e(number_format($bill->water_charge, 2)); ?>


                            </span>

                        </div>


                        

                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if((float) $bill->previous_balance > 0): ?>

                            <div class="flex justify-between text-sm">

                                <span class="text-gray-500">
                                    Previous Balance
                                </span>

                                <span class="font-semibold text-gray-800">

                                    KSh <?php echo e(number_format($bill->previous_balance, 2)); ?>


                                </span>

                            </div>


                            

                            <div class="flex justify-between text-sm">

                                <span class="text-gray-500">
                                    Total Before Credit
                                </span>

                                <span class="font-semibold text-gray-800">

                                    KSh <?php echo e(number_format(
                                        (float) $bill->water_charge +
                                        (float) $bill->previous_balance,
                                        2
                                    )); ?>


                                </span>

                            </div>

                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>


                        

                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if((float) $bill->credit_applied > 0): ?>

                            <div class="bg-green-50 border border-green-200 rounded-xl p-4">

                                <div class="flex justify-between items-center">

                                    <span class="font-semibold text-green-700">
                                        Credit Applied
                                    </span>

                                    <span class="font-bold text-green-700">

                                        - KSh <?php echo e(number_format($bill->credit_applied, 2)); ?>


                                    </span>

                                </div>


                                <p class="mt-2 text-xs text-green-600">

                                    This amount was settled using the customer's
                                    previously available account credit.

                                </p>

                            </div>

                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>


                        

                        <div class="border-t border-gray-200 pt-4 flex justify-between">

                            <span class="font-bold text-gray-900">
                                Amount Paid
                            </span>

                            <span class="font-bold text-green-700">

                                KSh <?php echo e(number_format($bill->amount_paid, 2)); ?>


                            </span>

                        </div>


                        

                        <div class="bg-blue-50 rounded-xl p-5 flex justify-between items-center">

                            <span class="font-bold text-blue-900">
                                Balance Due
                            </span>

                            <span class="text-2xl font-extrabold text-blue-700">

                                KSh <?php echo e(number_format($bill->balance, 2)); ?>


                            </span>

                        </div>


                        

                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if((float) $bill->credit_applied > 0): ?>

                            <div class="bg-green-50 border border-green-200 rounded-xl p-4">

                                <p class="text-xs uppercase tracking-widest font-bold text-green-600">
                                    Payment Method
                                </p>

                                <p class="mt-1 font-bold text-green-800">
                                    Customer Account Credit
                                </p>

                                <p class="mt-1 text-xs text-green-600">
                                    This invoice was settled using previously
                                    available customer account credit.
                                </p>

                            </div>

                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                    </div>

                </div>

            </div>


            

            <div class="px-8 sm:px-12 pb-8">

                <div class="border-t border-gray-200 pt-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-5">

                    

                    <div>

                        <p class="text-xs uppercase tracking-widest font-bold text-gray-400">
                            Payment Status
                        </p>


                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($bill->status === 'paid'): ?>

                            <span class="inline-flex mt-2 px-4 py-2 rounded-full bg-green-100 text-green-700 text-sm font-bold">
                                ✓ PAID
                            </span>


                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if((float) $bill->credit_applied > 0): ?>

                                <p class="mt-3 text-sm text-green-600 font-medium">
                                    ✓ Settled using customer account credit.
                                </p>

                            <?php else: ?>

                                <p class="mt-3 text-sm text-green-600 font-medium">
                                    ✓ This invoice has been fully paid.
                                </p>

                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>


                        <?php elseif($bill->status === 'partially_paid'): ?>

                            <span class="inline-flex mt-2 px-4 py-2 rounded-full bg-yellow-100 text-yellow-700 text-sm font-bold">
                                PARTIALLY PAID
                            </span>


                        <?php elseif($bill->status === 'overdue'): ?>

                            <span class="inline-flex mt-2 px-4 py-2 rounded-full bg-red-100 text-red-700 text-sm font-bold">
                                OVERDUE
                            </span>


                        <?php else: ?>

                            <span class="inline-flex mt-2 px-4 py-2 rounded-full bg-gray-100 text-gray-700 text-sm font-bold">
                                UNPAID
                            </span>

                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>


                        

                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($bill->balance > 0): ?>

                            <p class="mt-3 text-sm text-gray-500">

                                Outstanding balance:

                                <span class="font-semibold text-gray-800">

                                    KSh <?php echo e(number_format($bill->balance, 2)); ?>


                                </span>

                            </p>

                        <?php elseif((float) $bill->credit_applied <= 0): ?>

                            <p class="mt-3 text-sm text-green-600 font-medium">
                                ✓ This invoice has been fully paid.
                            </p>

                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                    </div>


                    

                    <div class="text-left sm:text-right text-sm text-gray-500">

                        <p class="font-semibold text-gray-800">
                            PURE TIDE MAZURI LTD
                        </p>

                        <p class="mt-1">
                            PURE WATER. PURE LIFE.
                        </p>

                    </div>

                </div>

            </div>


            

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($bill->payments->count()): ?>

                <div class="px-8 sm:px-12 pb-8 no-print">

                    <div class="border-t border-gray-200 pt-8">

                        <h3 class="text-lg font-bold text-gray-900">
                            Payment History
                        </h3>


                        <p class="text-sm text-gray-500 mt-1">
                            Payments recorded against this invoice
                        </p>


                        <div class="mt-4 border border-gray-200 rounded-xl overflow-hidden">

                            <div class="overflow-x-auto">

                                <table class="w-full">

                                    <thead class="bg-gray-50">

                                        <tr>

                                            <th class="px-5 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-500">
                                                Date
                                            </th>

                                            <th class="px-5 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-500">
                                                Method
                                            </th>

                                            <th class="px-5 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-500">
                                                Reference
                                            </th>

                                            <th class="px-5 py-4 text-right text-xs font-bold uppercase tracking-wider text-gray-500">
                                                Amount
                                            </th>

                                        </tr>

                                    </thead>


                                    <tbody class="divide-y divide-gray-200">

                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $bill->payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                            <tr class="hover:bg-gray-50">

                                                <td class="px-5 py-4 text-sm text-gray-700">

                                                    <?php echo e($payment->payment_date
                                                        ? $payment->payment_date->format('d M Y')
                                                        : 'N/A'); ?>


                                                </td>


                                                <td class="px-5 py-4 text-sm font-medium text-gray-800">

                                                    <?php echo e(ucfirst($payment->payment_method)); ?>


                                                </td>


                                                <td class="px-5 py-4 text-sm text-gray-600">

                                                    <?php echo e($payment->reference_number ?: '—'); ?>


                                                </td>


                                                <td class="px-5 py-4 text-right text-sm font-bold text-green-700">

                                                    KSh <?php echo e(number_format($payment->amount, 2)); ?>


                                                </td>

                                            </tr>

                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                                    </tbody>

                                </table>

                            </div>

                        </div>

                    </div>

                </div>

            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>


            

            <div class="bg-gray-900 px-8 sm:px-12 py-6 text-center">

                <p class="text-white font-semibold">
                    Thank you for your business.
                </p>

                <p class="text-gray-400 text-sm mt-1">
                    Please retain this invoice for your records.
                </p>

            </div>

        </div>

    </div>

</div>




<style>

    @media print {

        body {
            background: white !important;
        }


        nav,
        header,
        .no-print {
            display: none !important;
        }


        .py-8 {
            padding-top: 0 !important;
            padding-bottom: 0 !important;
        }


        .min-h-screen {
            min-height: 0 !important;
        }


        .invoice-paper {
            box-shadow: none !important;
            border-radius: 0 !important;
            width: 100% !important;
            max-width: none !important;
        }


        @page {
            size: A4 portrait;
            margin: 10mm;
        }

    }

</style>


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
<?php /**PATH C:\Users\ADMIN\Downloads\maji-mazuri-deploy\resources\views/bills/show.blade.php ENDPATH**/ ?>