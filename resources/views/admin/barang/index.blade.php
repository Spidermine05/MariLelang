@extends('layouts.admin')
@section('title', 'Pendataan Barang')

@section('content')
<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">
    <h2 style="font-size:20px; font-weight:800;">Pendataan Barang</h2>
    <a href="{{ route('admin.barang.create') }}" style="padding:8px 18px; background:var(--brand); color:white; border-radius:8px; font-size:13px; font-weight:700; text-decoration:none;">
        <i class="bi bi-plus-lg"></i> Tambah Barang
    </a>
</div>

{{-- SEARCH --}}
<form method="GET" style="margin-bottom:16px; display:flex; gap:8px;">
    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama barang..." style="padding:8px 12px; border:1px solid var(--border); border-radius:8px; font-size:13px; flex:1; font-family:inherit;">
    <button type="submit" style="padding:8px 16px; background:var(--brand); color:white; border:none; border-radius:8px; font-size:13px; font-weight:700; cursor:pointer; font-family:inherit;">Cari</button>
    @if(request('search'))
    <a href="{{ route('admin.barang.index') }}" style="padding:8px 14px; background:#F1F5F9; color:var(--text-muted); border-radius:8px; font-size:13px; font-weight:700; text-decoration:none;">Reset</a>
    @endif
</form>

<div style="background:white; border-radius:12px; border:1px solid var(--border); overflow:hidden;">
    <table style="width:100%; border-collapse:collapse; font-size:13px;">
        <thead>
            <tr style="background:var(--bg);">
                @foreach(['ID','Foto','Nama Barang','Kategori','Petugas','Harga Awal','Status','Aksi'] as $h)
                <th style="padding:12px 16px; text-align:left; font-weight:700; color:var(--text-muted); font-size:11px; text-transform:uppercase;">{{ $h }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @forelse($barang as $item)
            <tr style="border-top:1px solid var(--border);">
                <td style="padding:12px 16px; font-weight:700; color:var(--text-muted); font-size:12px;">{{ str_pad($item->id_barang,4,'0',STR_PAD_LEFT) }}</td>
                <td style="padding:12px 16px; width:68px;">
                    <img src="{{ $item->foto_url }}" style="width:44px; height:44px; min-width:44px; max-width:44px; object-fit:cover; border-radius:6px; border:1px solid var(--border); display:block;">
                </td>
                <td style="padding:12px 16px; font-weight:700;">{{ $item->nama_barang }}</td>
                <td style="padding:12px 16px; color:var(--text-muted);">{{ $item->kategori?->nama_kategori ?? '—' }}</td>
                <td style="padding:12px 16px; color:var(--text-muted);">{{ $item->petugas?->nama_petugas ?? '—' }}</td>
                <td style="padding:12px 16px; font-weight:700;">Rp {{ number_format($item->harga_awal,0,',','.') }}</td>
                <td style="padding:12px 16px;">
                    @php
                    $c = ['tersedia'=>['#EEF2FF','#4F46E5'],'dilelang'=>['#FFFBEB','#D97706'],'terjual'=>['#ECFDF5','#059669']];
                    [$bg,$fg] = $c[$item->status_barang] ?? ['#F1F5F9','#64748B'];
                    @endphp
                    <span style="background:{{ $bg }}; color:{{ $fg }}; padding:3px 10px; border-radius:50px; font-size:11px; font-weight:700;">{{ ucfirst($item->status_barang) }}</span>
                </td>
                <td style="padding:12px 16px;">
                    <div style="display:flex; gap:6px;">
                        <a href="{{ route('admin.barang.edit', $item->id_barang) }}" style="padding:5px 10px; background:#EEF2FF; color:var(--brand); border-radius:6px; font-size:12px; font-weight:700; text-decoration:none;">Edit</a>
                        @if($item->status_barang === 'tersedia')
                        <button type="button"
                            onclick="bukaMHapus('{{ route('admin.barang.destroy', $item->id_barang) }}')"
                            style="padding:5px 10px; background:#FEF2F2; color:#DC2626; border:none; border-radius:6px; font-size:12px; font-weight:700; cursor:pointer; font-family:inherit;">Hapus</button>
                        @endif
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="7" style="padding:40px; text-align:center; color:var(--text-muted);">Belum ada barang.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
<div style="margin-top:16px;">{{ $barang->withQueryString()->links('vendor.pagination.custom') }}</div>

{{-- MODAL HAPUS BARANG --}}
<div id="modal-hapus" style="display:none; position:fixed; inset:0; background:rgba(0,0,0,.45); z-index:9999; align-items:center; justify-content:center;">
    <div style="background:white; border-radius:20px; padding:36px 32px; width:100%; max-width:360px; text-align:center; box-shadow:0 20px 60px rgba(0,0,0,.2);">
        <div style="width:64px; height:64px; background:#FEE2E2; border-radius:50%; display:flex; align-items:center; justify-content:center; margin:0 auto 20px; font-size:28px; color:#EF4444;">
            <i class="bi bi-trash3"></i>
        </div>
        <h3 style="font-size:18px; font-weight:800; color:#0F172A; margin-bottom:8px;">Hapus Barang?</h3>
        <p style="font-size:13px; color:#64748B; margin-bottom:28px;">Data barang akan dihapus secara permanen dan tidak dapat dikembalikan.</p>
        <div style="display:flex; gap:10px;">
            <button onclick="document.getElementById('modal-hapus').style.display='none'" style="flex:1; padding:11px; border:1.5px solid #E2E8F0; border-radius:10px; font-size:14px; font-weight:700; color:#64748B; background:white; cursor:pointer; font-family:inherit;">Batal</button>
            <form id="form-hapus" method="POST" style="flex:1;">
                @csrf @method('DELETE')
                <button type="submit" style="width:100%; padding:11px; border:none; border-radius:10px; font-size:14px; font-weight:700; color:white; background:#EF4444; cursor:pointer; font-family:inherit;">
                    <i class="bi bi-trash3"></i> Hapus
                </button>
            </form>
        </div>
    </div>
</div>

<script>
function bukaMHapus(url) {
    document.getElementById('form-hapus').action = url;
    document.getElementById('modal-hapus').style.display = 'flex';
}
document.getElementById('modal-hapus').addEventListener('click', function(e) {
    if (e.target === this) this.style.display = 'none';
});
</script>
@endsection