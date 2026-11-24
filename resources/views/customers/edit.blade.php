<x-app-layout>

    <x-slot name="header">
        <div>
            <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-100">
                Edit Customer
            </h2>

            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                Update customer account information
            </p>
        </div>
    </x-slot>

    <div class="py-8 bg-gray-100 dark:bg-gray-950 min-h-screen">

        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Validation Errors -->
            @if ($errors->any())
                <div class="mb-6 bg-red-50 dark:bg-red-900/30 border border-red-200 dark:border-red-800 rounded-xl p-5">

                    <h3 class="font-semibold text-red-700 dark:text-red-300 mb-2">
                        Please correct the following errors:
                    </h3>

                    <ul class="list-disc list-inside text-sm text-red-600 dark:text-red-300">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>

                </div>
            @endif

            <!-- Main Card -->
            <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-800 overflow-hidden">

                <!-- Header -->
                <div class="p-6 border-b border-gray-200 dark:border-gray-800">

                    <div class="flex items-center gap-4">

                        <div class="w-12 h-12 rounded-xl bg-blue-100 dark:bg-blue-900/40 flex items-center justify-center text-2xl">
                            ✏️
                        </div>

                        <div>
                            <h3 class="text-lg font-semibold text-gray-800 dark:text-white">
                                Edit Customer Information
                            </h3>

                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                Customer No:
                                <span class="font-semibold">
                                    {{ $customer->customer_number }}
                                </span>
                            </p>
                        </div>

                    </div>

                </div>

                <!-- Form -->
                <form method="POST" action="{{ route('customers.update', $customer) }}">

                    @csrf
                    @method('PUT')

                    <div class="p-6 space-y-6">

                        <!-- Full Name -->
                        <div>

                            <label for="full_name"
                                   class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Full Name
                                <span class="text-red-500">*</span>
                            </label>

                            <input
                                type="text"
                                id="full_name"
                                name="full_name"
                                value="{{ old('full_name', $customer->full_name) }}"
                                required
                                class="w-full rounded-xl border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white focus:border-blue-500 focus:ring-blue-500"
                            >

                        </div>

                        <!-- ID + Phone -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                            <div>

                                <label for="id_number"
                                       class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    ID Number
                                </label>

                                <input
                                    type="text"
                                    id="id_number"
                                    name="id_number"
                                    value="{{ old('id_number', $customer->id_number) }}"
                                    class="w-full rounded-xl border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white focus:border-blue-500 focus:ring-blue-500"
                                >

                            </div>

                            <div>

                                <label for="phone_number"
                                       class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Phone Number
                                    <span class="text-red-500">*</span>
                                </label>

                                <input
                                    type="text"
                                    id="phone_number"
                                    name="phone_number"
                                    value="{{ old('phone_number', $customer->phone_number) }}"
                                    required
                                    class="w-full rounded-xl border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white focus:border-blue-500 focus:ring-blue-500"
                                >

                            </div>

                        </div>

                        <!-- Email -->
                        <div>

                            <label for="email"
                                   class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Email Address
                            </label>

                            <input
                                type="email"
                                id="email"
                                name="email"
                                value="{{ old('email', $customer->email) }}"
                                class="w-full rounded-xl border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white focus:border-blue-500 focus:ring-blue-500"
                            >

                        </div>

                        <!-- Area -->
                        <div>

                            <label for="area"
                                   class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Area / Location
                            </label>

                            <input
                                type="text"
                                id="area"
                                name="area"
                                value="{{ old('area', $customer->area) }}"
                                class="w-full rounded-xl border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white focus:border-blue-500 focus:ring-blue-500"
                            >

                        </div>

                        <!-- Address -->
                        <div>

                            <label for="address"
                                   class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Physical Address
                            </label>

                            <textarea
                                id="address"
                                name="address"
                                rows="3"
                                class="w-full rounded-xl border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white focus:border-blue-500 focus:ring-blue-500"
                            >{{ old('address', $customer->address) }}</textarea>

                        </div>

                        <!-- Status -->
                        <div>

                            <label for="status"
                                   class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Account Status
                                <span class="text-red-500">*</span>
                            </label>

                            <select
                                id="status"
                                name="status"
                                required
                                class="w-full rounded-xl border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white focus:border-blue-500 focus:ring-blue-500"
                            >

                                <option value="active"
                                    {{ old('status', $customer->status) === 'active' ? 'selected' : '' }}>
                                    Active
                                </option>

                                <option value="inactive"
                                    {{ old('status', $customer->status) === 'inactive' ? 'selected' : '' }}>
                                    Inactive
                                </option>

                            </select>

                        </div>

                    </div>

                    <!-- Buttons -->
                    <div class="px-6 py-5 bg-gray-50 dark:bg-gray-800/50 border-t border-gray-200 dark:border-gray-800 flex flex-col sm:flex-row justify-end gap-3">

                        <a href="{{ route('customers.show', $customer) }}"
                           class="inline-flex justify-center items-center px-5 py-2.5 rounded-xl border border-gray-300 dark:border-gray-700 text-gray-700 dark:text-gray-300 font-semibold hover:bg-gray-100 dark:hover:bg-gray-800 transition">
                            Cancel
                        </a>

                        <button
                            type="submit"
                            class="inline-flex justify-center items-center px-6 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-semibold transition shadow-sm"
                        >
                            Save Changes
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</x-app-layout>