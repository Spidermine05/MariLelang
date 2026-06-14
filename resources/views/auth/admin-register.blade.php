<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Administrator</title>
    @vite(['resources/css/auth-petugas.css'])
</head>
<body>
    <div class="auth-bg">
        <div class="bg-pattern"></div>
        <div class="auth-card auth-card--register">

            {{-- Header --}}
            <div class="card-header">
                <div class="header-badge">
                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                        <circle cx="9" cy="7" r="4"/>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                    </svg>
                    DAFTAR ADMINISTRATOR
                </div>
                <h1 class="header-title">Buat Akun Admin</h1>
                <p class="header-subtitle">Kelola sistem lelang dengan akses penuh</p>
            </div>

            {{-- Disclaimer --}}
            <div class="disclaimer-box">
                <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                </svg>
                <span>Akun Administrator memiliki akses <strong>penuh</strong> ke seluruh sistem.</span>
            </div>

            {{-- Form --}}
            <form method="POST" action="{{ route('admin.register.post') }}" class="auth-form">
                @csrf

                {{-- Error --}}
                @if ($errors->any())
                    <div class="alert-error">
                        <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="10"/>
                            <line x1="15" y1="9" x2="9" y2="15"/>
                            <line x1="9" y1="9" x2="15" y2="15"/>
                        </svg>
                        {{ $errors->first() }}
                    </div>
                @endif

                {{-- Row: Nama + Username --}}
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Nama Lengkap</label>
                        <div class="input-wrapper">
                            <span class="input-icon">
                                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                                    <circle cx="12" cy="7" r="4"/>
                                </svg>
                            </span>
                            <input
                                type="text"
                                name="nama_petugas"
                                class="form-input @error('nama_petugas') input-error @enderror"
                                placeholder="Nama lengkap"
                                value="{{ old('nama_petugas') }}"
                                maxlength="25"
                                required
                            >
                        </div>
                        @error('nama_petugas')
                            <span class="field-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">Username</label>
                        <div class="input-wrapper">
                            <span class="input-icon">
                                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <rect x="3" y="3" width="18" height="18" rx="3"/>
                                    <path d="M3 9h18M9 21V9"/>
                                </svg>
                            </span>
                            <input
                                type="text"
                                name="username"
                                class="form-input @error('username') input-error @enderror"
                                placeholder="Username"
                                value="{{ old('username') }}"
                                maxlength="25"
                                required
                            >
                        </div>
                        @error('username')
                            <span class="field-error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                {{-- Password --}}
                <div class="form-group">
                    <label class="form-label">Password</label>
                    <div class="input-wrapper">
                        <span class="input-icon">
                            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
                                <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                            </svg>
                        </span>
                        <input
                            type="password"
                            name="password"
                            id="password"
                            class="form-input @error('password') input-error @enderror"
                            placeholder="Minimal 8 karakter"
                            autocomplete="new-password"
                            required
                        >
                        <button type="button" class="toggle-password" onclick="togglePass('password','eye1')">
                            <svg id="eye1" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                <circle cx="12" cy="12" r="3"/>
                            </svg>
                        </button>
                    </div>
                    @error('password')
                        <span class="field-error">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Confirm Password --}}
                <div class="form-group">
                    <label class="form-label">Konfirmasi Password</label>
                    <div class="input-wrapper">
                        <span class="input-icon">
                            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
                                <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                            </svg>
                        </span>
                        <input
                            type="password"
                            name="password_confirmation"
                            id="password_confirmation"
                            class="form-input"
                            placeholder="Konfirmasi Password"
                            autocomplete="new-password"
                            required
                        >
                        <button type="button" class="toggle-password" onclick="togglePass('password_confirmation','eye2')">
                            <svg id="eye2" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                <circle cx="12" cy="12" r="3"/>
                            </svg>
                        </button>
                    </div>

                    {{-- Password strength bar --}}
                    <div class="strength-bar" id="strengthBar">
                        <div class="strength-fill" id="strengthFill"></div>
                    </div>
                    <span class="strength-label" id="strengthLabel"></span>
                </div>

                {{-- Submit --}}
                <button type="submit" class="btn-submit">
                    <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                        <circle cx="9" cy="7" r="4"/>
                        <line x1="19" y1="8" x2="19" y2="14"/>
                        <line x1="22" y1="11" x2="16" y2="11"/>
                    </svg>
                    Buat Akun Administrator
                </button>
            </form>

            {{-- Footer --}}
            <div class="card-footer">
                <p>Sudah punya akun? <a href="{{ route('admin.login') }}" class="footer-link">Login Administrator</a></p>
                <p>Login sebagai petugas? <a href="{{ route('petugas.login') }}" class="footer-link">Portal Petugas</a></p>
            </div>

        </div>
    </div>

    <script>
        function togglePass(inputId, iconId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);
            if (input.type === 'password') {
                input.type = 'text';
                icon.innerHTML = `<path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94"/><path d="M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19"/><line x1="1" y1="1" x2="23" y2="23"/>`;
            } else {
                input.type = 'password';
                icon.innerHTML = `<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>`;
            }
        }

        document.getElementById('password').addEventListener('input', function() {
            const val = this.value;
            const fill = document.getElementById('strengthFill');
            const label = document.getElementById('strengthLabel');
            let strength = 0;
            if (val.length >= 8) strength++;
            if (/[A-Z]/.test(val)) strength++;
            if (/[0-9]/.test(val)) strength++;
            if (/[^A-Za-z0-9]/.test(val)) strength++;

            const levels = [
                { pct: '0%',   color: 'transparent', text: '' },
                { pct: '25%',  color: '#ef4444', text: 'Lemah' },
                { pct: '50%',  color: '#f97316', text: 'Cukup' },
                { pct: '75%',  color: '#eab308', text: 'Kuat' },
                { pct: '100%', color: '#10b981', text: 'Sangat Kuat' },
            ];
            fill.style.width = levels[strength].pct;
            fill.style.background = levels[strength].color;
            label.textContent = levels[strength].text;
            label.style.color = levels[strength].color;
        });
    </script>
</body>
</html>