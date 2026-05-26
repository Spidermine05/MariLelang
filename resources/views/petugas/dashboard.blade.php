@extends('layouts.petugas')
@section('title', 'Dashboard Petugas')

@section('content')
@php
    $petugas = auth('petugas')->user();
    $totalBarang   = \App\Models\Barang::where('id_petugas', $petugas->id_petugas)->count();
    $lelangAktif   = \App\Models\Lelang::where('id_petugas', $petugas->id_petugas)->where('status','berlangsung')->count();
    $lelangSelesai = \App\Models\Lelang::where('id_petugas', $petugas->id_petugas)->where('status','ditutup')->whereDate('updated_at', today())->count();
@endphp

<div class="page-header" style="border-radius:12px; margin-bottom:24px;">
    <h1>Dashboard Petugas</h1>
    <p>Selamat datang, {{ $petugas->nama_petugas }} · {{ now()->translatedFormat('l, d F Y') }}</p>
</div>

<div class="stat-grid" style="grid-template-columns:repeat(3,1fr); margin-bottom:28px;">
    <div class="stat-card blue">
        <div class="stat-icon blue"><i class="bi bi-box-seam"></i></div>
        <div class="stat-label">Total Barang Saya</div>
        <div class="stat-value">{{ $totalBarang }}</div>
    </div>
    <div class="stat-card green">
        <div class="stat-icon green"><i class="bi bi-hammer"></i></div>
        <div class="stat-label">Lelang Berlangsung</div>
        <div class="stat-value">{{ $lelangAktif }}</div>
    </div>
    <div class="stat-card amber">
        <div class="stat-icon amber"><i class="bi bi-check-circle-fill"></i></div>
        <div class="stat-label">Selesai Hari Ini</div>
        <div class="stat-value">{{ $lelangSelesai }}</div>
    </div>
</div>

<div class="action-grid" style="grid-template-columns:repeat(3,1fr);">
    <a href="{{ route('petugas.barang.index') }}" class="action-card">
        <div class="action-icon"><i class="bi bi-box-seam"></i></div>
        <span class="action-label">Pendataan Barang</span>
    </a>
    <a href="{{ route('petugas.lelang.index') }}" class="action-card">
        <div class="action-icon"><i class="bi bi-hammer"></i></div>
        <span class="action-label">Manajemen Lelang</span>
    </a>
    <a href="{{ route('petugas.laporan.index') }}" class="action-card">
        <div class="action-icon"><i class="bi bi-file-earmark-text"></i></div>
        <span class="action-label">Generate Laporan</span>
    </a>
</div>
@endsection
