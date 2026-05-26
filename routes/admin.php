<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\Auth\PetugasAuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PetugasController as AdminPetugasController;
use App\Http\Controllers\Admin\BarangController as AdminBarangController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\LaporanController as AdminLaporanController;
use App\Http\Controllers\Petugas\BarangController as PetugasBarangController;
use App\Http\Controllers\Petugas\LelangController as PetugasLelangController;
use App\Http\Controllers\Petugas\LaporanController as PetugasLaporanController;

// ── Admin Auth (publik) ───────────────────────────────────────────────────────
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get ('login',    [AdminAuthController::class, 'showLoginForm'])->name('login');
    Route::post('login',    [AdminAuthController::class, 'login'])->name('login.post')->middleware('throttle:login');
    Route::get ('register', [AdminAuthController::class, 'showRegisterForm'])->name('register');
    Route::post('register', [AdminAuthController::class, 'register'])->name('register.post')->middleware('throttle:login');
    Route::post('logout',   [AdminAuthController::class, 'logout'])->name('logout');
});

// ── Admin Feature (dilindungi middleware admin) ───────────────────────────────
Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
    Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Kelola User (Masyarakat)
    Route::get('users',                  [UserController::class, 'index'])->name('users.index');
    Route::get('users/{id}',             [UserController::class, 'show'])->name('users.show');
    Route::patch('users/{id}/aktivasi',  [UserController::class, 'aktivasi'])->name('users.aktivasi');
    Route::patch('users/{id}/nonaktif',  [UserController::class, 'nonaktifkan'])->name('users.nonaktif');

    // Kelola Petugas
    Route::get('petugas',                [AdminPetugasController::class, 'index'])->name('petugas.index');
    Route::get('petugas/create',         [AdminPetugasController::class, 'create'])->name('petugas.create');
    Route::post('petugas',               [AdminPetugasController::class, 'store'])->name('petugas.store');
    Route::get('petugas/{id}/edit',      [AdminPetugasController::class, 'edit'])->name('petugas.edit');
    Route::put('petugas/{id}',           [AdminPetugasController::class, 'update'])->name('petugas.update');
    Route::delete('petugas/{id}',        [AdminPetugasController::class, 'destroy'])->name('petugas.destroy');

    // Pendataan Barang
    Route::get('barang',                 [AdminBarangController::class, 'index'])->name('barang.index');
    Route::get('barang/create',          [AdminBarangController::class, 'create'])->name('barang.create');
    Route::post('barang',                [AdminBarangController::class, 'store'])->name('barang.store');
    Route::get('barang/{id}/edit',       [AdminBarangController::class, 'edit'])->name('barang.edit');
    Route::put('barang/{id}',            [AdminBarangController::class, 'update'])->name('barang.update');
    Route::delete('barang/{id}',         [AdminBarangController::class, 'destroy'])->name('barang.destroy');

    // Kelola Kategori
    Route::get('kategori',               [KategoriController::class, 'index'])->name('kategori.index');
    Route::get('kategori/create',        [KategoriController::class, 'create'])->name('kategori.create');
    Route::post('kategori',              [KategoriController::class, 'store'])->name('kategori.store');
    Route::get('kategori/{id}/edit',     [KategoriController::class, 'edit'])->name('kategori.edit');
    Route::put('kategori/{id}',          [KategoriController::class, 'update'])->name('kategori.update');
    Route::delete('kategori/{id}',       [KategoriController::class, 'destroy'])->name('kategori.destroy');

    // Laporan
    Route::get('laporan',                [AdminLaporanController::class, 'index'])->name('laporan.index');
    Route::get('laporan/export',         [AdminLaporanController::class, 'exportPdf'])->name('laporan.export')->middleware('throttle:export');
});

// ── Petugas Auth (publik) ─────────────────────────────────────────────────────
Route::prefix('petugas')->name('petugas.')->group(function () {
    Route::get ('login',  [PetugasAuthController::class, 'showLoginForm'])->name('login');
    Route::post('login',  [PetugasAuthController::class, 'login'])->name('login.post')->middleware('throttle:login');
    Route::post('logout', [PetugasAuthController::class, 'logout'])->name('logout');
});

// ── Petugas Feature (dilindungi middleware petugas) ───────────────────────────
Route::middleware('petugas')->prefix('petugas')->name('petugas.')->group(function () {
    Route::get('dashboard', function () {
        return view('petugas.dashboard');
    })->name('dashboard');

    // Pendataan Barang
    Route::get('barang',                 [PetugasBarangController::class, 'index'])->name('barang.index');
    Route::get('barang/create',          [PetugasBarangController::class, 'create'])->name('barang.create');
    Route::post('barang',                [PetugasBarangController::class, 'store'])->name('barang.store');
    Route::get('barang/{id}/edit',       [PetugasBarangController::class, 'edit'])->name('barang.edit');
    Route::put('barang/{id}',            [PetugasBarangController::class, 'update'])->name('barang.update');
    Route::delete('barang/{id}',         [PetugasBarangController::class, 'destroy'])->name('barang.destroy');

    // Manajemen Lelang
    Route::get('lelang',                 [PetugasLelangController::class, 'index'])->name('lelang.index');
    Route::get('lelang/create',          [PetugasLelangController::class, 'create'])->name('lelang.create');
    Route::post('lelang',                [PetugasLelangController::class, 'store'])->name('lelang.store');
    Route::get('lelang/{id}',            [PetugasLelangController::class, 'show'])->name('lelang.show');
    Route::patch('lelang/{id}/buka',     [PetugasLelangController::class, 'buka'])->name('lelang.buka');
    Route::patch('lelang/{id}/tutup',    [PetugasLelangController::class, 'tutup'])->name('lelang.tutup');

    // Laporan
    Route::get('laporan',                [PetugasLaporanController::class, 'index'])->name('laporan.index');
    Route::get('laporan/export',         [PetugasLaporanController::class, 'exportPdf'])->name('laporan.export')->middleware('throttle:export');
});
