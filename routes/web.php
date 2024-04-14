<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BandController;
use App\Http\Controllers\BandInvitationController;
use App\Http\Controllers\LiveSessionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::middleware('auth:web')->get('/', function (Request $request) {
    $liveSessions = $request->user()->liveSessions;

    return Inertia::render('Landing/Index', [
        'liveSessions' => $liveSessions->load('host', 'band', 'members'),
    ]);
})->name('home');

Route::middleware('auth:web')->prefix('bands')->group(function () {
    Route::get('/', [BandController::class, 'index'])->name('bands.index');
    Route::post('/', [BandController::class, 'store'])->name('bands.store');
    Route::get('/create', [BandController::class, 'create'])->name('bands.create');

    Route::get('/invitations', [BandInvitationController::class, 'index'])->name('bands.invitations');
    Route::post('/invitations/{bandUser}/accept', [BandInvitationController::class, 'accept'])->name('bands.invitations.accept');
    Route::post('/invitations/{bandUser}/reject', [BandInvitationController::class, 'reject'])->name('bands.invitations.reject');
    Route::post('/{band}/invite', [BandInvitationController::class, 'invite'])->name('bands.invite');

    Route::get('/{band}', [BandController::class, 'show'])->name('bands.show');
    Route::put('/{band}', [BandController::class, 'update'])->name('bands.update');

    Route::delete('/{band}/members/{bandUser}/remove', [BandController::class, 'removeMember'])->name('bands.members.remove');
});

Route::middleware('auth:web')->prefix('live-sessions')->group(function () {
    Route::post('/', [LiveSessionController::class, 'store'])->name('live-sessions.store');
    Route::post('/join', [LiveSessionController::class, 'join'])->name('live-sessions.join');

    Route::get('/{liveSession}', [LiveSessionController::class, 'show'])->name('live-sessions.show');
    Route::delete('/{liveSession}', [LiveSessionController::class, 'destroy'])->name('live-sessions.destroy');
});

Route::post('/register', [AuthController::class, 'register'])->name('register-user');
Route::get('/register', function () {
    return Inertia::render('Register');
})->name('register');

Route::post('/login', [AuthController::class, 'login'])->name('login-user');
Route::get('/login', function () {
    return Inertia::render('Login');
})->name('login');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
