@extends('layouts.app-masyarakat')
@section('title', 'Dashboard — MariLelang')

@section('content')

{{-- BANNER / SLIDER --}}
<div class="ml-banner-wrap">
    <div class="ml-banner" id="banner">
        <div class="ml-banner-slide active">
            <div class="ml-banner-content">
                <h2>Selamat Datang, {{ $user->nama_lengkap }}!</h2>
                <p>Temukan barang terbaik dengan harga terjangkau</p>
            </div>
        </div>
        <div class="ml-banner-slide">
            <div class="ml-banner-content">
                <h2>Lelang Berlangsung Sekarang</h2>
                <p>Ikuti lelang dan menangkan penawaran terbaik</p>
            </div>
        </div>
        <div class="ml-banner-slide">
            <div class="ml-banner-content">
                <h2>Jadwal Lelang Terbaru</h2>
                <p>Pantau jadwal dan jangan sampai ketinggalan</p>
            </div>
        </div>
        <button class="ml-banner-arrow ml-banner-prev" id="bannerPrev">&#8249;</button>
        <button class="ml-banner-arrow ml-banner-next" id="bannerNext">&#8250;</button>
        <div class="ml-banner-dots" id="bannerDots"></div>
    </div>
</div>

{{-- KATEGORI --}}
<div class="ml-section">
    <div class="ml-categories">
        <a href="{{ route('masyarakat.lelang.index') }}" class="ml-cat-item" style="text-decoration:none; color:inherit;">
            <div class="ml-cat-icon">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"/></svg>
            </div>
            <span>Lelang</span>
        </a>
        <a href="{{ route('masyarakat.lelang.search') }}" class="ml-cat-item" style="text-decoration:none; color:inherit;">
            <div class="ml-cat-icon">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7H4a2 2 0 00-2 2v6a2 2 0 002 2h16a2 2 0 002-2V9a2 2 0 00-2-2zM9 12h6"/></svg>
            </div>
            <span>Barang</span>
        </a>
        <a href="{{ route('masyarakat.penawaran.riwayat') }}" class="ml-cat-item" style="text-decoration:none; color:inherit;">
            <div class="ml-cat-icon">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <span>History</span>
        </a>
        <a href="{{ route('masyarakat.laporan.index') }}" class="ml-cat-item" style="text-decoration:none; color:inherit;">
            <div class="ml-cat-icon">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            </div>
            <span>Laporan</span>
        </a>
    </div>
</div>

{{-- JADWAL LELANG --}}
<div class="ml-section">
    <h2 class="ml-section-title">Jadwal Lelang</h2>
    <div class="ml-cards-grid">
        @forelse($lelangAktif as $item)
        @php
            $hargaTertinggi = $item->penawaran()->orderByDesc('harga_tawar')->value('harga_tawar') ?? $item->barang->harga_awal;
            $isBerlangsung  = $item->status === 'berlangsung';
        @endphp
        <div class="ml-item-card">
            @if($isBerlangsung)
                <span class="ml-badge ml-badge-green">Berlangsung</span>
            @else
                <span class="ml-badge ml-badge-blue">Belum Dimulai</span>
            @endif

            <div class="ml-item-img">
                @if($item->barang->foto_barang)
                    <img src="{{ asset('storage/barang/' . $item->barang->foto_barang) }}" alt="{{ $item->barang->nama_barang }}" style="width:100%; height:100%; object-fit:cover; border-radius:8px;">
                @else
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7H4a2 2 0 00-2 2v6a2 2 0 002 2h16a2 2 0 002-2V9a2 2 0 00-2-2zM9 12h6"/></svg>
                @endif
            </div>

            <div class="ml-item-name">{{ $item->barang->nama_barang }}</div>

            <div class="ml-item-price-row">
                <span class="ml-price-label">Harga Awal</span>
                <span class="ml-price-value">Rp {{ number_format($item->barang->harga_awal, 0, ',', '.') }}</span>
            </div>
            <div class="ml-item-price-row">
                <span class="ml-price-label">Tawaran Tertinggi</span>
                <span class="ml-price-value ml-price-top">Rp {{ number_format($hargaTertinggi, 0, ',', '.') }}</span>
            </div>

            @if($isBerlangsung)
                <a href="{{ route('masyarakat.lelang.show', $item->id_lelang) }}" class="ml-btn-detail ml-btn-detail-active" style="text-decoration:none; display:block; text-align:center;">Ikut Lelang</a>
            @else
                <a href="{{ route('masyarakat.lelang.show', $item->id_lelang) }}" class="ml-btn-detail" style="text-decoration:none; display:block; text-align:center;">Lihat Detail</a>
            @endif
        </div>
        @empty
        <div style="grid-column:1/-1; text-align:center; padding:40px; color:#64748B;">
            <p style="font-size:15px; font-weight:600;">Belum ada jadwal lelang aktif saat ini.</p>
            <a href="{{ route('masyarakat.lelang.search') }}" style="color:#4F46E5; font-weight:700; text-decoration:none;">Cari Lelang →</a>
        </div>
        @endforelse
    </div>
</div>

<script>
const slides = document.querySelectorAll('.ml-banner-slide');
const dotsWrap = document.getElementById('bannerDots');
let current = 0;

slides.forEach((_, i) => {
    const dot = document.createElement('button');
    dot.className = 'ml-dot' + (i === 0 ? ' active' : '');
    dot.addEventListener('click', () => goTo(i));
    dotsWrap.appendChild(dot);
});

function goTo(n) {
    slides[current].classList.remove('active');
    dotsWrap.children[current].classList.remove('active');
    current = (n + slides.length) % slides.length;
    slides[current].classList.add('active');
    dotsWrap.children[current].classList.add('active');
}

document.getElementById('bannerPrev').addEventListener('click', () => goTo(current - 1));
document.getElementById('bannerNext').addEventListener('click', () => goTo(current + 1));
setInterval(() => goTo(current + 1), 4000);
</script>

@endsection