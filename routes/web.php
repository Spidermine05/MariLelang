<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\MasyarakatAuthController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\Masyarakat\DashboardController as MasyarakatDashboardController;
use App\Http\Controllers\Masyarakat\LelangController as MasyarakatLelangController;
use App\Http\Controllers\Masyarakat\PenawaranController;
use App\Http\Controllers\Masyarakat\LaporanController as MasyarakatLaporanController;
use App\Http\Controllers\Masyarakat\ProfilController;

// ── Landing Page ──────────────────────────────────────────────────────────────
Route::get('/', [LandingController::class, 'index'])->name('landing');

// ── Static Pages ──────────────────────────────────────────────────────────────
Route::get('/kontak', fn() => view('static.kontak'))->name('static.kontak');
Route::get('/kebijakan-privasi', fn() => view('static.kebijakan-privasi'))->name('static.kebijakan');
Route::get('/bantuan', fn() => view('static.bantuan'))->name('static.bantuan');

// ── Masyarakat Auth (publik) ──────────────────────────────────────────────────
Route::prefix('masyarakat')->name('masyarakat.')->group(function () {
    Route::get('/login',     [MasyarakatAuthController::class, 'showLogin'])->name('login');
    Route::post('/login',    [MasyarakatAuthController::class, 'login'])->middleware('throttle:login');
    Route::get('/register',  [MasyarakatAuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [MasyarakatAuthController::class, 'register'])->middleware('throttle:login');
    Route::post('/logout',   [MasyarakatAuthController::class, 'logout'])->name('logout')->middleware('auth:masyarakat');
});

// ── Masyarakat Feature (dilindungi) ──────────────────────────────────────────
Route::prefix('masyarakat')->name('masyarakat.')->middleware('auth:masyarakat')->group(function () {
    Route::get('/dashboard', [MasyarakatDashboardController::class, 'index'])->name('dashboard');

    // Lelang
    Route::get('/lelang',           [MasyarakatLelangController::class, 'index'])->name('lelang.index');
    Route::get('/lelang/search',    [MasyarakatLelangController::class, 'search'])->name('lelang.search');
    Route::get('/lelang/{id}',      [MasyarakatLelangController::class, 'show'])->name('lelang.show');

    // Penawaran
    Route::post('/lelang/{id}/bid', [PenawaranController::class, 'store'])->name('penawaran.store')->middleware('throttle:bid');
    Route::get('/riwayat',          [PenawaranController::class, 'riwayat'])->name('penawaran.riwayat');

    // Laporan
    Route::get('/laporan',          [MasyarakatLaporanController::class, 'index'])->name('laporan.index');
    Route::get('/laporan/export',   [MasyarakatLaporanController::class, 'exportPdf'])->name('laporan.export')->middleware('throttle:export');
    Route::get('/profil',           [ProfilController::class, 'edit'])->name('profil.edit');
    Route::put('/profil',           [ProfilController::class, 'update'])->name('profil.update');
});