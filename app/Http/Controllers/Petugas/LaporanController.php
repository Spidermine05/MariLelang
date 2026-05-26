<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Lelang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $query = Lelang::with(['barang', 'pemenang'])
            ->where('id_petugas', Auth::guard('petugas')->id())
            ->where('status', 'ditutup');

        if ($request->filled('dari')) {
            $query->whereDate('updated_at', '>=', $request->dari);
        }
        if ($request->filled('sampai')) {
            $query->whereDate('updated_at', '<=', $request->sampai);
        }

        $lelang = $query->latest()->paginate(10)->withQueryString();

        return view('petugas.laporan.index', compact('lelang'));
    }

    public function exportPdf(Request $request)
    {
        $query = Lelang::with(['barang', 'pemenang'])
            ->where('id_petugas', Auth::guard('petugas')->id())
            ->where('status', 'ditutup');

        if ($request->filled('dari')) {
            $query->whereDate('updated_at', '>=', $request->dari);
        }
        if ($request->filled('sampai')) {
            $query->whereDate('updated_at', '<=', $request->sampai);
        }

        $lelang  = $query->latest()->get();
        $petugas = Auth::guard('petugas')->user();

        $pdf = app('dompdf.wrapper');
        $pdf->loadView('petugas.laporan.pdf', compact('lelang', 'petugas'));

        return $pdf->download('laporan-lelang-' . now()->format('Ymd') . '.pdf');
    }
}
