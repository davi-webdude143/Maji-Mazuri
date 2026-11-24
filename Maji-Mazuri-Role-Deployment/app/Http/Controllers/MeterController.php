<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Meter;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class MeterController extends Controller
{
    public function index(Request $request)
    {
        $search = trim($request->input('search', ''));

        $query = Meter::with('customer')
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('meter_number', 'like', '%' . $search . '%')
                        ->orWhere('status', 'like', '%' . $search . '%')
                        ->orWhereHas('customer', function ($customerQuery) use ($search) {
                            $customerQuery
                                ->where('full_name', 'like', '%' . $search . '%')
                                ->orWhere('customer_number', 'like', '%' . $search . '%')
                                ->orWhere('phone_number', 'like', '%' . $search . '%')
                                ->orWhere('area', 'like', '%' . $search . '%');
                        });
                });
            });

        $totalMeters = (clone $query)->count();

        $activeMeters = (clone $query)
            ->where('status', 'active')
            ->count();

        $inactiveMeters = (clone $query)
            ->where('status', 'inactive')
            ->count();

        $meters = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('meters.index', compact(
            'meters',
            'search',
            'totalMeters',
            'activeMeters',
            'inactiveMeters'
        ));
    }

    public function create()
    {
        $customers = Customer::where('status', 'active')
            ->orderBy('full_name')
            ->get();

        return view('meters.create', compact('customers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'installation_date' => 'nullable|date',
            'initial_reading' => 'required|numeric|min:0',
            'status' => 'required|in:active,inactive',
        ]);

        if ($validated['status'] === 'active') {
            $existingActiveMeter = Meter::where('customer_id', $validated['customer_id'])
                ->where('status', 'active')
                ->exists();

            if ($existingActiveMeter) {
                throw ValidationException::withMessages([
                    'customer_id' =>
                        'This customer already has an active water meter. '
                        . 'Deactivate the existing meter before registering another active meter.',
                ]);
            }
        }

        $lastMeter = Meter::where('meter_number', 'like', 'MTR-%')
            ->orderByRaw("CAST(SUBSTRING(meter_number, 5) AS UNSIGNED) DESC")
            ->first();

        $nextNumber = $lastMeter
            ? ((int) substr($lastMeter->meter_number, 4)) + 1
            : 1;

        $meterNumber = 'MTR-' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);

        $validated['meter_number'] = $meterNumber;
        $validated['current_reading'] = $validated['initial_reading'];

        Meter::create($validated);

        return redirect()
            ->route('meters.index')
            ->with(
                'success',
                'Water meter registered successfully. Meter/Account Number: '
                . $meterNumber
            );
    }

    public function show(Meter $meter)
    {
        $meter->load([
            'customer',
            'readings' => function ($query) {
                $query->latest('reading_date');
            },
        ]);

        return view('meters.show', compact('meter'));
    }

    public function edit(Meter $meter)
    {
        $customers = Customer::where('status', 'active')
            ->orderBy('full_name')
            ->get();

        if (
            $meter->customer &&
            !$customers->contains('id', $meter->customer_id)
        ) {
            $customers->push($meter->customer);
        }

        return view(
            'meters.edit',
            compact('meter', 'customers')
        );
    }

    public function update(Request $request, Meter $meter)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'installation_date' => 'nullable|date',
            'initial_reading' => 'required|numeric|min:0',
            'current_reading' => 'required|numeric|min:0',
            'status' => 'required|in:active,inactive',
        ]);

        /*
         * Operators may edit normal meter information, but they must not
         * be able to deactivate an active meter.
         *
         * Admins and Managers are allowed to change an active meter
         * to inactive.
         */
        $isAdminOrManager = in_array(
            auth()->user()->role,
            ['admin', 'manager'],
            true
        );

        if (
            !$isAdminOrManager &&
            $meter->status === 'active' &&
            $validated['status'] === 'inactive'
        ) {
            abort(
                403,
                'Only an Administrator or Manager can deactivate a water meter.'
            );
        }

        if (
            (float) $validated['current_reading']
            < (float) $validated['initial_reading']
        ) {
            throw ValidationException::withMessages([
                'current_reading' =>
                    'Current reading cannot be lower than the initial reading.',
            ]);
        }

        if ($validated['status'] === 'active') {
            $existingActiveMeter = Meter::where('customer_id', $validated['customer_id'])
                ->where('status', 'active')
                ->where('id', '!=', $meter->id)
                ->exists();

            if ($existingActiveMeter) {
                throw ValidationException::withMessages([
                    'customer_id' =>
                        'This customer already has another active water meter. '
                        . 'Deactivate that meter before assigning this meter as active.',
                ]);
            }
        }

        unset($validated['meter_number']);

        $meter->update($validated);

        return redirect()
            ->route('meters.show', $meter)
            ->with(
                'success',
                'Meter information updated successfully.'
            );
    }

    public function destroy(Meter $meter)
    {
        /*
         * Meter deactivation is a protected administrative action.
         * Only Administrators and Managers may perform it.
         */
        if (!in_array(auth()->user()->role, ['admin', 'manager'], true)) {
            abort(
                403,
                'Only an Administrator or Manager can deactivate a water meter.'
            );
        }

        $meter->update([
            'status' => 'inactive',
        ]);

        return redirect()
            ->route('meters.index')
            ->with(
                'success',
                'Water meter deactivated successfully.'
            );
    }
}

