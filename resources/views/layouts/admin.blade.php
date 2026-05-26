<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') — MariLelang</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    @vite(['resources/css/admin/dashboard.css'])
</head>
<body style="display:flex; flex-direction:column; min-height:100vh;">

<nav class="navbar">
    <a href="{{ route('admin.dashboard') }}" class="navbar-brand">
        <div class="navbar-logo">ML</div>
        <span class="navbar-title">MariLelang</span>
    </a>
    <div class="navbar-right">
        <div class="navbar-admin">
            <div class="navbar-avatar">{{ strtoupper(substr(auth('petugas')->user()->nama_petugas, 0, 1)) }}</div>
            <span class="navbar-admin-name">{{ auth('petugas')->user()->nama_petugas }}</span>
        </div>
        <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button type="submit" class="btn-logout">Logout</button>
        </form>
    </div>
</nav>

<div style="display:flex; flex:1;">
    <aside style="width:220px; background:#fff; border-right:1px solid var(--border); padding:24px 0; flex-shrink:0; position:sticky; top:60px; height:calc(100vh - 60px); overflow-y:auto;">
        <nav style="display:flex; flex-direction:column; gap:4px; padding:0 12px;">
            @php
            $links = [
                ['route'=>'admin.dashboard',      'icon'=>'<i class="bi bi-bar-chart-fill"></i>', 'label'=>'Dashboard',       'match'=>'admin.dashboard'],
                ['route'=>'admin.users.index',     'icon'=>'<i class="bi bi-people-fill"></i>', 'label'=>'Kelola User',      'match'=>'admin.users.*'],
                ['route'=>'admin.petugas.index',   'icon'=>'<i class="bi bi-person-badge-fill"></i>', 'label'=>'Kelola Petugas',   'match'=>'admin.petugas.*'],
                ['route'=>'admin.barang.index',    'icon'=>'<i class="bi bi-box-seam"></i>', 'label'=>'Pendataan Barang', 'match'=>'admin.barang.*'],
                ['route'=>'admin.kategori.index',  'icon'=>'<i class="bi bi-tag-fill"></i>', 'label'=>'Kategori',         'match'=>'admin.kategori.*'],
                ['route'=>'admin.laporan.index',   'icon'=>'<i class="bi bi-file-earmark-text"></i>', 'label'=>'Laporan',          'match'=>'admin.laporan.*'],
            ];
            @endphp
            @foreach($links as $link)
            @php $active = request()->routeIs($link['match']); @endphp
            <a href="{{ route($link['route']) }}" style="display:flex; align-items:center; gap:10px; padding:10px 12px; border-radius:8px; font-size:13px; font-weight:600; text-decoration:none; color:{{ $active ? 'var(--brand)' : 'var(--text-muted)' }}; background:{{ $active ? 'var(--brand-light)' : 'transparent' }};">
                {{ $link['icon'] }} {{ $link['label'] }}
            </a>
            @endforeach
        </nav>
    </aside>

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
