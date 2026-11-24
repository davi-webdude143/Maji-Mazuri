<x-app-layout>

    <x-slot name="header">

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

            <div>

                <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-100">
                    Meter Reading Details
                </h2>

                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                    View the details and status of this meter reading
                </p>

            </div>

            <a
                href="{{ route('meter-readings.index') }}"
                class="inline-flex items-center justify-center px-5 py-2.5 rounded-xl border border-gray-300 dark:border-gray-700 text-gray-700 dark:text-gray-300 font-semibold hover:bg-gray-100 dark:hover:bg-gray-800 transition"
            >
                ← Back to Readings
            </a>

        </div>

    </x-slot>


    <div class="py-8 bg-gray-100 dark:bg-gray-950 min-h-screen">

        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">


            {{-- Status Banner --}}

            @if($meterReading->is_abnormal)

                <div class="mb-6 bg-amber-50 dark:bg-amber-900/30 border border-amber-300 dark:border-amber-800 rounded-2xl p-5">

                    <div class="flex items-start gap-4">

                        <div class="text-2xl">
                            ⚠️
                        </div>

                        <div>

                            <h3 class="font-semibold text-amber-800 dark:text-amber-300">
                                Abnormal Consumption Detected
                            </h3>

                            <p class="text-sm text-amber-700 dark:text-amber-400 mt-1">
                                This reading has been flagged because the recorded consumption
                                is unusually high.
                            </p>

                        </div>

                    </div>

                </div>

            @elseif($meterReading->exception_type)

                <div class="mb-6 bg-purple-50 dark:bg-purple-900/30 border border-purple-200 dark:border-purple-800 rounded-2xl p-5">

                    <div class="flex items-start gap-4">

                        <div class="text-2xl">
                            ℹ️
                        </div>

                        <div>

                            <h3 class="font-semibold text-purple-800 dark:text-purple-300">
                                Exceptional Meter Reading
                            </h3>

                            <p class="text-sm text-purple-700 dark:text-purple-400 mt-1">
                                This reading was recorded with an exception.
                            </p>

                        </div>

                    </div>

                </div>

            @else

                <div class="mb-6 bg-green-50 dark:bg-green-900/30 border border-green-200 dark:border-green-800 rounded-2xl p-5">

                    <div class="flex items-center gap-4">

                        <div class="text-2xl">
                            ✓
                        </div>

                        <div>

                            <h3 class="font-semibold text-green-800 dark:text-green-300">
                                Normal Meter Reading
                            </h3>

                            <p class="text-sm text-green-700 dark:text-green-400 mt-1">
                                This reading was recorded without an exception.
                            </p>

                        </div>

                    </div>

                </div>

            @endif


            {{-- Main Details Card --}}

            <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-800 overflow-hidden">


                {{-- Card Header --}}

                <div class="p-6 border-b border-gray-200 dark:border-gray-800">

                    <div class="flex items-center gap-4">

                        <div class="w-12 h-12 rounded-xl bg-blue-100 dark:bg-blue-900/40 flex items-center justify-center text-2xl">
                            💧
                        </div>

                        <div>

                            <h3 class="text-lg font-semibold text-gray-800 dark:text-white">
                                Reading Information
                            </h3>

                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                Meter {{ $meterReading->meter->meter_number ?? 'N/A' }}
                            </p>

                        </div>

                    </div>

                </div>


                {{-- Reading Information --}}

                <div class="p-6">

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">


                        {{-- Customer --}}

                        <div class="bg-gray-50 dark:bg-gray-800 rounded-xl p-5">

                            <p class="text-xs uppercase tracking-wider font-semibold text-gray-500 dark:text-gray-400">
                                Customer
                            </p>

                            <p class="mt-2 text-lg font-semibold text-gray-800 dark:text-white">
                                {{ $meterReading->meter->customer->full_name ?? 'N/A' }}
                            </p>

                            @if($meterReading->meter->customer->customer_number ?? false)

                                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                                    {{ $meterReading->meter->customer->customer_number }}
                                </p>

                            @endif

                        </div>


                        {{-- Reading Date --}}

                        <div class="bg-gray-50 dark:bg-gray-800 rounded-xl p-5">

                            <p class="text-xs uppercase tracking-wider font-semibold text-gray-500 dark:text-gray-400">
                                Reading Date
                            </p>

                            <p class="mt-2 text-lg font-semibold text-gray-800 dark:text-white">
                                {{ \Carbon\Carbon::parse($meterReading->reading_date)->format('d M Y') }}
                            </p>

                        </div>


                        {{-- Previous Reading --}}

                        <div class="bg-gray-50 dark:bg-gray-800 rounded-xl p-5">

                            <p class="text-xs uppercase tracking-wider font-semibold text-gray-500 dark:text-gray-400">
                                Previous Reading
                            </p>

                            <p class="mt-2 text-2xl font-bold text-gray-800 dark:text-white">
                                {{ number_format($meterReading->previous_reading, 2) }}
                            </p>

                        </div>


                        {{-- Current Reading --}}

                        <div class="bg-gray-50 dark:bg-gray-800 rounded-xl p-5">

                            <p class="text-xs uppercase tracking-wider font-semibold text-gray-500 dark:text-gray-400">
                                Current Reading
                            </p>

                            <p class="mt-2 text-2xl font-bold text-gray-800 dark:text-white">
                                {{ number_format($meterReading->current_reading, 2) }}
                            </p>

                        </div>


                        {{-- Consumption --}}

                        <div class="sm:col-span-2 bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-xl p-5">

                            <p class="text-xs uppercase tracking-wider font-semibold text-blue-600 dark:text-blue-400">
                                Water Consumption
                            </p>

                            <p class="mt-2 text-3xl font-bold text-blue-700 dark:text-blue-300">
                                {{ number_format($meterReading->consumption, 2) }} m³
                            </p>

                            <p class="text-sm text-blue-600 dark:text-blue-400 mt-1">
                                Current reading − previous reading
                            </p>

                        </div>

                    </div>


                    {{-- Exception Details --}}

                    @if($meterReading->exception_type)

                        <div class="mt-8 border-t border-gray-200 dark:border-gray-800 pt-8">

                            <h3 class="text-lg font-semibold text-gray-800 dark:text-white">
                                Exception Details
                            </h3>

                            <div class="mt-4 bg-purple-50 dark:bg-purple-900/20 border border-purple-200 dark:border-purple-800 rounded-xl p-5">

                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">

                                    {{-- Exception Type --}}

                                    <div>

                                        <p class="text-xs uppercase tracking-wider font-semibold text-purple-600 dark:text-purple-400">
                                            Exception Type
                                        </p>

                                        <p class="mt-2 font-semibold text-purple-800 dark:text-purple-300">
                                            {{ ucwords(str_replace('_', ' ', $meterReading->exception_type)) }}
                                        </p>

                                    </div>


                                    {{-- Abnormal Status --}}

                                    <div>

                                        <p class="text-xs uppercase tracking-wider font-semibold text-purple-600 dark:text-purple-400">
                                            Consumption Status
                                        </p>

                                        @if($meterReading->is_abnormal)

                                            <span class="inline-flex mt-2 items-center px-3 py-1 rounded-full bg-amber-100 dark:bg-amber-900/30 text-amber-700 dark:text-amber-300 text-sm font-bold">
                                                ⚠️ Abnormal
                                            </span>

                                        @else

                                            <span class="inline-flex mt-2 items-center px-3 py-1 rounded-full bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-300 text-sm font-bold">
                                                ✓ Within Normal Range
                                            </span>

                                        @endif

                                    </div>

                                </div>


                                {{-- Notes --}}

                                @if($meterReading->exception_notes)

                                    <div class="mt-5 pt-5 border-t border-purple-200 dark:border-purple-800">

                                        <p class="text-xs uppercase tracking-wider font-semibold text-purple-600 dark:text-purple-400">
                                            Operator Notes
                                        </p>

                                        <p class="mt-2 text-sm text-purple-800 dark:text-purple-300 whitespace-pre-line">
                                            {{ $meterReading->exception_notes }}
                                        </p>

                                    </div>

                                @endif

                            </div>

                        </div>

                    @endif

                </div>


                {{-- Actions --}}

                <div class="px-6 py-5 bg-gray-50 dark:bg-gray-800/50 border-t border-gray-200 dark:border-gray-800 flex flex-col sm:flex-row justify-end gap-3">

                    <a
                        href="{{ route('meter-readings.index') }}"
                        class="inline-flex justify-center items-center px-5 py-2.5 rounded-xl border border-gray-300 dark:border-gray-700 text-gray-700 dark:text-gray-300 font-semibold hover:bg-gray-100 dark:hover:bg-gray-800 transition"
                    >
                        ← Back
                    </a>

                    <a
                        href="{{ route('meter-readings.edit', $meterReading) }}"
                        class="inline-flex justify-center items-center px-6 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-semibold transition shadow-sm"
                    >
                        ✏️ Edit Reading
                    </a>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>