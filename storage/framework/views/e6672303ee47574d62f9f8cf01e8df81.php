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

                <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-100">
                    Payment Details
                </h2>

                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                    View payment information and the related invoice
                </p>

            </div>


            <div class="flex flex-wrap gap-3">

                

                <a
                    href="<?php echo e(route('payments.index')); ?>"
                    class="inline-flex items-center justify-center px-5 py-2.5 rounded-xl border border-gray-300 dark:border-gray-700 text-gray-700 dark:text-gray-300 font-semibold hover:bg-gray-100 dark:hover:bg-gray-800 transition"
                >
                    ← Back to Payments
                </a>

            </div>

        </div>

     <?php $__env->endSlot(); ?>


    <div class="py-8 bg-gray-100 dark:bg-gray-950 min-h-screen">

        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">


            

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('success')): ?>

                <div class="mb-6 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-xl p-4">

                    <div class="flex items-center gap-3">

                        <span class="text-green-600 text-xl">
                            ✓
                        </span>

                        <p class="text-sm font-medium text-green-700 dark:text-green-300">
                            <?php echo e(session('success')); ?>

                        </p>

                    </div>

                </div>

            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>


            

            <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 shadow-sm overflow-hidden mb-6">


                

                <div class="px-6 sm:px-8 py-6 border-b border-gray-200 dark:border-gray-800">

                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-5">

                        <div class="flex items-center gap-4">

                            <div class="w-14 h-14 rounded-2xl bg-green-100 dark:bg-green-900/30 flex items-center justify-center text-3xl">
                                💰
                            </div>

                            <div>

                                <h3 class="text-xl font-bold text-gray-900 dark:text-white">
                                    Payment Received
                                </h3>

                                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                                    Payment ID #<?php echo e($payment->id); ?>

                                </p>

                            </div>

                        </div>


                        

                        <div class="sm:text-right">

                            <p class="text-xs uppercase tracking-widest font-bold text-gray-400">
                                Amount Paid
                            </p>

                            <p class="mt-1 text-3xl font-extrabold text-green-600 dark:text-green-400">
                                KSh <?php echo e(number_format($payment->amount, 2)); ?>

                            </p>

                        </div>

                    </div>

                </div>


                

                <div class="p-6 sm:p-8">

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">


                        

                        <div class="bg-gray-50 dark:bg-gray-800 rounded-xl p-5">

                            <p class="text-xs uppercase tracking-wider font-semibold text-gray-500 dark:text-gray-400">
                                Payment Date
                            </p>

                            <p class="mt-2 text-lg font-bold text-gray-900 dark:text-white">

                                <?php echo e($payment->payment_date
                                    ? $payment->payment_date->format('d M Y')
                                    : 'N/A'); ?>


                            </p>

                        </div>


                        

                        <div class="bg-gray-50 dark:bg-gray-800 rounded-xl p-5">

                            <p class="text-xs uppercase tracking-wider font-semibold text-gray-500 dark:text-gray-400">
                                Payment Method
                            </p>

                            <div class="mt-2">

                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($payment->payment_method === 'mpesa'): ?>

                                    <span class="inline-flex items-center px-3 py-1.5 rounded-full bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-300 text-sm font-bold">
                                        📱 M-PESA
                                    </span>

                                <?php elseif($payment->payment_method === 'cash'): ?>

                                    <span class="inline-flex items-center px-3 py-1.5 rounded-full bg-yellow-100 dark:bg-yellow-900/30 text-yellow-700 dark:text-yellow-300 text-sm font-bold">
                                        💵 CASH
                                    </span>

                                <?php else: ?>

                                    <span class="inline-flex items-center px-3 py-1.5 rounded-full bg-purple-100 dark:bg-purple-900/30 text-purple-700 dark:text-purple-300 text-sm font-bold">
                                        🏦 BANK
                                    </span>

                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                            </div>

                        </div>


                        

                        <div class="bg-gray-50 dark:bg-gray-800 rounded-xl p-5">

                            <p class="text-xs uppercase tracking-wider font-semibold text-gray-500 dark:text-gray-400">
                                Reference Number
                            </p>

                            <p class="mt-2 text-lg font-bold text-gray-900 dark:text-white break-all">
                                <?php echo e($payment->reference_number ?: '—'); ?>

                            </p>

                        </div>

                    </div>


                    

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($payment->notes): ?>

                        <div class="mt-6 bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-xl p-5">

                            <p class="text-xs uppercase tracking-wider font-semibold text-blue-600 dark:text-blue-400">
                                Payment Notes
                            </p>

                            <p class="mt-2 text-sm text-blue-900 dark:text-blue-200 whitespace-pre-line">
                                <?php echo e($payment->notes); ?>

                            </p>

                        </div>

                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                </div>

            </div>


            

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">


                

                <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 shadow-sm overflow-hidden">

                    <div class="px-6 py-5 border-b border-gray-200 dark:border-gray-800">

                        <h3 class="text-lg font-bold text-gray-900 dark:text-white">
                            Customer Information
                        </h3>

                    </div>


                    <div class="p-6">

                        <p class="text-xs uppercase tracking-widest font-bold text-gray-400">
                            Customer
                        </p>

                        <p class="mt-2 text-xl font-bold text-gray-900 dark:text-white">

                            <?php echo e($payment->bill->customer->full_name ?? 'N/A'); ?>


                        </p>


                        <div class="mt-5 space-y-3 text-sm">


                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($payment->bill?->customer?->customer_number): ?>

                                <div class="flex justify-between gap-4">

                                    <span class="text-gray-500 dark:text-gray-400">
                                        Customer No.
                                    </span>

                                    <span class="font-semibold text-gray-800 dark:text-gray-200">
                                        <?php echo e($payment->bill->customer->customer_number); ?>

                                    </span>

                                </div>

                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>


                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($payment->bill?->customer?->phone): ?>

                                <div class="flex justify-between gap-4">

                                    <span class="text-gray-500 dark:text-gray-400">
                                        Phone
                                    </span>

                                    <span class="font-semibold text-gray-800 dark:text-gray-200">
                                        <?php echo e($payment->bill->customer->phone); ?>

                                    </span>

                                </div>

                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>


                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($payment->bill?->customer?->email): ?>

                                <div class="flex justify-between gap-4">

                                    <span class="text-gray-500 dark:text-gray-400">
                                        Email
                                    </span>

                                    <span class="font-semibold text-gray-800 dark:text-gray-200 break-all">
                                        <?php echo e($payment->bill->customer->email); ?>

                                    </span>

                                </div>

                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                        </div>

                    </div>

                </div>


                

                <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 shadow-sm overflow-hidden">

                    <div class="px-6 py-5 border-b border-gray-200 dark:border-gray-800">

                        <h3 class="text-lg font-bold text-gray-900 dark:text-white">
                            Related Invoice
                        </h3>

                    </div>


                    <div class="p-6">

                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($payment->bill): ?>

                            <p class="text-xs uppercase tracking-widest font-bold text-gray-400">
                                Invoice Number
                            </p>

                            <p class="mt-2 text-xl font-bold text-gray-900 dark:text-white">
                                <?php echo e($payment->bill->invoice_number); ?>

                            </p>


                            <div class="mt-5 space-y-3 text-sm">


                                <div class="flex justify-between gap-4">

                                    <span class="text-gray-500 dark:text-gray-400">
                                        Invoice Amount
                                    </span>

                                    <span class="font-semibold text-gray-800 dark:text-gray-200">
                                        KSh <?php echo e(number_format($payment->bill->water_charge, 2)); ?>

                                    </span>

                                </div>


                                <div class="flex justify-between gap-4">

                                    <span class="text-gray-500 dark:text-gray-400">
                                        Amount Paid
                                    </span>

                                    <span class="font-semibold text-green-700 dark:text-green-400">
                                        KSh <?php echo e(number_format($payment->bill->amount_paid, 2)); ?>

                                    </span>

                                </div>


                                <div class="flex justify-between gap-4">

                                    <span class="text-gray-500 dark:text-gray-400">
                                        Balance
                                    </span>

                                    <span class="font-bold text-blue-700 dark:text-blue-400">
                                        KSh <?php echo e(number_format($payment->bill->balance, 2)); ?>

                                    </span>

                                </div>

                            </div>


                            <div class="mt-6">

                                <a
                                    href="<?php echo e(route('bills.show', $payment->bill)); ?>"
                                    class="inline-flex items-center justify-center w-full px-5 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-semibold transition"
                                >
                                    🧾 View Invoice
                                </a>

                            </div>

                        <?php else: ?>

                            <p class="text-gray-500">
                                No invoice associated with this payment.
                            </p>

                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                    </div>

                </div>

            </div>


            

            <div class="mt-6 bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 shadow-sm p-6">

                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">


                    <div>

                        <h3 class="font-bold text-gray-900 dark:text-white">
                            Payment Actions
                        </h3>

                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                            Manage this payment record.
                        </p>

                    </div>


                    <div class="flex flex-wrap gap-3">


                        

                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($payment->bill): ?>

                            <a
                                href="<?php echo e(route('bills.show', $payment->bill)); ?>"
                                class="inline-flex items-center justify-center px-5 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-semibold transition"
                            >
                                🧾 View Invoice
                            </a>

                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>


                        

                        <form
                            method="POST"
                            action="<?php echo e(route('payments.destroy', $payment)); ?>"
                            onsubmit="return confirm('Are you sure you want to delete this payment? This will also update the invoice balance.');"
                        >

                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>

                            <button
                                type="submit"
                                class="inline-flex items-center justify-center px-5 py-2.5 rounded-xl bg-red-600 hover:bg-red-700 text-white font-semibold transition"
                            >
                                🗑 Delete Payment
                            </button>

                        </form>


                    </div>

                </div>

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
<?php endif; ?><?php /**PATH C:\Users\ADMIN\Downloads\maji-mazuri-deploy\resources\views\payments\show.blade.php ENDPATH**/ ?>