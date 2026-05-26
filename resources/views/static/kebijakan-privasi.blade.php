<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kebijakan Privasi — MariLelang</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    @vite(['resources/css/landing.css'])
    <style>
        .static-hero { background: linear-gradient(135deg, #4338CA 0%, #4F46E5 50%, #6366F1 100%); padding: 120px 5% 60px; text-align: center; color: white; }
        .static-hero h1 { font-family: 'Playfair Display', serif; font-size: 42px; font-weight: 800; margin-bottom: 12px; }
        .static-hero p { font-size: 16px; opacity: 0.9; }
        .static-content { max-width: 760px; margin: 60px auto 80px; padding: 0 5%; }
        .back-link { display: inline-flex; align-items: center; gap: 6px; color: var(--brand); font-weight: 600; text-decoration: none; margin-bottom: 32px; }
        .back-link:hover { text-decoration: underline; }
        .updated-badge { display: inline-block; background: #EEF2FF; color: var(--brand); padding: 6px 14px; border-radius: 999px; font-size: 12px; font-weight: 600; margin-bottom: 32px; }
        .prose h2 { font-family: 'Playfair Display', serif; font-size: 28px; color: var(--brand); margin-top: 48px; margin-bottom: 16px; }
        .prose h2:first-of-type { margin-top: 0; }
        .prose p { font-size: 16px; line-height: 1.8; color: var(--text); margin-bottom: 16px; }
        .prose ul { margin: 16px 0; padding-left: 24px; }
        .prose li { font-size: 16px; line-height: 1.8; color: var(--text); margin-bottom: 8px; }
        .prose strong { color: var(--text); font-weight: 700; }
        .contact-box { background: #EEF2FF; border-left: 4px solid var(--brand); border-radius: 12px; padding: 24px; margin-top: 48px; }
        .contact-box p { margin-bottom: 8px; }
        .contact-box a { color: var(--brand); font-weight: 600; text-decoration: none; }
        .contact-box a:hover { text-decoration: underline; }
        @media (max-width: 768px) {
            .static-hero h1 { font-size: 32px; }
            .prose h2 { font-size: 24px; }
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
    <h1>Kebijakan Privasi</h1>
    <p>Terakhir diperbarui: {{ date('d F Y') }}</p>
</section>

{{-- CONTENT --}}
<div class="static-content">
    <a href="{{ route('landing') }}" class="back-link">
        <i class="bi bi-arrow-left"></i> Kembali ke Beranda
    </a>

    <div class="updated-badge">
        <i class="bi bi-calendar-check"></i> Terakhir diperbarui: {{ date('d F Y') }}
    </div>

    <div class="prose">
        <h2>1. Pendahuluan</h2>
        <p>MariLelang berkomitmen untuk melindungi privasi dan keamanan data pribadi Anda. Kebijakan ini menjelaskan bagaimana kami mengumpulkan, menggunakan, dan melindungi informasi Anda saat menggunakan layanan kami.</p>

        <h2>2. Data yang Kami Kumpulkan</h2>
        <ul>
            <li><strong>Informasi identitas:</strong> nama lengkap, username, alamat email</li>
            <li><strong>Informasi kontak:</strong> nomor telepon, alamat</li>
            <li><strong>Data transaksi:</strong> riwayat penawaran dan lelang yang diikuti</li>
            <li><strong>Data teknis:</strong> alamat IP, jenis browser, waktu akses</li>
        </ul>

        <h2>3. Cara Kami Menggunakan Data</h2>
        <ul>
            <li>Memproses pendaftaran dan autentikasi akun</li>
            <li>Menjalankan dan mengelola proses lelang</li>
            <li>Mengirimkan notifikasi terkait aktivitas lelang Anda</li>
            <li>Meningkatkan keamanan dan performa platform</li>
            <li>Memenuhi kewajiban hukum yang berlaku</li>
        </ul>

        <h2>4. Keamanan Data</h2>
        <p>Kami menggunakan enkripsi SSL/TLS untuk melindungi data yang dikirimkan. Password disimpan dalam bentuk terenkripsi dan tidak dapat dibaca oleh siapapun termasuk tim kami.</p>

        <h2>5. Berbagi Data</h2>
        <p>Kami tidak menjual, menyewakan, atau membagikan data pribadi Anda kepada pihak ketiga untuk tujuan komersial tanpa persetujuan Anda, kecuali diwajibkan oleh hukum.</p>

        <h2>6. Hak Pengguna</h2>
        <ul>
            <li>Mengakses data pribadi yang kami simpan</li>
            <li>Meminta koreksi data yang tidak akurat</li>
            <li>Meminta penghapusan akun dan data terkait</li>
            <li>Menghubungi kami melalui WhatsApp: <strong>0862-8374-823</strong></li>
        </ul>

        <h2>7. Perubahan Kebijakan</h2>
        <p>Kami dapat memperbarui kebijakan ini sewaktu-waktu. Perubahan signifikan akan diberitahukan melalui email atau notifikasi di platform.</p>

        <h2>8. Hubungi Kami</h2>
        <p>Jika Anda memiliki pertanyaan mengenai kebijakan privasi ini, hubungi kami melalui WhatsApp di <strong>0862-8374-823</strong> atau kunjungi halaman Kontak kami.</p>

        <div class="contact-box">
            <p><strong><i class="bi bi-question-circle-fill"></i> Ada pertanyaan tentang privasi Anda?</strong></p>
            <p>Hubungi kami di <a href="https://wa.me/6208628374823" target="_blank" rel="noopener noreferrer">WhatsApp: 0862-8374-823</a> atau kunjungi <a href="{{ route('static.kontak') }}">halaman Kontak</a>.</p>
        </div>
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
