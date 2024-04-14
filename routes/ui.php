<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::middleware('auth:web')->group(function () {
    Route::get('/', function () {
        return Inertia::render('Index');
    })->name('home');
});

Route::get('/register', function () {
    return Inertia::render('Register');
})->name('register');

Route::get('/login', function () {
    return Inertia::render('Login');
})->name('login');
