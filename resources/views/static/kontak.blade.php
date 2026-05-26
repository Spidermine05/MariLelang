<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontak Kami — MariLelang</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    @vite(['resources/css/landing.css'])
    <style>
        .static-hero { background: linear-gradient(135deg, #4338CA 0%, #4F46E5 50%, #6366F1 100%); padding: 120px 5% 60px; text-align: center; color: white; }
        .static-hero h1 { font-family: 'Playfair Display', serif; font-size: 42px; font-weight: 800; margin-bottom: 12px; }
        .static-hero p { font-size: 16px; opacity: 0.9; }
        .static-content { max-width: 900px; margin: 60px auto; padding: 0 5%; }
        .back-link { display: inline-flex; align-items: center; gap: 6px; color: var(--brand); font-weight: 600; text-decoration: none; margin-bottom: 32px; }
        .back-link:hover { text-decoration: underline; }
        .contact-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 32px; margin-bottom: 48px; }
        .contact-card { background: white; border-radius: 16px; padding: 28px; box-shadow: 0 4px 24px rgba(79,70,229,0.08); }
        .contact-card.primary { border: 2px solid #25D366; background: linear-gradient(135deg, #F0FFF4, #DCFCE7); }
        .contact-icon { font-size: 32px; margin-bottom: 12px; }
        .contact-icon.whatsapp { color: #16A34A; }
        .contact-label { font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.08em; color: var(--text-muted); margin-bottom: 6px; }
        .contact-value { font-size: 20px; font-weight: 700; color: var(--text); margin-bottom: 4px; }
        .contact-sub { font-size: 13px; color: var(--text-muted); margin-bottom: 16px; }
        .btn-whatsapp { display: inline-block; background: #25D366; color: white; padding: 10px 20px; border-radius: 10px; font-weight: 600; text-decoration: none; transition: transform 0.2s; }
        .btn-whatsapp:hover { transform: translateY(-1px); }
        .faq-section h3 { font-family: 'Playfair Display', serif; font-size: 24px; color: var(--text); margin-bottom: 20px; }
        .faq-item { background: white; border-radius: 12px; padding: 20px; margin-bottom: 16px; box-shadow: 0 2px 12px rgba(0,0,0,0.05); }
        .faq-q { font-weight: 700; color: var(--brand); margin-bottom: 8px; }
        .faq-a { color: var(--text-muted); line-height: 1.7; }
        .cta-bar { background: #EEF2FF; border-radius: 16px; padding: 32px; text-align: center; margin-top: 48px; }
        .cta-bar p { font-size: 16px; color: var(--text); margin-bottom: 12px; }
        .cta-bar a { color: var(--brand); font-weight: 600; text-decoration: none; }
        .cta-bar a:hover { text-decoration: underline; }
        @media (max-width: 768px) {
            .contact-grid { grid-template-columns: 1fr; }
            .static-hero h1 { font-size: 32px; }
        }
    </style>
</head>
<body>

{{-- NAVBAR --}}
<nav class="navbar scrolled" id="navbar">
    <a href="{{ route('landing') }}" class="nav-brand">
        <div class="nav-logo">ML</div>
        <span class="nav-wordmark">MariLelang</span>
    </a>
    <ul class="nav-links">
        <li><a href="{{ route('landing') }}#tentang">Tentang Kami</a></li>
        <li><a href="{{ route('landing') }}#cara-kerja">Cara Kerja</a></li>
        <li><a href="{{ route('landing') }}#lelang-aktif">Lelang Aktif</a></li>
    </ul>
    <div class="nav-actions">
        <a href="{{ route('masyarakat.login') }}" class="btn-outline">Masuk</a>
        <a href="{{ route('masyarakat.register') }}" class="btn-filled">Daftar Sekarang</a>
    </div>
    <button class="nav-hamburger" id="hamburger" aria-label="Menu">
        <span></span><span></span><span></span>
    </button>
</nav>

{{-- HERO --}}
<section class="static-hero">
    <h1>Kontak Kami</h1>
    <p>Ada pertanyaan? Kami siap membantu Anda</p>
</section>

{{-- CONTENT --}}
<div class="static-content">
    <a href="{{ route('landing') }}" class="back-link">
        <i class="bi bi-arrow-left"></i> Kembali ke Beranda
    </a>

    <div class="contact-grid">
        {{-- LEFT COLUMN --}}
        <div>
            <div class="contact-card primary">
                <i class="bi bi-whatsapp contact-icon whatsapp"></i>
                <div class="contact-label">WhatsApp</div>
                <div class="contact-value">0862-8374-823</div>
                <div class="contact-sub">Senin – Sabtu, 08.00 – 17.00 WIB</div>
                <a href="https://wa.me/6208628374823" target="_blank" rel="noopener noreferrer" class="btn-whatsapp">
                    <i class="bi bi-chat-dots-fill"></i> Chat Sekarang
                </a>
            </div>

            <div class="contact-card" style="margin-top: 20px;">
                <i class="bi bi-envelope-fill contact-icon" style="color: var(--brand);"></i>
                <div class="contact-label">Email</div>
                <div class="contact-value">bantuan@marilelang.id</div>
                <div class="contact-sub">Respon dalam 1x24 jam</div>
            </div>

            <div class="contact-card" style="margin-top: 20px;">
                <i class="bi bi-geo-alt-fill contact-icon" style="color: var(--accent);"></i>
                <div class="contact-label">Kantor</div>
                <div class="contact-value">Bandung, Jawa Barat</div>
                <div class="contact-sub">Indonesia</div>
            </div>
        </div>

        {{-- RIGHT COLUMN --}}
        <div class="faq-section">
            <h3>Pertanyaan Umum</h3>
            <div class="faq-item">
                <div class="faq-q">Bagaimana cara mendaftar?</div>
                <div class="faq-a">Klik tombol Daftar Sekarang di halaman utama dan isi data diri Anda.</div>
            </div>
            <div class="faq-item">
                <div class="faq-q">Apakah pendaftaran gratis?</div>
                <div class="faq-a">Ya, pendaftaran akun masyarakat sepenuhnya gratis.</div>
            </div>
            <div class="faq-item">
                <div class="faq-q">Bagaimana jika saya memenangkan lelang?</div>
                <div class="faq-a">Petugas kami akan menghubungi Anda melalui kontak yang terdaftar.</div>
            </div>
        </div>
    </div>

    <div class="cta-bar">
        <p><strong>Butuh bantuan lebih lanjut?</strong></p>
        <a href="{{ route('static.bantuan') }}">Kunjungi Halaman Bantuan <i class="bi bi-arrow-right"></i></a>
    </div>
</div>

{{-- FOOTER --}}
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
            <h4>Navigasi</h4>
            <ul>
                <li><a href="{{ route('landing') }}#beranda">Beranda</a></li>
                <li><a href="{{ route('landing') }}#cara-kerja">Cara Kerja</a></li>
                <li><a href="{{ route('landing') }}#lelang-aktif">Lelang Aktif</a></li>
                <li><a href="{{ route('landing') }}#tentang">Tentang Kami</a></li>
            </ul>
        </div>
        <div class="footer-col">
            <h4>Akun</h4>
            <ul>
                <li><a href="{{ route('masyarakat.register') }}">Daftar Masyarakat</a></li>
                <li><a href="{{ route('masyarakat.login') }}">Masuk</a></li>
                <li><a href="{{ route('petugas.login') }}">Portal Petugas</a></li>
                <li><a href="{{ route('admin.login') }}">Portal Admin</a></li>
            </ul>
        </div>
        <div class="footer-col">
            <h4>Kontak</h4>
            <div class="footer-contact-item">
                <span class="icon"><i class="bi bi-envelope-fill"></i></span>
                <span>info@marilelang.id</span>
            </div>
            <div class="footer-contact-item">
                <span class="icon"><i class="bi bi-telephone-fill"></i></span>
                <span>+62 812-3456-7890</span>
            </div>
            <div class="footer-contact-item">
                <span class="icon"><i class="bi bi-geo-alt-fill"></i></span>
                <span>Jl. Contoh No. 123,<br>Jakarta, Indonesia</span>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        &copy; {{ date('Y') }} MariLelang by <strong>PERINTIS TEAM</strong>. All rights reserved.
    </div>
</footer>

<script>
const hamburger = document.getElementById('hamburger');
const navMobile = document.getElementById('navMobile');
if (hamburger && navMobile) {
    hamburger.addEventListener('click', () => navMobile.classList.toggle('open'));
}
</script>

</body>
</html>
