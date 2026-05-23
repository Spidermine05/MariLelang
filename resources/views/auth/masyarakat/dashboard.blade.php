@extends('layouts.app-masyarakat')
@section('title', 'Dashboard — MariLelang')

@section('content')

{{-- BANNER / SLIDER --}}
<div class="ml-banner-wrap">
    <div class="ml-banner" id="banner">
        <div class="ml-banner-slide active">
            <div class="ml-banner-content">
                <h2>Selamat Datang di MariLelang</h2>
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
        <div class="ml-cat-item">
            <div class="ml-cat-icon">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"/></svg>
            </div>
            <span>Lelang</span>
        </div>
        <div class="ml-cat-item">
            <div class="ml-cat-icon">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
            </div>
            <span>Barang</span>
        </div>
        <div class="ml-cat-item">
            <div class="ml-cat-icon">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <span>History</span>
        </div>
        <div class="ml-cat-item">
            <div class="ml-cat-icon">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            </div>
            <span>Jadwal Lelang</span>
        </div>
    </div>
</div>

{{-- JADWAL LELANG --}}
<div class="ml-section">
    <h2 class="ml-section-title">Jadwal Lelang</h2>
    <div class="ml-cards-grid">

        {{-- Card 1 --}}
        <div class="ml-item-card">
            <span class="ml-badge ml-badge-red">Berakhir</span>
            <div class="ml-item-img">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7H4a2 2 0 00-2 2v6a2 2 0 002 2h16a2 2 0 002-2V9a2 2 0 00-2-2zM9 12h6"/></svg>
            </div>
            <div class="ml-item-name">Kursi Gaming</div>
            <div class="ml-item-price-row">
                <span class="ml-price-label">Harga Awal</span>
                <span class="ml-price-value">Rp. 350.000</span>
            </div>
            <div class="ml-item-price-row">
                <span class="ml-price-label">Tawaran Tertinggi</span>
                <span class="ml-price-value ml-price-top">Rp. 800.000</span>
            </div>
            <button class="ml-btn-detail">Lihat Detail</button>
        </div>

        {{-- Card 2 --}}
        <div class="ml-item-card">
            <span class="ml-badge ml-badge-green">Berlangsung</span>
            <div class="ml-item-img">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 10h18M3 14h18M5 6h14a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2z"/></svg>
            </div>
            <div class="ml-item-name">Meja Bundar</div>
            <div class="ml-item-price-row">
                <span class="ml-price-label">Harga Awal</span>
                <span class="ml-price-value">Rp. 100.000</span>
            </div>
            <div class="ml-item-price-row">
                <span class="ml-price-label">Tawaran Tertinggi</span>
                <span class="ml-price-value ml-price-top">Rp. 200.000</span>
            </div>
            <button class="ml-btn-detail ml-btn-detail-active">Ikut Lelang</button>
        </div>

        {{-- Card 3 --}}
        <div class="ml-item-card">
            <span class="ml-badge ml-badge-blue">Belum Dimulai</span>
            <div class="ml-item-img">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 10h18M5 6h14a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2z"/></svg>
            </div>
            <div class="ml-item-name">Meja Minimalis</div>
            <div class="ml-item-price-row">
                <span class="ml-price-label">Harga Awal</span>
                <span class="ml-price-value">Rp. 150.000</span>
            </div>
            <div class="ml-item-price-row">
                <span class="ml-price-label">Tawaran Tertinggi</span>
                <span class="ml-price-value">Rp. —</span>
            </div>
            <button class="ml-btn-detail">Lihat Detail</button>
        </div>

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