<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Petugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PetugasAuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | SHOW FORM
    |--------------------------------------------------------------------------
    */

    public function showLoginForm()
    {
        // Jika sudah login sebagai petugas, langsung ke dashboard
        if (Auth::guard('petugas')->check() && Auth::guard('petugas')->user()->isPetugas()) {
            return redirect()->route('petugas.dashboard');
        }

        return view('auth.petugas-login');
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

        // Validasi: akun ada dan password cocok
        if (! $petugas || ! Hash::check($request->password, $petugas->password)) {
            return back()
                ->withInput($request->only('username'))
                ->withErrors(['username' => 'Username atau password salah.']);
        }

        // Petugas tidak boleh login lewat portal admin (dan sebaliknya)
        if ($petugas->isAdmin()) {
            return back()
                ->withInput($request->only('username'))
                ->withErrors(['username' => 'Akun Administrator tidak dapat login di sini. Gunakan portal administrator.']);
        }

        // Login menggunakan guard 'petugas'
        Auth::guard('petugas')->login($petugas, $request->boolean('remember'));

        $request->session()->regenerate();

        return redirect()->intended(route('petugas.dashboard'))
            ->with('success', 'Selamat datang, ' . $petugas->nama_petugas . '!');
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

        return redirect()->route('petugas.login')
            ->with('success', 'Anda telah berhasil keluar.');
    }
}