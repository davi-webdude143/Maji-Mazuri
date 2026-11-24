<x-app-layout>

    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

            <div>
                <h2 class="font-bold text-2xl text-gray-800 dark:text-gray-100">
                    Customers
                </h2>

                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                    Manage Maji Mazuri water customers and their accounts.
                </p>
            </div>


            {{-- Customer Actions — Admin + Manager Only --}}
            @if(auth()->check() && in_array(auth()->user()->role, ['admin', 'manager'], true))
                <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-2">

                    {{-- Import Customers --}}
                    <a href="{{ route('customers.import.create') }}"
                       class="inline-flex items-center justify-center gap-2 px-5 py-2.5
                              rounded-xl border border-blue-200 dark:border-blue-800
                              bg-blue-50 dark:bg-blue-900/20
                              hover:bg-blue-100 dark:hover:bg-blue-900/40
                              text-blue-700 dark:text-blue-300
                              text-sm font-semibold
                              shadow-sm hover:shadow-md transition">

                        <svg class="w-5 h-5"
                             fill="none"
                             stroke="currentColor"
                             viewBox="0 0 24 24">
                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M7 16a4 4 0 01-.88-7.903A5 5 0 0117.9 6L18 6a5 5 0 011 9.9M12 12v9m0 0l-3-3m3 3l3-3"/>
                        </svg>

                        Import Customers
                    </a>


                    {{-- Add Customer --}}
                    <a href="{{ route('customers.create') }}"
                       class="inline-flex items-center justify-center gap-2 px-5 py-2.5
                              rounded-xl bg-blue-600 hover:bg-blue-700
                              text-white text-sm font-semibold
                              shadow-sm hover:shadow-md transition">

                        <svg class="w-5 h-5"
                             fill="none"
                             stroke="currentColor"
                             viewBox="0 0 24 24">
                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M12 4v16m8-8H4"/>
                        </svg>

                        Add Customer
                    </a>

                </div>
            @endif

        </div>
    </x-slot>


    <div class="py-8 bg-gray-100 dark:bg-gray-950 min-h-screen">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">


            {{-- Success Message --}}
            @if(session('success'))
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
                            {{ session('success') }}
                        </p>
                    </div>

                </div>
            @endif


            {{-- Main Customer Card --}}
            <div class="bg-white dark:bg-gray-900
                        rounded-2xl shadow-sm
                        border border-gray-200 dark:border-gray-800
                        overflow-hidden">


                {{-- Card Header --}}
                <div class="p-6 border-b border-gray-200 dark:border-gray-800">

                    <div class="flex flex-col lg:flex-row
                                lg:items-center lg:justify-between gap-5">


                        {{-- Title --}}
                        <div>

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
                                              d="M17 20h5V4H2v16h5m10 0v-6H7v6m10 0H7M8 8h8M8 12h4"/>
                                    </svg>

                                </div>

                                <div>

                                    <h3 class="text-lg font-bold text-gray-800 dark:text-white">
                                        Customer Management
                                    </h3>

                                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-0.5">
                                        {{ $customers->total() }} customer(s) registered
                                    </p>

                                </div>

                            </div>

                        </div>


                        {{-- Search --}}
                        <form method="GET"
                              action="{{ route('customers.index') }}"
                              class="w-full lg:w-auto">

                            <div class="flex flex-col sm:flex-row gap-2">

                                <div class="relative">

                                    <svg class="absolute left-3 top-1/2 -translate-y-1/2
                                                w-5 h-5 text-gray-400"
                                         fill="none"
                                         stroke="currentColor"
                                         viewBox="0 0 24 24">

                                        <path stroke-linecap="round"
                                              stroke-linejoin="round"
                                              stroke-width="2"
                                              d="m21 21-4.35-4.35m2.35-5.65a8 8 0 1 1-16 0 8 8 0 0 1 16 0z"/>

                                    </svg>

                                    <input
                                        type="text"
                                        name="search"
                                        value="{{ $search ?? '' }}"
                                        placeholder="Search customers..."
                                        class="w-full sm:w-80
                                               pl-10 pr-4 py-2.5
                                               rounded-xl
                                               border-gray-300 dark:border-gray-700
                                               bg-white dark:bg-gray-800
                                               text-gray-800 dark:text-white
                                               placeholder-gray-400
                                               focus:border-blue-500
                                               focus:ring-blue-500"
                                    >

                                </div>


                                <button
                                    type="submit"
                                    class="inline-flex items-center justify-center gap-2
                                           px-5 py-2.5 rounded-xl
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
                                              d="m21 21-4.35-4.35m2.35-5.65a8 8 0 1 1-16 0 8 8 0 0 1 16 0z"/>

                                    </svg>

                                    Search

                                </button>


                                @if(!empty($search))

                                    <a href="{{ route('customers.index') }}"
                                       class="inline-flex items-center justify-center gap-2
                                              px-5 py-2.5 rounded-xl
                                              border border-gray-300 dark:border-gray-700
                                              text-gray-700 dark:text-gray-300
                                              text-sm font-semibold
                                              hover:bg-gray-100 dark:hover:bg-gray-800
                                              transition">

                                        <svg class="w-4 h-4"
                                             fill="none"
                                             stroke="currentColor"
                                             viewBox="0 0 24 24">

                                            <path stroke-linecap="round"
                                                  stroke-linejoin="round"
                                                  stroke-width="2"
                                                  d="M6 18L18 6M6 6l12 12"/>

                                        </svg>

                                        Clear

                                    </a>

                                @endif

                            </div>

                        </form>

                    </div>

                </div>


                {{-- Desktop Table --}}
                <div class="overflow-x-auto">

                    <table class="w-full">

                        <thead class="bg-gray-50 dark:bg-gray-800/70">

                            <tr>

                                <th class="px-6 py-4 text-left text-xs font-bold
                                           text-gray-500 dark:text-gray-400
                                           uppercase tracking-wider">
                                    Customer
                                </th>

                                <th class="px-6 py-4 text-left text-xs font-bold
                                           text-gray-500 dark:text-gray-400
                                           uppercase tracking-wider">
                                    Customer No.
                                </th>

                                <th class="px-6 py-4 text-left text-xs font-bold
                                           text-gray-500 dark:text-gray-400
                                           uppercase tracking-wider">
                                    Phone
                                </th>

                                <th class="px-6 py-4 text-left text-xs font-bold
                                           text-gray-500 dark:text-gray-400
                                           uppercase tracking-wider">
                                    Location
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

                            @forelse($customers as $customer)

                                <tr class="hover:bg-blue-50/40 dark:hover:bg-gray-800/50
                                           transition">


                                    {{-- Customer --}}
                                    <td class="px-6 py-5">

                                        <div class="flex items-center gap-3">

                                            <div class="w-11 h-11 rounded-xl
                                                        bg-blue-100 dark:bg-blue-900/30
                                                        flex items-center justify-center
                                                        flex-shrink-0">

                                                <svg class="w-5 h-5 text-blue-600 dark:text-blue-400"
                                                     fill="none"
                                                     stroke="currentColor"
                                                     viewBox="0 0 24 24">

                                                    <path stroke-linecap="round"
                                                          stroke-linejoin="round"
                                                          stroke-width="2"
                                                          d="M16 7a4 4 0 1 1-8 0 4 4 0 0 1 8 0ZM4 21a8 8 0 0 1 16 0"/>

                                                </svg>

                                            </div>


                                            <div class="min-w-0">

                                                <p class="font-semibold text-gray-800 dark:text-white truncate">
                                                    {{ $customer->full_name }}
                                                </p>

                                                <p class="text-sm text-gray-500 dark:text-gray-400 truncate">
                                                    {{ $customer->email ?: 'No email provided' }}
                                                </p>

                                            </div>

                                        </div>

                                    </td>


                                    {{-- Customer Number --}}
                                    <td class="px-6 py-5">

                                        <span class="inline-flex items-center
                                                     px-2.5 py-1 rounded-lg
                                                     bg-gray-100 dark:bg-gray-800
                                                     text-sm font-semibold
                                                     text-gray-700 dark:text-gray-300">

                                            {{ $customer->customer_number }}

                                        </span>

                                    </td>


                                    {{-- Phone --}}
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
                                                      d="M3 5a2 2 0 0 1 2-2h2.28a2 2 0 0 1 1.94 1.515L10 7a2 2 0 0 1-.55 1.86l-1.27 1.27a16 16 0 0 0 5.69 5.69l1.27-1.27A2 2 0 0 1 17 14l2.485.78A2 2 0 0 1 21 16.72V19a2 2 0 0 1-2 2h-1C9.716 21 3 14.284 3 6V5Z"/>

                                            </svg>

                                            {{ $customer->phone_number }}

                                        </div>

                                    </td>


                                    {{-- Location --}}
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
                                                      d="M12 21s7-5.2 7-11a7 7 0 1 0-14 0c0 5.8 7 11 7 11Z"/>

                                                <circle cx="12"
                                                        cy="10"
                                                        r="2.5"
                                                        stroke-width="2"/>

                                            </svg>

                                            {{ $customer->area ?: 'Not provided' }}

                                        </div>

                                    </td>


                                    {{-- Status --}}
                                    <td class="px-6 py-5">

                                        @if($customer->status === 'active')

                                            <span class="inline-flex items-center gap-1.5
                                                         px-3 py-1.5 rounded-full
                                                         bg-green-100 dark:bg-green-900/30
                                                         text-green-700 dark:text-green-300
                                                         text-xs font-bold">

                                                <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>

                                                Active

                                            </span>

                                        @else

                                            <span class="inline-flex items-center gap-1.5
                                                         px-3 py-1.5 rounded-full
                                                         bg-red-100 dark:bg-red-900/30
                                                         text-red-700 dark:text-red-300
                                                         text-xs font-bold">

                                                <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span>

                                                Inactive

                                            </span>

                                        @endif

                                    </td>


                                    {{-- Actions --}}
                                    <td class="px-6 py-5">

                                        <div class="flex items-center justify-end gap-2">


                                            {{-- View — All Authenticated Users --}}
                                            <a href="{{ route('customers.show', $customer) }}"
                                               title="View Customer"
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


                                            {{-- Admin + Manager Actions --}}
                                            @if(auth()->check() && in_array(auth()->user()->role, ['admin', 'manager'], true))

                                                {{-- Edit --}}
                                                <a href="{{ route('customers.edit', $customer) }}"
                                                   title="Edit Customer"
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


                                                {{-- Deactivate --}}
                                                @if($customer->status === 'active')

                                                    <form method="POST"
                                                          action="{{ route('customers.destroy', $customer) }}"
                                                          onsubmit="return confirm('Are you sure you want to deactivate this customer?');">

                                                        @csrf
                                                        @method('DELETE')

                                                        <button
                                                            type="submit"
                                                            title="Deactivate Customer"
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

                                                @endif

                                            @endif

                                        </div>

                                    </td>

                                </tr>

                            @empty

                                {{-- Empty State --}}
                                <tr>

                                    <td colspan="6" class="px-6 py-16 text-center">

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
                                                      d="M17 20h5V4H2v16h5m10 0v-6H7v6m10 0H7M8 8h8M8 12h4"/>

                                            </svg>

                                        </div>


                                        <h3 class="mt-5 text-lg font-bold
                                                   text-gray-800 dark:text-white">

                                            No customers found

                                        </h3>


                                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">

                                            @if(!empty($search))

                                                No customers match your search criteria.

                                            @else

                                                Start by registering your first customer.

                                            @endif

                                        </p>


                                        {{-- Add Customer — Admin + Manager Only --}}
                                        @if(empty($search) && auth()->check() && in_array(auth()->user()->role, ['admin', 'manager'], true))

                                            <a href="{{ route('customers.create') }}"
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

                                                Add Customer

                                            </a>

                                        @elseif(!empty($search))

                                            <a href="{{ route('customers.index') }}"
                                               class="inline-flex items-center gap-2
                                                      mt-5 px-5 py-2.5 rounded-xl
                                                      border border-gray-300 dark:border-gray-700
                                                      text-gray-700 dark:text-gray-300
                                                      text-sm font-semibold
                                                      hover:bg-gray-100 dark:hover:bg-gray-800
                                                      transition">

                                                Clear Search

                                            </a>

                                        @endif

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>


                {{-- Pagination --}}
                @if($customers->hasPages())

                    <div class="px-6 py-5
                                border-t border-gray-200 dark:border-gray-800">

                        {{ $customers->links() }}

                    </div>

                @endif

            </div>


            {{-- Footer --}}
            <div class="text-center py-6">

                <p class="text-xs text-gray-400 dark:text-gray-500">
                    Maji Mazuri Water Billing & Customer Management System
                </p>

            </div>

        </div>

    </div>

</x-app-layout>