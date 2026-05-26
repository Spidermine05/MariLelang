<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;
use App\Models\Lelang;
use App\Models\Penawaran;
use App\Models\Barang;
use App\Models\HistoryLelang;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Auto-close lelang yang sudah melewati waktu_selesai
Schedule::call(function () {
    $expired = Lelang::where('status', 'berlangsung')
        ->where('waktu_selesai', '<', now())
        ->with('penawaran')
        ->get();

    foreach ($expired as $lelang) {
        DB::transaction(function () use ($lelang) {
            $pemenang = $lelang->penawaran()->orderByDesc('harga_tawar')->first();

            $lelang->update([
                'status'      => 'ditutup',
                'harga_akhir' => $pemenang?->harga_tawar,
                'id_user'     => $pemenang?->id_user,
            ]);

            if ($pemenang) {
                $pemenang->update(['status_tawar' => 'menang']);
                $lelang->penawaran()->where('id_penawaran', '!=', $pemenang->id_penawaran)->update(['status_tawar' => 'kalah']);

                HistoryLelang::create([
                    'id_lelang'       => $lelang->id_lelang,
                    'id_barang'       => $lelang->id_barang,
                    'id_user'         => $pemenang->id_user,
                    'penawaran_harga' => $pemenang->harga_tawar,
                    'status_history'  => 'menang',
                    'tgl_history'     => now(),
                ]);

                Barang::where('id_barang', $lelang->id_barang)->update(['status_barang' => 'terjual']);
            } else {
                Barang::where('id_barang', $lelang->id_barang)->update(['status_barang' => 'tersedia']);
            }
        });

        Log::info('Lelang auto-closed', ['lelang_id' => $lelang->id_lelang]);
    }
})->everyMinute()->name('auto-close-lelang');
