<x-app-layout>

    <x-slot name="header">
        <div>
            <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100">
                Edit User
            </h2>

            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                Update this user's account details, role, or password.
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

            {{-- Success Message --}}
            @if (session('success'))
                <div class="mb-6 rounded-lg border border-green-200 bg-green-50 px-4 py-4">
                    <p class="text-sm text-green-700">
                        {{ session('success') }}
                    </p>
                </div>
            @endif

            <div class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800">

                {{-- Header --}}
                <div class="border-b border-gray-200 px-6 py-5 dark:border-gray-700">
                    <div class="flex items-center gap-4">

                        <div class="flex h-12 w-12 items-center justify-center rounded-full bg-blue-100 dark:bg-blue-900/40">
                            <span class="text-lg font-bold text-blue-700 dark:text-blue-300">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </span>
                        </div>

                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                {{ $user->name }}
                            </h3>

                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                {{ $user->email }}
                            </p>
                        </div>

                    </div>
                </div>

                {{-- Form --}}
                <form action="{{ route('users.update', $user) }}" method="POST" class="p-6">

                    @csrf
                    @method('PUT')

                    <div class="space-y-6">

                        {{-- Full Name --}}
                        <div>
                            <label for="name"
                                   class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Full Name
                            </label>

                            <input
                                type="text"
                                id="name"
                                name="name"
                                value="{{ old('name', $user->name) }}"
                                required
                                autocomplete="name"
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
                            <label for="email"
                                   class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Email Address
                            </label>

                            <input
                                type="email"
                                id="email"
                                name="email"
                                value="{{ old('email', $user->email) }}"
                                required
                                autocomplete="email"
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
                            <label for="role"
                                   class="block text-sm font-medium text-gray-700 dark:text-gray-300">
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

                                <option value="operator"
                                    {{ old('role', $user->role) === 'operator' ? 'selected' : '' }}>
                                    Operator — Daily billing operations
                                </option>

                                <option value="admin"
                                    {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>
                                    Administrator — Full system access
                                </option>

                            </select>

                            @error('role')
                                <p class="mt-1 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Password Section --}}
                        <div class="border-t border-gray-200 pt-6 dark:border-gray-700">

                            <h4 class="text-base font-semibold text-gray-900 dark:text-white">
                                Change Password
                            </h4>

                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                Leave the password fields blank if you do not want to change the current password.
                            </p>

                        </div>

                        {{-- New Password --}}
                        <div>
                            <label for="password"
                                   class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                New Password
                            </label>

                            <input
                                type="password"
                                id="password"
                                name="password"
                                minlength="8"
                                autocomplete="new-password"
                                placeholder="Leave blank to keep current password"
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
                            <label for="password_confirmation"
                                   class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Confirm New Password
                            </label>

                            <input
                                type="password"
                                id="password_confirmation"
                                name="password_confirmation"
                                minlength="8"
                                autocomplete="new-password"
                                placeholder="Repeat the new password"
                                class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm
                                       focus:border-blue-500 focus:ring-blue-500
                                       dark:border-gray-600 dark:bg-gray-700
                                       dark:text-white"
                            >
                        </div>

                    </div>

                    {{-- Buttons --}}
                    <div class="mt-8 flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">

                        <a href="{{ route('users.index') }}"
                           class="inline-flex items-center justify-center rounded-lg border
                                  border-gray-300 bg-white px-5 py-2.5 text-sm font-semibold
                                  text-gray-700 transition hover:bg-gray-50
                                  dark:border-gray-600 dark:bg-gray-700
                                  dark:text-gray-200 dark:hover:bg-gray-600">
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
                            Save Changes
                        </button>

                    </div>

                </form>

            </div>

        </div>
    </div>

</x-app-layout>