@extends('layouts.admin')
@section('title', 'Dashboard Admin')

@section('content')

{{-- WELCOME BANNER --}}
<div style="background:linear-gradient(135deg, var(--brand) 0%, var(--brand-dark) 100%); border-radius:16px; padding:28px 32px; margin-bottom:28px; color:white;">
    <h1 style="font-size:22px; font-weight:800; margin-bottom:4px;">Dashboard Admin</h1>
    <p style="font-size:13px; opacity:.75;">Selamat datang, {{ $admin->nama_petugas }} · {{ now()->translatedFormat('l, d F Y') }}</p>
</div>

{{-- STAT CARDS - PENGGUNA --}}
<div style="font-size:11px; font-weight:700; color:var(--text-muted); text-transform:uppercase; letter-spacing:.8px; margin-bottom:10px;">Pengguna</div>
<div style="display:grid; grid-template-columns:repeat(3,1fr); gap:14px; margin-bottom:24px;">
    <div class="stat-card indigo">
        <div class="stat-icon indigo"><i class="bi bi-people-fill"></i></div>
        <div class="stat-label">Total</div>
        <div class="stat-value">{{ $stats['total_user'] }}</div>
    </div>
    <div class="stat-card green">
        <div class="stat-icon green"><i class="bi bi-check-circle-fill"></i></div>
        <div class="stat-label">Aktif</div>
        <div class="stat-value">{{ $stats['user_aktif'] }}</div>
    </div>
    <div class="stat-card red">
        <div class="stat-icon red"><i class="bi bi-x-circle-fill"></i></div>
        <div class="stat-label">Nonaktif</div>
        <div class="stat-value">{{ $stats['user_nonaktif'] }}</div>
    </div>
</div>

{{-- STAT CARDS - BARANG --}}
<div style="font-size:11px; font-weight:700; color:var(--text-muted); text-transform:uppercase; letter-spacing:.8px; margin-bottom:10px;">Barang</div>
<div style="display:grid; grid-template-columns:repeat(3,1fr); gap:14px; margin-bottom:28px;">
    <div class="stat-card blue">
        <div class="stat-icon blue"><i class="bi bi-box-seam"></i></div>
        <div class="stat-label">Total</div>
        <div class="stat-value">{{ $stats['total_barang'] }}</div>
    </div>
    <div class="stat-card amber">
        <div class="stat-icon amber"><i class="bi bi-tag-fill"></i></div>
        <div class="stat-label">Lelang</div>
        <div class="stat-value">{{ $stats['barang_dilelang'] }}</div>
    </div>
    <div class="stat-card green">
        <div class="stat-icon green"><i class="bi bi-trophy-fill"></i></div>
        <div class="stat-label">Terjual</div>
        <div class="stat-value">{{ $stats['barang_terjual'] }}</div>
    </div>
</div>

{{-- MENU SHORTCUTS --}}
<div style="font-size:11px; font-weight:700; color:var(--text-muted); text-transform:uppercase; letter-spacing:.8px; margin-bottom:10px;">Menu</div>
<div class="action-grid">
    <a href="{{ route('admin.laporan.index') }}" class="action-card">
        <div class="action-icon"><i class="bi bi-file-earmark-bar-graph" style="font-size:22px;"></i></div>
        <span class="action-label">Generate Laporan</span>
    </a>
    <a href="{{ route('admin.barang.index') }}" class="action-card">
        <div class="action-icon"><i class="bi bi-box-seam" style="font-size:22px;"></i></div>
        <span class="action-label">Pendataan Barang</span>
    </a>
    <a href="{{ route('admin.users.index') }}" class="action-card">
        <div class="action-icon"><i class="bi bi-people-fill" style="font-size:22px;"></i></div>
        <span class="action-label">Kelola User</span>
    </a>
    <a href="{{ route('admin.petugas.create') }}" class="action-card">
        <div class="action-icon"><i class="bi bi-person-plus-fill" style="font-size:22px;"></i></div>
        <span class="action-label">Tambah Petugas</span>
    </a>
</div>

@endsection
