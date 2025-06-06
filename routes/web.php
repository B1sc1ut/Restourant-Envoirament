<?php

use Illuminate\Support\Facades\Route;

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

