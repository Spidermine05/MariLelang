<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Petugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BarangController extends Controller
{
    public function index(Request $request)
    {
        $query = Barang::with(['kategori', 'petugas']);

        if ($request->filled('search')) {
            $query->where('nama_barang', 'like', '%' . $request->search . '%');
        }

        $barang = $query->latest()->paginate(10)->withQueryString();
        return view('admin.barang.index', compact('barang'));
    }

    public function create()
    {
        $kategori    = Kategori::orderBy('nama_kategori')->get();
        $petugasList = Petugas::orderBy('nama_petugas')->get();
        $nextId      = (Barang::max('id_barang') ?? 0) + 1;
        return view('admin.barang.form', compact('kategori', 'petugasList', 'nextId'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_barang'      => 'required|string|max:25',
            'tgl'              => 'required|date',
            'harga_awal'       => 'required|integer|min:0',
            'deskripsi_barang' => 'required|string|max:100',
            'id_kategori'      => 'required|exists:tb_kategori,id_kategori',
            'id_petugas'       => 'nullable|exists:tb_petugas,id_petugas',
            'kondisi'          => 'required|in:baru,bekas',
            'foto_barang'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $validated['id_petugas']    = $validated['id_petugas'] ?? Auth::guard('petugas')->id();
        $validated['status_barang'] = 'tersedia';

        if ($request->hasFile('foto_barang')) {
            $validated['foto_barang'] = $this->uploadFoto($request->file('foto_barang'));
        }

        Barang::create($validated);

        return redirect()->route('admin.barang.index')
            ->with('success', 'Barang berhasil ditambahkan.');
    }

    public function edit(int $id)
    {
        $barang      = Barang::findOrFail($id);
        $kategori    = Kategori::orderBy('nama_kategori')->get();
        $petugasList = Petugas::orderBy('nama_petugas')->get();
        return view('admin.barang.form', compact('barang', 'kategori', 'petugasList'));
    }

    public function update(Request $request, int $id)
    {
        $barang = Barang::findOrFail($id);

        $validated = $request->validate([
            'nama_barang'      => 'required|string|max:25',
            'tgl'              => 'required|date',
            'harga_awal'       => 'required|integer|min:0',
            'deskripsi_barang' => 'required|string|max:100',
            'id_kategori'      => 'required|exists:tb_kategori,id_kategori',
            'id_petugas'       => 'nullable|exists:tb_petugas,id_petugas',
            'kondisi'          => 'required|in:baru,bekas',
            'foto_barang'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('foto_barang')) {
            if ($barang->foto_barang) {
                Storage::disk('public')->delete('barang/' . $barang->foto_barang);
            }
            $validated['foto_barang'] = $this->uploadFoto($request->file('foto_barang'));
        } else {
            unset($validated['foto_barang']);
        }

        $barang->update($validated);

        return redirect()->route('admin.barang.index')
            ->with('success', 'Barang berhasil diperbarui.');
    }

    public function destroy(int $id)
    {
        $barang = Barang::findOrFail($id);

        if ($barang->foto_barang) {
            Storage::disk('public')->delete('barang/' . $barang->foto_barang);
        }

        $barang->delete();

        return redirect()->route('admin.barang.index')
            ->with('success', 'Barang berhasil dihapus.');
    }

    private function uploadFoto($file): string
    {
        $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
        $file->storeAs('barang', $filename, 'public');
        return $filename;
    }
}