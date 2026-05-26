<?php

namespace App\Http\Controllers\Masyarakat;

use App\Http\Controllers\Controller;
use App\Models\Lelang;
use App\Models\Kategori;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::guard('masyarakat')->user();

        // Lelang aktif (berlangsung + dibuka) untuk jadwal
        $lelangAktif = Lelang::with(['barang.kategori'])
            ->whereIn('status', ['berlangsung', 'dibuka'])
            ->latest()
            ->limit(6)
            ->get();

        // Kategori untuk navigasi
        $kategori = Kategori::withCount(['barang' => fn($q) => $q->where('status_barang', 'dilelang')])
            ->orderBy('nama_kategori')
            ->get();

        return view('auth.masyarakat.dashboard', compact('user', 'lelangAktif', 'kategori'));
    }
}
