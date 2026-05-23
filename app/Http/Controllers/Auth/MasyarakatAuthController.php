<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Masyarakat;

class MasyarakatAuthController extends Controller
{
    // ── Login ──────────────────────────────────────────────────────────────────

    public function showLogin()
    {
        if (Auth::guard('masyarakat')->check()) {
            return redirect()->route('masyarakat.dashboard');
        }
        return view('auth.masyarakat.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|min:6',
        ], [
            'email.required'    => 'Email wajib diisi.',
            'email.email'       => 'Format email tidak valid.',
            'password.required' => 'Password wajib diisi.',
            'password.min'      => 'Password minimal 6 karakter.',
        ]);

        $credentials = $request->only('email', 'password');
        $remember    = $request->boolean('remember');

        if (Auth::guard('masyarakat')->attempt($credentials, $remember)) {
            $request->session()->regenerate();

            // Cek status akun
            $user = Auth::guard('masyarakat')->user();
            if ($user->status_akun !== 'aktif') {
                Auth::guard('masyarakat')->logout();
                return back()->withErrors(['email' => 'Akun Anda telah dinonaktifkan.']);
            }

            return redirect()->intended(route('masyarakat.dashboard'));
        }

        return back()
            ->withInput($request->only('email'))
            ->withErrors(['email' => 'Email atau password salah.']);
    }

    // ── Register ───────────────────────────────────────────────────────────────

    public function showRegister()
    {
        if (Auth::guard('masyarakat')->check()) {
            return redirect()->route('masyarakat.dashboard');
        }
        return view('auth.masyarakat.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:25',
            'username'     => 'required|string|max:25|unique:tb_masyarakat,username',
            'email'        => 'required|email|max:100|unique:tb_masyarakat,email',
            'telp'         => 'required|string|max:25|unique:tb_masyarakat,telp',
            'alamat'       => 'required|string|max:255',
            'password'     => 'required|string|min:6|confirmed',
        ], [
            'nama_lengkap.required' => 'Nama lengkap wajib diisi.',
            'username.required'     => 'Username wajib diisi.',
            'username.unique'       => 'Username sudah digunakan.',
            'email.required'        => 'Email wajib diisi.',
            'email.unique'          => 'Email sudah terdaftar.',
            'password.required'     => 'Password wajib diisi.',
            'password.min'          => 'Password minimal 6 karakter.',
            'password.confirmed'    => 'Konfirmasi password tidak cocok.',
            'telp.required'         => 'Nomor Telepon sudah digunakan',
            'telp.unique'           => 'Telpon wajib diisi',
            'alamat.required'       => 'Alamat wajib diisi',
        ]);

        $user = Masyarakat::create([
            'nama_lengkap' => $request->nama_lengkap,
            'username'     => $request->username,
            'email'        => $request->email,
            'telp'         => $request->telp,
            'alamat'       => $request->alamat,
            'password'     => $request->password, // auto-hashed oleh cast
            'status_akun'  => 'aktif',
        ]);

        return redirect()->route('masyarakat.login')
            ->with('success', 'Registrasi berhasil! Silahkan Masuk ke akun MariLelang anda, ' . $user->nama_lengkap . '.');
    }

    // ── Logout ─────────────────────────────────────────────────────────────────

    public function logout(Request $request)
    {
        Auth::guard('masyarakat')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('masyarakat.login')
            ->with('success', 'Anda berhasil logout.');
    }
}
