<?php

namespace App\Http\Controllers\Masyarakat;

use App\Http\Controllers\Controller;
use App\Models\Penawaran;
use Illuminate\Support\Facades\Auth;

class LaporanController extends Controller
{
    public function index()
    {
        $penawaran = Penawaran::with(['lelang.barang'])
            ->where('id_user', Auth::guard('masyarakat')->id())
            ->latest()
            ->paginate(10);

        return view('masyarakat.laporan.index', compact('penawaran'));
    }

    public function exportPdf()
    {
        $user      = Auth::guard('masyarakat')->user();
        $penawaran = Penawaran::with(['lelang.barang'])
            ->where('id_user', $user->id_user)
            ->latest()
            ->get();

        $pdf = app('dompdf.wrapper');
        $pdf->loadView('masyarakat.laporan.pdf', compact('penawaran', 'user'));

        return $pdf->download('laporan-saya-' . now()->format('Ymd') . '.pdf');
    }
}
