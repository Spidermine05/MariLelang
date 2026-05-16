<?php

use App\Http\Controllers\Admin\AuthController;
use Illuminate\Support\Facades\Route;

// ─── Route Admin Auth (tanpa middleware) ──────────────────────────────────────
Route::prefix('admin')->name('admin.')->group(function () {

    Route::middleware('admin.guest')->group(function () {
        Route::get('/login',    [AuthController::class, 'showLogin'])->name('login');
        Route::post('/login',   [AuthController::class, 'login']);

        Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
        Route::post('/register',[AuthController::class, 'register']);
    });

    // ─── Route Admin yang dilindungi ───────────────────────────────────────
    Route::middleware('admin.auth')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');

        // Tambahkan route admin lainnya di sini
        // Route::resource('users', \App\Http\Controllers\Admin\UserController::class);
    });
});
