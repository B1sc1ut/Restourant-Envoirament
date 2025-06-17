<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserManagementController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('userManagement.index', compact('users'));
    }

    public function create()
    {
        return view('userManagement.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'role' => 'required|in:user,waiter,chef,manager,admin'
        ]);

        $currentUser = Auth::user();

        // Managers cannot create managers or admins
        if ($currentUser->role === 'manager' && in_array($request->role, ['manager', 'admin'])) {
            return back()->withErrors(['You do not have permission to assign this role.']);
        }

        User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role
        ]);

        return redirect()->route('user.management')->with('success', 'User created successfully.');
    }
}
