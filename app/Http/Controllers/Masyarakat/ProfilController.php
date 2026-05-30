<?php

namespace App\Http\Controllers\Masyarakat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ProfilController extends Controller
{
    public function edit()
    {
        $user = Auth::guard('masyarakat')->user();
        return view('masyarakat.profil.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::guard('masyarakat')->user();

        $request->validate([
            'nama_lengkap' => ['required', 'string', 'max:100'],
            'username'     => ['required', 'string', 'max:50', Rule::unique('tb_masyarakat', 'username')->ignore($user->id_user, 'id_user')],
            'email'        => ['required', 'email', Rule::unique('tb_masyarakat', 'email')->ignore($user->id_user, 'id_user')],
            'telp'         => ['nullable', 'string', 'max:20'],
            'alamat'       => ['nullable', 'string', 'max:255'],
            'password'     => ['nullable', 'string', 'min:8', 'confirmed'],
        ], [
            'nama_lengkap.required' => 'Nama lengkap wajib diisi.',
            'username.required'     => 'Username wajib diisi.',
            'username.unique'       => 'Username sudah digunakan.',
            'email.required'        => 'Email wajib diisi.',
            'email.unique'          => 'Email sudah digunakan.',
            'password.min'          => 'Password minimal 8 karakter.',
            'password.confirmed'    => 'Konfirmasi password tidak cocok.',
        ]);

        $data = [
            'nama_lengkap' => $request->nama_lengkap,
            'username'     => $request->username,
            'email'        => $request->email,
            'telp'         => $request->telp,
            'alamat'       => $request->alamat,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('masyarakat.profil.edit')
            ->with('success', 'Profil berhasil diperbarui!');
    }
}