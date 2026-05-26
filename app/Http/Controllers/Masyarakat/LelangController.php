<?php

namespace App\Http\Controllers\Masyarakat;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\Lelang;
use Illuminate\Http\Request;

class LelangController extends Controller
{
    public function index()
    {
        $lelang = Lelang::with(['barang.kategori'])
            ->where('status', 'berlangsung')
            ->latest()
            ->paginate(12);

        return view('masyarakat.lelang.index', compact('lelang'));
    }

    public function show(int $id)
    {
        $lelang = Lelang::with(['barang.kategori', 'penawaran.masyarakat'])
            ->where('status', 'berlangsung')
            ->findOrFail($id);

        $penawaranTertinggi = $lelang->penawaran()
            ->orderByDesc('harga_tawar')
            ->first();

        return view('masyarakat.lelang.show', compact('lelang', 'penawaranTertinggi'));
    }

    public function search(Request $request)
    {
        $query = Lelang::with(['barang.kategori'])
            ->whereIn('status', ['berlangsung', 'dibuka']);

        if ($request->filled('q')) {
            $query->whereHas('barang', fn($q) =>
                $q->where('nama_barang', 'like', '%' . $request->q . '%')
            );
        }

        if ($request->filled('id_kategori')) {
            $query->whereHas('barang', fn($q) =>
                $q->where('id_kategori', $request->id_kategori)
            );
        }

        if ($request->filled('harga_min')) {
            $query->whereHas('barang', fn($q) =>
                $q->where('harga_awal', '>=', $request->harga_min)
            );
        }

        if ($request->filled('harga_max')) {
            $query->whereHas('barang', fn($q) =>
                $q->where('harga_awal', '<=', $request->harga_max)
            );
        }

        $lelang   = $query->latest()->paginate(12)->withQueryString();
        $kategori = Kategori::orderBy('nama_kategori')->get();

        return view('masyarakat.lelang.search', compact('lelang', 'kategori'));
    }
}
