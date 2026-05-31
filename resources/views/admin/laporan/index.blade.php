@extends('layouts.admin')
@section('title', 'Laporan Global')

@section('content')
<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">
    <h2 style="font-size:20px; font-weight:800;">Laporan Global</h2>
</div>

{{-- STAT CARDS --}}
<div style="display:grid; grid-template-columns:repeat(4,1fr); gap:14px; margin-bottom:28px;">
    <div class="stat-card indigo">
        <div class="stat-icon indigo"><i class="bi bi-hammer"></i></div>
        <div class="stat-label">Total Lelang</div>
        <div class="stat-value">{{ $stats['total_lelang'] }}</div>
    </div>
    <div class="stat-card green">
        <div class="stat-icon green"><i class="bi bi-check-circle-fill"></i></div>
        <div class="stat-label">Lelang Selesai</div>
        <div class="stat-value">{{ $stats['lelang_selesai'] }}</div>
    </div>
    <div class="stat-card blue">
        <div class="stat-icon blue"><i class="bi bi-box-seam"></i></div>
        <div class="stat-label">Total Barang</div>
        <div class="stat-value">{{ $stats['total_barang'] }}</div>
    </div>
    <div class="stat-card amber">
        <div class="stat-icon amber"><i class="bi bi-cash-stack"></i></div>
        <div class="stat-label">Total Transaksi</div>
        <div class="stat-value" style="font-size:18px;">Rp {{ number_format($stats['total_transaksi'],0,',','.') }}</div>
    </div>
</div>

{{-- FILTER + EXPORT --}}
<form method="GET" style="background:white; border-radius:12px; border:1px solid var(--border); padding:20px; margin-bottom:20px; display:flex; gap:12px; align-items:flex-end; flex-wrap:wrap;">
    <div>
        <label style="display:block; font-size:11px; font-weight:700; color:var(--text-muted); margin-bottom:4px; text-transform:uppercase;">Bulan</label>
        <select name="bulan" style="padding:8px 12px; border:1px solid var(--border); border-radius:8px; font-size:13px; font-family:inherit;">
            <option value="">Semua Bulan</option>
            @foreach(range(1,12) as $m)
            <option value="{{ $m }}" {{ request('bulan') == $m ? 'selected' : '' }}>{{ \Carbon\Carbon::create()->month($m)->translatedFormat('F') }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label style="display:block; font-size:11px; font-weight:700; color:var(--text-muted); margin-bottom:4px; text-transform:uppercase;">Tahun</label>
        <select name="tahun" style="padding:8px 12px; border:1px solid var(--border); border-radius:8px; font-size:13px; font-family:inherit;">
            <option value="">Semua Tahun</option>
            @foreach(range(date('Y'), date('Y')-3) as $y)
            <option value="{{ $y }}" {{ request('tahun') == $y ? 'selected' : '' }}>{{ $y }}</option>
            @endforeach
        </select>
    </div>
    <button type="submit" style="padding:8px 16px; background:var(--brand); color:white; border:none; border-radius:8px; font-size:13px; font-weight:700; cursor:pointer; font-family:inherit;">
        <i class="bi bi-funnel"></i> Filter
    </button>
    <a href="{{ route('admin.laporan.export', request()->query()) }}" style="padding:8px 16px; background:#ECFDF5; color:#059669; border-radius:8px; font-size:13px; font-weight:700; text-decoration:none; border:1px solid #6EE7B7;">
        <i class="bi bi-download"></i> Export PDF
    </a>
</form>

{{-- TABLE --}}
<div style="background:white; border-radius:12px; border:1px solid var(--border); overflow:hidden;">
    <table style="width:100%; border-collapse:collapse; font-size:13px;">
        <thead>
            <tr style="background:var(--bg);">
                @foreach(['Barang','Petugas','Pemenang','Harga Akhir','Tanggal Selesai'] as $h)
                <th style="padding:12px 16px; text-align:left; font-weight:700; color:var(--text-muted); font-size:11px; text-transform:uppercase;">{{ $h }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @forelse($lelang as $item)
            <tr style="border-top:1px solid var(--border);">
                <td style="padding:12px 16px; font-weight:700;">{{ $item->barang?->nama_barang ?? '—' }}</td>
                <td style="padding:12px 16px; color:var(--text-muted);">{{ $item->petugas?->nama_petugas ?? '—' }}</td>
                <td style="padding:12px 16px;">{{ $item->pemenang?->nama_lengkap ?? '—' }}</td>
                <td style="padding:12px 16px; font-weight:800; color:var(--brand);">
                    {{ $item->harga_akhir ? 'Rp '.number_format($item->harga_akhir,0,',','.') : '—' }}
                </td>
                <td style="padding:12px 16px; color:var(--text-muted);">{{ $item->updated_at?->format('d/m/Y H:i') }}</td>
            </tr>
            @empty
            <tr><td colspan="5" style="padding:40px; text-align:center; color:var(--text-muted);">Belum ada data lelang selesai.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
<div style="margin-top:16px;">{{ $lelang->withQueryString()->links() }}</div>
@endsection
