@extends('layouts.petugas')
@section('title', 'Laporan Lelang')

@section('content')
<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">
    <h2 style="font-size:20px; font-weight:800;">Laporan Lelang</h2>
</div>

<form method="GET" style="background:white; border-radius:12px; border:1px solid var(--border); padding:20px; margin-bottom:20px; display:flex; gap:12px; align-items:flex-end; flex-wrap:wrap;">
    <div>
        <label style="display:block; font-size:11px; font-weight:700; color:var(--text-muted); margin-bottom:4px; text-transform:uppercase;">Dari Tanggal</label>
        <input type="date" name="dari" value="{{ request('dari') }}" style="padding:8px 12px; border:1px solid var(--border); border-radius:8px; font-size:13px; font-family:inherit;">
    </div>
    <div>
        <label style="display:block; font-size:11px; font-weight:700; color:var(--text-muted); margin-bottom:4px; text-transform:uppercase;">Sampai Tanggal</label>
        <input type="date" name="sampai" value="{{ request('sampai') }}" style="padding:8px 12px; border:1px solid var(--border); border-radius:8px; font-size:13px; font-family:inherit;">
    </div>
    <button type="submit" style="padding:8px 16px; background:var(--brand); color:white; border:none; border-radius:8px; font-size:13px; font-weight:700; cursor:pointer; font-family:inherit;">Filter</button>
    <a href="{{ route('petugas.laporan.export', request()->query()) }}" style="padding:8px 16px; background:#ECFDF5; color:#059669; border-radius:8px; font-size:13px; font-weight:700; text-decoration:none;">⬇ Export PDF</a>
</form>

<div style="background:white; border-radius:12px; border:1px solid var(--border); overflow:hidden;">
    <table style="width:100%; border-collapse:collapse; font-size:13px;">
        <thead>
            <tr style="background:var(--bg);">
                <th style="padding:12px 16px; text-align:left; font-weight:700; color:var(--text-muted); font-size:11px; text-transform:uppercase;">Barang</th>
                <th style="padding:12px 16px; text-align:left; font-weight:700; color:var(--text-muted); font-size:11px; text-transform:uppercase;">Pemenang</th>
                <th style="padding:12px 16px; text-align:left; font-weight:700; color:var(--text-muted); font-size:11px; text-transform:uppercase;">Harga Akhir</th>
                <th style="padding:12px 16px; text-align:left; font-weight:700; color:var(--text-muted); font-size:11px; text-transform:uppercase;">Tanggal Selesai</th>
            </tr>
        </thead>
        <tbody>
            @forelse($lelang as $item)
            <tr style="border-top:1px solid var(--border);">
                <td style="padding:12px 16px; font-weight:700;">{{ $item->barang?->nama_barang ?? '—' }}</td>
                <td style="padding:12px 16px;">{{ $item->pemenang?->nama_lengkap ?? '—' }}</td>
                <td style="padding:12px 16px; font-weight:800; color:var(--brand);">
                    {{ $item->harga_akhir ? 'Rp ' . number_format($item->harga_akhir, 0, ',', '.') : '—' }}
                </td>
                <td style="padding:12px 16px; color:var(--text-muted);">{{ $item->updated_at?->format('d/m/Y H:i') }}</td>
            </tr>
            @empty
            <tr><td colspan="4" style="padding:40px; text-align:center; color:var(--text-muted);">Belum ada data laporan.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
<div style="margin-top:16px;">{{ $lelang->links('vendor.pagination.custom') }}</div>
@endsection
