<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin — MariLelang</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    @vite('resources/css/admin/dashboard.css')
</head>
<body>

{{-- NAVBAR --}}
<nav class="navbar">
    <a href="{{ route('admin.dashboard') }}" class="navbar-brand">
        <div class="navbar-logo">ML</div>
        <span class="navbar-title">MariLelang</span>
    </a>
    <div class="navbar-right">
        <div class="navbar-admin">
            <div class="navbar-avatar">{{ strtoupper(substr($admin->nama_petugas, 0, 1)) }}</div>
            <span class="navbar-admin-name">{{ $admin->nama_petugas }}</span>
        </div>
        <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button type="submit" class="btn-logout">Logout</button>
        </form>
    </div>
</nav>

{{-- PAGE HEADER --}}
<div class="page-header">
    <h1>Dashboard Admin</h1>
    <p>Selamat datang, {{ $admin->nama_petugas }} · {{ now()->translatedFormat('l, d F Y') }}</p>
</div>

{{-- MAIN --}}
<div class="main">

    {{-- STATISTIK --}}
    <div class="two-col">

        {{-- Pengguna --}}
        <div>
            <div class="grp-title">Pengguna</div>
            <div class="stat-grid">
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
        </div>

        {{-- Barang --}}
        <div>
            <div class="grp-title">Barang</div>
            <div class="stat-grid">
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
        </div>

    </div>

    {{-- MENU --}}
    <div class="menu-title">Menu</div>
    <div class="action-grid">
        <a href="#" class="action-card">
            <div class="action-icon">
                <svg width="26" height="26" viewBox="0 0 24 24" fill="none">
                    <path d="M9 17H5a2 2 0 00-2 2v2h18v-2a2 2 0 00-2-2h-4M9 17V9m0 8h6M15 17V9M9 9H5l2-5h10l2 5h-4M9 9h6" stroke="#4F46E5" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
            <span class="action-label">Generate Laporan</span>
        </a>
        <a href="#" class="action-card">
            <div class="action-icon">
                <svg width="26" height="26" viewBox="0 0 24 24" fill="none">
                    <rect x="3" y="3" width="18" height="18" rx="3" stroke="#4F46E5" stroke-width="1.8"/>
                    <path d="M3 9h18M9 21V9" stroke="#4F46E5" stroke-width="1.8" stroke-linecap="round"/>
                </svg>
            </div>
            <span class="action-label">Pendataan Barang</span>
        </a>
        <a href="#" class="action-card">
            <div class="action-icon">
                <svg width="26" height="26" viewBox="0 0 24 24" fill="none">
                    <circle cx="9" cy="7" r="4" stroke="#4F46E5" stroke-width="1.8"/>
                    <path d="M3 21v-2a4 4 0 014-4h4a4 4 0 014 4v2" stroke="#4F46E5" stroke-width="1.8" stroke-linecap="round"/>
                    <path d="M16 11l2 2 4-4" stroke="#4F46E5" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
            <span class="action-label">Kelola User</span>
        </a>
        <a href="#" class="action-card">
            <div class="action-icon">
                <svg width="26" height="26" viewBox="0 0 24 24" fill="none">
                    <circle cx="12" cy="8" r="4" stroke="#4F46E5" stroke-width="1.8"/>
                    <path d="M4 20v-1a4 4 0 014-4h8a4 4 0 014 4v1" stroke="#4F46E5" stroke-width="1.8" stroke-linecap="round"/>
                    <path d="M19 3v6M16 6h6" stroke="#4F46E5" stroke-width="1.8" stroke-linecap="round"/>
                </svg>
            </div>
            <span class="action-label">Tambah Petugas</span>
        </a>
    </div>

    {{-- FOOTER --}}
    <div class="footer">
        &copy; {{ date('Y') }} <span>MariLelang</span> by <strong>PERINTIS TEAM</strong>. All rights reserved.
    </div>

</div>

</body>
</html>