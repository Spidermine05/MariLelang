<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\Auth\PetugasAuthController;
use App\Http\Controllers\Admin\AdminDashboardController;

// ── Admin Auth (publik) ───────────────────────────────────────────────────────
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get ('login',    [AdminAuthController::class, 'showLoginForm'])->name('login');
    Route::post('login',    [AdminAuthController::class, 'login'])->name('login.post');
    Route::get ('register', [AdminAuthController::class, 'showRegisterForm'])->name('register');
    Route::post('register', [AdminAuthController::class, 'register'])->name('register.post');
    Route::post('logout',   [AdminAuthController::class, 'logout'])->name('logout');
});

// ── Admin Dashboard (dilindungi middleware admin) ─────────────────────────────
Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
    Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
});

// ── Petugas Auth (publik) ─────────────────────────────────────────────────────
Route::prefix('petugas')->name('petugas.')->group(function () {
    Route::get ('login',  [PetugasAuthController::class, 'showLoginForm'])->name('login');
    Route::post('login',  [PetugasAuthController::class, 'login'])->name('login.post');
    Route::post('logout', [PetugasAuthController::class, 'logout'])->name('logout');
});

// ── Petugas Dashboard (dilindungi middleware petugas) ─────────────────────────
Route::middleware('petugas')->prefix('petugas')->name('petugas.')->group(function () {
    Route::get('dashboard', function () {
        return view('petugas.dashboard');
    })->name('dashboard');
});