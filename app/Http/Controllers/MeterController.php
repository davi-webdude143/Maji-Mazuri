<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Meter;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class MeterController extends Controller
{
    /**
     * Display a listing of meters.
     */
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

    /**
     * Show the meter registration form.
     */
    public function create()
    {
        $customers = Customer::where('status', 'active')
            ->orderBy('full_name')
            ->get();

        return view('meters.create', compact('customers'));
    }

    /**
     * Store a newly registered meter.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'installation_date' => 'nullable|date',
            'initial_reading' => 'required|numeric|min:0',
            'status' => 'required|in:active,inactive',
        ]);

        /*
         * Prevent a customer from having more than one active meter.
         */
        if ($validated['status'] === 'active') {
            $existingActiveMeter = Meter::where(
                'customer_id',
                $validated['customer_id']
            )
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

        /*
         * Generate the next physical meter number.
         */
        $lastMeter = Meter::where('meter_number', 'like', 'MTR-%')
            ->orderByRaw(
                "CAST(SUBSTRING(meter_number, 5) AS UNSIGNED) DESC"
            )
            ->first();

        $nextNumber = $lastMeter
            ? ((int) substr($lastMeter->meter_number, 4)) + 1
            : 1;

        $meterNumber = 'MTR-' . str_pad(
            $nextNumber,
            4,
            '0',
            STR_PAD_LEFT
        );

        $validated['meter_number'] = $meterNumber;

        /*
         * A newly registered meter starts with the same
         * initial and current reading.
         */
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

    /**
     * Display a specific meter.
     */
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

    /**
     * Show the meter edit form.
     *
     * Admin:
     * - Can edit everything.
     *
     * Manager:
     * - Cannot edit meter number.
     * - Cannot edit initial reading.
     * - Cannot edit current reading.
     * - Cannot edit maximum reading.
     * - May edit permitted general information.
     *
     * Operator:
     * - Cannot edit meter number.
     * - Cannot edit initial reading.
     * - Cannot edit current reading.
     * - Cannot edit maximum reading.
     * - Cannot deactivate an active meter.
     */
    public function edit(Meter $meter)
    {
        $customers = Customer::where('status', 'active')
            ->orderBy('full_name')
            ->get();

        /*
         * Keep the current meter's customer available even if
         * the customer is no longer active.
         */
        if (
            $meter->customer &&
            !$customers->contains('id', $meter->customer_id)
        ) {
            $customers->push($meter->customer);
        }

        /*
         * Normalize the user's role.
         */
        $userRole = strtolower(
            trim((string) auth()->user()->role)
        );

        $isAdmin = $userRole === 'admin';

        return view(
            'meters.edit',
            compact(
                'meter',
                'customers',
                'isAdmin'
            )
        );
    }

    /**
     * Update meter information.
     *
     * ADMIN:
     * Can edit all meter fields.
     *
     * MANAGER / OPERATOR:
     * Cannot modify:
     * - Meter Number
     * - Initial Reading
     * - Current Reading
     * - Maximum Reading
     *
     * Manager may still change permitted general information
     * and deactivate meters.
     *
     * Operator may not deactivate an active meter.
     */
    public function update(Request $request, Meter $meter)
    {
        /*
         * Normalize role.
         */
        $userRole = strtolower(
            trim((string) auth()->user()->role)
        );

        $isAdmin = $userRole === 'admin';

        $isAdminOrManager = in_array(
            $userRole,
            ['admin', 'manager'],
            true
        );

        /*
         * -------------------------------------------------------------
         * ADMIN UPDATE
         * -------------------------------------------------------------
         *
         * Admin has full control over the meter.
         */
        if ($isAdmin) {
            $validated = $request->validate([
                'customer_id' => 'required|exists:customers,id',
                'meter_number' => [
                    'required',
                    'string',
                    'max:255',
                    'unique:meters,meter_number,' . $meter->id,
                ],
                'installation_date' => 'nullable|date',
                'initial_reading' => 'required|numeric|min:0',
                'current_reading' => 'required|numeric|min:0',
                'maximum_reading' => 'nullable|numeric|min:0',
                'status' => 'required|in:active,inactive',
            ]);

            /*
             * Current reading cannot be lower than initial reading.
             */
            if (
                (float) $validated['current_reading'] <
                (float) $validated['initial_reading']
            ) {
                throw ValidationException::withMessages([
                    'current_reading' =>
                        'Current reading cannot be lower than the initial reading.',
                ]);
            }

            /*
             * If maximum reading is provided, current reading
             * cannot exceed it.
             */
            if (
                isset($validated['maximum_reading']) &&
                $validated['maximum_reading'] !== null &&
                (float) $validated['current_reading'] >
                (float) $validated['maximum_reading']
            ) {
                throw ValidationException::withMessages([
                    'current_reading' =>
                        'Current reading cannot be greater than the maximum meter reading.',
                ]);
            }

            /*
             * Prevent duplicate active meters for the same customer.
             */
            if ($validated['status'] === 'active') {
                $existingActiveMeter = Meter::where(
                    'customer_id',
                    $validated['customer_id']
                )
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

            /*
             * Admin can update EVERYTHING.
             */
            $meter->update([
                'customer_id' => $validated['customer_id'],
                'meter_number' => $validated['meter_number'],
                'installation_date' =>
                    $validated['installation_date'] ?? null,
                'initial_reading' => $validated['initial_reading'],
                'current_reading' => $validated['current_reading'],
                'maximum_reading' =>
                    $validated['maximum_reading'] ?? null,
                'status' => $validated['status'],
            ]);

            return redirect()
                ->route('meters.show', $meter)
                ->with(
                    'success',
                    'Meter information updated successfully.'
                );
        }

        /*
         * -------------------------------------------------------------
         * MANAGER / OPERATOR UPDATE
         * -------------------------------------------------------------
         *
         * Protected fields are intentionally NOT accepted.
         */
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'installation_date' => 'nullable|date',
            'initial_reading' => 'required|numeric|min:0',
            'status' => 'required|in:active,inactive',
        ]);

        /*
         * -------------------------------------------------------------
         * INITIAL READING — PROTECTED
         * -------------------------------------------------------------
         *
         * Manager and Operator cannot change it.
         */
        if (
            (float) $validated['initial_reading'] !==
            (float) $meter->initial_reading
        ) {
            abort(
                403,
                'Only an Administrator can edit the initial meter reading.'
            );
        }

        /*
         * -------------------------------------------------------------
         * CURRENT READING — PROTECTED
         * -------------------------------------------------------------
         *
         * current_reading is NOT accepted or updated for Manager
         * or Operator.
         */

        /*
         * -------------------------------------------------------------
         * MAXIMUM READING — PROTECTED
         * -------------------------------------------------------------
         *
         * maximum_reading is NOT accepted or updated for Manager
         * or Operator.
         */

        /*
         * -------------------------------------------------------------
         * METER NUMBER — PROTECTED
         * -------------------------------------------------------------
         *
         * meter_number is NOT accepted or updated for Manager
         * or Operator.
         */

        /*
         * -------------------------------------------------------------
         * OPERATOR DEACTIVATION PROTECTION
         * -------------------------------------------------------------
         */
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

        /*
         * Initial reading must not be greater than the current
         * database reading.
         */
        if (
            (float) $validated['initial_reading'] >
            (float) $meter->current_reading
        ) {
            throw ValidationException::withMessages([
                'initial_reading' =>
                    'Initial reading cannot be greater than the current meter reading.',
            ]);
        }

        /*
         * Prevent assigning another active meter to a customer
         * who already has one.
         */
        if ($validated['status'] === 'active') {
            $existingActiveMeter = Meter::where(
                'customer_id',
                $validated['customer_id']
            )
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

        /*
         * Manager / Operator can update only permitted fields.
         *
         * Notice that:
         *
         * meter_number       -> NOT changed
         * current_reading    -> NOT changed
         * maximum_reading    -> NOT changed
         * initial_reading    -> verified unchanged above
         */
        $meter->update([
            'customer_id' => $validated['customer_id'],
            'installation_date' =>
                $validated['installation_date'] ?? null,
            'status' => $validated['status'],
        ]);

        return redirect()
            ->route('meters.show', $meter)
            ->with(
                'success',
                'Meter information updated successfully.'
            );
    }

    /**
     * Deactivate a meter.
     *
     * Admin and Manager only.
     */
    public function destroy(Meter $meter)
    {
        $userRole = strtolower(
            trim((string) auth()->user()->role)
        );

        if (!in_array($userRole, ['admin', 'manager'], true)) {
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

