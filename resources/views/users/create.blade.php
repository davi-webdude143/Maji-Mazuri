<x-app-layout>

    <x-slot name="header">

        <div>
            <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100">
                Add New User
            </h2>

            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                Create an administrator, manager, or operator account.
            </p>
        </div>

    </x-slot>


    <div class="py-8">

        <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">

            {{-- Validation Errors --}}
            @if ($errors->any())

                <div class="mb-6 rounded-lg border border-red-200 bg-red-50 px-4 py-4">

                    <p class="text-sm font-semibold text-red-700">
                        Please correct the following errors:
                    </p>

                    <ul class="mt-2 list-inside list-disc text-sm text-red-600">

                        @foreach ($errors->all() as $error)

                            <li>{{ $error }}</li>

                        @endforeach

                    </ul>

                </div>

            @endif


            <div class="rounded-xl border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800">

                {{-- Header --}}
                <div class="border-b border-gray-200 px-6 py-5 dark:border-gray-700">

                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        User Account Details
                    </h3>

                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                        Enter the details for the new system user.
                    </p>

                </div>


                {{-- Form --}}
                <form
                    action="{{ route('users.store') }}"
                    method="POST"
                    class="p-6"
                >

                    @csrf


                    <div class="space-y-6">

                        {{-- Name --}}
                        <div>

                            <label
                                for="name"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300"
                            >
                                Full Name
                            </label>

                            <input
                                type="text"
                                id="name"
                                name="name"
                                value="{{ old('name') }}"
                                required
                                autocomplete="name"
                                placeholder="Enter user's full name"
                                class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm
                                       focus:border-blue-500 focus:ring-blue-500
                                       dark:border-gray-600 dark:bg-gray-700
                                       dark:text-white"
                            >

                            @error('name')

                                <p class="mt-1 text-sm text-red-600">
                                    {{ $message }}
                                </p>

                            @enderror

                        </div>


                        {{-- Email --}}
                        <div>

                            <label
                                for="email"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300"
                            >
                                Email Address
                            </label>

                            <input
                                type="email"
                                id="email"
                                name="email"
                                value="{{ old('email') }}"
                                required
                                autocomplete="email"
                                placeholder="user@example.com"
                                class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm
                                       focus:border-blue-500 focus:ring-blue-500
                                       dark:border-gray-600 dark:bg-gray-700
                                       dark:text-white"
                            >

                            @error('email')

                                <p class="mt-1 text-sm text-red-600">
                                    {{ $message }}
                                </p>

                            @enderror

                        </div>


                        {{-- Role --}}
                        <div>

                            <label
                                for="role"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300"
                            >
                                User Role
                            </label>

                            <select
                                id="role"
                                name="role"
                                required
                                class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm
                                       focus:border-blue-500 focus:ring-blue-500
                                       dark:border-gray-600 dark:bg-gray-700
                                       dark:text-white"
                            >

                                <option value="">
                                    Select a role
                                </option>

                                <option
                                    value="operator"
                                    {{ old('role') === 'operator' ? 'selected' : '' }}
                                >
                                    Operator — Daily billing operations
                                </option>

                                <option
                                    value="manager"
                                    {{ old('role') === 'manager' ? 'selected' : '' }}
                                >
                                    Manager — Full operational and financial access
                                </option>

                                <option
                                    value="admin"
                                    {{ old('role') === 'admin' ? 'selected' : '' }}
                                >
                                    Administrator — Full system access
                                </option>

                            </select>

                            @error('role')

                                <p class="mt-1 text-sm text-red-600">
                                    {{ $message }}
                                </p>

                            @enderror

                        </div>


                        {{-- Password --}}
                        <div>

                            <label
                                for="password"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300"
                            >
                                Password
                            </label>

                            <input
                                type="password"
                                id="password"
                                name="password"
                                required
                                minlength="8"
                                autocomplete="new-password"
                                placeholder="Minimum 8 characters"
                                class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm
                                       focus:border-blue-500 focus:ring-blue-500
                                       dark:border-gray-600 dark:bg-gray-700
                                       dark:text-white"
                            >

                            @error('password')

                                <p class="mt-1 text-sm text-red-600">
                                    {{ $message }}
                                </p>

                            @enderror

                        </div>


                        {{-- Confirm Password --}}
                        <div>

                            <label
                                for="password_confirmation"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300"
                            >
                                Confirm Password
                            </label>

                            <input
                                type="password"
                                id="password_confirmation"
                                name="password_confirmation"
                                required
                                minlength="8"
                                autocomplete="new-password"
                                placeholder="Enter the password again"
                                class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm
                                       focus:border-blue-500 focus:ring-blue-500
                                       dark:border-gray-600 dark:bg-gray-700
                                       dark:text-white"
                            >

                        </div>

                    </div>


                    {{-- Buttons --}}
                    <div class="mt-8 flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">

                        <a
                            href="{{ route('users.index') }}"
                            class="inline-flex items-center justify-center rounded-lg border
                                   border-gray-300 bg-white px-5 py-2.5 text-sm font-semibold
                                   text-gray-700 transition hover:bg-gray-50
                                   dark:border-gray-600 dark:bg-gray-700
                                   dark:text-gray-200 dark:hover:bg-gray-600"
                        >
                            Cancel
                        </a>


                        <button
                            type="submit"
                            class="inline-flex items-center justify-center rounded-lg
                                   bg-blue-600 px-5 py-2.5 text-sm font-semibold
                                   text-white shadow-sm transition hover:bg-blue-700
                                   focus:outline-none focus:ring-2 focus:ring-blue-500
                                   focus:ring-offset-2"
                        >
                            Create User
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</x-app-layout>