<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Level;
use App\Models\Petugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminAuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | SHOW FORMS
    |--------------------------------------------------------------------------
    */

    public function showLoginForm()
{
    if (Auth::guard('petugas')->check() && Auth::guard('petugas')->user()->isAdmin()) {
        return redirect()->route('admin.dashboard');
    }

    return view('auth.admin-login');
}

    public function showRegisterForm()
    {
        return view('auth.admin-register');
    }

    /*
    |--------------------------------------------------------------------------
    | LOGIN
    |--------------------------------------------------------------------------
    */

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:25',
            'password' => 'required|string',
        ], [
            'username.required' => 'Username wajib diisi.',
            'password.required' => 'Password wajib diisi.',
        ]);

        // Cari petugas dengan username tersebut
        $petugas = Petugas::with('level')
            ->where('username', $request->username)
            ->first();

        // Validasi: akun ada, password cocok, dan levelnya administrator
        if (! $petugas || ! Hash::check($request->password, $petugas->password)) {
            return back()
                ->withInput($request->only('username'))
                ->withErrors(['username' => 'Username atau password salah.']);
        }

        if (! $petugas->isAdmin()) {
            return back()
                ->withInput($request->only('username'))
                ->withErrors(['username' => 'Akun ini bukan Administrator. Gunakan portal petugas.']);
        }

        // Login menggunakan guard 'petugas'
        Auth::guard('petugas')->login($petugas, $request->boolean('remember'));

        $request->session()->regenerate();

        return redirect()->intended(route('admin.dashboard'))
            ->with('success', 'Selamat datang, ' . $petugas->nama_petugas . '!');
    }

    /*
    |--------------------------------------------------------------------------
    | REGISTER
    |--------------------------------------------------------------------------
    */

    public function register(Request $request)
    {
        $request->validate([
            'nama_petugas' => 'required|string|max:25',
            'username'     => 'required|string|max:25|unique:tb_petugas,username',
            'password'     => 'required|string|min:8|confirmed',
        ], [
            'nama_petugas.required' => 'Nama lengkap wajib diisi.',
            'nama_petugas.max'      => 'Nama maksimal 25 karakter.',
            'username.required'     => 'Username wajib diisi.',
            'username.max'          => 'Username maksimal 25 karakter.',
            'username.unique'       => 'Username sudah digunakan.',
            'password.required'     => 'Password wajib diisi.',
            'password.min'          => 'Password minimal 8 karakter.',
            'password.confirmed'    => 'Konfirmasi password tidak cocok.',
        ]);

        // Ambil id_level untuk 'administrator'
        $level = Level::where('level', 'administrator')->firstOrFail();

        $petugas = Petugas::create([
            'nama_petugas' => $request->nama_petugas,
            'username'     => $request->username,
            'password'     => Hash::make($request->password),
            'id_level'     => $level->id_level,
        ]);

        // Auto-login setelah register
        Auth::guard('petugas')->login($petugas);
        $request->session()->regenerate();

        return redirect()->route('admin.dashboard')
            ->with('success', 'Akun Administrator berhasil dibuat!');
    }

    /*
    |--------------------------------------------------------------------------
    | LOGOUT
    |--------------------------------------------------------------------------
    */

    public function logout(Request $request)
    {
        Auth::guard('petugas')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login')
            ->with('success', 'Anda telah berhasil keluar.');
    }
}