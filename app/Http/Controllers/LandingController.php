<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class LandingController extends Controller
{
    public function index()
    {
        $stats = [
            'total_barang'      => DB::table('tb_barang')->count(),
            'total_lelang_aktif'=> DB::table('tb_lelang')->whereIn('status', ['dibuka', 'berlangsung'])->count(),
            'total_masyarakat'  => DB::table('tb_masyarakat')->count(),
            'total_terjual'     => DB::table('tb_barang')->where('status_barang', 'terjual')->count(),
        ];

        $lelangAktif = DB::table('tb_lelang as l')
            ->join('tb_barang as b', 'l.id_barang', '=', 'b.id_barang')
            ->leftJoin('tb_kategori as k', 'b.id_kategori', '=', 'k.id_kategori')
            ->leftJoin('tb_penawaran as p', function ($join) {
                $join->on('p.id_lelang', '=', 'l.id_lelang')
                     ->where('p.status_tawar', '=', 'aktif');
            })
            ->whereIn('l.status', ['dibuka', 'berlangsung'])
            ->select(
                'l.id_lelang', 'l.status', 'l.waktu_selesai', 'l.harga_minimal_bid',
                'b.nama_barang', 'b.foto_barang', 'b.harga_awal',
                'k.nama_kategori',
                DB::raw('MAX(p.harga_tawar) as harga_tertinggi')
            )
            ->groupBy(
                'l.id_lelang', 'l.status', 'l.waktu_selesai', 'l.harga_minimal_bid',
                'b.nama_barang', 'b.foto_barang', 'b.harga_awal', 'k.nama_kategori'
            )
            ->orderByDesc('l.id_lelang')
            ->limit(6)
            ->get();

        return view('landing', compact('stats', 'lelangAktif'));
    }
}
