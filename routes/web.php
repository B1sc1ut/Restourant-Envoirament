<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\GoogleController;

Route::middleware('web')->group(function () {
    Route::get('/lang/{locale}', function ($locale) {
        if (!in_array($locale, ['en', 'lv'])) {
            abort(400);
        }
        Session::put('locale', $locale);
        return redirect()->back();
    })->name('lang.switch');

    Route::get('/', function () {
        return view('home');
    })->name('home');

    Route::get('/map', function () {
        return view('map');
    })->name('map');

    Route::get('/products', function () {
        return view('products');
    })->name('products');

    Route::get('/tables', function () {
        return view('tables');
    })->name('tables');

    Route::get('/userManagment', function () {
        return view('userManagment');
    })->name('userManagment');

    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.submit');

    Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');

    Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
    Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('/debug-session', function () {
    if (!session()->has('test')) {
        session()->put('test', 'Session is working');
        return 'Session was empty — now set!';
    }

    return 'Session test: ' . session('test');
    });

});