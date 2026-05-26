<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Petugas') — MariLelang</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    @vite(['resources/css/admin/dashboard.css'])
</head>
<body style="display:flex; flex-direction:column; min-height:100vh;">

{{-- NAVBAR --}}
<nav class="navbar">
    <a href="{{ route('petugas.dashboard') }}" class="navbar-brand">
        <div class="navbar-logo">ML</div>
        <span class="navbar-title">MariLelang</span>
    </a>
    <div class="navbar-right">
        <div class="navbar-admin">
            <div class="navbar-avatar">{{ strtoupper(substr(auth('petugas')->user()->nama_petugas, 0, 1)) }}</div>
            <span class="navbar-admin-name">{{ auth('petugas')->user()->nama_petugas }}</span>
        </div>
        <form method="POST" action="{{ route('petugas.logout') }}">
            @csrf
            <button type="submit" class="btn-logout">Logout</button>
        </form>
    </div>
</nav>

<div style="display:flex; flex:1;">
    {{-- SIDEBAR --}}
    <aside style="width:220px; background:#fff; border-right:1px solid var(--border); padding:24px 0; flex-shrink:0; position:sticky; top:60px; height:calc(100vh - 60px); overflow-y:auto;">
        @php $r = request()->routeIs(...) @endphp
        <nav style="display:flex; flex-direction:column; gap:4px; padding:0 12px;">
            <a href="{{ route('petugas.dashboard') }}" style="display:flex; align-items:center; gap:10px; padding:10px 12px; border-radius:8px; font-size:13px; font-weight:600; text-decoration:none; color:{{ request()->routeIs('petugas.dashboard') ? 'var(--brand)' : 'var(--text-muted)' }}; background:{{ request()->routeIs('petugas.dashboard') ? 'var(--brand-light)' : 'transparent' }};">
                <i class="bi bi-bar-chart-fill"></i> Dashboard
            </a>
            <a href="{{ route('petugas.barang.index') }}" style="display:flex; align-items:center; gap:10px; padding:10px 12px; border-radius:8px; font-size:13px; font-weight:600; text-decoration:none; color:{{ request()->routeIs('petugas.barang.*') ? 'var(--brand)' : 'var(--text-muted)' }}; background:{{ request()->routeIs('petugas.barang.*') ? 'var(--brand-light)' : 'transparent' }};">
                <i class="bi bi-box-seam"></i> Pendataan Barang
            </a>
            <a href="{{ route('petugas.lelang.index') }}" style="display:flex; align-items:center; gap:10px; padding:10px 12px; border-radius:8px; font-size:13px; font-weight:600; text-decoration:none; color:{{ request()->routeIs('petugas.lelang.*') ? 'var(--brand)' : 'var(--text-muted)' }}; background:{{ request()->routeIs('petugas.lelang.*') ? 'var(--brand-light)' : 'transparent' }};">
                <i class="bi bi-hammer"></i> Manajemen Lelang
            </a>
            <a href="{{ route('petugas.laporan.index') }}" style="display:flex; align-items:center; gap:10px; padding:10px 12px; border-radius:8px; font-size:13px; font-weight:600; text-decoration:none; color:{{ request()->routeIs('petugas.laporan.*') ? 'var(--brand)' : 'var(--text-muted)' }}; background:{{ request()->routeIs('petugas.laporan.*') ? 'var(--brand-light)' : 'transparent' }};">
                <i class="bi bi-file-earmark-text"></i> Laporan
            </a>
        </nav>
    </aside>

    {{-- CONTENT --}}
    <main style="flex:1; padding:28px; overflow-x:auto;">
        @if(session('success'))
        <div style="background:#ECFDF5; border:1px solid #6EE7B7; color:#065F46; padding:12px 16px; border-radius:8px; margin-bottom:20px; font-size:13px; font-weight:600;">
            <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
        </div>
        @endif
        @if(session('error'))
        <div style="background:#FEF2F2; border:1px solid #FCA5A5; color:#991B1B; padding:12px 16px; border-radius:8px; margin-bottom:20px; font-size:13px; font-weight:600;">
            <i class="bi bi-x-circle-fill"></i> {{ session('error') }}
        </div>
        @endif
        @yield('content')
        <div style="margin-top:auto; padding:16px 0; text-align:center; font-size:11px; color:var(--text-muted); border-top:1px solid var(--border);">
            &copy; {{ date('Y') }} <strong style="color:var(--brand);">MariLelang</strong> by PERINTIS TEAM. All rights reserved.
        </div>
    </main>
</div>

</body>
</html>
