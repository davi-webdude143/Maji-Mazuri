<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display all system users.
     *
     * Administrators and Managers may view the user list.
     */
    public function index()
    {
        $users = User::orderBy('name')->get();

        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new user.
     *
     * Only Administrators may create users.
     */
    public function create()
    {
        $this->authorizeAdministrator();

        return view('users.create');
    }

    /**
     * Store a new user.
     *
     * Only Administrators may create users.
     */
    public function store(Request $request)
    {
        $this->authorizeAdministrator();

        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:users,email',
            ],

            'role' => [
                'required',
                Rule::in(['admin', 'manager', 'operator']),
            ],

            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
            ],
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'role' => $validated['role'],
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()
            ->route('users.index')
            ->with('success', 'User created successfully.');
    }

    /**
     * Show the form for editing a user.
     *
     * Only Administrators may edit users.
     */
    public function edit(User $user)
    {
        $this->authorizeAdministrator();

        return view('users.edit', compact('user'));
    }

    /**
     * Update an existing user.
     *
     * Only Administrators may update users.
     */
    public function update(Request $request, User $user)
    {
        $this->authorizeAdministrator();

        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($user->id),
            ],

            'role' => [
                'required',
                Rule::in(['admin', 'manager', 'operator']),
            ],

            'password' => [
                'nullable',
                'string',
                'min:8',
                'confirmed',
            ],
        ]);

        /*
         * Prevent the last administrator from
         * losing administrator privileges.
         */
        if (
            $user->role === 'admin' &&
            $validated['role'] !== 'admin' &&
            User::where('role', 'admin')->count() <= 1
        ) {
            return back()
                ->withInput()
                ->withErrors([
                    'role' => 'The system must always have at least one administrator.',
                ]);
        }

        /*
         * Update basic account information.
         */
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->role = $validated['role'];

        /*
         * Only change the password when
         * a new password was provided.
         */
        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        return redirect()
            ->route('users.index')
            ->with('success', 'User updated successfully.');
    }

    /**
     * Delete a user.
     *
     * Only Administrators may delete users.
     */
    public function destroy(User $user)
    {
        $this->authorizeAdministrator();

        /*
         * Prevent the currently logged-in user
         * from deleting their own account.
         */
        if ($user->id === auth()->id()) {
            return back()->withErrors([
                'user' => 'You cannot delete your own account.',
            ]);
        }

        /*
         * Prevent deletion of the last administrator.
         */
        if (
            $user->role === 'admin' &&
            User::where('role', 'admin')->count() <= 1
        ) {
            return back()->withErrors([
                'user' => 'The last administrator cannot be deleted.',
            ]);
        }

        $user->delete();

        return redirect()
            ->route('users.index')
            ->with('success', 'User deleted successfully.');
    }

    /**
     * Ensure only an Administrator can manage user accounts.
     *
     * Managers may view the user list but cannot create,
     * edit, or delete users.
     */
    private function authorizeAdministrator(): void
    {
        if (
            !auth()->check() ||
            auth()->user()->role !== 'admin'
        ) {
            abort(
                403,
                'Only an Administrator can manage user accounts.'
            );
        }
    }
}

