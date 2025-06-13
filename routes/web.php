<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

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

    Route::get('/about', function () {
        return view('about');
    })->name('about');

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

    Route::get('/login', function () {
        return view('auth.login');
    })->name('login');

    Route::get('/register', function () {
        return view('auth.register');
    })->name('register');

    Route::get('/debug-session', function () {
    if (!session()->has('test')) {
        session()->put('test', 'Session is working');
        return 'Session was empty — now set!';
    }

    return '✅ Session test: ' . session('test');
});

});