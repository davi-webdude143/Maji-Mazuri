<x-app-layout>

    <div class="min-h-screen bg-gray-50 dark:bg-gray-950 py-8">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

            {{-- =================================================
                 PAGE HEADER
            ================================================== --}}

            <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

                <div>
                    <h1 class="text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                        Import Customers
                    </h1>

                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                        Review the spreadsheet data before importing it into Maji Mazuri.
                    </p>
                </div>

                <a
                    href="{{ route('customers.import.create') }}"
                    class="inline-flex items-center justify-center rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-900 px-4 py-2.5 text-sm font-medium text-gray-700 dark:text-gray-200 shadow-sm transition hover:bg-gray-50 dark:hover:bg-gray-800"
                >
                    ← Choose Another File
                </a>

            </div>


            {{-- =================================================
                 INFORMATION NOTICE
            ================================================== --}}

            <div class="mb-6 rounded-xl border border-blue-200 dark:border-blue-900 bg-blue-50 dark:bg-blue-950/40 p-4">

                <div class="flex gap-3">

                    <div class="mt-0.5 flex-shrink-0">

                        <svg
                            class="h-5 w-5 text-blue-600 dark:text-blue-400"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M12 20a8 8 0 100-16 8 8 0 000 16z"
                            />
                        </svg>

                    </div>

                    <div>

                        <h3 class="text-sm font-semibold text-blue-900 dark:text-blue-300">
                            Review before importing
                        </h3>

                        <p class="mt-1 text-sm leading-6 text-blue-800 dark:text-blue-300">
                            No customers or meters have been created yet.
                            Records will only be saved after you click
                            <strong>Confirm Import</strong>.
                        </p>

                    </div>

                </div>

            </div>


            {{-- =================================================
                 PREPARE COUNTS
            ================================================== --}}

            @php

                $processedRows = is_array($processed ?? null)
                    ? $processed
                    : ($processed ?? []);

                $validRows = is_array($valid ?? null)
                    ? $valid
                    : ($valid ?? []);

                $errorRows = is_array($errors ?? null)
                    ? $errors
                    : ($errors ?? []);

                $duplicateRows = is_array($duplicates ?? null)
                    ? $duplicates
                    : ($duplicates ?? []);

                $totalRowsCount = count($processedRows);
                $validRowsCount = count($validRows);
                $errorRowsCount = count($errorRows);
                $duplicateRowsCount = count($duplicateRows);

            @endphp


            {{-- =================================================
                 SUMMARY CARDS
            ================================================== --}}

            <div class="mb-8 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">

                {{-- Total Rows --}}
                <div class="rounded-xl border border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-900 p-5 shadow-sm">

                    <div class="flex items-center justify-between">

                        <div>

                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">
                                Total Rows
                            </p>

                            <p class="mt-2 text-3xl font-bold text-gray-900 dark:text-white">
                                {{ $totalRowsCount }}
                            </p>

                        </div>

                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-300">

                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-6 w-6"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2H9zm0 0a3 3 0 016 0v2H9V5z"
                                />
                            </svg>

                        </div>

                    </div>

                </div>


                {{-- Ready --}}
                <div class="rounded-xl border border-green-200 dark:border-green-900 bg-white dark:bg-gray-900 p-5 shadow-sm">

                    <div class="flex items-center justify-between">

                        <div>

                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">
                                Ready to Import
                            </p>

                            <p class="mt-2 text-3xl font-bold text-green-600">
                                {{ $validRowsCount }}
                            </p>

                        </div>

                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-green-50 dark:bg-green-950/40 text-green-600">

                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-6 w-6"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M5 13l4 4L19 7"
                                />
                            </svg>

                        </div>

                    </div>

                </div>


                {{-- Errors --}}
                <div class="rounded-xl border border-red-200 dark:border-red-900 bg-white dark:bg-gray-900 p-5 shadow-sm">

                    <div class="flex items-center justify-between">

                        <div>

                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">
                                With Errors
                            </p>

                            <p class="mt-2 text-3xl font-bold text-red-600">
                                {{ $errorRowsCount }}
                            </p>

                        </div>

                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-red-50 dark:bg-red-950/40 text-red-600">

                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-6 w-6"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M12 9v2m0 4h.01M5.07 19h13.86a2 2 0 001.73-3L13.73 4a2 2 0 00-3.46 0L3.34 16a2 2 0 001.73 3z"
                                />
                            </svg>

                        </div>

                    </div>

                </div>


                {{-- Duplicates --}}
                <div class="rounded-xl border border-yellow-200 dark:border-yellow-900 bg-white dark:bg-gray-900 p-5 shadow-sm">

                    <div class="flex items-center justify-between">

                        <div>

                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">
                                Duplicates
                            </p>

                            <p class="mt-2 text-3xl font-bold text-yellow-600">
                                {{ $duplicateRowsCount }}
                            </p>

                        </div>

                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-yellow-50 dark:bg-yellow-950/40 text-yellow-600">

                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-6 w-6"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M12 9v2m0 4h.01M12 3a9 9 0 100 18 9 9 0 000-18z"
                                />
                            </svg>

                        </div>

                    </div>

                </div>

            </div>


            {{-- =================================================
                 READING EXPLANATION
            ================================================== --}}

            <div class="mb-6 rounded-xl border border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-900 p-6 shadow-sm">

                <h2 class="text-base font-semibold text-gray-900 dark:text-white">
                    How the readings will be imported
                </h2>

                <div class="mt-4 grid grid-cols-1 gap-4 md:grid-cols-3">

                    <div class="rounded-lg bg-gray-50 dark:bg-gray-800 p-4">

                        <p class="text-xs font-semibold uppercase tracking-wide text-gray-500 dark:text-gray-400">
                            Previous Reading
                        </p>

                        <p class="mt-2 text-sm text-gray-700 dark:text-gray-300">
                            Becomes the meter's
                            <strong>initial reading</strong>.
                        </p>

                    </div>


                    <div class="rounded-lg bg-gray-50 dark:bg-gray-800 p-4">

                        <p class="text-xs font-semibold uppercase tracking-wide text-gray-500 dark:text-gray-400">
                            Current Reading
                        </p>

                        <p class="mt-2 text-sm text-gray-700 dark:text-gray-300">
                            Becomes the meter's
                            <strong>current reading</strong>.
                        </p>

                    </div>


                    <div class="rounded-lg bg-gray-50 dark:bg-gray-800 p-4">

                        <p class="text-xs font-semibold uppercase tracking-wide text-gray-500 dark:text-gray-400">
                            Consumption
                        </p>

                        <p class="mt-2 text-sm text-gray-700 dark:text-gray-300">
                            Calculated automatically from the two readings.
                        </p>

                    </div>

                </div>


                <div class="mt-4 rounded-lg border border-blue-100 dark:border-blue-900 bg-blue-50 dark:bg-blue-950/40 p-4 text-sm text-blue-800 dark:text-blue-300">

                    <strong>Important:</strong>

                    Previous balances, payments, totals and amounts from the
                    spreadsheet are shown for reference only.

                    This import does not create historical bills,
                    payments or meter-reading transactions.

                </div>

            </div>


            {{-- =================================================
                 CUSTOMER PREVIEW TABLE
            ================================================== --}}

            <div class="overflow-hidden rounded-xl border border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-900 shadow-sm">

                <div class="border-b border-gray-200 dark:border-gray-800 px-6 py-5">

                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Customer Preview
                    </h2>

                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                        Verify the account numbers, system meter numbers and readings before confirming.
                    </p>

                </div>


                <div class="overflow-x-auto">

                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-800">

                        <thead class="bg-gray-50 dark:bg-gray-800">

                            <tr>

                                <th class="whitespace-nowrap px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500 dark:text-gray-400">
                                    Row
                                </th>

                                <th class="whitespace-nowrap px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500 dark:text-gray-400">
                                    Account No.
                                </th>

                                <th class="whitespace-nowrap px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500 dark:text-gray-400">
                                    System Meter
                                </th>

                                <th class="whitespace-nowrap px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500 dark:text-gray-400">
                                    Customer
                                </th>

                                <th class="whitespace-nowrap px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500 dark:text-gray-400">
                                    Phone
                                </th>

                                <th class="whitespace-nowrap px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500 dark:text-gray-400">
                                    Area
                                </th>

                                <th class="whitespace-nowrap px-4 py-3 text-right text-xs font-semibold uppercase tracking-wide text-gray-500 dark:text-gray-400">
                                    Previous
                                </th>

                                <th class="whitespace-nowrap px-4 py-3 text-right text-xs font-semibold uppercase tracking-wide text-gray-500 dark:text-gray-400">
                                    Current
                                </th>

                                <th class="whitespace-nowrap px-4 py-3 text-right text-xs font-semibold uppercase tracking-wide text-gray-500 dark:text-gray-400">
                                    Consumption
                                </th>

                                <th class="whitespace-nowrap px-4 py-3 text-right text-xs font-semibold uppercase tracking-wide text-gray-500 dark:text-gray-400">
                                    Amount
                                </th>

                                <th class="whitespace-nowrap px-4 py-3 text-right text-xs font-semibold uppercase tracking-wide text-gray-500 dark:text-gray-400">
                                    Previous Balance
                                </th>

                                <th class="whitespace-nowrap px-4 py-3 text-right text-xs font-semibold uppercase tracking-wide text-gray-500 dark:text-gray-400">
                                    Paid
                                </th>

                                <th class="whitespace-nowrap px-4 py-3 text-right text-xs font-semibold uppercase tracking-wide text-gray-500 dark:text-gray-400">
                                    Current Balance
                                </th>

                                <th class="whitespace-nowrap px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500 dark:text-gray-400">
                                    Status
                                </th>

                            </tr>

                        </thead>


                        <tbody class="divide-y divide-gray-100 dark:divide-gray-800 bg-white dark:bg-gray-900">

                            @forelse($processedRows as $row)

                                @php

                                    $rowStatus = $row['status'] ?? 'error';

                                    $rowErrors = $row['errors'] ?? [];

                                    if (!is_array($rowErrors)) {
                                        $rowErrors = [$rowErrors];
                                    }

                                @endphp


                                <tr class="{{ $rowStatus === 'valid'
                                    ? 'hover:bg-gray-50 dark:hover:bg-gray-800/60'
                                    : 'bg-red-50 dark:bg-red-950/30'
                                }}">

                                    {{-- Row --}}
                                    <td class="whitespace-nowrap px-4 py-4 text-sm text-gray-500 dark:text-gray-400">
                                        {{ $row['row_number'] ?? '—' }}
                                    </td>


                                    {{-- Account Number --}}
                                    <td class="whitespace-nowrap px-4 py-4">

                                        <span class="font-semibold text-gray-900 dark:text-white">
                                            {{ $row['account_number'] ?? '—' }}
                                        </span>

                                    </td>


                                    {{-- System Meter --}}
                                    <td class="whitespace-nowrap px-4 py-4">

                                        <span class="rounded-md bg-gray-100 dark:bg-gray-800 px-2.5 py-1 text-xs font-semibold text-gray-700 dark:text-gray-300">
                                            {{ $row['meter_number'] ?? '—' }}
                                        </span>

                                    </td>


                                    {{-- Customer --}}
                                    <td class="whitespace-nowrap px-4 py-4 text-sm font-medium text-gray-900 dark:text-white">
                                        {{ $row['full_name'] ?? '—' }}
                                    </td>


                                    {{-- Phone --}}
                                    <td class="whitespace-nowrap px-4 py-4 text-sm text-gray-600 dark:text-gray-400">
                                        {{ $row['phone_number'] ?? '—' }}
                                    </td>


                                    {{-- Area --}}
                                    <td class="whitespace-nowrap px-4 py-4 text-sm text-gray-600 dark:text-gray-400">
                                        {{ $row['area'] ?? '—' }}
                                    </td>


                                    {{-- Previous --}}
                                    <td class="whitespace-nowrap px-4 py-4 text-right text-sm text-gray-700 dark:text-gray-300">

                                        @if(isset($row['previous_reading']) && $row['previous_reading'] !== null)

                                            {{ number_format((float) $row['previous_reading'], 2) }}

                                        @else

                                            —

                                        @endif

                                    </td>


                                    {{-- Current --}}
                                    <td class="whitespace-nowrap px-4 py-4 text-right text-sm text-gray-700 dark:text-gray-300">

                                        @if(isset($row['current_reading']) && $row['current_reading'] !== null)

                                            {{ number_format((float) $row['current_reading'], 2) }}

                                        @else

                                            —

                                        @endif

                                    </td>


                                    {{-- Consumption --}}
                                    <td class="whitespace-nowrap px-4 py-4 text-right text-sm font-semibold text-gray-900 dark:text-white">

                                        @if(isset($row['consumption']) && $row['consumption'] !== null)

                                            {{ number_format((float) $row['consumption'], 2) }}

                                        @else

                                            —

                                        @endif

                                    </td>


                                    {{-- Amount --}}
                                    <td class="whitespace-nowrap px-4 py-4 text-right text-sm font-semibold text-gray-900 dark:text-white">

                                        @if(isset($row['amount']) && $row['amount'] !== null)

                                            KSh {{ number_format((float) $row['amount'], 2) }}

                                        @else

                                            —

                                        @endif

                                    </td>


                                    {{-- Previous Balance --}}
                                    <td class="whitespace-nowrap px-4 py-4 text-right text-sm text-gray-600 dark:text-gray-400">

                                        @if(isset($row['previous_balance']) && $row['previous_balance'] !== null)

                                            KSh {{ number_format((float) $row['previous_balance'], 2) }}

                                        @else

                                            —

                                        @endif

                                    </td>


                                    {{-- Paid --}}
                                    <td class="whitespace-nowrap px-4 py-4 text-right text-sm text-gray-600 dark:text-gray-400">

                                        @if(isset($row['paid']) && $row['paid'] !== null)

                                            KSh {{ number_format((float) $row['paid'], 2) }}

                                        @else

                                            —

                                        @endif

                                    </td>


                                    {{-- Current Balance --}}
                                    <td class="whitespace-nowrap px-4 py-4 text-right text-sm font-semibold text-gray-900 dark:text-white">

                                        @if(isset($row['current_balance']) && $row['current_balance'] !== null)

                                            KSh {{ number_format((float) $row['current_balance'], 2) }}

                                        @else

                                            —

                                        @endif

                                    </td>


                                    {{-- Status --}}
                                    <td class="px-4 py-4">

                                        @if($rowStatus === 'valid')

                                            <span class="inline-flex items-center rounded-full bg-green-100 dark:bg-green-950/50 px-2.5 py-1 text-xs font-semibold text-green-700 dark:text-green-300">
                                                Ready
                                            </span>

                                        @else

                                            <div>

                                                <span class="inline-flex items-center rounded-full bg-red-100 dark:bg-red-950/50 px-2.5 py-1 text-xs font-semibold text-red-700 dark:text-red-300">
                                                    Error
                                                </span>

                                                @if(!empty($rowErrors))

                                                    <div class="mt-2 min-w-[220px] text-xs leading-5 text-red-700 dark:text-red-300">

                                                        @foreach($rowErrors as $error)

                                                            <div>
                                                                • {{ $error }}
                                                            </div>

                                                        @endforeach

                                                    </div>

                                                @endif

                                            </div>

                                        @endif

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td
                                        colspan="14"
                                        class="px-6 py-12 text-center"
                                    >

                                        <p class="text-sm font-medium text-gray-900 dark:text-white">
                                            No customer records were found.
                                        </p>

                                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                            Please return and upload a spreadsheet containing customer rows.
                                        </p>

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>


            {{-- =================================================
                 CONFIRM IMPORT
            ================================================== --}}

            @if($validRowsCount > 0)

                <div class="mt-6 rounded-xl border border-green-200 dark:border-green-900 bg-white dark:bg-gray-900 p-6 shadow-sm">

                    <div class="flex flex-col gap-5 lg:flex-row lg:items-center lg:justify-between">

                        <div>

                            <h2 class="text-lg font-semibold text-gray-900 dark:text-white">
                                Ready to Import
                            </h2>

                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                {{ $validRowsCount }}
                                customer(s) are ready to be added to Maji Mazuri.
                            </p>

                            <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">
                                Only customers and their meters will be created.
                                No historical bills, payments or meter-reading
                                transactions will be created.
                            </p>

                        </div>


                        <form
                            method="POST"
                            action="{{ route('customers.import.confirm') }}"
                            id="confirmImportForm"
                        >

                            @csrf


                            @foreach($validRows as $index => $row)

                                <input
                                    type="hidden"
                                    name="rows[{{ $index }}][status]"
                                    value="valid"
                                >

                                <input
                                    type="hidden"
                                    name="rows[{{ $index }}][row_number]"
                                    value="{{ $row['row_number'] ?? '' }}"
                                >

                                <input
                                    type="hidden"
                                    name="rows[{{ $index }}][first_name]"
                                    value="{{ $row['first_name'] ?? '' }}"
                                >

                                <input
                                    type="hidden"
                                    name="rows[{{ $index }}][second_name]"
                                    value="{{ $row['second_name'] ?? '' }}"
                                >

                                <input
                                    type="hidden"
                                    name="rows[{{ $index }}][full_name]"
                                    value="{{ $row['full_name'] ?? '' }}"
                                >

                                <input
                                    type="hidden"
                                    name="rows[{{ $index }}][account_number]"
                                    value="{{ $row['account_number'] ?? '' }}"
                                >

                                <input
                                    type="hidden"
                                    name="rows[{{ $index }}][meter_number]"
                                    value="{{ $row['meter_number'] ?? '' }}"
                                >

                                <input
                                    type="hidden"
                                    name="rows[{{ $index }}][phone_number]"
                                    value="{{ $row['phone_number'] ?? '' }}"
                                >

                                <input
                                    type="hidden"
                                    name="rows[{{ $index }}][area]"
                                    value="{{ $row['area'] ?? '' }}"
                                >

                                <input
                                    type="hidden"
                                    name="rows[{{ $index }}][previous_reading]"
                                    value="{{ $row['previous_reading'] ?? '' }}"
                                >

                                <input
                                    type="hidden"
                                    name="rows[{{ $index }}][current_reading]"
                                    value="{{ $row['current_reading'] ?? '' }}"
                                >

                                <input
                                    type="hidden"
                                    name="rows[{{ $index }}][consumption]"
                                    value="{{ $row['consumption'] ?? '' }}"
                                >

                                <input
                                    type="hidden"
                                    name="rows[{{ $index }}][amount]"
                                    value="{{ $row['amount'] ?? '' }}"
                                >

                                <input
                                    type="hidden"
                                    name="rows[{{ $index }}][previous_balance]"
                                    value="{{ $row['previous_balance'] ?? '' }}"
                                >

                                <input
                                    type="hidden"
                                    name="rows[{{ $index }}][paid]"
                                    value="{{ $row['paid'] ?? '' }}"
                                >

                                <input
                                    type="hidden"
                                    name="rows[{{ $index }}][current_balance]"
                                    value="{{ $row['current_balance'] ?? '' }}"
                                >

                            @endforeach


                            <button
                                type="submit"
                                id="confirmImportButton"
                                class="inline-flex w-full items-center justify-center rounded-lg bg-gray-900 dark:bg-white px-6 py-3 text-sm font-semibold text-white dark:text-gray-900 shadow-sm transition hover:bg-gray-800 dark:hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-900 dark:focus:ring-white focus:ring-offset-2 lg:w-auto"
                            >
                                Confirm Import
                            </button>

                        </form>

                    </div>

                </div>

            @else

                <div class="mt-6 rounded-xl border border-red-200 dark:border-red-900 bg-red-50 dark:bg-red-950/30 p-6">

                    <h2 class="text-lg font-semibold text-red-900 dark:text-red-300">
                        No records are ready to import
                    </h2>

                    <p class="mt-1 text-sm text-red-700 dark:text-red-300">
                        Please correct the errors in your spreadsheet and upload it again.
                    </p>

                </div>

            @endif

        </div>
    </div>


    {{-- =================================================
         PREVENT DOUBLE SUBMISSION
    ================================================== --}}

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const form = document.getElementById('confirmImportForm');
            const button = document.getElementById('confirmImportButton');

            if (!form || !button) {
                return;
            }

            form.addEventListener('submit', function () {

                button.disabled = true;

                button.classList.add(
                    'opacity-60',
                    'cursor-not-allowed'
                );

                button.textContent = 'Importing...';

            });

        });
    </script>

</x-app-layout>