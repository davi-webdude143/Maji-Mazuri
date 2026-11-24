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
                Record Payment
            </h2>

            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                Record a manual payment or send an M-PESA STK Push.
            </p>
        </div>
     <?php $__env->endSlot(); ?>


    <div class="py-8">

        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">


            
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('success')): ?>

                <div class="mb-6 rounded-xl border border-green-200 bg-green-50 dark:bg-green-900/20 dark:border-green-800 p-4">

                    <div class="flex items-start gap-3">

                        <div class="text-xl">
                            ✓
                        </div>

                        <div>
                            <h3 class="font-semibold text-green-800 dark:text-green-300">
                                Success
                            </h3>

                            <p class="mt-1 text-sm text-green-700 dark:text-green-400">
                                <?php echo e(session('success')); ?>

                            </p>
                        </div>

                    </div>

                </div>

            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>


            
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($errors->any()): ?>

                <div class="mb-6 rounded-xl border border-red-200 bg-red-50 dark:bg-red-900/20 dark:border-red-800 p-4">

                    <div class="flex items-start gap-3">

                        <div class="text-xl">
                            ⚠
                        </div>

                        <div>

                            <h3 class="font-semibold text-red-800 dark:text-red-300">
                                Please correct the following:
                            </h3>

                            <ul class="mt-2 text-sm text-red-700 dark:text-red-400 list-disc list-inside">

                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                    <li><?php echo e($error); ?></li>

                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                            </ul>

                        </div>

                    </div>

                </div>

            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>


            
            <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-800 overflow-hidden mb-6">

                <div class="p-6 border-b border-gray-200 dark:border-gray-800">

                    <div class="flex items-center gap-4">

                        <div class="w-12 h-12 rounded-xl bg-blue-100 dark:bg-blue-900/40 flex items-center justify-center text-2xl">
                            🧾
                        </div>

                        <div>

                            <h3 class="text-lg font-semibold text-gray-800 dark:text-white">
                                Bill Information
                            </h3>

                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                                <?php echo e($bill->invoice_number); ?>

                            </p>

                        </div>

                    </div>

                </div>


                <div class="p-6">

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">

                        
                        <div class="bg-gray-50 dark:bg-gray-800 rounded-xl p-4">

                            <p class="text-xs uppercase tracking-wider font-semibold text-gray-500 dark:text-gray-400">
                                Customer
                            </p>

                            <p class="mt-2 font-semibold text-gray-800 dark:text-white">
                                <?php echo e($bill->customer->full_name ?? 'N/A'); ?>

                            </p>

                        </div>


                        
                        <div class="bg-gray-50 dark:bg-gray-800 rounded-xl p-4">

                            <p class="text-xs uppercase tracking-wider font-semibold text-gray-500 dark:text-gray-400">
                                Invoice
                            </p>

                            <p class="mt-2 font-semibold text-blue-600 dark:text-blue-400">
                                <?php echo e($bill->invoice_number); ?>

                            </p>

                        </div>


                        
                        <div class="bg-gray-50 dark:bg-gray-800 rounded-xl p-4">

                            <p class="text-xs uppercase tracking-wider font-semibold text-gray-500 dark:text-gray-400">
                                Bill Amount
                            </p>

                            <p class="mt-2 text-xl font-bold text-gray-800 dark:text-white">
                                KSh <?php echo e(number_format($bill->water_charge, 2)); ?>

                            </p>

                        </div>


                        
                        <div class="bg-amber-50 dark:bg-amber-900/20 border border-amber-200 dark:border-amber-800 rounded-xl p-4">

                            <p class="text-xs uppercase tracking-wider font-semibold text-amber-600 dark:text-amber-400">
                                Outstanding Balance
                            </p>

                            <p class="mt-2 text-xl font-bold text-amber-700 dark:text-amber-300">
                                KSh <?php echo e(number_format($bill->balance, 2)); ?>

                            </p>

                        </div>

                    </div>

                </div>

            </div>


            
            <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-sm border border-green-200 dark:border-green-900 overflow-hidden mb-6">

                <div class="p-6 border-b border-green-100 dark:border-green-900">

                    <div class="flex items-center gap-4">

                        <div class="w-12 h-12 rounded-xl bg-green-100 dark:bg-green-900/40 flex items-center justify-center text-xl font-bold text-green-700 dark:text-green-300">
                            M
                        </div>

                        <div>

                            <h3 class="text-lg font-semibold text-gray-800 dark:text-white">
                                Pay with M-PESA
                            </h3>

                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                                Send an STK Push to the customer's phone.
                            </p>

                        </div>

                    </div>

                </div>


                <div class="p-6">

                    <form
                        action="<?php echo e(route('payments.mpesa', $bill)); ?>"
                        method="POST"
                        id="mpesaForm"
                    >

                        <?php echo csrf_field(); ?>


                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">


                            
                            <div>

                                <label
                                    for="mpesa_amount"
                                    class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2"
                                >
                                    Amount <span class="text-red-500">*</span>
                                </label>

                                <div class="relative">

                                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500 dark:text-gray-400 font-medium">
                                        KSh
                                    </span>

                                    <input
                                        type="number"
                                        id="mpesa_amount"
                                        name="amount"
                                        value="<?php echo e(old('amount', number_format((float) $bill->balance, 2, '.', ''))); ?>"
                                        min="1"
                                        max="<?php echo e($bill->balance); ?>"
                                        step="1"
                                        required
                                        class="w-full pl-14 pr-4 py-3 rounded-xl border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-800 dark:text-white focus:ring-2 focus:ring-green-500 focus:border-green-500"
                                    >

                                </div>

                                <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">
                                    Maximum: KSh <?php echo e(number_format($bill->balance, 2)); ?>

                                </p>

                            </div>


                            
                            <div>

                                <label
                                    for="phone_number"
                                    class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2"
                                >
                                    M-PESA Phone Number <span class="text-red-500">*</span>
                                </label>

                                <input
                                    type="text"
                                    id="phone_number"
                                    name="phone_number"
                                    value="<?php echo e(old('phone_number', $bill->customer->phone_number ?? '')); ?>"
                                    placeholder="0712345678"
                                    required
                                    class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-800 dark:text-white focus:ring-2 focus:ring-green-500 focus:border-green-500"
                                >

                                <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">
                                    Use a Kenyan Safaricom number, e.g. 0712345678.
                                </p>

                            </div>

                        </div>


                        
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($errors->has('mpesa')): ?>

                            <div class="mt-5 rounded-xl border border-red-200 bg-red-50 dark:bg-red-900/20 dark:border-red-800 p-4">

                                <p class="text-sm text-red-700 dark:text-red-400">
                                    <?php echo e($errors->first('mpesa')); ?>

                                </p>

                            </div>

                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>


                        
                        <div class="mt-6">

                            <button
                                type="submit"
                                id="mpesaButton"
                                class="w-full inline-flex justify-center items-center gap-2 px-6 py-3 rounded-xl bg-green-600 hover:bg-green-700 text-white font-semibold transition shadow-sm"
                            >

                                <span id="mpesaButtonText">
                                    Send M-PESA STK Push
                                </span>

                            </button>

                        </div>


                        <div class="mt-4 rounded-xl bg-green-50 dark:bg-green-900/20 border border-green-100 dark:border-green-900 p-4">

                            <p class="text-sm text-green-800 dark:text-green-300">

                                <strong>How it works:</strong>
                                The customer will receive an M-PESA payment prompt on the phone number above.
                                They should confirm the amount and enter their M-PESA PIN.

                            </p>

                        </div>

                    </form>

                </div>

            </div>


            
            <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-800 overflow-hidden">

                <div class="p-6 border-b border-gray-200 dark:border-gray-800">

                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white">
                        Manual Payment
                    </h3>

                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                        Record cash, bank, or manually received M-PESA payments.
                    </p>

                </div>


                <form
                    action="<?php echo e(route('payments.store', $bill)); ?>"
                    method="POST"
                    class="p-6"
                >

                    <?php echo csrf_field(); ?>


                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">


                        
                        <div>

                            <label
                                for="amount"
                                class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2"
                            >
                                Payment Amount <span class="text-red-500">*</span>
                            </label>

                            <div class="relative">

                                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500 dark:text-gray-400 font-medium">
                                    KSh
                                </span>

                                <input
                                    type="number"
                                    id="amount"
                                    name="amount"
                                    step="0.01"
                                    min="0.01"
                                    max="<?php echo e($bill->balance); ?>"
                                    value="<?php echo e(old('amount')); ?>"
                                    required
                                    class="w-full pl-14 pr-4 py-3 rounded-xl border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-800 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                    placeholder="0.00"
                                >

                            </div>

                            <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">
                                Maximum payment: KSh <?php echo e(number_format($bill->balance, 2)); ?>

                            </p>

                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['amount'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>

                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">
                                    <?php echo e($message); ?>

                                </p>

                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                        </div>


                        
                        <div>

                            <label
                                for="payment_date"
                                class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2"
                            >
                                Payment Date <span class="text-red-500">*</span>
                            </label>

                            <input
                                type="date"
                                id="payment_date"
                                name="payment_date"
                                value="<?php echo e(old('payment_date', now()->format('Y-m-d'))); ?>"
                                required
                                class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-800 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            >

                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['payment_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>

                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">
                                    <?php echo e($message); ?>

                                </p>

                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                        </div>


                        
                        <div>

                            <label
                                for="payment_method"
                                class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2"
                            >
                                Payment Method <span class="text-red-500">*</span>
                            </label>

                            <select
                                id="payment_method"
                                name="payment_method"
                                required
                                class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-800 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            >

                                <option value="">
                                    Select payment method
                                </option>

                                <option
                                    value="cash"
                                    <?php echo e(old('payment_method') === 'cash' ? 'selected' : ''); ?>

                                >
                                    Cash
                                </option>

                                <option
                                    value="mpesa"
                                    <?php echo e(old('payment_method') === 'mpesa' ? 'selected' : ''); ?>

                                >
                                    M-PESA
                                </option>

                                <option
                                    value="bank"
                                    <?php echo e(old('payment_method') === 'bank' ? 'selected' : ''); ?>

                                >
                                    Bank
                                </option>

                            </select>

                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['payment_method'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>

                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">
                                    <?php echo e($message); ?>

                                </p>

                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                        </div>


                        
                        <div>

                            <label
                                for="reference_number"
                                class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2"
                            >
                                Reference Number
                            </label>

                            <input
                                type="text"
                                id="reference_number"
                                name="reference_number"
                                value="<?php echo e(old('reference_number')); ?>"
                                maxlength="100"
                                class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-800 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                placeholder="e.g. M-PESA transaction code"
                            >

                            <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">
                                Recommended for M-PESA or bank payments.
                            </p>

                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['reference_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>

                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">
                                    <?php echo e($message); ?>

                                </p>

                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                        </div>


                        
                        <div class="sm:col-span-2">

                            <label
                                for="notes"
                                class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2"
                            >
                                Notes
                            </label>

                            <textarea
                                id="notes"
                                name="notes"
                                rows="4"
                                maxlength="1000"
                                class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-800 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Add any additional payment notes..."
                            ><?php echo e(old('notes')); ?></textarea>

                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['notes'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>

                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">
                                    <?php echo e($message); ?>

                                </p>

                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                        </div>

                    </div>


                    
                    <div class="mt-8 pt-6 border-t border-gray-200 dark:border-gray-800 flex flex-col sm:flex-row justify-end gap-3">

                        <a
                            href="<?php echo e(route('bills.show', $bill)); ?>"
                            class="inline-flex justify-center items-center px-6 py-3 rounded-xl border border-gray-300 dark:border-gray-700 text-gray-700 dark:text-gray-300 font-semibold hover:bg-gray-100 dark:hover:bg-gray-800 transition"
                        >
                            Cancel
                        </a>


                        <button
                            type="submit"
                            class="inline-flex justify-center items-center px-6 py-3 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-semibold transition shadow-sm"
                        >

                            💰 Record Payment

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>


    
    <script>

        document.addEventListener('DOMContentLoaded', function () {

            const form = document.getElementById('mpesaForm');
            const button = document.getElementById('mpesaButton');
            const buttonText = document.getElementById('mpesaButtonText');

            if (!form || !button) {
                return;
            }

            form.addEventListener('submit', function () {

                button.disabled = true;

                button.classList.add(
                    'opacity-70',
                    'cursor-not-allowed'
                );

                buttonText.textContent =
                    'Sending M-PESA Request...';

            });

        });

    </script>

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

<?php /**PATH C:\Users\ADMIN\Downloads\maji-mazuri-deploy\resources\views\payments\create.blade.php ENDPATH**/ ?>