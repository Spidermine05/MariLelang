<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    // ─── LOGIN ────────────────────────────────────────────────────────────────

    public function showLogin()
    {
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::guard('admin')->attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended(route('admin.dashboard'))
                ->with('success', 'Selamat datang kembali, ' . Auth::guard('admin')->user()->name . '!');
        }

        return back()
            ->withInput($request->only('email', 'remember'))
            ->withErrors(['email' => 'Email atau password tidak valid.']);
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login')
            ->with('success', 'Anda telah berhasil logout.');
    }

    // ─── REGISTER ─────────────────────────────────────────────────────────────

    public function showRegister()
    {
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.auth.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name'     => ['required', 'string', 'max:100'],
            'email'    => ['required', 'email', 'unique:admins,email'],
            'password' => ['required', 'confirmed', Password::min(8)->mixedCase()->numbers()],
            'secret_key' => ['required', 'string'],
        ]);

        // Validasi secret key pendaftaran admin (ubah sesuai kebutuhan)
        if ($validated['secret_key'] !== config('admin.registration_key', env('ADMIN_REGISTRATION_KEY', 'ADMIN-SECRET-2024'))) {
            return back()
                ->withInput($request->except('password', 'password_confirmation', 'secret_key'))
                ->withErrors(['secret_key' => 'Kunci registrasi admin tidak valid.']);
        }

        $admin = Admin::create([
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        Auth::guard('admin')->login($admin);

        return redirect()->route('admin.dashboard')
            ->with('success', 'Akun administrator berhasil dibuat!');
    }
}