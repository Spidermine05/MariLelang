<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Lelang;
use App\Models\Masyarakat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $stats = [
            'total_lelang'   => Lelang::count(),
            'lelang_selesai' => Lelang::where('status', 'ditutup')->count(),
            'total_barang'   => Barang::count(),
            'total_user'     => Masyarakat::count(),
            'total_transaksi'=> Lelang::where('status', 'ditutup')->whereNotNull('harga_akhir')->sum('harga_akhir'),
        ];

        $query = Lelang::with(['barang', 'pemenang', 'petugas'])
            ->where('status', 'ditutup');

        if ($request->filled('bulan')) {
            $query->whereMonth('updated_at', $request->bulan);
        }
        if ($request->filled('tahun')) {
            $query->whereYear('updated_at', $request->tahun);
        }

        $lelang = $query->latest()->paginate(10)->withQueryString();

        return view('admin.laporan.index', compact('stats', 'lelang'));
    }

    public function exportPdf(Request $request)
    {
        $query = Lelang::with(['barang', 'pemenang', 'petugas'])
            ->where('status', 'ditutup');

        if ($request->filled('bulan')) {
            $query->whereMonth('updated_at', $request->bulan);
        }
        if ($request->filled('tahun')) {
            $query->whereYear('updated_at', $request->tahun);
        }

        $lelang = $query->latest()->get();
        $stats  = [
            'total_transaksi' => $lelang->sum('harga_akhir'),
            'total_lelang'    => $lelang->count(),
        ];

        $pdf = app('dompdf.wrapper');
        $pdf->loadView('admin.laporan.pdf', compact('lelang', 'stats'));

        return $pdf->download('laporan-admin-' . now()->format('Ymd') . '.pdf');
    }
}
