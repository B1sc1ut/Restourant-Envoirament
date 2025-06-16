<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Hash;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();

            $user = User::firstOrCreate(
                ['email' => $googleUser->getEmail()],
                [
                    'password' => Hash::make(uniqid()), // Assign random password
                    'role' => 'user', // Default role
                ]
            );

            Auth::login($user);

            return redirect()->route('home');

        } catch (\Exception $e) {
            return redirect()->route('login')->withErrors(['email' => 'Google login failed.']);
        }
    }
}
