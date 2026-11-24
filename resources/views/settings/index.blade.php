<x-app-layout>

    <x-slot name="header">
        <div>
            <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-100">
                System Settings
            </h2>

            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                Configure meter reading and consumption monitoring settings.
            </p>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Success Message --}}
            @if (session('success'))
                <div class="mb-6 rounded-lg bg-green-50 border border-green-200 p-4">
                    <p class="text-sm font-medium text-green-700">
                        ✓ {{ session('success') }}
                    </p>
                </div>
            @endif

            {{-- Validation Errors --}}
            @if ($errors->any())
                <div class="mb-6 rounded-lg bg-red-50 border border-red-200 p-4">
                    <p class="font-semibold text-red-700 mb-2">
                        Please correct the following:
                    </p>

                    <ul class="list-disc list-inside text-sm text-red-600">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Main Settings Card --}}
            <div class="bg-white dark:bg-gray-800 shadow-sm rounded-xl overflow-hidden">

                {{-- Header --}}
                <div class="px-6 py-5 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                        Meter Reading Configuration
                    </h3>

                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                        These settings control meter limits and unusual consumption
                        detection.
                    </p>
                </div>

                {{-- Settings Form --}}
                <form
                    method="POST"
                    action="{{ route('settings.update') }}"
                >

                    @csrf
                    @method('PUT')

                    <div class="p-6 space-y-8">

                        {{-- Maximum Meter Reading --}}
                        <div>
                            <label
                                for="maximum_meter_reading"
                                class="block text-sm font-semibold text-gray-700 dark:text-gray-300"
                            >
                                Maximum Meter Reading
                            </label>

                            <p class="mt-1 mb-3 text-sm text-gray-500 dark:text-gray-400">
                                The maximum number the water meter can display
                                before it rolls over to zero.
                            </p>

                            <input
                                type="number"
                                id="maximum_meter_reading"
                                name="maximum_meter_reading"
                                value="{{ old('maximum_meter_reading', $maximumMeterReading) }}"
                                min="1"
                                max="999999"
                                required
                                class="w-full rounded-lg border-gray-300 dark:border-gray-600
                                       dark:bg-gray-700 dark:text-white
                                       focus:border-indigo-500 focus:ring-indigo-500"
                            >

                            @error('maximum_meter_reading')
                                <p class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>


                        {{-- Unusual Consumption Threshold --}}
                        <div>
                            <label
                                for="unusual_consumption_threshold"
                                class="block text-sm font-semibold text-gray-700 dark:text-gray-300"
                            >
                                Unusual Consumption Threshold
                            </label>

                            <p class="mt-1 mb-3 text-sm text-gray-500 dark:text-gray-400">
                                Consumption above this value will automatically
                                be flagged as unusual for review.
                            </p>

                            <div class="flex items-center gap-3">

                                <input
                                    type="number"
                                    id="unusual_consumption_threshold"
                                    name="unusual_consumption_threshold"
                                    value="{{ old('unusual_consumption_threshold', $unusualConsumptionThreshold) }}"
                                    min="1"
                                    max="999999"
                                    step="0.01"
                                    required
                                    class="w-full rounded-lg border-gray-300 dark:border-gray-600
                                           dark:bg-gray-700 dark:text-white
                                           focus:border-indigo-500 focus:ring-indigo-500"
                                >

                                <span class="text-sm font-medium text-gray-600 dark:text-gray-300">
                                    units
                                </span>

                            </div>

                            @error('unusual_consumption_threshold')
                                <p class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                    </div>


                    {{-- SAVE BUTTON --}}
                    <div class="px-6 py-5 border-t border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900">

                        <button
                            type="submit"
                            class="inline-flex items-center justify-center
                                   px-6 py-3
                                   rounded-lg
                                   bg-indigo-600
                                   text-white
                                   font-semibold
                                   text-sm
                                   shadow-sm
                                   hover:bg-indigo-700
                                   focus:outline-none
                                   focus:ring-2
                                   focus:ring-indigo-500
                                   focus:ring-offset-2"
                        >
                            Save Settings
                        </button>

                    </div>

                </form>

            </div>


            {{-- Information Card --}}
            <div class="mt-6 rounded-xl border border-blue-200
                        bg-blue-50 dark:bg-blue-900/20
                        dark:border-blue-800 p-6">

                <h4 class="font-semibold text-blue-900 dark:text-blue-100">
                    How these settings work
                </h4>

                <div class="mt-3 space-y-2 text-sm text-blue-800 dark:text-blue-200">

                    <p>
                        • The maximum meter reading is currently configured as
                        <strong>{{ $maximumMeterReading }}</strong>.
                    </p>

                    <p>
                        • Consumption above
                        <strong>{{ $unusualConsumptionThreshold }} units</strong>
                        will be flagged as unusual.
                    </p>

                    <p>
                        • Meter replacement, meter rollover, faulty meter and
                        incorrect previous reading can be recorded as exceptions.
                    </p>

                </div>

            </div>

        </div>
    </div>

</x-app-layout>