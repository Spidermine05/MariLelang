@extends('layouts.app-masyarakat')
@section('title', 'Cari Lelang')
@section('content')
<div style="padding:24px; display:grid; grid-template-columns:260px 1fr; gap:24px; align-items:start;">
    {{-- Filter Sidebar --}}
    <div style="background:white; border-radius:14px; border:1px solid #E2E8F0; padding:20px; position:sticky; top:80px;">
        <h3 style="font-size:14px; font-weight:800; margin-bottom:16px;">Filter Pencarian</h3>
        <form method="GET" action="{{ route('masyarakat.lelang.search') }}">
            <div style="margin-bottom:14px;">
                <label style="display:block; font-size:11px; font-weight:700; color:#64748B; margin-bottom:6px; text-transform:uppercase;">Kata Kunci</label>
                <input type="text" name="q" value="{{ request('q') }}" placeholder="Nama barang..." style="width:100%; padding:8px 10px; border:1px solid #E2E8F0; border-radius:8px; font-size:13px; font-family:inherit;">
            </div>
            <div style="margin-bottom:14px;">
                <label style="display:block; font-size:11px; font-weight:700; color:#64748B; margin-bottom:6px; text-transform:uppercase;">Kategori</label>
                <select name="id_kategori" style="width:100%; padding:8px 10px; border:1px solid #E2E8F0; border-radius:8px; font-size:13px; font-family:inherit;">
                    <option value="">Semua Kategori</option>
                    @foreach($kategori as $k)
                    <option value="{{ $k->id_kategori }}" {{ request('id_kategori') == $k->id_kategori ? 'selected' : '' }}>{{ $k->nama_kategori }}</option>
                    @endforeach
                </select>
            </div>
            <div style="margin-bottom:14px;">
                <label style="display:block; font-size:11px; font-weight:700; color:#64748B; margin-bottom:6px; text-transform:uppercase;">Harga Min (Rp)</label>
                <input type="number" name="harga_min" value="{{ request('harga_min') }}" min="0" style="width:100%; padding:8px 10px; border:1px solid #E2E8F0; border-radius:8px; font-size:13px; font-family:inherit;">
            </div>
            <div style="margin-bottom:20px;">
                <label style="display:block; font-size:11px; font-weight:700; color:#64748B; margin-bottom:6px; text-transform:uppercase;">Harga Max (Rp)</label>
                <input type="number" name="harga_max" value="{{ request('harga_max') }}" min="0" style="width:100%; padding:8px 10px; border:1px solid #E2E8F0; border-radius:8px; font-size:13px; font-family:inherit;">
            </div>
            <button type="submit" style="width:100%; padding:10px; background:#4F46E5; color:white; border:none; border-radius:8px; font-size:13px; font-weight:700; cursor:pointer; font-family:inherit;">Cari</button>
            <a href="{{ route('masyarakat.lelang.search') }}" style="display:block; text-align:center; margin-top:8px; font-size:12px; color:#64748B; text-decoration:none;">Reset Filter</a>
        </form>
    </div>

    {{-- Results --}}
    <div>
        <div style="font-size:14px; color:#64748B; margin-bottom:16px;">Ditemukan <strong>{{ $lelang->total() }}</strong> lelang</div>
        <div style="display:grid; grid-template-columns:repeat(auto-fill,minmax(240px,1fr)); gap:16px;">
            @forelse($lelang as $item)
            <div style="background:white; border-radius:12px; border:1px solid #E2E8F0; overflow:hidden;">
                <div style="height:140px; background:linear-gradient(135deg,#EEF2FF,#E0E7FF); display:flex; align-items:center; justify-content:center; position:relative;">
                    @if($item->barang->foto_barang)
                    <img src="{{ $item->barang->foto_url }}" style="width:100%; height:100%; object-fit:cover;">
                    @else
                    <span style="font-size:40px;"><i class="bi bi-tag-fill" style="color:#A5B4FC;"></i></span>
                    @endif
                    <span style="position:absolute; top:8px; left:8px; background:{{ $item->status==='berlangsung' ? '#ECFDF5' : '#EFF6FF' }}; color:{{ $item->status==='berlangsung' ? '#059669' : '#2563EB' }}; padding:2px 8px; border-radius:50px; font-size:10px; font-weight:700;">
                        @if($item->status==='berlangsung')
                            <i class="bi bi-circle-fill"></i> Berlangsung
                        @else
                            <i class="bi bi-circle-fill"></i> Akan Dibuka
                        @endif
                    </span>
                </div>
                <div style="padding:14px;">
                    <div style="font-size:14px; font-weight:800; margin-bottom:4px;">{{ $item->barang->nama_barang }}</div>
                    <div style="font-size:16px; font-weight:800; color:#F59E0B; margin-bottom:10px;">Rp {{ number_format($item->barang->harga_awal,0,',','.') }}</div>
                    <a href="{{ route('masyarakat.lelang.show', $item->id_lelang) }}" style="display:block; text-align:center; padding:8px; background:#4F46E5; color:white; border-radius:8px; font-size:12px; font-weight:700; text-decoration:none;">Lihat Detail</a>
                </div>
            </div>
            @empty
            <div style="grid-column:1/-1; text-align:center; padding:60px; color:#64748B;">
                <div style="font-size:48px; margin-bottom:12px;"><i class="bi bi-search"></i></div>
                <p style="font-size:16px; font-weight:600;">Tidak ada lelang yang sesuai.</p>
            </div>
            @endforelse
        </div>
        <div style="margin-top:20px;">{{ $lelang->links() }}</div>
    </div>
</div>
@endsection
