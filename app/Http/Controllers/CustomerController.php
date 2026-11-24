<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display all customers.
     *
     * All authenticated roles may view customers.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $customers = Customer::query()
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('full_name', 'like', '%' . $search . '%')
                        ->orWhere(
                            'customer_number',
                            'like',
                            '%' . $search . '%'
                        )
                        ->orWhere(
                            'phone_number',
                            'like',
                            '%' . $search . '%'
                        )
                        ->orWhere(
                            'id_number',
                            'like',
                            '%' . $search . '%'
                        );
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view(
            'customers.index',
            compact('customers', 'search')
        );
    }

    /**
     * Show the add customer form.
     *
     * Only Administrators may add customers.
     */
    public function create()
    {
        $this->authorizeAdministrator();

        return view('customers.create');
    }

    /**
     * Store a new customer.
     *
     * Only Administrators may create customers.
     *
     * Customer numbers are automatically generated:
     *
     * M0001
     * M0002
     * M0003
     */
    public function store(Request $request)
    {
        $this->authorizeAdministrator();

        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'id_number' => 'nullable|string|max:50',
            'phone_number' => 'required|string|max:30',
            'email' => 'nullable|email|max:255',
            'address' => 'nullable|string|max:1000',
            'area' => 'nullable|string|max:255',
            'status' => 'required|in:active,inactive',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Generate Customer Number
        |--------------------------------------------------------------------------
        |
        | Customer numbers are used as the M-PESA PayBill
        | account/reference numbers.
        |
        | They are independent from physical meter numbers.
        |
        */

        $lastCustomer = Customer::query()
            ->where('customer_number', 'like', 'M%')
            ->orderByDesc('id')
            ->first();

        if (
            $lastCustomer &&
            preg_match(
                '/^M(\d+)$/',
                $lastCustomer->customer_number,
                $matches
            )
        ) {
            $nextNumber = (int) $matches[1] + 1;
        } else {
            $nextNumber = 1;
        }

        $validated['customer_number'] =
            'M' . str_pad(
                $nextNumber,
                4,
                '0',
                STR_PAD_LEFT
            );

        $customer = Customer::create($validated);

        return redirect()
            ->route('customers.index')
            ->with(
                'success',
                'Customer registered successfully with account number ' .
                $customer->customer_number .
                '.'
            );
    }

    /**
     * Display one customer.
     *
     * All authenticated roles may view customer details.
     */
    public function show(Customer $customer)
    {
        $customer->load([
            'meter',
            'bills',
            'bills.payments',
        ]);

        return view(
            'customers.show',
            compact('customer')
        );
    }

    /**
     * Show the edit customer form.
     *
     * Only Administrators may edit customers.
     */
    public function edit(Customer $customer)
    {
        $this->authorizeAdministrator();

        return view(
            'customers.edit',
            compact('customer')
        );
    }

    /**
     * Update a customer.
     *
     * Only Administrators may update customers.
     *
     * The customer number cannot be changed
     * from the normal edit screen.
     */
    public function update(
        Request $request,
        Customer $customer
    ) {
        $this->authorizeAdministrator();

        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'id_number' => 'nullable|string|max:50',
            'phone_number' => 'required|string|max:30',
            'email' => 'nullable|email|max:255',
            'address' => 'nullable|string|max:1000',
            'area' => 'nullable|string|max:255',
            'status' => 'required|in:active,inactive',
        ]);

        $customer->update($validated);

        return redirect()
            ->route('customers.show', $customer)
            ->with(
                'success',
                'Customer information updated successfully.'
            );
    }

    /**
     * Display customer statement.
     *
     * All authenticated roles may view customer statements.
     */
    public function statement(Customer $customer)
    {
        $customer->load([
            'meter',
            'bills' => function ($query) {
                $query->orderBy('billing_date');
            },
            'bills.payments' => function ($query) {
                $query->orderBy('payment_date');
            },
        ]);

        $totalBilled = $customer->bills->sum('water_charge');

        $totalPaid = $customer->bills
            ->flatMap(function ($bill) {
                return $bill->payments;
            })
            ->sum('amount');

        $balance = $totalBilled - $totalPaid;

        return view(
            'customers.statement',
            compact(
                'customer',
                'totalBilled',
                'totalPaid',
                'balance'
            )
        );
    }

    /**
     * Deactivate a customer.
     *
     * Only Administrators may deactivate customers.
     */
    public function destroy(Customer $customer)
    {
        $this->authorizeAdministrator();

        $customer->update([
            'status' => 'inactive',
        ]);

        return redirect()
            ->route('customers.index')
            ->with(
                'success',
                'Customer deactivated successfully.'
            );
    }

    /**
     * Ensure only an Administrator can modify customer records.
     *
     * Managers and Operators can view customers,
     * but they cannot create, edit, update, or deactivate customers.
     */
    private function authorizeAdministrator(): void
    {
        if (
            !auth()->check() ||
            auth()->user()->role !== 'admin'
        ) {
            abort(
                403,
                'Only an Administrator can manage customer records.'
            );
        }
    }
}

