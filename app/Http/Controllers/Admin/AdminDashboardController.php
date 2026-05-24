<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $admin = Auth::guard('petugas')->user();

        $stats = [
            'total_user'      => DB::table('tb_masyarakat')->count(),
            'user_aktif'      => DB::table('tb_masyarakat')->where('status_akun', 'aktif')->count(),
            'user_nonaktif'   => DB::table('tb_masyarakat')->where('status_akun', 'nonaktif')->count(),
            'total_barang'    => DB::table('tb_barang')->count(),
            'barang_dilelang' => DB::table('tb_barang')->where('status_barang', 'dilelang')->count(),
            'barang_terjual'  => DB::table('tb_barang')->where('status_barang', 'terjual')->count(),
        ];

        return view('admin.dashboard', compact('admin', 'stats'));
    }
}