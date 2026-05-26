@extends('layouts.app-masyarakat')
@section('title', 'Lelang Aktif')
@section('content')
<div style="padding:24px;">
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">
        <h2 style="font-size:20px; font-weight:800;">Lelang Berlangsung</h2>
        <a href="{{ route('masyarakat.lelang.search') }}" style="padding:8px 16px; background:#EEF2FF; color:var(--brand,#4F46E5); border-radius:8px; font-size:13px; font-weight:700; text-decoration:none;"><i class="bi bi-search"></i> Cari Lelang</a>
    </div>

    <div style="display:grid; grid-template-columns:repeat(auto-fill,minmax(280px,1fr)); gap:20px;">
        @forelse($lelang as $item)
        @php $harga = $item->penawaran()->orderByDesc('harga_tawar')->value('harga_tawar') ?? $item->barang->harga_awal; @endphp
        <div style="background:white; border-radius:14px; border:1px solid #E2E8F0; overflow:hidden; transition:transform .2s, box-shadow .2s;" onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 8px 32px rgba(79,70,229,.15)'" onmouseout="this.style.transform=''; this.style.boxShadow=''">
            <div style="height:160px; background:linear-gradient(135deg,#EEF2FF,#E0E7FF); display:flex; align-items:center; justify-content:center; position:relative; overflow:hidden;">
                @if($item->barang->foto_barang)
                <img src="{{ $item->barang->foto_url }}" style="width:100%; height:100%; object-fit:cover;">
                @else
                <span style="font-size:48px;"><i class="bi bi-tag-fill" style="color:#A5B4FC;"></i></span>
                @endif
                <span style="position:absolute; top:10px; left:10px; background:#ECFDF5; color:#059669; padding:3px 10px; border-radius:50px; font-size:11px; font-weight:700;"><i class="bi bi-circle-fill"></i> Berlangsung</span>
            </div>
            <div style="padding:16px;">
                @if($item->barang->kategori)
                <span style="background:#EEF2FF; color:#4F46E5; font-size:10px; font-weight:700; padding:2px 8px; border-radius:50px; text-transform:uppercase;">{{ $item->barang->kategori->nama_kategori }}</span>
                @endif
                <div style="font-size:15px; font-weight:800; margin:8px 0 4px;">{{ $item->barang->nama_barang }}</div>
                <div style="font-size:11px; color:#64748B; font-weight:600; margin-bottom:2px;">Penawaran Tertinggi</div>
                <div style="font-size:18px; font-weight:800; color:#F59E0B; margin-bottom:8px;">Rp {{ number_format($harga,0,',','.') }}</div>
                <div style="font-size:12px; color:#64748B; margin-bottom:12px; display:flex; align-items:center; gap:4px;">
                    <span style="width:6px; height:6px; border-radius:50%; background:#EF4444; display:inline-block; animation:blink 1s infinite;"></span>
                    <span class="countdown" data-end="{{ $item->waktu_selesai }}">Menghitung...</span>
                </div>
                <a href="{{ route('masyarakat.lelang.show', $item->id_lelang) }}" style="display:block; text-align:center; padding:10px; background:#4F46E5; color:white; border-radius:8px; font-size:13px; font-weight:700; text-decoration:none;">Ikut Lelang <i class="bi bi-arrow-right"></i></a>
            </div>
        </div>
        @empty
        <div style="grid-column:1/-1; text-align:center; padding:60px; color:#64748B;">
            <div style="font-size:48px; margin-bottom:12px;"><i class="bi bi-bell"></i></div>
            <p style="font-size:16px; font-weight:600;">Belum ada lelang aktif saat ini.</p>
        </div>
        @endforelse
    </div>
    <div style="margin-top:20px;">{{ $lelang->links() }}</div>
</div>
<style>@keyframes blink{0%,100%{opacity:1}50%{opacity:.3}}</style>
<script>
function updateCountdowns(){document.querySelectorAll('.countdown[data-end]').forEach(el=>{const d=new Date(el.dataset.end)-Date.now();if(d<=0){el.textContent='Selesai';return;}const h=Math.floor(d/3600000),m=Math.floor(d%3600000/60000),s=Math.floor(d%60000/1000);el.textContent=`${String(h).padStart(2,'0')}:${String(m).padStart(2,'0')}:${String(s).padStart(2,'0')} tersisa`;});}
updateCountdowns();setInterval(updateCountdowns,1000);
</script>
@endsection
