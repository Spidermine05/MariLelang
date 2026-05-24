<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\MasyarakatAuthController;

Route::get('/', function () {
    return redirect()->route('masyarakat.login');
});

Route::prefix('masyarakat')->name('masyarakat.')->group(function () {
    Route::get('/login',     [MasyarakatAuthController::class, 'showLogin'])->name('login');
    Route::post('/login',    [MasyarakatAuthController::class, 'login']);
    Route::get('/register',  [MasyarakatAuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [MasyarakatAuthController::class, 'register']);
    Route::post('/logout',   [MasyarakatAuthController::class, 'logout'])->name('logout')->middleware('auth:masyarakat');
    Route::get('/dashboard', function () {
        return view('auth.masyarakat.dashboard');
    })->name('dashboard')->middleware('auth:masyarakat');
});