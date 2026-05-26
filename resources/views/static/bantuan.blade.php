<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pusat Bantuan — MariLelang</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    @vite(['resources/css/landing.css'])
    <style>
        .static-hero { background: linear-gradient(135deg, #4338CA 0%, #4F46E5 50%, #6366F1 100%); padding: 120px 5% 60px; text-align: center; color: white; }
        .static-hero h1 { font-family: 'Playfair Display', serif; font-size: 42px; font-weight: 800; margin-bottom: 12px; }
        .static-hero p { font-size: 16px; opacity: 0.9; }
        .static-content { max-width: 860px; margin: 60px auto 80px; padding: 0 5%; }
        .back-link { display: inline-flex; align-items: center; gap: 6px; color: var(--brand); font-weight: 600; text-decoration: none; margin-bottom: 32px; }
        .back-link:hover { text-decoration: underline; }
        .search-bar { display: flex; gap: 10px; margin-bottom: 32px; }
        .search-bar input { flex: 1; padding: 14px 20px; border: 2px solid var(--border); border-radius: 10px; font-size: 15px; }
        .search-bar input:focus { outline: none; border-color: var(--brand); }
        .search-bar button { padding: 14px 24px; background: var(--brand); color: white; border: none; border-radius: 10px; font-weight: 600; cursor: pointer; }
        .search-bar button:hover { background: var(--brand-dark); }
        .category-tabs { display: flex; gap: 10px; margin-bottom: 32px; flex-wrap: wrap; }
        .category-tab { padding: 10px 20px; background: white; border: 2px solid var(--border); border-radius: 999px; font-size: 14px; font-weight: 600; color: var(--text-muted); cursor: pointer; transition: all 0.2s; }
        .category-tab:hover { border-color: var(--brand); color: var(--brand); }
        .category-tab.active { background: var(--brand); border-color: var(--brand); color: white; }
        .faq-item { background: white; border-radius: 16px; padding: 24px; margin-bottom: 16px; box-shadow: 0 2px 12px rgba(0,0,0,0.05); cursor: pointer; transition: all 0.3s; }
        .faq-item:hover { box-shadow: 0 4px 24px rgba(79,70,229,0.12); }
        .faq-item.open { border-left: 3px solid var(--brand); }
        .faq-question { display: flex; justify-content: space-between; align-items: center; font-weight: 700; color: var(--text); font-size: 16px; }
        .faq-chevron { font-size: 20px; color: var(--brand); transition: transform 0.3s ease; }
        .faq-item.open .faq-chevron { transform: rotate(180deg); }
        .faq-answer { max-height: 0; overflow: hidden; transition: max-height 0.3s ease, padding-top 0.3s ease; color: #4B5563; line-height: 1.8; font-size: 15px; }
        .faq-item.open .faq-answer { max-height: 500px; padding-top: 12px; }
        .faq-item.hidden { display: none; }
        .contact-banner { background: #EEF2FF; border-radius: 16px; padding: 40px; text-align: center; margin-top: 48px; }
        .contact-banner p { font-size: 18px; font-weight: 600; color: var(--text); margin-bottom: 16px; }
        .btn-whatsapp-big { display: inline-block; background: #25D366; color: white; padding: 14px 28px; border-radius: 10px; font-weight: 600; text-decoration: none; transition: transform 0.2s; }
        .btn-whatsapp-big:hover { transform: translateY(-2px); }
        @media (max-width: 768px) {
            .static-hero h1 { font-size: 32px; }
            .search-bar { flex-direction: column; }
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
    <h1>Pusat Bantuan</h1>
    <p>Temukan jawaban atas pertanyaan Anda</p>
</section>

{{-- CONTENT --}}
<div class="static-content">
    <a href="{{ route('landing') }}" class="back-link">
        <i class="bi bi-arrow-left"></i> Kembali ke Beranda
    </a>

    <div class="search-bar">
        <input type="text" id="searchInput" placeholder="Cari pertanyaan...">
        <button><i class="bi bi-search"></i></button>
    </div>

    <div class="category-tabs">
        <div class="category-tab active" data-category="semua">Semua</div>
        <div class="category-tab" data-category="akun">Akun</div>
        <div class="category-tab" data-category="lelang">Lelang</div>
        <div class="category-tab" data-category="penawaran">Penawaran</div>
        <div class="category-tab" data-category="teknis">Teknis</div>
    </div>

    <div id="faqContainer">
        {{-- AKUN --}}
        <div class="faq-item" data-category="akun">
            <div class="faq-question">
                <span>Bagaimana cara membuat akun?</span>
                <i class="bi bi-chevron-down faq-chevron"></i>
            </div>
            <div class="faq-answer">
                Klik tombol "Daftar Sekarang" di halaman utama. Isi nama lengkap, username, email, nomor telepon, alamat, dan password. Klik "Daftar" dan akun Anda langsung aktif.
            </div>
        </div>

        <div class="faq-item" data-category="akun">
            <div class="faq-question">
                <span>Saya lupa password, apa yang harus dilakukan?</span>
                <i class="bi bi-chevron-down faq-chevron"></i>
            </div>
            <div class="faq-answer">
                Saat ini reset password dilakukan melalui bantuan petugas. Hubungi kami via WhatsApp di 0862-8374-823 dengan menyertakan username dan email terdaftar.
            </div>
        </div>

        <div class="faq-item" data-category="akun">
            <div class="faq-question">
                <span>Bagaimana cara mengubah data profil?</span>
                <i class="bi bi-chevron-down faq-chevron"></i>
            </div>
            <div class="faq-answer">
                Login ke akun Anda, lalu buka menu Profil di pojok kanan atas untuk mengubah data diri.
            </div>
        </div>

        {{-- LELANG --}}
        <div class="faq-item" data-category="lelang">
            <div class="faq-question">
                <span>Bagaimana cara melihat lelang yang sedang berlangsung?</span>
                <i class="bi bi-chevron-down faq-chevron"></i>
            </div>
            <div class="faq-answer">
                Setelah login, buka menu "Lelang Aktif" di dashboard. Semua lelang yang sedang berlangsung akan ditampilkan beserta countdown waktu berakhirnya.
            </div>
        </div>

        <div class="faq-item" data-category="lelang">
            <div class="faq-question">
                <span>Apa itu harga minimal bid?</span>
                <i class="bi bi-chevron-down faq-chevron"></i>
            </div>
            <div class="faq-answer">
                Harga minimal bid adalah selisih minimum yang harus ditambahkan dari tawaran tertinggi saat ini. Contoh: jika tawaran tertinggi Rp 500.000 dan minimal bid Rp 10.000, maka tawaran Anda minimal Rp 510.000.
            </div>
        </div>

        <div class="faq-item" data-category="lelang">
            <div class="faq-question">
                <span>Kapan lelang ditutup?</span>
                <i class="bi bi-chevron-down faq-chevron"></i>
            </div>
            <div class="faq-answer">
                Lelang ditutup otomatis sesuai waktu yang telah ditentukan petugas, atau dapat ditutup manual oleh petugas sebelum waktu berakhir.
            </div>
        </div>

        {{-- PENAWARAN --}}
        <div class="faq-item" data-category="penawaran">
            <div class="faq-question">
                <span>Bagaimana cara mengajukan penawaran?</span>
                <i class="bi bi-chevron-down faq-chevron"></i>
            </div>
            <div class="faq-answer">
                Buka detail lelang yang ingin diikuti, masukkan nominal tawaran Anda di kolom yang tersedia, lalu klik "Ajukan Penawaran". Pastikan tawaran Anda melebihi tawaran tertinggi saat ini plus harga minimal bid.
            </div>
        </div>

        <div class="faq-item" data-category="penawaran">
            <div class="faq-question">
                <span>Apa yang terjadi jika saya memenangkan lelang?</span>
                <i class="bi bi-chevron-down faq-chevron"></i>
            </div>
            <div class="faq-answer">
                Selamat! Petugas kami akan menghubungi Anda melalui nomor telepon yang terdaftar untuk proses serah terima barang dan pembayaran.
            </div>
        </div>

        <div class="faq-item" data-category="penawaran">
            <div class="faq-question">
                <span>Bisakah saya membatalkan penawaran?</span>
                <i class="bi bi-chevron-down faq-chevron"></i>
            </div>
            <div class="faq-answer">
                Penawaran yang sudah diajukan tidak dapat dibatalkan. Pastikan Anda yakin sebelum mengajukan penawaran.
            </div>
        </div>

        {{-- TEKNIS --}}
        <div class="faq-item" data-category="teknis">
            <div class="faq-question">
                <span>Browser apa yang didukung?</span>
                <i class="bi bi-chevron-down faq-chevron"></i>
            </div>
            <div class="faq-answer">
                MariLelang mendukung semua browser modern: Chrome, Firefox, Safari, dan Edge versi terbaru.
            </div>
        </div>

        <div class="faq-item" data-category="teknis">
            <div class="faq-question">
                <span>Apakah MariLelang tersedia di smartphone?</span>
                <i class="bi bi-chevron-down faq-chevron"></i>
            </div>
            <div class="faq-answer">
                Ya, tampilan MariLelang sudah responsif dan dapat diakses melalui browser di smartphone Anda.
            </div>
        </div>

        <div class="faq-item" data-category="teknis">
            <div class="faq-question">
                <span>Mengapa halaman tidak bisa diakses?</span>
                <i class="bi bi-chevron-down faq-chevron"></i>
            </div>
            <div class="faq-answer">
                Coba bersihkan cache browser Anda atau gunakan mode incognito. Jika masalah berlanjut, hubungi kami via WhatsApp di 0862-8374-823.
            </div>
        </div>
    </div>

    <div class="contact-banner">
        <p>Tidak menemukan jawaban yang Anda cari?</p>
        <a href="https://wa.me/6208628374823" target="_blank" rel="noopener noreferrer" class="btn-whatsapp-big">
            <i class="bi bi-chat-dots-fill"></i> Chat WhatsApp — 0862-8374-823
        </a>
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
// Hamburger menu
const hamburger = document.getElementById('hamburger');
const navMobile = document.getElementById('navMobile');
if (hamburger && navMobile) {
    hamburger.addEventListener('click', () => navMobile.classList.toggle('open'));
}

// FAQ accordion
document.querySelectorAll('.faq-item').forEach(item => {
    item.addEventListener('click', () => {
        item.classList.toggle('open');
    });
});

// Category filter
const categoryTabs = document.querySelectorAll('.category-tab');
const faqItems = document.querySelectorAll('.faq-item');

categoryTabs.forEach(tab => {
    tab.addEventListener('click', () => {
        const category = tab.dataset.category;
        
        // Update active tab
        categoryTabs.forEach(t => t.classList.remove('active'));
        tab.classList.add('active');
        
        // Filter FAQ items
        faqItems.forEach(item => {
            if (category === 'semua' || item.dataset.category === category) {
                item.classList.remove('hidden');
            } else {
                item.classList.add('hidden');
            }
        });
    });
});

// Search filter
const searchInput = document.getElementById('searchInput');
searchInput.addEventListener('input', (e) => {
    const query = e.target.value.toLowerCase();
    
    faqItems.forEach(item => {
        const text = item.textContent.toLowerCase();
        if (text.includes(query)) {
            item.classList.remove('hidden');
        } else {
            item.classList.add('hidden');
        }
    });
    
    // Reset category to "Semua" when searching
    if (query) {
        categoryTabs.forEach(t => t.classList.remove('active'));
        categoryTabs[0].classList.add('active');
    }
});
</script>

</body>
</html>
