<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\HistoryLelang;
use App\Models\Lelang;
use App\Models\Penawaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class LelangController extends Controller
{
    public function index()
    {
        $lelang = Lelang::with('barang')
            ->where('id_petugas', Auth::guard('petugas')->id())
            ->latest()
            ->paginate(10);

        return view('petugas.lelang.index', compact('lelang'));
    }

    public function create()
    {
        $barang = Barang::where('status_barang', 'tersedia')
            ->where('id_petugas', Auth::guard('petugas')->id())
            ->orderBy('nama_barang')
            ->get();

        return view('petugas.lelang.form', compact('barang'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_barang'         => 'required|exists:tb_barang,id_barang',
            'waktu_mulai'       => 'required|date',
            'waktu_selesai'     => 'required|date|after:waktu_mulai',
            'harga_minimal_bid' => 'required|integer|min:0',
        ]);

        $validated['id_petugas'] = Auth::guard('petugas')->id();
        $validated['tgl_lelang'] = now()->toDateString();
        $validated['status']     = 'dibuka';

        DB::transaction(function () use ($validated) {
            Lelang::create($validated);
            Barang::where('id_barang', $validated['id_barang'])
                ->update(['status_barang' => 'dilelang']);
        });

        return redirect()->route('petugas.lelang.index')
            ->with('success', 'Lelang berhasil dibuat.');
    }

    public function show(int $id)
    {
        $lelang = Lelang::with(['barang', 'penawaran.masyarakat'])
            ->where('id_petugas', Auth::guard('petugas')->id())
            ->findOrFail($id);

        return view('petugas.lelang.show', compact('lelang'));
    }

    public function buka(int $id)
    {
        $lelang = Lelang::where('id_petugas', Auth::guard('petugas')->id())
            ->where('status', 'dibuka')
            ->findOrFail($id);

        $lelang->update(['status' => 'berlangsung', 'waktu_mulai' => now()]);

        Log::info('Lelang dibuka', ['petugas_id' => Auth::guard('petugas')->id(), 'lelang_id' => $id]);

        return redirect()->route('petugas.lelang.index')
            ->with('success', 'Lelang berhasil dibuka.');
    }

    public function tutup(int $id)
    {
        $lelang = Lelang::with('penawaran')
            ->where('id_petugas', Auth::guard('petugas')->id())
            ->where('status', 'berlangsung')
            ->findOrFail($id);

        DB::transaction(function () use ($lelang) {
            $pemenang = $lelang->penawaran()
                ->orderByDesc('harga_tawar')
                ->first();

            $lelang->update([
                'status'      => 'ditutup',
                'harga_akhir' => $pemenang?->harga_tawar,
                'id_user'     => $pemenang?->id_user,
            ]);

            if ($pemenang) {
                // Tandai penawaran pemenang
                $pemenang->update(['status_tawar' => 'menang']);

                // Tandai semua penawaran lain sebagai kalah
                $lelang->penawaran()
                    ->where('id_penawaran', '!=', $pemenang->id_penawaran)
                    ->update(['status_tawar' => 'kalah']);

                // Simpan ke history
                HistoryLelang::create([
                    'id_lelang'       => $lelang->id_lelang,
                    'id_barang'       => $lelang->id_barang,
                    'id_user'         => $pemenang->id_user,
                    'penawaran_harga' => $pemenang->harga_tawar,
                    'status_history'  => 'menang',
                    'tgl_history'     => now(),
                ]);

                Barang::where('id_barang', $lelang->id_barang)
                    ->update(['status_barang' => 'terjual']);
            } else {
                Barang::where('id_barang', $lelang->id_barang)
                    ->update(['status_barang' => 'tersedia']);
            }
        });

        Log::info('Lelang ditutup', ['petugas_id' => Auth::guard('petugas')->id(), 'lelang_id' => $lelang->id_lelang]);

        return redirect()->route('petugas.lelang.index')
            ->with('success', 'Lelang berhasil ditutup.');
    }
}
