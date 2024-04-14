<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BandController;
use App\Http\Controllers\BandInvitationController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::middleware('auth:web')->group(function () {
    Route::get('/', function () {
        return Inertia::render('Index');
    })->name('home');

    Route::prefix('bands')->group(function () {
        Route::get('/', [BandController::class, 'index'])->name('bands.index');
        Route::post('/', [BandController::class, 'store'])->name('bands.store');
        Route::get('/create', [BandController::class, 'create'])->name('bands.create');

        Route::get('/{band}', [BandController::class, 'show'])->name('bands.show');
        Route::put('/{band}', [BandController::class, 'update'])->name('bands.update');
        Route::get('/{band}/settings', [BandController::class, 'settings'])->name('bands.settings');

        Route::get('/invitations', [BandInvitationController::class, 'index'])->name('bands.invitations');
        Route::post('/invitations/{bandUser}/accept', [BandInvitationController::class, 'accept'])->name('bands.invitations.accept');
        Route::post('/invitations/{bandUser}/reject', [BandInvitationController::class, 'reject'])->name('bands.invitations.reject');
        Route::post('/{band}/invite/{user}', [BandInvitationController::class, 'invite'])->name('bands.invite');
    });
});

Route::get('/register', function () {
    return Inertia::render('Register');
})->name('register');

Route::get('/login', function () {
    return Inertia::render('Login');
})->name('login');

Route::post('/register', [AuthController::class, 'register'])->name('register-user');
Route::post('/login', [AuthController::class, 'login'])->name('login-user');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
