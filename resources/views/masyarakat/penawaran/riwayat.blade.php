@extends('layouts.app-masyarakat')
@section('title', 'Riwayat Penawaran')
@section('content')
<div style="padding:24px;">
    <h2 style="font-size:20px; font-weight:800; margin-bottom:20px;">Riwayat Penawaran Saya</h2>
    <div style="background:white; border-radius:14px; border:1px solid #E2E8F0; overflow:hidden;">
        <table style="width:100%; border-collapse:collapse; font-size:13px;">
            <thead><tr style="background:#F8FAFF;">
                @foreach(['Barang','Harga Tawar','Waktu','Status Lelang','Status Bid'] as $h)
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
                        @php $sc=['dibuka'=>['#EFF6FF','#2563EB'],'berlangsung'=>['#ECFDF5','#059669'],'ditutup'=>['#F1F5F9','#64748B']]; [$sb,$sf]=$sc[$p->lelang?->status??'ditutup']??['#F1F5F9','#64748B']; @endphp
                        <span style="background:{{ $sb }}; color:{{ $sf }}; padding:3px 10px; border-radius:50px; font-size:11px; font-weight:700;">{{ ucfirst($p->lelang?->status ?? '—') }}</span>
                    </td>
                    <td style="padding:12px 16px;">
                        @php $bc=['aktif'=>['#EEF2FF','#4F46E5'],'menang'=>['#ECFDF5','#059669'],'kalah'=>['#FEF2F2','#DC2626']]; [$bb,$bf]=$bc[$p->status_tawar]??['#F1F5F9','#64748B']; @endphp
                        <span style="background:{{ $bb }}; color:{{ $bf }}; padding:3px 10px; border-radius:50px; font-size:11px; font-weight:700;">{{ ucfirst($p->status_tawar) }}</span>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" style="padding:40px; text-align:center; color:#64748B;">Belum ada riwayat penawaran.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div style="margin-top:16px;">{{ $penawaran->links() }}</div>
</div>
@endsection
