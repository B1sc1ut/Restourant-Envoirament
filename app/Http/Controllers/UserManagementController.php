<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UserManagementController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('user-management.index', compact('users'));
    }

    public function create()
    {
        $roles = ['user', 'waiter', 'chef'];
        if (auth()->user()->role === 'admin') {
            $roles[] = 'manager';
            $roles[] = 'admin';
        }
        return view('user-management.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $roles = ['user', 'waiter', 'chef'];
        if (auth()->user()->role === 'admin') {
            $roles[] = 'manager';
            $roles[] = 'admin';
        }

        $request->validate([
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'role' => ['required', Rule::in($roles)],
        ]);

        User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'is_blocked' => false,
        ]);

        return redirect()->route('user.management')->with('success', 'User added successfully.');
    }

    public function edit(User $user)
    {
        $roles = ['user', 'waiter', 'chef'];
        if (auth()->user()->role === 'admin') {
            $roles[] = 'manager';
            $roles[] = 'admin';
        }

        return view('user-management.edit', compact('user', 'roles'));
    }

    public function update(Request $request, $user_id)
    {
        $user = User::findOrFail($user_id);

        $roles = ['user', 'waiter', 'chef'];
        if (auth()->user()->role === 'admin') {
            $roles[] = 'manager';
            $roles[] = 'admin';
        }

        $request->validate([
            'role' => ['required', Rule::in($roles)],
        ]);

        $user->role = $request->role;
        $user->save();

        return redirect()->route('user.management')->with('success', 'User role updated successfully.');
    }

    public function toggleBlock(User $user)
    {
        $user->is_blocked = !$user->is_blocked;
        $user->save();

        return redirect()->route('user.management')->with('success', 'User status updated.');
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect()->route('user.management')->with('success', 'User deleted.');
    }

}
