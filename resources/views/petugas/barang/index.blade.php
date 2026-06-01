@extends('layouts.petugas')
@section('title', 'Pendataan Barang')

@section('content')
<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">
    <h2 style="font-size:20px; font-weight:800;">Pendataan Barang</h2>
    <a href="{{ route('petugas.barang.create') }}" class="btn-logout" style="background:var(--brand); border-color:var(--brand); text-decoration:none; padding:8px 18px; border-radius:8px; font-size:13px; font-weight:700; color:white;">+ Tambah Barang</a>
</div>

<form method="GET" style="margin-bottom:16px; display:flex; gap:8px;">
    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama barang..." style="padding:8px 12px; border:1px solid var(--border); border-radius:8px; font-size:13px; flex:1; font-family:inherit;">
    <button type="submit" style="padding:8px 16px; background:var(--brand); color:white; border:none; border-radius:8px; font-size:13px; font-weight:700; cursor:pointer; font-family:inherit;">Cari</button>
</form>

<div style="background:white; border-radius:12px; border:1px solid var(--border); overflow:hidden;">
    <table style="width:100%; border-collapse:collapse; font-size:13px;">
        <thead>
            <tr style="background:var(--bg);">
                <th style="padding:12px 16px; text-align:left; font-weight:700; color:var(--text-muted); font-size:11px; text-transform:uppercase; letter-spacing:.5px;">ID</th>
                <th style="padding:12px 16px; text-align:left; font-weight:700; color:var(--text-muted); font-size:11px; text-transform:uppercase; letter-spacing:.5px;">Foto</th>
                <th style="padding:12px 16px; text-align:left; font-weight:700; color:var(--text-muted); font-size:11px; text-transform:uppercase; letter-spacing:.5px;">Nama Barang</th>
                <th style="padding:12px 16px; text-align:left; font-weight:700; color:var(--text-muted); font-size:11px; text-transform:uppercase; letter-spacing:.5px;">Kategori</th>
                <th style="padding:12px 16px; text-align:left; font-weight:700; color:var(--text-muted); font-size:11px; text-transform:uppercase; letter-spacing:.5px;">Harga Awal</th>
                <th style="padding:12px 16px; text-align:left; font-weight:700; color:var(--text-muted); font-size:11px; text-transform:uppercase; letter-spacing:.5px;">Status</th>
                <th style="padding:12px 16px; text-align:left; font-weight:700; color:var(--text-muted); font-size:11px; text-transform:uppercase; letter-spacing:.5px;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($barang as $item)
            <tr style="border-top:1px solid var(--border);">
                <td style="padding:12px 16px; font-weight:700; color:var(--text-muted); font-size:12px;">{{ str_pad($item->id_barang,4,'0',STR_PAD_LEFT) }}</td>
                <td style="padding:12px 16px;">
                    <img src="{{ $item->foto_url }}" alt="" style="width:48px; height:48px; object-fit:cover; border-radius:8px; border:1px solid var(--border);">
                </td>
                <td style="padding:12px 16px; font-weight:700;">{{ $item->nama_barang }}</td>
                <td style="padding:12px 16px; color:var(--text-muted);">{{ $item->kategori?->nama_kategori ?? '—' }}</td>
                <td style="padding:12px 16px; font-weight:700;">Rp {{ number_format($item->harga_awal, 0, ',', '.') }}</td>
                <td style="padding:12px 16px;">
                    @php $colors = ['tersedia'=>'#EEF2FF:#4F46E5','dilelang'=>'#FFFBEB:#D97706','terjual'=>'#ECFDF5:#059669']; [$bg,$fg] = explode(':', $colors[$item->status_barang] ?? '#F1F5F9:#64748B'); @endphp
                    <span style="background:{{ $bg }}; color:{{ $fg }}; padding:3px 10px; border-radius:50px; font-size:11px; font-weight:700;">{{ ucfirst($item->status_barang) }}</span>
                </td>
                <td style="padding:12px 16px;">
                    <div style="display:flex; gap:6px;">
                        <a href="{{ route('petugas.barang.edit', $item->id_barang) }}" style="padding:5px 12px; background:#EEF2FF; color:var(--brand); border-radius:6px; font-size:12px; font-weight:700; text-decoration:none;">Edit</a>
                        @if($item->status_barang === 'tersedia')
                        <form method="POST" action="{{ route('petugas.barang.destroy', $item->id_barang) }}" onsubmit="return confirm('Hapus barang ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" style="padding:5px 12px; background:#FEF2F2; color:#DC2626; border:none; border-radius:6px; font-size:12px; font-weight:700; cursor:pointer; font-family:inherit;">Hapus</button>
                        </form>
                        @endif
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="6" style="padding:40px; text-align:center; color:var(--text-muted);">Belum ada barang.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
<div style="margin-top:16px;">{{ $barang->links('vendor.pagination.custom') }}</div>
@endsection