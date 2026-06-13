@extends('layouts.app-masyarakat')
@section('title', 'Laporan Saya')
@section('content')
<div style="padding:24px;">
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">
        <h2 style="font-size:20px; font-weight:800;">Laporan Penawaran Saya</h2>
        <a href="{{ route('masyarakat.laporan.export') }}" style="padding:8px 16px; background:#ECFDF5; color:#059669; border-radius:8px; font-size:13px; font-weight:700; text-decoration:none;"><i class="bi bi-download"></i> Export PDF</a>
    </div>

    @php
        $menang = $penawaran->where('status_tawar','menang')->count();
        $kalah  = $penawaran->where('status_tawar','kalah')->count();
        $aktif  = $penawaran->where('status_tawar','aktif')->count();
    @endphp
    <div class="stat-grid" style="grid-template-columns:repeat(3,1fr); margin-bottom:24px;">
        <div style="background:white; border-radius:12px; border:1px solid #E2E8F0; padding:20px; text-align:center;">
            <div style="font-size:28px; margin-bottom:6px;"><i class="bi bi-trophy-fill" style="color:#059669;"></i></div>
            <div style="font-size:32px; font-weight:800; color:#059669;">{{ $menang }}</div>
            <div style="font-size:12px; color:#64748B; font-weight:600; text-transform:uppercase;">Menang</div>
        </div>
        <div style="background:white; border-radius:12px; border:1px solid #E2E8F0; padding:20px; text-align:center;">
            <div style="font-size:28px; margin-bottom:6px;"><i class="bi bi-x-circle-fill" style="color:#DC2626;"></i></div>
            <div style="font-size:32px; font-weight:800; color:#DC2626;">{{ $kalah }}</div>
            <div style="font-size:12px; color:#64748B; font-weight:600; text-transform:uppercase;">Kalah</div>
        </div>
        <div style="background:white; border-radius:12px; border:1px solid #E2E8F0; padding:20px; text-align:center;">
            <div style="font-size:28px; margin-bottom:6px;"><i class="bi bi-hourglass-split" style="color:#4F46E5;"></i></div>
            <div style="font-size:32px; font-weight:800; color:#4F46E5;">{{ $aktif }}</div>
            <div style="font-size:12px; color:#64748B; font-weight:600; text-transform:uppercase;">Aktif</div>
        </div>
    </div>

    <div style="background:white; border-radius:14px; border:1px solid #E2E8F0; overflow:hidden;">
        <table style="width:100%; border-collapse:collapse; font-size:13px;">
            <thead><tr style="background:#F8FAFF;">
                @foreach(['Barang','Harga Tawar','Waktu','Status'] as $h)
                <th style="padding:12px 16px; text-align:left; font-weight:700; color:#64748B; font-size:11px; text-transform:uppercase;">{{ $h }}</th>
                @endforeach
            </tr></thead>
            <tbody>
                @forelse($penawaran as $p)
                <tr style="border-top:1px solid #E2E8F0;">
                    <td style="padding:12px 16px; font-weight:700;">{{ $p->lelang?->barang?->nama_barang ?? '—' }}</td>
                    <td style="padding:12px 16px; font-weight:800; color:#4F46E5;">Rp {{ number_format($p->harga_tawar,0,',','.') }}</td>
                    <td style="padding:12px 16px; color:#64748B;">{{ $p->waktu_tawar?->format('d/m/Y H:i') }}</td>
                    <td style="padding:12px 16px;">
                        @php $bc=['aktif'=>['#EEF2FF','#4F46E5'],'menang'=>['#ECFDF5','#059669'],'kalah'=>['#FEF2F2','#DC2626']]; [$bb,$bf]=$bc[$p->status_tawar]??['#F1F5F9','#64748B']; @endphp
                        <span style="background:{{ $bb }}; color:{{ $bf }}; padding:3px 10px; border-radius:50px; font-size:11px; font-weight:700;">{{ ucfirst($p->status_tawar) }}</span>
                    </td>
                </tr>
                @empty
                <tr><td colspan="4" style="padding:40px; text-align:center; color:#64748B;">Belum ada data.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div style="margin-top:16px;">{{ $penawaran->links('vendor.pagination.custom') }}</div>
</div>
@endsection
