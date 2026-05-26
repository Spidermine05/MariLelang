<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Masyarakat;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $users = Masyarakat::latest()->paginate(10);
        return view('admin.user.index', compact('users'));
    }

    public function show(int $id)
    {
        $user = Masyarakat::with('penawaran.lelang.barang')->findOrFail($id);
        return view('admin.user.show', compact('user'));
    }

    public function aktivasi(int $id)
    {
        $user = Masyarakat::findOrFail($id);
        $user->update(['status_akun' => 'aktif']);

        Log::info('Admin aktivasi user', ['admin_id' => Auth::guard('petugas')->id(), 'user_id' => $id]);

        return redirect()->route('admin.users.index')
            ->with('success', 'Akun pengguna berhasil diaktifkan.');
    }

    public function nonaktifkan(int $id)
    {
        $user = Masyarakat::findOrFail($id);
        $user->update(['status_akun' => 'nonaktif']);

        Log::info('Admin nonaktifkan user', ['admin_id' => Auth::guard('petugas')->id(), 'user_id' => $id]);

        return redirect()->route('admin.users.index')
            ->with('success', 'Akun pengguna berhasil dinonaktifkan.');
    }
}
