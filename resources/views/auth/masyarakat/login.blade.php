@extends('layouts.auth')
@section('title', 'Login Masyarakat')

@section('content')
<div class="auth-wrapper">
    <div class="auth-card">

        {{-- Header --}}
        <div class="auth-header">
            <div class="badge">
                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2a5 5 0 1 1 0 10A5 5 0 0 1 12 2zm0 12c5.33 0 8 2.67 8 4v2H4v-2c0-1.33 2.67-4 8-4z"/></svg>
                Masyarakat
            </div>
            <h1>Selamat Datang</h1>
            <p>Masuk ke akun Marilelang Anda</p>
        </div>

        {{-- Body --}}
        <div class="auth-body">

            {{-- Flash success (dari logout) --}}
            @if(session('success'))
                <div class="alert alert-success">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    {{ session('success') }}
                </div>
            @endif

            {{-- General error --}}
            @if($errors->has('email') && !$errors->has('password'))
                <div class="alert alert-error">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    {{ $errors->first('email') }}
                </div>
            @endif

            <form method="POST" action="{{ route('masyarakat.login') }}">
                @csrf

                {{-- Email --}}
                <div class="form-group">
                    <label for="email">Email</label>
                    <div class="input-wrap">
                        <input
                            type="email" id="email" name="email"
                            value="{{ old('email') }}"
                            placeholder="nama@email.com"
                            class="{{ $errors->has('email') ? 'is-invalid' : '' }}"
                            autocomplete="email" required
                        >
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    </div>
                    @error('email')
                        <span class="field-error">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/></svg>
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                {{-- Password --}}
                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-wrap">
                        <input
                            type="password" id="password" name="password"
                            placeholder="••••••••"
                            class="has-toggle {{ $errors->has('password') ? 'is-invalid' : '' }}"
                            autocomplete="current-password" required
                        >
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
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

                {{-- Remember me --}}
                <label class="remember-row">
                    <input type="checkbox" name="remember"> Ingat saya
                </label>

                <button type="submit" class="btn-primary">Masuk</button>
            </form>

            <p class="auth-footer">
                Belum punya akun? <a href="{{ route('masyarakat.register') }}">Daftar sekarang</a>
            </p>
        </div>
    </div>
</div>
@endsection
