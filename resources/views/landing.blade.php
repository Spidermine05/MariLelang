<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MariLelang — Platform Lelang Online Terpercaya</title>
    <meta name="description" content="Ikuti lelang online secara real-time. Temukan barang berkualitas dengan penawaran yang adil dan transparan.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    @vite(['resources/css/landing.css'])
</head>
<body>

{{-- ═══════════════════════════════════════════════════════════════════════ --}}
{{-- NAVBAR                                                                  --}}
{{-- ═══════════════════════════════════════════════════════════════════════ --}}
<nav class="navbar" id="navbar">
    <a href="{{ route('landing') }}" class="nav-brand">
        <div class="nav-logo">ML</div>
        <span class="nav-wordmark">MariLelang</span>
    </a>

    <ul class="nav-links">
        <li><a href="#tentang">Tentang</a></li>
        <li><a href="#cara-kerja">Cara Kerja</a></li>
        <li><a href="#lelang-aktif">Lelang Aktif</a></li>
        <li><a href="{{ route('static.bantuan') }}">Bantuan</a></li>
        <li><a href="{{ route('static.kontak') }}">Kontak</a></li>
    </ul>

    <div class="nav-actions">
        <a href="{{ route('masyarakat.login') }}" class="btn-outline">Masuk</a>
        <a href="{{ route('masyarakat.register') }}" class="btn-filled">Daftar Sekarang</a>
    </div>

    <button class="nav-hamburger" id="hamburger" aria-label="Menu">
        <span></span><span></span><span></span>
    </button>
</nav>

{{-- Mobile Menu --}}
<div class="nav-mobile" id="navMobile">
    <a href="#tentang">Tentang</a>
    <a href="#cara-kerja">Cara Kerja</a>
    <a href="#lelang-aktif">Lelang Aktif</a>
    <a href="{{ route('static.bantuan') }}">Bantuan</a>
    <a href="{{ route('static.kontak') }}">Kontak</a>
    <a href="{{ route('masyarakat.login') }}" class="btn-outline">Masuk</a>
    <a href="{{ route('masyarakat.register') }}" class="btn-filled">Daftar Sekarang</a>
</div>

