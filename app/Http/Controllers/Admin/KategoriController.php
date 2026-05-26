<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        $kategori = Kategori::withCount('barang')->latest()->paginate(10);
        return view('admin.kategori.index', compact('kategori'));
    }

    public function create()
    {
        return view('admin.kategori.form');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_kategori'      => 'required|string|max:50|unique:tb_kategori,nama_kategori',
            'deskripsi_kategori' => 'nullable|string|max:255',
        ]);

        Kategori::create($validated);

        return redirect()->route('admin.kategori.index')
            ->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function edit(int $id)
    {
        $kategori = Kategori::findOrFail($id);
        return view('admin.kategori.form', compact('kategori'));
    }

    public function update(Request $request, int $id)
    {
        $kategori = Kategori::findOrFail($id);

        $validated = $request->validate([
            'nama_kategori'      => 'required|string|max:50|unique:tb_kategori,nama_kategori,' . $id . ',id_kategori',
            'deskripsi_kategori' => 'nullable|string|max:255',
        ]);

        $kategori->update($validated);

        return redirect()->route('admin.kategori.index')
            ->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy(int $id)
    {
        $kategori = Kategori::findOrFail($id);
        $kategori->delete();

        return redirect()->route('admin.kategori.index')
            ->with('success', 'Kategori berhasil dihapus.');
    }
}
