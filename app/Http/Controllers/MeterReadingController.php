<?php

namespace App\Http\Controllers;

use App\Models\Meter;
use App\Models\MeterReading;
use App\Models\SystemSetting;
use Illuminate\Http\Request;

class MeterReadingController extends Controller
{
    /**
     * Display all meter readings with optional search.
     */
    public function index(Request $request)
    {
        $search = trim($request->input('search', ''));

        $readings = MeterReading::with('meter.customer')
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($query) use ($search) {
                    $query->whereHas('meter', function ($meterQuery) use ($search) {
                        $meterQuery->where('meter_number', 'like', "%{$search}%")
                            ->orWhereHas('customer', function ($customerQuery) use ($search) {
                                $customerQuery->where('full_name', 'like', "%{$search}%")
                                    ->orWhere('customer_number', 'like', "%{$search}%")
                                    ->orWhere('phone_number', 'like', "%{$search}%");
                            });
                    })
                    ->orWhere('exception_type', 'like', "%{$search}%");
                });
            })
            ->latest('reading_date')
            ->paginate(10)
            ->withQueryString();

        return view('meter-readings.index', compact('readings', 'search'));
    }

    /**
     * Show the form for recording a new reading.
     */
    public function create(Request $request)
    {
        $search = trim($request->input('search', ''));

        $meters = Meter::with('customer')
            ->where('status', 'active')
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($query) use ($search) {
                    $query->where('meter_number', 'like', "%{$search}%")
                        ->orWhereHas('customer', function ($customerQuery) use ($search) {
                            $customerQuery->where('customer_number', 'like', "%{$search}%")
                                ->orWhere('full_name', 'like', "%{$search}%")
                                ->orWhere('phone_number', 'like', "%{$search}%");
                        });
                });
            })
            ->orderBy('meter_number')
            ->get();

        return view(
            'meter-readings.create',
            compact('meters', 'search')
        );
    }

    /**
     * Store a new meter reading.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'meter_id' => ['required', 'exists:meters,id'],
            'reading_date' => ['required', 'date'],
            'current_reading' => ['required', 'numeric', 'min:0'],

            'is_exception' => ['nullable', 'boolean'],

            'exception_type' => [
                'nullable',
                'in:meter_replaced,meter_reset,meter_rollover,faulty_meter,incorrect_previous_reading',
            ],

            'exception_notes' => [
                'nullable',
                'string',
                'max:1000',
            ],
        ]);

        $meter = Meter::findOrFail($validated['meter_id']);

        /*
        |--------------------------------------------------------------------------
        | System Settings
        |--------------------------------------------------------------------------
        */

        $maximumMeterReading = (float) SystemSetting::getValue(
            'maximum_meter_reading',
            9999
        );

        $abnormalThreshold = (float) SystemSetting::getValue(
            'unusual_consumption_threshold',
            100
        );

        /*
        |--------------------------------------------------------------------------
        | Previous and Current Reading
        |--------------------------------------------------------------------------
        */

        $previousReading = (float) (
            $meter->current_reading
            ?? $meter->initial_reading
            ?? 0
        );

        $currentReading = (float) $validated['current_reading'];

        /*
        |--------------------------------------------------------------------------
        | Maximum Reading Validation
        |--------------------------------------------------------------------------
        */

        if ($currentReading > $maximumMeterReading) {
            return back()
                ->withErrors([
                    'current_reading' =>
                        'The current reading cannot exceed '
                        . number_format($maximumMeterReading, 2)
                        . '.',
                ])
                ->withInput();
        }

        /*
        |--------------------------------------------------------------------------
        | Exception Information
        |--------------------------------------------------------------------------
        */

        $isException = $request->boolean('is_exception');

        $exceptionType = $isException
            ? ($validated['exception_type'] ?? null)
            : null;

        $exceptionNotes = $isException
            ? ($validated['exception_notes'] ?? null)
            : null;

        if ($isException && !$exceptionType) {
            return back()
                ->withErrors([
                    'exception_type' =>
                        'Please select the reason for the exceptional meter reading.',
                ])
                ->withInput();
        }

        /*
        |--------------------------------------------------------------------------
        | Calculate Consumption
        |--------------------------------------------------------------------------
        */

        if ($exceptionType === 'meter_replaced') {

            $consumption = $currentReading;

        } elseif (
            $exceptionType === 'meter_reset'
            || $exceptionType === 'meter_rollover'
        ) {

            if ($currentReading >= $previousReading) {
                return back()
                    ->withErrors([
                        'current_reading' =>
                            'For a meter reset or rollover, the current reading should be lower than the previous reading.',
                    ])
                    ->withInput();
            }

            $consumption =
                ($maximumMeterReading - $previousReading)
                + $currentReading;

        } elseif ($exceptionType === 'faulty_meter') {

            if ($currentReading < $previousReading) {
                return back()
                    ->withErrors([
                        'current_reading' =>
                            'The current reading cannot be lower than the previous reading for a faulty meter. If the meter was reset, rolled over or replaced, select the appropriate exception.',
                    ])
                    ->withInput();
            }

            $consumption =
                $currentReading - $previousReading;

        } elseif ($exceptionType === 'incorrect_previous_reading') {

            if (!$exceptionNotes) {
                return back()
                    ->withErrors([
                        'exception_notes' =>
                            'Please explain the correct previous reading or the reason for the correction.',
                    ])
                    ->withInput();
            }

            if ($currentReading < $previousReading) {
                return back()
                    ->withErrors([
                        'current_reading' =>
                            'The current reading cannot be lower than the previous reading without a meter rollover or replacement.',
                    ])
                    ->withInput();
            }

            $consumption =
                $currentReading - $previousReading;

        } else {

            if ($currentReading < $previousReading) {
                return back()
                    ->withErrors([
                        'current_reading' =>
                            'Current reading cannot be lower than the previous reading. If the meter rolled over or was replaced, select the appropriate exception.',
                    ])
                    ->withInput();
            }

            $consumption =
                $currentReading - $previousReading;
        }

        /*
        |--------------------------------------------------------------------------
        | Abnormal Consumption Detection
        |--------------------------------------------------------------------------
        */

        $isAbnormal = $consumption > $abnormalThreshold;

        /*
        |--------------------------------------------------------------------------
        | Save Reading
        |--------------------------------------------------------------------------
        */

        MeterReading::create([
            'meter_id' => $meter->id,
            'reading_date' => $validated['reading_date'],
            'previous_reading' => $previousReading,
            'current_reading' => $currentReading,
            'consumption' => $consumption,
            'is_abnormal' => $isAbnormal,
            'exception_type' => $exceptionType,
            'exception_notes' => $exceptionNotes,
        ]);

        /*
        |--------------------------------------------------------------------------
        | Update Meter Current Reading
        |--------------------------------------------------------------------------
        */

        $meter->update([
            'current_reading' => $currentReading,
        ]);

        /*
        |--------------------------------------------------------------------------
        | Response
        |--------------------------------------------------------------------------
        */

        if ($isAbnormal) {
            return redirect()
                ->route('meter-readings.index')
                ->with(
                    'warning',
                    'Meter reading recorded, but unusually high consumption was detected.'
                );
        }

        return redirect()
            ->route('meter-readings.index')
            ->with(
                'success',
                'Meter reading recorded successfully.'
            );
    }

    /**
     * Display one meter reading.
     */
    public function show(MeterReading $meterReading)
    {
        $meterReading->load('meter.customer');

        return view(
            'meter-readings.show',
            compact('meterReading')
        );
    }

    /**
     * Show the form for editing a reading.
     */
    public function edit(MeterReading $meterReading)
    {
        $meters = Meter::with('customer')
            ->orderBy('meter_number')
            ->get();

        return view(
            'meter-readings.edit',
            compact('meterReading', 'meters')
        );
    }

    /**
     * Update an existing meter reading.
     */
    public function update(
        Request $request,
        MeterReading $meterReading
    ) {
        $validated = $request->validate([
            'reading_date' => ['required', 'date'],
            'current_reading' => ['required', 'numeric', 'min:0'],

            'is_exception' => ['nullable', 'boolean'],

            'exception_type' => [
                'nullable',
                'in:meter_replaced,meter_reset,meter_rollover,faulty_meter,incorrect_previous_reading',
            ],

            'exception_notes' => [
                'nullable',
                'string',
                'max:1000',
            ],
        ]);

        $meter = $meterReading->meter;

        $maximumMeterReading = (float) SystemSetting::getValue(
            'maximum_meter_reading',
            9999
        );

        $abnormalThreshold = (float) SystemSetting::getValue(
            'unusual_consumption_threshold',
            100
        );

        $previousReading = (float) $meterReading->previous_reading;
        $currentReading = (float) $validated['current_reading'];

        if ($currentReading > $maximumMeterReading) {
            return back()
                ->withErrors([
                    'current_reading' =>
                        'The current reading cannot exceed '
                        . number_format($maximumMeterReading, 2)
                        . '.',
                ])
                ->withInput();
        }

        $isException = $request->boolean('is_exception');

        $exceptionType = $isException
            ? ($validated['exception_type'] ?? null)
            : null;

        $exceptionNotes = $isException
            ? ($validated['exception_notes'] ?? null)
            : null;

        if ($isException && !$exceptionType) {
            return back()
                ->withErrors([
                    'exception_type' =>
                        'Please select the reason for the exceptional meter reading.',
                ])
                ->withInput();
        }

        if ($exceptionType === 'meter_replaced') {

            $consumption = $currentReading;

        } elseif (
            $exceptionType === 'meter_reset'
            || $exceptionType === 'meter_rollover'
        ) {

            if ($currentReading >= $previousReading) {
                return back()
                    ->withErrors([
                        'current_reading' =>
                            'For a meter reset or rollover, the current reading should be lower than the previous reading.',
                    ])
                    ->withInput();
            }

            $consumption =
                ($maximumMeterReading - $previousReading)
                + $currentReading;

        } elseif ($exceptionType === 'faulty_meter') {

            if ($currentReading < $previousReading) {
                return back()
                    ->withErrors([
                        'current_reading' =>
                            'The current reading cannot be lower than the previous reading for a faulty meter. If the meter was reset, rolled over or replaced, select the appropriate exception.',
                    ])
                    ->withInput();
            }

            $consumption =
                $currentReading - $previousReading;

        } elseif ($exceptionType === 'incorrect_previous_reading') {

            if (!$exceptionNotes) {
                return back()
                    ->withErrors([
                        'exception_notes' =>
                            'Please explain the correct previous reading or the reason for the correction.',
                    ])
                    ->withInput();
            }

            if ($currentReading < $previousReading) {
                return back()
                    ->withErrors([
                        'current_reading' =>
                            'The current reading cannot be lower than the previous reading without a meter rollover or replacement.',
                    ])
                    ->withInput();
            }

            $consumption =
                $currentReading - $previousReading;

        } else {

            if ($currentReading < $previousReading) {
                return back()
                    ->withErrors([
                        'current_reading' =>
                            'Current reading cannot be lower than the previous reading. If the meter rolled over or was replaced, select the appropriate exception.',
                    ])
                    ->withInput();
            }

            $consumption =
                $currentReading - $previousReading;
        }

        $isAbnormal = $consumption > $abnormalThreshold;

        $meterReading->update([
            'reading_date' => $validated['reading_date'],
            'current_reading' => $currentReading,
            'consumption' => $consumption,
            'is_abnormal' => $isAbnormal,
            'exception_type' => $exceptionType,
            'exception_notes' => $exceptionNotes,
        ]);

        $meter->update([
            'current_reading' => $currentReading,
        ]);

        if ($isAbnormal) {
            return redirect()
                ->route('meter-readings.show', $meterReading)
                ->with(
                    'warning',
                    'Meter reading updated, but unusually high consumption was detected.'
                );
        }

        return redirect()
            ->route('meter-readings.show', $meterReading)
            ->with(
                'success',
                'Meter reading updated successfully.'
            );
    }

    /**
     * Delete a meter reading.
     */
    public function destroy(MeterReading $meterReading)
    {
        $meterReading->delete();

        return redirect()
            ->route('meter-readings.index')
            ->with(
                'success',
                'Meter reading deleted successfully.'
            );
    }
}