{{-- ═══════════════════════════════════════════════════════════════════════ --}}
{{-- HERO                                                                     --}}
{{-- ═══════════════════════════════════════════════════════════════════════ --}}
<section class="hero" id="beranda">
    <div class="hero-mesh"></div>
    <div class="hero-inner">
        {{-- Left --}}
        <div class="hero-left">
            <div class="hero-badge"><i class="bi bi-hammer"></i> Platform Lelang Terpercaya #1</div>
            <h1 class="hero-title">
                Lelang Barang Terbaik,<br>
                <span>Harga Terjangkau</span>
            </h1>
            <p class="hero-sub">
                Ikuti lelang online secara real-time. Temukan barang berkualitas dengan penawaran yang adil dan transparan.
            </p>
            <div class="hero-ctas">
                <a href="{{ route('masyarakat.register') }}" class="btn-hero-primary">Mulai Lelang Sekarang</a>
                <a href="#cara-kerja" class="btn-hero-ghost">
                    Lihat Cara Kerja
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                </a>
            </div>
            <div class="hero-trust">
                <div class="trust-item"><div class="check"><i class="bi bi-check-circle-fill"></i></div> Terpercaya</div>
                <div class="trust-item"><div class="check"><i class="bi bi-check-circle-fill"></i></div> Aman & Terverifikasi</div>
                <div class="trust-item"><div class="check"><i class="bi bi-check-circle-fill"></i></div> Transparan</div>
            </div>
        </div>

        {{-- Right Visual --}}
        <div class="hero-visual">
            <div class="hero-blob"></div>
            <div class="card-stack">
                @forelse($lelangAktif->take(3) as $hero)
                <div class="auction-card">
                    <div class="ac-icon"><i class="bi bi-box-seam"></i></div>
                    <div class="ac-name">{{ $hero->nama_barang }}</div>
                    <div class="ac-bid-label">Penawaran Tertinggi</div>
                    <div class="ac-bid-value">Rp {{ number_format($hero->harga_tertinggi ?? $hero->harga_awal, 0, ',', '.') }}</div>
                    @if($hero->status === 'berlangsung' && $hero->waktu_selesai)
                    <div class="ac-timer"><div class="ac-timer-dot"></div> <span class="countdown" data-end="{{ $hero->waktu_selesai }}">Menghitung...</span></div>
                    @else
                    <div class="ac-timer"><div class="ac-timer-dot" style="background:#818cf8"></div> Segera Dibuka</div>
                    @endif
                </div>
                @empty
                <div class="auction-card">
                    <div class="ac-icon"><i class="bi bi-bell"></i></div>
                    <div class="ac-name">Belum ada lelang aktif</div>
                    <div class="ac-bid-label">Pantau terus</div>
                    <div class="ac-bid-value">—</div>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════════════════════════ --}}
{{-- STATS                                                                    --}}
{{-- ═══════════════════════════════════════════════════════════════════════ --}}
<section class="stats-section">
    <div class="stats-inner">
        <div class="stat-item">
            <div class="stat-icon-wrap"><i class="bi bi-box-seam"></i></div>
            <div class="stat-number" data-target="{{ $stats['total_barang'] }}">0</div>
            <div class="stat-label">Total Barang Dilelang</div>
        </div>
        <div class="stat-item">
            <div class="stat-icon-wrap"><i class="bi bi-hammer"></i></div>
            <div class="stat-number" data-target="{{ $stats['total_lelang_aktif'] }}">0</div>
            <div class="stat-label">Lelang Berlangsung</div>
        </div>
        <div class="stat-item">
            <div class="stat-icon-wrap"><i class="bi bi-people-fill"></i></div>
            <div class="stat-number" data-target="{{ $stats['total_masyarakat'] }}">0</div>
            <div class="stat-label">Pengguna Terdaftar</div>
        </div>
        <div class="stat-item">
            <div class="stat-icon-wrap"><i class="bi bi-trophy-fill"></i></div>
            <div class="stat-number" data-target="{{ $stats['total_terjual'] }}">0</div>
            <div class="stat-label">Transaksi Selesai</div>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════════════════════════ --}}
{{-- CARA KERJA                                                               --}}
{{-- ═══════════════════════════════════════════════════════════════════════ --}}
<section class="section" id="cara-kerja">
    <div class="section-inner">
        <div class="section-label">Cara Kerja</div>
        <h2 class="section-title">Mudah, Cepat, dan Transparan</h2>
        <p class="section-sub">Ikuti lelang dalam 3 langkah sederhana</p>

        <div class="steps-grid">
            <div class="step-card">
                <div class="step-number">01</div>
                <div class="step-icon-wrap"><i class="bi bi-pencil-square"></i></div>
                <h3 class="step-title">Daftar Akun</h3>
                <p class="step-desc">Buat akun gratis dalam hitungan menit. Isi data diri dan langsung siap ikut lelang.</p>
            </div>
            <div class="step-card">
                <div class="step-number">02</div>
                <div class="step-icon-wrap"><i class="bi bi-search"></i></div>
                <h3 class="step-title">Temukan Barang</h3>
                <p class="step-desc">Jelajahi ratusan barang lelang yang tersedia. Filter berdasarkan kategori dan harga.</p>
            </div>
            <div class="step-card">
                <div class="step-number">03</div>
                <div class="step-icon-wrap"><i class="bi bi-trophy-fill"></i></div>
                <h3 class="step-title">Ajukan Penawaran</h3>
                <p class="step-desc">Tawar harga terbaik Anda secara real-time dan menangkan lelang impian Anda.</p>
            </div>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════════════════════════ --}}
{{-- LELANG AKTIF                                                             --}}
{{-- ═══════════════════════════════════════════════════════════════════════ --}}
<section class="section" id="lelang-aktif" style="background: white; padding-top: 80px; padding-bottom: 80px;">
    <div class="section-inner">
        <div class="section-header">
            <div class="section-header-text">
                <div class="section-label">Lelang Aktif</div>
                <h2 class="section-title" style="margin-bottom: 0;">Sedang Berlangsung</h2>
            </div>
            <a href="{{ route('masyarakat.login') }}" class="section-see-all" style="display:inline-flex; align-items:center; gap:8px; padding:10px 20px; background:var(--brand); color:white; border-radius:50px; font-size:13px; font-weight:700; text-decoration:none; box-shadow:0 4px 12px rgba(79,70,229,.3); transition:all .2s;" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 20px rgba(79,70,229,.4)'" onmouseout="this.style.transform=''; this.style.boxShadow='0 4px 12px rgba(79,70,229,.3)'">
                <i class="bi bi-grid-fill"></i> Lihat Semua Lelang
            </a>
        </div>

        <div class="auction-grid">
            @forelse($lelangAktif as $item)
            <div class="auction-item-card">
                <div class="card-img">
                    @if($item->foto_barang)
                        <img src="{{ asset('storage/barang/' . $item->foto_barang) }}" alt="{{ e($item->nama_barang) }}">
                    @else
                        <i class="bi bi-tag-fill" style="font-size: 48px; color: #A5B4FC;"></i>
                    @endif
                    <span class="card-status-badge {{ $item->status === 'berlangsung' ? 'badge-berlangsung' : 'badge-dibuka' }}">
                        @if($item->status === 'berlangsung')
                            <i class="bi bi-circle-fill text-success"></i> Berlangsung
                        @else
                            <i class="bi bi-circle-fill text-primary"></i> Akan Dibuka
                        @endif
                    </span>
                </div>
                <div class="card-body">
                    @if($item->nama_kategori)
                    <span class="card-category">{{ $item->nama_kategori }}</span>
                    @endif
                    <div class="card-name">{{ $item->nama_barang }}</div>
                    <div class="card-bid-row">
                        <span class="card-bid-label">Penawaran Tertinggi</span>
                        <span class="card-bid-value">
                            Rp {{ number_format($item->harga_tertinggi ?? $item->harga_awal, 0, ',', '.') }}
                        </span>
                    </div>
                    @if($item->status === 'berlangsung')
                    <div class="card-timer">
                        <div class="card-timer-dot"></div>
                        <span class="countdown" data-end="{{ $item->waktu_selesai }}">Menghitung...</span>
                    </div>
                    @endif
                    <a href="{{ route('masyarakat.login') }}" class="card-btn"><i class="bi bi-hammer"></i> Ikut Lelang</a>
                </div>
            </div>
            @empty
            <div class="empty-state">
                <div class="empty-icon"><i class="bi bi-bell"></i></div>
                <p>Belum ada lelang aktif saat ini.<br>Pantau terus untuk update terbaru!</p>
            </div>
            @endforelse
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════════════════════════ --}}
{{-- KEUNGGULAN                                                               --}}
{{-- ═══════════════════════════════════════════════════════════════════════ --}}
<section class="features-section" id="tentang">
    <div class="features-inner">
        <div>
            <div class="section-label">Keunggulan</div>
            <h2 class="section-title">Mengapa Memilih<br>MariLelang?</h2>
            <p style="font-size:16px; color:var(--text-muted); line-height:1.8; max-width:400px;">
                Kami hadir sebagai platform lelang online yang mengutamakan keamanan, transparansi, dan kemudahan bagi seluruh pengguna di Indonesia.
            </p>
        </div>
        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon fi-indigo"><i class="bi bi-shield-lock-fill"></i></div>
                <div class="feature-title">Keamanan Terjamin</div>
                <div class="feature-desc">Sistem terenkripsi dan data pengguna terlindungi sepenuhnya.</div>
            </div>
            <div class="feature-card">
                <div class="feature-icon fi-green"><i class="bi bi-lightning-charge-fill"></i></div>
                <div class="feature-title">Real-time Updates</div>
                <div class="feature-desc">Pantau penawaran secara langsung tanpa perlu refresh halaman.</div>
            </div>
            <div class="feature-card">
                <div class="feature-icon fi-amber"><i class="bi bi-bar-chart-fill"></i></div>
                <div class="feature-title">Transparan</div>
                <div class="feature-desc">Semua riwayat penawaran dapat dilihat oleh seluruh peserta.</div>
            </div>
            <div class="feature-card">
                <div class="feature-icon fi-blue"><i class="bi bi-patch-check-fill"></i></div>
                <div class="feature-title">Terpercaya</div>
                <div class="feature-desc">Dikelola oleh petugas terverifikasi dengan pengawasan ketat.</div>
            </div>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════════════════════════ --}}
{{-- TESTIMONIALS                                                             --}}
{{-- ═══════════════════════════════════════════════════════════════════════ --}}
<section class="testimonials-section">
    <div class="section-inner">
        <div style="text-align:center;">
            <div class="section-label" style="justify-content:center; display:flex;">Testimoni</div>
            <h2 class="section-title" style="text-align:center;">Apa Kata Pengguna Kami</h2>
        </div>
        <div class="testimonials-grid">
            <div class="testi-card">
                <div class="testi-header">
                    <div class="testi-avatar">BW</div>
                    <div>
                        <div class="testi-name">Budi Wicaksono</div>
                        <div class="testi-role">Peserta Lelang</div>
                    </div>
                </div>
                <div class="testi-stars"><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i></div>
                <p class="testi-quote">"Saya berhasil mendapatkan laptop bekas berkualitas dengan harga jauh di bawah pasaran. Prosesnya mudah dan transparan!"</p>
            </div>
            <div class="testi-card">
                <div class="testi-header">
                    <div class="testi-avatar" style="background:#F59E0B;">SR</div>
                    <div>
                        <div class="testi-name">Siti Rahayu</div>
                        <div class="testi-role">Peserta Lelang</div>
                    </div>
                </div>
                <div class="testi-stars"><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i></div>
                <p class="testi-quote">"Platform yang sangat membantu! Saya bisa ikut lelang kapan saja dan di mana saja. Countdown timer-nya bikin deg-degan!"</p>
            </div>
            <div class="testi-card">
                <div class="testi-header">
                    <div class="testi-avatar" style="background:#10B981;">AP</div>
                    <div>
                        <div class="testi-name">Ahmad Pratama</div>
                        <div class="testi-role">Peserta Lelang</div>
                    </div>
                </div>
                <div class="testi-stars"><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star"></i></div>
                <p class="testi-quote">"Riwayat penawaran bisa dilihat semua, jadi saya yakin tidak ada kecurangan. Sangat recommended untuk yang mau cari barang murah!"</p>
            </div>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════════════════════════ --}}
{{-- CTA BANNER                                                               --}}
{{-- ═══════════════════════════════════════════════════════════════════════ --}}
<section class="cta-section">
    <div class="cta-deco cta-deco-1"></div>
    <div class="cta-deco cta-deco-2"></div>
    <div class="cta-deco cta-deco-3"></div>
    <div class="cta-inner">
        <h2 class="cta-title">Siap Ikut Lelang?</h2>
        <p class="cta-sub">Daftar gratis sekarang dan mulai penawaran pertama Anda. Ribuan barang menanti!</p>
        <div style="display:flex; gap:16px; justify-content:center; flex-wrap:wrap;">
            <a href="{{ route('masyarakat.register') }}" class="btn-cta"><i class="bi bi-person-plus-fill"></i> Daftar Sekarang — Gratis</a>
            <a href="{{ route('masyarakat.login') }}" style="display:inline-flex; align-items:center; gap:8px; padding:14px 28px; background:rgba(255,255,255,0.15); color:white; border:2px solid rgba(255,255,255,0.5); border-radius:50px; font-size:15px; font-weight:700; text-decoration:none; backdrop-filter:blur(4px); transition:all .2s;" onmouseover="this.style.background='rgba(255,255,255,0.25)'" onmouseout="this.style.background='rgba(255,255,255,0.15)'"><i class="bi bi-box-arrow-in-right"></i> Sudah Punya Akun</a>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════════════════════════ --}}
{{-- FOOTER                                                                   --}}
{{-- ═══════════════════════════════════════════════════════════════════════ --}}
<footer class="footer">
    <div class="footer-inner">
        <div class="footer-brand">
            <div style="display:flex; align-items:center; gap:10px; margin-bottom:12px;">
                <div class="nav-logo">ML</div>
                <span class="nav-wordmark">MariLelang</span>
            </div>
            <p class="footer-tagline">Platform lelang online terpercaya di Indonesia. Temukan barang terbaik dengan harga terjangkau.</p>
            <div class="footer-socials">
                <a href="#" class="social-btn" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
                <a href="#" class="social-btn" aria-label="Twitter"><i class="bi bi-twitter"></i></a>
                <a href="#" class="social-btn" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
            </div>
        </div>
        <div class="footer-col">
            <h4>Akun</h4>
            <ul>
                <li><a href="{{ route('masyarakat.register') }}"><i class="bi bi-person-plus"></i> Daftar Masyarakat</a></li>
                <li><a href="{{ route('masyarakat.login') }}"><i class="bi bi-box-arrow-in-right"></i> Masuk</a></li>
            </ul>
        </div>
        <div class="footer-col">
            <h4>Kontak</h4>
            <div class="footer-contact-item">
                <span class="icon"><i class="bi bi-whatsapp"></i></span>
                <a href="https://wa.me/62085188410138" target="_blank" rel="noopener noreferrer" style="color:#94A3B8; text-decoration:none;">0851-8841-0138</a>
            </div>
            <div class="footer-contact-item">
                <span class="icon"><i class="bi bi-envelope-fill"></i></span>
                <span>bantuan@marilelang.id</span>
            </div>
            <div class="footer-contact-item">
                <span class="icon"><i class="bi bi-geo-alt-fill"></i></span>
                <span>Bandung, Jawa Barat, Indonesia</span>
            </div>
        </div>
    </div>
    <div class="footer-bottom" style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:12px;">
        <span>&copy; {{ date('Y') }} MariLelang by <strong>PERINTIS TEAM</strong>. All rights reserved.</span>
        <div style="display:flex; gap:16px;">
            <a href="{{ route('static.kebijakan') }}" style="color:#64748B; text-decoration:none; font-size:13px;">Kebijakan Privasi</a>
            <a href="{{ route('static.bantuan') }}" style="color:#64748B; text-decoration:none; font-size:13px;">Bantuan</a>
        </div>
    </div>
