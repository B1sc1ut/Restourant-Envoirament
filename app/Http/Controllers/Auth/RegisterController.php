<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        // Validate form inputs
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);
        // Create new user
        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user' // Default role
        ]);

        // Log the user in
        Auth::login($user);

        // Redirect to home page
        return redirect()->route('home');
    }
}
