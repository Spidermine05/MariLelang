@extends('layouts.app-masyarakat')
@section('title', 'Edit Profil — MariLelang')
@section('content')

<div style="min-height:calc(100vh - 68px); background:#F0F2F8; padding:32px 20px;">
<div style="max-width:640px; margin:0 auto;">

    {{-- Header --}}
    <div style="margin-bottom:24px;">
        <a href="{{ route('masyarakat.dashboard') }}" style="display:inline-flex; align-items:center; gap:6px; color:#64748B; text-decoration:none; font-size:13px; font-weight:600; margin-bottom:16px;">
            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M19 12H5M12 5l-7 7 7 7"/></svg>
            Kembali ke Dashboard
        </a>
        <h1 style="font-size:22px; font-weight:900; color:#1A1A2E; margin:0 0 4px;">Edit Profil</h1>
        <p style="font-size:14px; color:#64748B; margin:0;">Perbarui informasi akun kamu</p>
    </div>

    {{-- Avatar Card --}}
    <div style="background:white; border-radius:16px; border:1px solid #E2E6F0; padding:24px; margin-bottom:20px; display:flex; align-items:center; gap:20px; box-shadow:0 2px 12px #0000000a;">
        <div style="width:72px; height:72px; border-radius:50%; background:linear-gradient(135deg,#5261c8,#6366F1); display:flex; align-items:center; justify-content:center; font-size:28px; font-weight:800; color:white; flex-shrink:0;">
            {{ strtoupper(substr($user->nama_lengkap, 0, 1)) }}
        </div>
        <div>
            <div style="font-size:18px; font-weight:800; color:#1A1A2E;">{{ $user->nama_lengkap }}</div>
            <div style="font-size:13px; color:#64748B; margin-top:2px;">{{ $user->email }}</div>
            <div style="display:inline-flex; align-items:center; gap:5px; background:#EEF2FF; color:#4F46E5; border-radius:50px; padding:3px 10px; font-size:11px; font-weight:700; margin-top:8px;">
                <span style="width:6px; height:6px; border-radius:50%; background:#4F46E5; display:inline-block;"></span>
                Akun Aktif
            </div>
        </div>
    </div>

    {{-- Alerts --}}
    @if(session('success'))
    <div style="background:#F0FDF4; border:1px solid #BBF7D0; border-radius:12px; padding:14px 16px; margin-bottom:20px; display:flex; align-items:center; gap:10px; font-size:14px; color:#15803D; font-weight:600;">
        <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M22 11.08V12a10 10 0 11-5.93-9.14"/><path d="M22 4L12 14.01l-3-3"/></svg>
        {{ session('success') }}
    </div>
    @endif
    @if($errors->any())
    <div style="background:#FEF2F2; border:1px solid #FECACA; border-radius:12px; padding:14px 16px; margin-bottom:20px; font-size:13px; color:#DC2626; font-weight:600;">
        <div style="display:flex; align-items:center; gap:8px; margin-bottom:6px;">
            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
            Terdapat kesalahan:
        </div>
        <ul style="margin:0; padding-left:20px;">
            @foreach($errors->all() as $error)
                <li style="margin-bottom:2px;">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    {{-- Form --}}
    <form method="POST" action="{{ route('masyarakat.profil.update') }}">
        @csrf
        @method('PUT')

        {{-- Informasi Dasar --}}
        <div style="background:white; border-radius:16px; border:1px solid #E2E6F0; padding:24px; margin-bottom:20px; box-shadow:0 2px 12px #0000000a;">
            <div style="font-size:13px; font-weight:800; color:#4F46E5; text-transform:uppercase; letter-spacing:.08em; margin-bottom:20px; display:flex; align-items:center; gap:8px;">
                <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                Informasi Dasar
            </div>

            {{-- Nama Lengkap --}}
            <div style="margin-bottom:16px;">
                <label style="display:block; font-size:12px; font-weight:700; color:#374151; margin-bottom:6px; letter-spacing:.02em;">NAMA LENGKAP</label>
                <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap', $user->nama_lengkap) }}"
                    placeholder="Nama lengkap kamu"
                    style="width:100%; padding:11px 14px; border:1.5px solid {{ $errors->has('nama_lengkap') ? '#EF4444' : '#E2E6F0' }}; border-radius:10px; font-size:14px; font-family:inherit; outline:none; box-sizing:border-box; transition:border-color .2s, box-shadow .2s; background:#FAFBFF; color:#1A1A2E;"
                    onfocus="this.style.borderColor='#5261c8'; this.style.boxShadow='0 0 0 3px #5261c81A';"
                    onblur="this.style.borderColor='{{ $errors->has('nama_lengkap') ? '#EF4444' : '#E2E6F0' }}'; this.style.boxShadow='none';">
                @error('nama_lengkap')<span style="color:#EF4444; font-size:11px; font-weight:600; margin-top:4px; display:block;">{{ $message }}</span>@enderror
            </div>

            {{-- Username --}}
            <div style="margin-bottom:16px;">
                <label style="display:block; font-size:12px; font-weight:700; color:#374151; margin-bottom:6px; letter-spacing:.02em;">USERNAME</label>
                <input type="text" name="username" value="{{ old('username', $user->username) }}"
                    placeholder="Username unik kamu"
                    style="width:100%; padding:11px 14px; border:1.5px solid {{ $errors->has('username') ? '#EF4444' : '#E2E6F0' }}; border-radius:10px; font-size:14px; font-family:inherit; outline:none; box-sizing:border-box; transition:border-color .2s, box-shadow .2s; background:#FAFBFF; color:#1A1A2E;"
                    onfocus="this.style.borderColor='#5261c8'; this.style.boxShadow='0 0 0 3px #5261c81A';"
                    onblur="this.style.borderColor='{{ $errors->has('username') ? '#EF4444' : '#E2E6F0' }}'; this.style.boxShadow='none';">
                @error('username')<span style="color:#EF4444; font-size:11px; font-weight:600; margin-top:4px; display:block;">{{ $message }}</span>@enderror
            </div>

            {{-- Email --}}
            <div style="margin-bottom:0;">
                <label style="display:block; font-size:12px; font-weight:700; color:#374151; margin-bottom:6px; letter-spacing:.02em;">EMAIL</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}"
                    placeholder="email@contoh.com"
                    style="width:100%; padding:11px 14px; border:1.5px solid {{ $errors->has('email') ? '#EF4444' : '#E2E6F0' }}; border-radius:10px; font-size:14px; font-family:inherit; outline:none; box-sizing:border-box; transition:border-color .2s, box-shadow .2s; background:#FAFBFF; color:#1A1A2E;"
                    onfocus="this.style.borderColor='#5261c8'; this.style.boxShadow='0 0 0 3px #5261c81A';"
                    onblur="this.style.borderColor='{{ $errors->has('email') ? '#EF4444' : '#E2E6F0' }}'; this.style.boxShadow='none';">
                @error('email')<span style="color:#EF4444; font-size:11px; font-weight:600; margin-top:4px; display:block;">{{ $message }}</span>@enderror
            </div>
        </div>

        {{-- Kontak --}}
        <div style="background:white; border-radius:16px; border:1px solid #E2E6F0; padding:24px; margin-bottom:20px; box-shadow:0 2px 12px #0000000a;">
            <div style="font-size:13px; font-weight:800; color:#4F46E5; text-transform:uppercase; letter-spacing:.08em; margin-bottom:20px; display:flex; align-items:center; gap:8px;">
                <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 9.81 19.79 19.79 0 012 1.18 2 2 0 014 2h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 16.92z"/></svg>
                Kontak & Alamat
            </div>

            {{-- Telepon --}}
            <div style="margin-bottom:16px;">
                <label style="display:block; font-size:12px; font-weight:700; color:#374151; margin-bottom:6px; letter-spacing:.02em;">NO. TELEPON</label>
                <input type="tel" name="telp" value="{{ old('telp', $user->telp) }}"
                    placeholder="08xxxxxxxxxx"
                    style="width:100%; padding:11px 14px; border:1.5px solid #E2E6F0; border-radius:10px; font-size:14px; font-family:inherit; outline:none; box-sizing:border-box; transition:border-color .2s, box-shadow .2s; background:#FAFBFF; color:#1A1A2E;"
                    onfocus="this.style.borderColor='#5261c8'; this.style.boxShadow='0 0 0 3px #5261c81A';"
                    onblur="this.style.borderColor='#E2E6F0'; this.style.boxShadow='none';">
            </div>

            {{-- Alamat --}}
            <div style="margin-bottom:0;">
                <label style="display:block; font-size:12px; font-weight:700; color:#374151; margin-bottom:6px; letter-spacing:.02em;">ALAMAT</label>
                <textarea name="alamat" rows="3"
                    placeholder="Jl. Contoh No. 1, Kota, Provinsi"
                    style="width:100%; padding:11px 14px; border:1.5px solid #E2E6F0; border-radius:10px; font-size:14px; font-family:inherit; outline:none; box-sizing:border-box; transition:border-color .2s, box-shadow .2s; background:#FAFBFF; color:#1A1A2E; resize:vertical;"
                    onfocus="this.style.borderColor='#5261c8'; this.style.boxShadow='0 0 0 3px #5261c81A';"
                    onblur="this.style.borderColor='#E2E6F0'; this.style.boxShadow='none';">{{ old('alamat', $user->alamat) }}</textarea>
            </div>
        </div>

        {{-- Ganti Password --}}
        <div style="background:white; border-radius:16px; border:1px solid #E2E6F0; padding:24px; margin-bottom:24px; box-shadow:0 2px 12px #0000000a;">
            <div style="font-size:13px; font-weight:800; color:#4F46E5; text-transform:uppercase; letter-spacing:.08em; margin-bottom:4px; display:flex; align-items:center; gap:8px;">
                <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0110 0v4"/></svg>
                Ganti Password
            </div>
            <p style="font-size:12px; color:#94A3B8; margin-bottom:20px;">Kosongkan jika tidak ingin mengganti password.</p>

            {{-- Password Baru --}}
            <div style="margin-bottom:16px;">
                <label style="display:block; font-size:12px; font-weight:700; color:#374151; margin-bottom:6px; letter-spacing:.02em;">PASSWORD BARU</label>
                <div style="position:relative;">
                    <input type="password" name="password" id="password"
                        placeholder="Minimal 8 karakter"
                        style="width:100%; padding:11px 44px 11px 14px; border:1.5px solid {{ $errors->has('password') ? '#EF4444' : '#E2E6F0' }}; border-radius:10px; font-size:14px; font-family:inherit; outline:none; box-sizing:border-box; transition:border-color .2s, box-shadow .2s; background:#FAFBFF; color:#1A1A2E;"
                        onfocus="this.style.borderColor='#5261c8'; this.style.boxShadow='0 0 0 3px #5261c81A';"
                        onblur="this.style.borderColor='{{ $errors->has('password') ? '#EF4444' : '#E2E6F0' }}'; this.style.boxShadow='none';">
                    <button type="button" onclick="togglePass('password', this)"
                        style="position:absolute; right:12px; top:50%; transform:translateY(-50%); background:none; border:none; cursor:pointer; color:#94A3B8; padding:2px; display:flex; align-items:center;">
                        <svg class="eye-icon" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                    </button>
                </div>
                @error('password')<span style="color:#EF4444; font-size:11px; font-weight:600; margin-top:4px; display:block;">{{ $message }}</span>@enderror
            </div>

            {{-- Konfirmasi Password --}}
            <div style="margin-bottom:0;">
                <label style="display:block; font-size:12px; font-weight:700; color:#374151; margin-bottom:6px; letter-spacing:.02em;">KONFIRMASI PASSWORD BARU</label>
                <div style="position:relative;">
                    <input type="password" name="password_confirmation" id="password_confirmation"
                        placeholder="Ulangi password baru"
                        style="width:100%; padding:11px 44px 11px 14px; border:1.5px solid #E2E6F0; border-radius:10px; font-size:14px; font-family:inherit; outline:none; box-sizing:border-box; transition:border-color .2s, box-shadow .2s; background:#FAFBFF; color:#1A1A2E;"
                        onfocus="this.style.borderColor='#5261c8'; this.style.boxShadow='0 0 0 3px #5261c81A';"
                        onblur="this.style.borderColor='#E2E6F0'; this.style.boxShadow='none';">
                    <button type="button" onclick="togglePass('password_confirmation', this)"
                        style="position:absolute; right:12px; top:50%; transform:translateY(-50%); background:none; border:none; cursor:pointer; color:#94A3B8; padding:2px; display:flex; align-items:center;">
                        <svg class="eye-icon" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                    </button>
                </div>
            </div>
        </div>

        {{-- Submit --}}
        <div style="display:flex; gap:12px;">
            <a href="{{ route('masyarakat.dashboard') }}"
                style="flex:1; text-align:center; padding:14px; background:white; color:#64748B; border:1.5px solid #E2E6F0; border-radius:12px; font-size:15px; font-weight:700; text-decoration:none; transition:all .2s; display:block;"
                onmouseover="this.style.borderColor='#5261c8'; this.style.color='#5261c8';"
                onmouseout="this.style.borderColor='#E2E6F0'; this.style.color='#64748B';">
                Batal
            </a>
            <button type="submit"
                style="flex:2; padding:14px; background:linear-gradient(135deg,#5261c8,#6366F1); color:white; border:none; border-radius:12px; font-size:15px; font-weight:800; cursor:pointer; font-family:inherit; box-shadow:0 4px 14px #5261c84D; transition:transform .15s, box-shadow .15s;"
                onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 20px #5261c866';"
                onmouseout="this.style.transform=''; this.style.boxShadow='0 4px 14px #5261c84D';">
                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" style="vertical-align:middle; margin-right:6px;"><path d="M19 21H5a2 2 0 01-2-2V5a2 2 0 012-2h11l5 5v11a2 2 0 01-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                Simpan Perubahan
            </button>
        </div>

    </form>
</div>
</div>

<script>
function togglePass(id, btn) {
    const input = document.getElementById(id);
    const isPass = input.type === 'password';
    input.type = isPass ? 'text' : 'password';
    btn.style.color = isPass ? '#5261c8' : '#94A3B8';
}
</script>
@endsection