</footer>

{{-- ═══════════════════════════════════════════════════════════════════════ --}}
{{-- SCRIPTS                                                                  --}}
{{-- ═══════════════════════════════════════════════════════════════════════ --}}
<script>
// ── Navbar scroll glassmorphism ──────────────────────────────────────────────
const navbar = document.getElementById('navbar');
window.addEventListener('scroll', () => {
    navbar.classList.toggle('scrolled', window.scrollY > 20);
}, { passive: true });

// ── Mobile hamburger ─────────────────────────────────────────────────────────
const hamburger = document.getElementById('hamburger');
const navMobile = document.getElementById('navMobile');
hamburger.addEventListener('click', () => {
    navMobile.classList.toggle('open');
});
document.querySelectorAll('.nav-mobile a').forEach(a => {
    a.addEventListener('click', () => navMobile.classList.remove('open'));
});

// ── Counter animation ────────────────────────────────────────────────────────
function animateCounter(el, target, duration = 1800) {
    let start = 0;
    const step = target / (duration / 16);
    const timer = setInterval(() => {
        start += step;
        if (start >= target) { start = target; clearInterval(timer); }
        el.textContent = Math.floor(start).toLocaleString('id-ID');
    }, 16);
}

const counterObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            const el = entry.target;
            const target = parseInt(el.dataset.target) || 0;
            animateCounter(el, target);
            counterObserver.unobserve(el);
        }
    });
}, { threshold: 0.5 });

