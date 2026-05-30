<?php

namespace App\Http\Controllers\Masyarakat;

use App\Http\Controllers\Controller;
use App\Models\Lelang;
use App\Models\Penawaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PenawaranController extends Controller
{
    public function store(Request $request, int $lelangId)
    {
        $lelang = Lelang::with('barang')->where('status', 'berlangsung')->findOrFail($lelangId);

        // Cek apakah waktu lelang sudah habis
        if ($lelang->waktu_selesai && now()->greaterThanOrEqualTo($lelang->waktu_selesai)) {
            $lelang->update(['status' => 'selesai']);
            return redirect()->route('masyarakat.lelang.show', $lelangId)
                ->with('error', 'Waktu lelang sudah habis. Penawaran tidak dapat diajukan.');
        }

        $tertinggi = $lelang->penawaran()->orderByDesc('harga_tawar')->value('harga_tawar')
            ?? $lelang->barang->harga_awal;

        $minBid = $tertinggi + $lelang->harga_minimal_bid;

        $request->validate([
            'harga_tawar' => ['required', 'integer', 'min:' . $minBid],
        ], [
            'harga_tawar.min' => 'Penawaran minimal Rp ' . number_format($minBid, 0, ',', '.'),
        ]);

        $userId = Auth::guard('masyarakat')->id();

        DB::transaction(function () use ($request, $lelangId, $userId) {
            Penawaran::create([
                'id_lelang'    => $lelangId,
                'id_user'      => $userId,
                'harga_tawar'  => $request->harga_tawar,
                'waktu_tawar'  => now(),
                'status_tawar' => 'aktif',
            ]);
        });

        Log::info('Bid submitted', ['user_id' => $userId, 'lelang_id' => $lelangId, 'amount' => $request->harga_tawar]);

        return redirect()->route('masyarakat.lelang.show', $lelangId)
            ->with('success', 'Penawaran berhasil diajukan!');
    }

    public function riwayat()
    {
        $penawaran = Penawaran::with(['lelang.barang'])
            ->where('id_user', Auth::guard('masyarakat')->id())
            ->latest()
            ->paginate(10);

        return view('masyarakat.penawaran.riwayat', compact('penawaran'));
    }
}