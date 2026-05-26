@extends('layouts.admin')
@section('title', 'Kelola Kategori')
@section('content')
<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">
    <h2 style="font-size:20px; font-weight:800;">Kelola Kategori</h2>
    <a href="{{ route('admin.kategori.create') }}" style="padding:8px 18px; background:var(--brand); color:white; border-radius:8px; font-size:13px; font-weight:700; text-decoration:none;">+ Tambah Kategori</a>
</div>
<div style="background:white; border-radius:12px; border:1px solid var(--border); overflow:hidden;">
    <table style="width:100%; border-collapse:collapse; font-size:13px;">
        <thead><tr style="background:var(--bg);">
            <th style="padding:12px 16px; text-align:left; font-weight:700; color:var(--text-muted); font-size:11px; text-transform:uppercase;">Nama Kategori</th>
            <th style="padding:12px 16px; text-align:left; font-weight:700; color:var(--text-muted); font-size:11px; text-transform:uppercase;">Deskripsi</th>
            <th style="padding:12px 16px; text-align:left; font-weight:700; color:var(--text-muted); font-size:11px; text-transform:uppercase;">Jumlah Barang</th>
            <th style="padding:12px 16px; text-align:left; font-weight:700; color:var(--text-muted); font-size:11px; text-transform:uppercase;">Aksi</th>
        </tr></thead>
        <tbody>
            @forelse($kategori as $k)
            <tr style="border-top:1px solid var(--border);">
                <td style="padding:12px 16px; font-weight:700;">{{ $k->nama_kategori }}</td>
                <td style="padding:12px 16px; color:var(--text-muted);">{{ $k->deskripsi_kategori ?? '—' }}</td>
                <td style="padding:12px 16px;"><span style="background:#EEF2FF; color:var(--brand); padding:3px 10px; border-radius:50px; font-size:12px; font-weight:700;">{{ $k->barang_count }}</span></td>
                <td style="padding:12px 16px;">
                    <div style="display:flex; gap:6px;">
                        <a href="{{ route('admin.kategori.edit', $k->id_kategori) }}" style="padding:5px 10px; background:#EEF2FF; color:var(--brand); border-radius:6px; font-size:12px; font-weight:700; text-decoration:none;">Edit</a>
                        <form method="POST" action="{{ route('admin.kategori.destroy', $k->id_kategori) }}" onsubmit="return confirm('Hapus kategori ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" style="padding:5px 10px; background:#FEF2F2; color:#DC2626; border:none; border-radius:6px; font-size:12px; font-weight:700; cursor:pointer; font-family:inherit;">Hapus</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="4" style="padding:40px; text-align:center; color:var(--text-muted);">Belum ada kategori.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
<div style="margin-top:16px;">{{ $kategori->links() }}</div>
@endsection