document.querySelectorAll('.stat-number[data-target]').forEach(el => {
    counterObserver.observe(el);
});

// ── Step cards scroll animation ──────────────────────────────────────────────
const stepObserver = new IntersectionObserver((entries) => {
    entries.forEach((entry, i) => {
        if (entry.isIntersecting) {
            setTimeout(() => entry.target.classList.add('visible'), i * 150);
            stepObserver.unobserve(entry.target);
        }
    });
}, { threshold: 0.2 });

document.querySelectorAll('.step-card').forEach(el => stepObserver.observe(el));

// ── Countdown timers ─────────────────────────────────────────────────────────
function updateCountdowns() {
    document.querySelectorAll('.countdown[data-end]').forEach(el => {
        const end = new Date(el.dataset.end).getTime();
        const now = Date.now();
        const diff = end - now;
        if (diff <= 0) {
            el.textContent = 'Lelang selesai';
            return;
        }
        const h = Math.floor(diff / 3600000);
        const m = Math.floor((diff % 3600000) / 60000);
        const s = Math.floor((diff % 60000) / 1000);
        el.textContent = `${String(h).padStart(2,'0')}:${String(m).padStart(2,'0')}:${String(s).padStart(2,'0')} tersisa`;
    });
}
updateCountdowns();
setInterval(updateCountdowns, 1000);

