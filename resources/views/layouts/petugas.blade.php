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
        <button type="button" class="btn-logout" onclick="document.getElementById('modal-logout').style.display='flex'">Logout</button>
    </div>
</nav>

{{-- MODAL LOGOUT --}}
<div id="modal-logout" style="display:none; position:fixed; inset:0; background:rgba(0,0,0,.45); z-index:9999; align-items:center; justify-content:center;">
    <div style="background:white; border-radius:20px; padding:36px 32px; width:100%; max-width:360px; text-align:center; box-shadow:0 20px 60px rgba(0,0,0,.2);">
        <div style="width:64px; height:64px; background:#FEE2E2; border-radius:50%; display:flex; align-items:center; justify-content:center; margin:0 auto 20px; font-size:28px; color:#EF4444;">
            <i class="bi bi-box-arrow-right"></i>
        </div>
        <h3 style="font-size:18px; font-weight:800; color:#0F172A; margin-bottom:8px;">Apa Anda yakin untuk logout?</h3>
        <p style="font-size:13px; color:#64748B; margin-bottom:28px;">Sesi Anda akan diakhiri dan Anda perlu login kembali.</p>
        <div style="display:flex; gap:10px;">
            <button onclick="document.getElementById('modal-logout').style.display='none'" style="flex:1; padding:11px; border:1.5px solid #E2E8F0; border-radius:10px; font-size:14px; font-weight:700; color:#64748B; background:white; cursor:pointer; font-family:inherit;">Batal</button>
            <form method="POST" action="{{ route('petugas.logout') }}" style="flex:1;">
                @csrf
                <button type="submit" style="width:100%; padding:11px; border:none; border-radius:10px; font-size:14px; font-weight:700; color:white; background:#EF4444; cursor:pointer; font-family:inherit;">Logout</button>
            </form>
        </div>
    </div>
</div>

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