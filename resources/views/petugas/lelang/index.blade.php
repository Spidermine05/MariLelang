@extends('layouts.petugas')
@section('title', 'Manajemen Lelang')

@section('content')
<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">
    <h2 style="font-size:20px; font-weight:800;">Manajemen Lelang</h2>
    <a href="{{ route('petugas.lelang.create') }}" style="padding:8px 18px; background:var(--brand); color:white; border-radius:8px; font-size:13px; font-weight:700; text-decoration:none;">+ Buat Lelang</a>
</div>

<div style="background:white; border-radius:12px; border:1px solid var(--border); overflow:hidden;">
    <table style="width:100%; border-collapse:collapse; font-size:13px;">
        <thead>
            <tr style="background:var(--bg);">
                <th style="padding:12px 16px; text-align:left; font-weight:700; color:var(--text-muted); font-size:11px; text-transform:uppercase;">Barang</th>
                <th style="padding:12px 16px; text-align:left; font-weight:700; color:var(--text-muted); font-size:11px; text-transform:uppercase;">Status</th>
                <th style="padding:12px 16px; text-align:left; font-weight:700; color:var(--text-muted); font-size:11px; text-transform:uppercase;">Waktu Mulai</th>
                <th style="padding:12px 16px; text-align:left; font-weight:700; color:var(--text-muted); font-size:11px; text-transform:uppercase;">Waktu Selesai</th>
                <th style="padding:12px 16px; text-align:left; font-weight:700; color:var(--text-muted); font-size:11px; text-transform:uppercase;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($lelang as $item)
            @php
                $statusMap = [
                    'dibuka'=>['#EFF6FF','#2563EB','<i class="bi bi-circle-fill"></i> Dibuka'],
                    'berlangsung'=>['#ECFDF5','#059669','<i class="bi bi-circle-fill"></i> Berlangsung'],
                    'ditutup'=>['#F1F5F9','#64748B','<i class="bi bi-circle-fill"></i> Ditutup']
                ];
                [$bg,$fg,$label] = $statusMap[$item->status] ?? ['#F1F5F9','#64748B',$item->status];
            @endphp
            <tr style="border-top:1px solid var(--border);">
                <td style="padding:12px 16px; font-weight:700;">{{ $item->barang?->nama_barang ?? '—' }}</td>
                <td style="padding:12px 16px;">
                    <span style="background:{{ $bg }}; color:{{ $fg }}; padding:3px 10px; border-radius:50px; font-size:11px; font-weight:700;">{!! $label !!}</span>
                </td>
                <td style="padding:12px 16px; color:var(--text-muted);">{{ $item->waktu_mulai?->format('d/m/Y H:i') ?? '—' }}</td>
                <td style="padding:12px 16px; color:var(--text-muted);">{{ $item->waktu_selesai?->format('d/m/Y H:i') ?? '—' }}</td>
                <td style="padding:12px 16px;">
                    <div style="display:flex; gap:6px; flex-wrap:wrap;">
                        <a href="{{ route('petugas.lelang.show', $item->id_lelang) }}" style="padding:5px 10px; background:#EEF2FF; color:var(--brand); border-radius:6px; font-size:12px; font-weight:700; text-decoration:none;">Detail</a>
                        @if($item->status === 'dibuka')
                        <form method="POST" action="{{ route('petugas.lelang.buka', $item->id_lelang) }}">
                            @csrf @method('PATCH')
                            <button type="submit" style="padding:5px 10px; background:#ECFDF5; color:#059669; border:none; border-radius:6px; font-size:12px; font-weight:700; cursor:pointer; font-family:inherit;">Buka</button>
                        </form>
                        @elseif($item->status === 'berlangsung')
                        <form method="POST" action="{{ route('petugas.lelang.tutup', $item->id_lelang) }}" onsubmit="return confirm('Tutup lelang ini sekarang?')">
                            @csrf @method('PATCH')
                            <button type="submit" style="padding:5px 10px; background:#FEF2F2; color:#DC2626; border:none; border-radius:6px; font-size:12px; font-weight:700; cursor:pointer; font-family:inherit;">Tutup</button>
                        </form>
                        @endif
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="5" style="padding:40px; text-align:center; color:var(--text-muted);">Belum ada lelang.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
<div style="margin-top:16px;">{{ $lelang->links() }}</div>
@endsection