// ── Smooth scroll for anchor links ───────────────────────────────────────────
document.querySelectorAll('a[href^="#"]').forEach(a => {
    a.addEventListener('click', e => {
        const target = document.querySelector(a.getAttribute('href'));
        if (target) {
            e.preventDefault();
            target.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
    });
});

// ── Back to top button ────────────────────────────────────────────────────────
const backToTop = document.getElementById('backToTop');
window.addEventListener('scroll', () => {
    backToTop.classList.toggle('visible', window.scrollY > 400);
}, { passive: true });
backToTop.addEventListener('click', () => window.scrollTo({ top: 0, behavior: 'smooth' }));
</script>

<button id="backToTop" aria-label="Kembali ke atas" style="position:fixed; bottom:28px; right:28px; width:48px; height:48px; border-radius:50%; background:var(--brand,#4F46E5); color:white; border:none; cursor:pointer; font-size:20px; display:flex; align-items:center; justify-content:center; box-shadow:0 4px 20px rgba(79,70,229,.4); opacity:0; transform:translateY(16px); transition:opacity .3s, transform .3s; z-index:999;">
    <i class="bi bi-arrow-up"></i>
</button>
<style>
#backToTop.visible { opacity:1; transform:translateY(0); }
#backToTop:hover { background:#4338CA; transform:translateY(-2px) !important; }
</style>

</body>
</html>
