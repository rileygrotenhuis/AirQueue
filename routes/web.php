<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register'])->name('register-user');
Route::post('/login', [AuthController::class, 'login'])->name('login-user');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

require __DIR__.'/ui.php';
