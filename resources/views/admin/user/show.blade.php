@extends('layouts.admin')
@section('title', 'Detail User')

@section('content')
<div style="display:flex; align-items:center; gap:12px; margin-bottom:24px;">
    <a href="{{ route('admin.users.index') }}" style="color:var(--text-muted); text-decoration:none; font-size:13px;"><i class="bi bi-arrow-left"></i> Kembali</a>
    <h2 style="font-size:20px; font-weight:800;">Detail Pengguna</h2>
</div>

<div style="display:grid; grid-template-columns:300px 1fr; gap:20px;">
    {{-- INFO CARD --}}
    <div style="background:white; border-radius:12px; border:1px solid var(--border); padding:24px; height:fit-content;">
        <div style="width:64px; height:64px; background:var(--brand); border-radius:50%; display:flex; align-items:center; justify-content:center; font-size:24px; font-weight:800; color:white; margin-bottom:16px;">
            {{ strtoupper(substr($user->nama_lengkap, 0, 1)) }}
        </div>
        <div style="font-size:18px; font-weight:800; margin-bottom:4px;">{{ $user->nama_lengkap }}</div>
        <div style="font-size:13px; color:var(--text-muted); margin-bottom:16px;">@{{ $user->username }}</div>

        @if($user->status_akun === 'aktif')
        <span style="background:#ECFDF5; color:#059669; padding:4px 12px; border-radius:50px; font-size:12px; font-weight:700; display:inline-block;">
            <i class="bi bi-check-circle-fill"></i> Aktif
        </span>
        @else
        <span style="background:#FEF2F2; color:#DC2626; padding:4px 12px; border-radius:50px; font-size:12px; font-weight:700; display:inline-block;">
            <i class="bi bi-x-circle-fill"></i> Nonaktif
        </span>
        @endif

        <div style="margin-top:20px; display:flex; flex-direction:column; gap:10px; font-size:13px;">
            <div><span style="color:var(--text-muted); font-weight:600;">Email:</span> {{ $user->email }}</div>
            <div><span style="color:var(--text-muted); font-weight:600;">Telepon:</span> {{ $user->telp ?? '—' }}</div>
            <div><span style="color:var(--text-muted); font-weight:600;">Alamat:</span> {{ $user->alamat ?? '—' }}</div>
            <div><span style="color:var(--text-muted); font-weight:600;">Bergabung:</span> {{ $user->created_at?->format('d/m/Y') }}</div>
        </div>

        {{-- Toggle Status --}}
        <div style="margin-top:20px; padding-top:16px; border-top:1px solid var(--border);">
            @if($user->status_akun === 'nonaktif')
            <form method="POST" action="{{ route('admin.users.aktivasi', $user->id_user) }}">
                @csrf @method('PATCH')
                <button type="submit" style="width:100%; padding:9px; background:#ECFDF5; color:#059669; border:1px solid #6EE7B7; border-radius:8px; font-size:13px; font-weight:700; cursor:pointer; font-family:inherit;">
                    <i class="bi bi-check-circle"></i> Aktifkan Akun
                </button>
            </form>
            @else
            <form method="POST" action="{{ route('admin.users.nonaktif', $user->id_user) }}" onsubmit="return confirm('Yakin nonaktifkan akun ini?')">
                @csrf @method('PATCH')
                <button type="submit" style="width:100%; padding:9px; background:#FEF2F2; color:#DC2626; border:1px solid #FCA5A5; border-radius:8px; font-size:13px; font-weight:700; cursor:pointer; font-family:inherit;">
                    <i class="bi bi-x-circle"></i> Nonaktifkan Akun
                </button>
            </form>
            @endif
        </div>
    </div>

    {{-- RIWAYAT PENAWARAN --}}
    <div style="background:white; border-radius:12px; border:1px solid var(--border); overflow:hidden;">
        <div style="padding:16px 20px; border-bottom:1px solid var(--border); font-size:14px; font-weight:800;">
            Riwayat Penawaran
        </div>
        <table style="width:100%; border-collapse:collapse; font-size:13px;">
            <thead>
                <tr style="background:var(--bg);">
                    <th style="padding:10px 16px; text-align:left; font-weight:700; color:var(--text-muted); font-size:11px; text-transform:uppercase;">Barang</th>
                    <th style="padding:10px 16px; text-align:left; font-weight:700; color:var(--text-muted); font-size:11px; text-transform:uppercase;">Harga Tawar</th>
                    <th style="padding:10px 16px; text-align:left; font-weight:700; color:var(--text-muted); font-size:11px; text-transform:uppercase;">Waktu</th>
                    <th style="padding:10px 16px; text-align:left; font-weight:700; color:var(--text-muted); font-size:11px; text-transform:uppercase;">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($user->penawaran as $p)
                <tr style="border-top:1px solid var(--border);">
                    <td style="padding:10px 16px; font-weight:700;">{{ $p->lelang?->barang?->nama_barang ?? '—' }}</td>
                    <td style="padding:10px 16px; font-weight:800; color:var(--brand);">Rp {{ number_format($p->harga_tawar, 0, ',', '.') }}</td>
                    <td style="padding:10px 16px; color:var(--text-muted);">{{ $p->waktu_tawar?->format('d/m/Y H:i') }}</td>
                    <td style="padding:10px 16px;">
                        @php
                        $sc = ['aktif'=>['#EEF2FF','#4F46E5'],'menang'=>['#ECFDF5','#059669'],'kalah'=>['#F1F5F9','#64748B']];
                        [$sb,$sf] = $sc[$p->status_tawar] ?? ['#F1F5F9','#64748B'];
                        @endphp
                        <span style="background:{{ $sb }}; color:{{ $sf }}; padding:3px 10px; border-radius:50px; font-size:11px; font-weight:700;">{{ ucfirst($p->status_tawar) }}</span>
                    </td>
                </tr>
                @empty
                <tr><td colspan="4" style="padding:32px; text-align:center; color:var(--text-muted);">Belum ada riwayat penawaran.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
