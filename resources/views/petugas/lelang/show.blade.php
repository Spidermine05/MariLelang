@extends('layouts.petugas')
@section('title', 'Detail Lelang')

@section('content')
<div style="display:flex; align-items:center; gap:12px; margin-bottom:24px;">
    <a href="{{ route('petugas.lelang.index') }}" style="color:var(--text-muted); text-decoration:none; font-size:13px;"><i class="bi bi-arrow-left"></i> Kembali</a>
    <h2 style="font-size:20px; font-weight:800;">Detail Lelang</h2>
</div>

<div style="display:grid; grid-template-columns:1fr 1fr; gap:20px; margin-bottom:24px;">
    <div style="background:white; border-radius:12px; border:1px solid var(--border); padding:24px;">
        <h3 style="font-size:14px; font-weight:800; margin-bottom:16px; color:var(--text-muted); text-transform:uppercase; letter-spacing:.5px;">Info Barang</h3>
        <img src="{{ $lelang->barang->foto_url }}" style="width:100%; height:160px; object-fit:cover; border-radius:8px; margin-bottom:12px;">
        <div style="font-size:16px; font-weight:800; margin-bottom:4px;">{{ $lelang->barang->nama_barang }}</div>
        <div style="font-size:13px; color:var(--text-muted);">{{ $lelang->barang->deskripsi_barang }}</div>
        <div style="margin-top:12px; font-size:14px; font-weight:700;">Harga Awal: <span style="color:var(--brand);">Rp {{ number_format($lelang->barang->harga_awal, 0, ',', '.') }}</span></div>
    </div>
    <div style="background:white; border-radius:12px; border:1px solid var(--border); padding:24px;">
        <h3 style="font-size:14px; font-weight:800; margin-bottom:16px; color:var(--text-muted); text-transform:uppercase; letter-spacing:.5px;">Info Lelang</h3>
        <div style="display:flex; flex-direction:column; gap:10px; font-size:13px;">
            <div><span style="color:var(--text-muted);">Status:</span> <strong>{{ ucfirst($lelang->status) }}</strong></div>
            <div><span style="color:var(--text-muted);">Waktu Mulai:</span> <strong>{{ $lelang->waktu_mulai?->format('d/m/Y H:i') }}</strong></div>
            <div><span style="color:var(--text-muted);">Waktu Selesai:</span> <strong>{{ $lelang->waktu_selesai?->format('d/m/Y H:i') }}</strong></div>
            <div><span style="color:var(--text-muted);">Min. Kenaikan Bid:</span> <strong>Rp {{ number_format($lelang->harga_minimal_bid, 0, ',', '.') }}</strong></div>
            <div><span style="color:var(--text-muted);">Total Penawaran:</span> <strong>{{ $lelang->penawaran->count() }}</strong></div>
            @if($lelang->harga_akhir)
            <div><span style="color:var(--text-muted);">Harga Akhir:</span> <strong style="color:var(--brand);">Rp {{ number_format($lelang->harga_akhir, 0, ',', '.') }}</strong></div>
            @endif
        </div>
    </div>
</div>

<div style="background:white; border-radius:12px; border:1px solid var(--border); overflow:hidden;">
    <div style="padding:16px 20px; border-bottom:1px solid var(--border); font-size:14px; font-weight:800;">Daftar Penawaran</div>
    <table style="width:100%; border-collapse:collapse; font-size:13px;">
        <thead>
            <tr style="background:var(--bg);">
                <th style="padding:10px 16px; text-align:left; font-weight:700; color:var(--text-muted); font-size:11px; text-transform:uppercase;">#</th>
                <th style="padding:10px 16px; text-align:left; font-weight:700; color:var(--text-muted); font-size:11px; text-transform:uppercase;">Peserta</th>
                <th style="padding:10px 16px; text-align:left; font-weight:700; color:var(--text-muted); font-size:11px; text-transform:uppercase;">Harga Tawar</th>
                <th style="padding:10px 16px; text-align:left; font-weight:700; color:var(--text-muted); font-size:11px; text-transform:uppercase;">Waktu</th>
                <th style="padding:10px 16px; text-align:left; font-weight:700; color:var(--text-muted); font-size:11px; text-transform:uppercase;">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($lelang->penawaran->sortByDesc('harga_tawar') as $i => $p)
            <tr style="border-top:1px solid var(--border); {{ $i === 0 ? 'background:#FFFBEB;' : '' }}">
                <td style="padding:10px 16px; color:var(--text-muted);">{{ $i + 1 }}</td>
                <td style="padding:10px 16px; font-weight:700;">{{ $p->masyarakat?->nama_lengkap ?? '—' }}</td>
                <td style="padding:10px 16px; font-weight:800; color:{{ $i === 0 ? '#D97706' : 'var(--text)' }};">Rp {{ number_format($p->harga_tawar, 0, ',', '.') }}</td>
                <td style="padding:10px 16px; color:var(--text-muted);">{{ $p->waktu_tawar?->format('d/m H:i:s') }}</td>
                <td style="padding:10px 16px;">
                    @php $sc = ['aktif'=>['#EEF2FF','#4F46E5'],'menang'=>['#ECFDF5','#059669'],'kalah'=>['#F1F5F9','#64748B']]; [$sb,$sf] = $sc[$p->status_tawar] ?? ['#F1F5F9','#64748B']; @endphp
                    <span style="background:{{ $sb }}; color:{{ $sf }}; padding:3px 10px; border-radius:50px; font-size:11px; font-weight:700;">{{ ucfirst($p->status_tawar) }}</span>
                </td>
            </tr>
            @empty
            <tr><td colspan="5" style="padding:32px; text-align:center; color:var(--text-muted);">Belum ada penawaran.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
