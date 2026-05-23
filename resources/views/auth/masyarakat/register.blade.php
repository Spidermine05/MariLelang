@extends('layouts.auth')
@section('title', 'Daftar Akun')

@section('content')
<div class="auth-wrapper" style="max-width:440px">
    <div class="auth-card">

        {{-- Header --}}
        <div class="auth-header">
            <div class="badge">
                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" viewBox="0 0 24 24"><path d="M15 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm-9-2V7H4v3H1v2h3v3h2v-3h3v-2H6zm9 4c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                Daftar Akun
            </div>
            <h1>Buat Akun Baru</h1>
            <p>Bergabung dengan MariLelang</p>
        </div>

        {{-- Body --}}
        <div class="auth-body">

            <a href="{{ route('masyarakat.login') }}" class="back-link">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                Kembali ke Login
            </a>

            @if($errors->any() && !$errors->has('nama_lengkap') && !$errors->has('username') && !$errors->has('email') && !$errors->has('password') && !$errors->has('password_confirmation'))
                <div class="alert alert-error">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    Terjadi kesalahan, silakan periksa isian Anda.
                </div>
            @endif

            <form method="POST" action="{{ route('masyarakat.register') }}">
                @csrf

                <div class="form-grid-2">
                    {{-- Nama Lengkap --}}
                    <div class="form-group">
                        <label for="nama_lengkap">Nama Lengkap</label>
                        <div class="input-wrap">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                            <input type="text" id="nama_lengkap" name="nama_lengkap"
                                value="{{ old('nama_lengkap') }}"
                                placeholder="Nama Lengkap"
                                class="{{ $errors->has('nama_lengkap') ? 'is-invalid' : '' }}"
                                maxlength="25" required>
                        </div>
                        @error('nama_lengkap')
                            <span class="field-error">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/></svg>
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    {{-- Username --}}
                    <div class="form-group">
                        <label for="username">Username</label>
                        <div class="input-wrap">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0"/></svg>
                            <input type="text" id="username" name="username"
                                value="{{ old('username') }}"
                                placeholder="Username"
                                class="{{ $errors->has('username') ? 'is-invalid' : '' }}"
                                maxlength="25" required>
                        </div>
                        @error('username')
                            <span class="field-error">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/></svg>
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>

                {{-- Email --}}
                <div class="form-group">
                    <label for="email">Email</label>
                    <div class="input-wrap">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        <input type="email" id="email" name="email"
                            value="{{ old('email') }}"
                            placeholder="nama@email.com"
                            class="{{ $errors->has('email') ? 'is-invalid' : '' }}"
                            autocomplete="email" required>
                    </div>
                    @error('email')
                        <span class="field-error">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/></svg>
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <div class="form-grid-2">
                    {{-- No. Telp --}}
                    <div class="form-group">
                        <label for="telp">No. Telp</label>
                        <div class="input-wrap">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                            <input type="tel" id="telp" name="telp"
                                value="{{ old('telp') }}"
                                placeholder="08xxxxxxxxxx"
                                maxlength="25">
                        </div>
                    </div>

                    {{-- Alamat --}}
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <div class="input-wrap">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            <input type="text" id="alamat" name="alamat"
                                value="{{ old('alamat') }}"
                                placeholder="Kota, Provinsi"
                                maxlength="255">
                        </div>
                    </div>
                </div>

                <div class="divider">Password</div>

                <div class="form-grid-2">
                    {{-- Password --}}
                    <div class="form-group">
                        <label for="password">Password</label>
                        <div class="input-wrap">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                            <input type="password" id="password" name="password"
                                placeholder="Min. 6 karakter"
                                class="has-toggle {{ $errors->has('password') ? 'is-invalid' : '' }}"
                                autocomplete="new-password" required>
                            <button type="button" class="toggle-pass" onclick="togglePassword('password')" aria-label="Tampilkan password">
                                <svg class="eye-open" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                <svg class="eye-close" style="display:none" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/></svg>
                            </button>
                        </div>
                        @error('password')
                            <span class="field-error">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/></svg>
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    {{-- Konfirmasi Password --}}
                    <div class="form-group">
                        <label for="password_confirmation">Konfirmasi</label>
                        <div class="input-wrap">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                            <input type="password" id="password_confirmation" name="password_confirmation"
                                placeholder="Ulangi password"
                                class="has-toggle {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}"
                                autocomplete="new-password" required>
                            <button type="button" class="toggle-pass" onclick="togglePassword('password_confirmation')" aria-label="Tampilkan konfirmasi">
                                <svg class="eye-open" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                <svg class="eye-close" style="display:none" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/></svg>
                            </button>
                        </div>
                        @error('password_confirmation')
                            <span class="field-error">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/></svg>
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>

                <button type="submit" class="btn-primary">Buat Akun</button>

            </form>

            <p class="auth-footer">
                Sudah punya akun? <a href="{{ route('masyarakat.login') }}">Masuk sekarang</a>
            </p>
        </div>
    </div>
</div>
@endsection