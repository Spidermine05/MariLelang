<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'MariLelang')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

{{-- NAVBAR --}}
<nav class="ml-navbar">
    <div class="ml-navbar-inner">

        {{-- Logo --}}
        <a href="{{ route('masyarakat.dashboard') }}" class="ml-logo">
            <div class="ml-logo-icon">ML</div>
            <span class="ml-logo-text">MariLelang</span>
        </a>

        {{-- Search --}}
        <div class="ml-search-wrap">
            <svg class="ml-search-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M17 11A6 6 0 115 11a6 6 0 0112 0z"/>
            </svg>
            <input type="text" class="ml-search-input" placeholder="Cari barang lelang...">
        </div>

        {{-- Profile Dropdown --}}
        <div class="ml-nav-right">
            <div class="ml-profile-wrap" id="profileWrap">
                <button class="ml-avatar-btn" id="avatarBtn" aria-label="Menu profil">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A8 8 0 1118.88 6.196M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </button>
                <div class="ml-dropdown" id="profileDropdown">
                    <div class="ml-dropdown-header">
                        <span class="ml-dropdown-name">{{ auth('masyarakat')->user()->nama_lengkap ?? 'Pengguna' }}</span>
                        <span class="ml-dropdown-email">{{ auth('masyarakat')->user()->email ?? '' }}</span>
                    </div>
                    <a href="#" class="ml-dropdown-item">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        Profil
                    </a>
                    <a href="#" class="ml-dropdown-item">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        History
                    </a>
                    <button class="ml-dropdown-item ml-dropdown-logout" id="btnLogout">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                        Logout
                    </button>
                </div>
            </div>
        </div>

    </div>
</nav>

{{-- CONTENT --}}
<main class="ml-main">
    @yield('content')
</main>

{{-- MODAL LOGOUT --}}
<div class="ml-modal-overlay" id="logoutModal">
    <div class="ml-modal">
        <div class="ml-modal-icon">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
            </svg>
        </div>
        <h3 class="ml-modal-title">Apa Anda yakin untuk logout?</h3>
        <p class="ml-modal-desc">Sesi Anda akan diakhiri dan Anda perlu login kembali.</p>
        <div class="ml-modal-actions">
            <button class="ml-btn-batal" id="btnBatal">Batal</button>
            <form method="POST" action="{{ route('masyarakat.logout') }}" id="logoutForm">
                @csrf
                <button type="submit" class="ml-btn-logout">Logout</button>
            </form>
        </div>
    </div>
</div>

<script>
const avatarBtn   = document.getElementById('avatarBtn');
const dropdown    = document.getElementById('profileDropdown');
const btnLogout   = document.getElementById('btnLogout');
const logoutModal = document.getElementById('logoutModal');
const btnBatal    = document.getElementById('btnBatal');

avatarBtn.addEventListener('click', (e) => {
    e.stopPropagation();
    dropdown.classList.toggle('open');
});
document.addEventListener('click', () => dropdown.classList.remove('open'));
btnLogout.addEventListener('click', () => {
    dropdown.classList.remove('open');
    logoutModal.classList.add('open');
});
btnBatal.addEventListener('click', () => logoutModal.classList.remove('open'));
logoutModal.addEventListener('click', (e) => {
    if (e.target === logoutModal) logoutModal.classList.remove('open');
});
</script>

</body>
</html>