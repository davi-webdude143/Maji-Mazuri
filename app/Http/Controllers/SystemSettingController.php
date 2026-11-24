<?php

namespace App\Http\Controllers;

use App\Models\SystemSetting;
use Illuminate\Http\Request;

class SystemSettingController extends Controller
{
    /**
     * Display the system settings page.
     */
    public function index()
    {
        $maximumMeterReading = SystemSetting::getValue(
            'maximum_meter_reading',
            9999
        );

        $unusualConsumptionThreshold = SystemSetting::getValue(
            'unusual_consumption_threshold',
            100
        );

        return view('settings.index', compact(
            'maximumMeterReading',
            'unusualConsumptionThreshold'
        ));
    }

    /**
     * Update the system settings.
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'maximum_meter_reading' => [
                'required',
                'integer',
                'min:1',
                'max:999999',
            ],

            'unusual_consumption_threshold' => [
                'required',
                'numeric',
                'min:1',
                'max:999999',
            ],
        ]);

        SystemSetting::setValue(
            'maximum_meter_reading',
            $validated['maximum_meter_reading']
        );

        SystemSetting::setValue(
            'unusual_consumption_threshold',
            $validated['unusual_consumption_threshold']
        );

        return redirect()
            ->route('settings.index')
            ->with(
                'success',
                'System settings updated successfully.'
            );
    }
}