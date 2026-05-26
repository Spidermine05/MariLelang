<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Level;
use App\Models\Petugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class PetugasController extends Controller
{
    public function index()
    {
        $petugas = Petugas::with('level')->latest()->paginate(10);
        return view('admin.petugas.index', compact('petugas'));
    }

    public function create()
    {
        $levels = Level::where('level', 'petugas')->get();
        return view('admin.petugas.form', compact('levels'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_petugas' => 'required|string|max:25',
            'username'     => 'required|string|max:25|unique:tb_petugas,username',
            'password'     => ['required', 'string', 'min:8', 'confirmed', new \App\Rules\StrongPassword],
            'id_level'     => 'required|exists:tb_level,id_level',
        ]);

        $validated['password'] = Hash::make($validated['password']);

        Petugas::create($validated);

        Log::info('Admin tambah petugas', ['admin_id' => Auth::guard('petugas')->id(), 'username' => $validated['username']]);

        return redirect()->route('admin.petugas.index')
            ->with('success', 'Petugas berhasil ditambahkan.');
    }

    public function edit(int $id)
    {
        $petugas = Petugas::findOrFail($id);
        $levels  = Level::where('level', 'petugas')->get();
        return view('admin.petugas.form', compact('petugas', 'levels'));
    }

    public function update(Request $request, int $id)
    {
        $petugas = Petugas::findOrFail($id);

        $validated = $request->validate([
            'nama_petugas' => 'required|string|max:25',
            'username'     => 'required|string|max:25|unique:tb_petugas,username,' . $id . ',id_petugas',
            'password'     => ['nullable', 'string', 'min:8', 'confirmed', new \App\Rules\StrongPassword],
            'id_level'     => 'required|exists:tb_level,id_level',
        ]);

        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $petugas->update($validated);

        Log::info('Admin update petugas', ['admin_id' => Auth::guard('petugas')->id(), 'petugas_id' => $id]);

        return redirect()->route('admin.petugas.index')
            ->with('success', 'Data petugas berhasil diperbarui.');
    }

    public function destroy(int $id)
    {
        if ($id === Auth::guard('petugas')->id()) {
            return redirect()->route('admin.petugas.index')
                ->with('error', 'Anda tidak dapat menghapus akun sendiri.');
        }

        $petugas = Petugas::findOrFail($id);
        $petugas->delete();

        Log::info('Admin hapus petugas', ['admin_id' => Auth::guard('petugas')->id(), 'petugas_id' => $id]);

        return redirect()->route('admin.petugas.index')
            ->with('success', 'Petugas berhasil dihapus.');
    }
}
