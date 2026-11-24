<x-app-layout>

    <x-slot name="header">
        <div>
            <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-100">
                Record Payment
            </h2>

            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                Record a manual payment or send an M-PESA STK Push.
            </p>
        </div>
    </x-slot>


    <div class="py-8">

        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">


            {{-- Success Message --}}
            @if(session('success'))

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
                                {{ session('success') }}
                            </p>
                        </div>

                    </div>

                </div>

            @endif


            {{-- Error Messages --}}
            @if($errors->any())

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

                                @foreach($errors->all() as $error)

                                    <li>{{ $error }}</li>

                                @endforeach

                            </ul>

                        </div>

                    </div>

                </div>

            @endif


            {{-- Bill Summary --}}
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
                                {{ $bill->invoice_number }}
                            </p>

                        </div>

                    </div>

                </div>


                <div class="p-6">

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">

                        {{-- Customer --}}
                        <div class="bg-gray-50 dark:bg-gray-800 rounded-xl p-4">

                            <p class="text-xs uppercase tracking-wider font-semibold text-gray-500 dark:text-gray-400">
                                Customer
                            </p>

                            <p class="mt-2 font-semibold text-gray-800 dark:text-white">
                                {{ $bill->customer->full_name ?? 'N/A' }}
                            </p>

                        </div>


                        {{-- Invoice --}}
                        <div class="bg-gray-50 dark:bg-gray-800 rounded-xl p-4">

                            <p class="text-xs uppercase tracking-wider font-semibold text-gray-500 dark:text-gray-400">
                                Invoice
                            </p>

                            <p class="mt-2 font-semibold text-blue-600 dark:text-blue-400">
                                {{ $bill->invoice_number }}
                            </p>

                        </div>


                        {{-- Bill Amount --}}
                        <div class="bg-gray-50 dark:bg-gray-800 rounded-xl p-4">

                            <p class="text-xs uppercase tracking-wider font-semibold text-gray-500 dark:text-gray-400">
                                Bill Amount
                            </p>

                            <p class="mt-2 text-xl font-bold text-gray-800 dark:text-white">
                                KSh {{ number_format($bill->water_charge, 2) }}
                            </p>

                        </div>


                        {{-- Balance --}}
                        <div class="bg-amber-50 dark:bg-amber-900/20 border border-amber-200 dark:border-amber-800 rounded-xl p-4">

                            <p class="text-xs uppercase tracking-wider font-semibold text-amber-600 dark:text-amber-400">
                                Outstanding Balance
                            </p>

                            <p class="mt-2 text-xl font-bold text-amber-700 dark:text-amber-300">
                                KSh {{ number_format($bill->balance, 2) }}
                            </p>

                        </div>

                    </div>

                </div>

            </div>


            {{-- M-PESA STK PUSH --}}
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
                        action="{{ route('payments.mpesa', $bill) }}"
                        method="POST"
                        id="mpesaForm"
                    >

                        @csrf


                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">


                            {{-- M-PESA Amount --}}
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
                                        value="{{ old('amount', number_format((float) $bill->balance, 2, '.', '')) }}"
                                        min="1"
                                        max="{{ $bill->balance }}"
                                        step="1"
                                        required
                                        class="w-full pl-14 pr-4 py-3 rounded-xl border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-800 dark:text-white focus:ring-2 focus:ring-green-500 focus:border-green-500"
                                    >

                                </div>

                                <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">
                                    Maximum: KSh {{ number_format($bill->balance, 2) }}
                                </p>

                            </div>


                            {{-- Phone Number --}}
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
                                    value="{{ old('phone_number', $bill->customer->phone_number ?? '') }}"
                                    placeholder="0712345678"
                                    required
                                    class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-800 dark:text-white focus:ring-2 focus:ring-green-500 focus:border-green-500"
                                >

                                <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">
                                    Use a Kenyan Safaricom number, e.g. 0712345678.
                                </p>

                            </div>

                        </div>


                        {{-- M-PESA Error --}}
                        @if($errors->has('mpesa'))

                            <div class="mt-5 rounded-xl border border-red-200 bg-red-50 dark:bg-red-900/20 dark:border-red-800 p-4">

                                <p class="text-sm text-red-700 dark:text-red-400">
                                    {{ $errors->first('mpesa') }}
                                </p>

                            </div>

                        @endif


                        {{-- M-PESA Button --}}
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


            {{-- Manual Payment --}}
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
                    action="{{ route('payments.store', $bill) }}"
                    method="POST"
                    class="p-6"
                >

                    @csrf


                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">


                        {{-- Amount --}}
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
                                    max="{{ $bill->balance }}"
                                    value="{{ old('amount') }}"
                                    required
                                    class="w-full pl-14 pr-4 py-3 rounded-xl border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-800 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                    placeholder="0.00"
                                >

                            </div>

                            <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">
                                Maximum payment: KSh {{ number_format($bill->balance, 2) }}
                            </p>

                            @error('amount')

                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">
                                    {{ $message }}
                                </p>

                            @enderror

                        </div>


                        {{-- Payment Date --}}
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
                                value="{{ old('payment_date', now()->format('Y-m-d')) }}"
                                required
                                class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-800 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            >

                            @error('payment_date')

                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">
                                    {{ $message }}
                                </p>

                            @enderror

                        </div>


                        {{-- Payment Method --}}
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
                                    {{ old('payment_method') === 'cash' ? 'selected' : '' }}
                                >
                                    Cash
                                </option>

                                <option
                                    value="mpesa"
                                    {{ old('payment_method') === 'mpesa' ? 'selected' : '' }}
                                >
                                    M-PESA
                                </option>

                                <option
                                    value="bank"
                                    {{ old('payment_method') === 'bank' ? 'selected' : '' }}
                                >
                                    Bank
                                </option>

                            </select>

                            @error('payment_method')

                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">
                                    {{ $message }}
                                </p>

                            @enderror

                        </div>


                        {{-- Reference Number --}}
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
                                value="{{ old('reference_number') }}"
                                maxlength="100"
                                class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-800 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                placeholder="e.g. M-PESA transaction code"
                            >

                            <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">
                                Recommended for M-PESA or bank payments.
                            </p>

                            @error('reference_number')

                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">
                                    {{ $message }}
                                </p>

                            @enderror

                        </div>


                        {{-- Notes --}}
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
                            >{{ old('notes') }}</textarea>

                            @error('notes')

                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">
                                    {{ $message }}
                                </p>

                            @enderror

                        </div>

                    </div>


                    {{-- Buttons --}}
                    <div class="mt-8 pt-6 border-t border-gray-200 dark:border-gray-800 flex flex-col sm:flex-row justify-end gap-3">

                        <a
                            href="{{ route('bills.show', $bill) }}"
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


    {{-- Prevent double submission of STK Push --}}
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

</x-app-layout>

