<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lelang extends Model
{
    protected $table      = 'tb_lelang';
    protected $primaryKey = 'id_lelang';

    protected $fillable = [
        'id_barang', 'tgl_lelang', 'harga_akhir', 'id_user', 'id_petugas',
        'status', 'waktu_mulai', 'waktu_selesai', 'harga_minimal_bid',
    ];

    protected $casts = [
        'waktu_mulai'   => 'datetime',
        'waktu_selesai' => 'datetime',
        'tgl_lelang'    => 'date',
    ];

    // ── Relationships ──────────────────────────────────────────────────────────

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang', 'id_barang');
    }

    public function petugas()
    {
        return $this->belongsTo(Petugas::class, 'id_petugas', 'id_petugas');
    }

    public function pemenang()
    {
        return $this->belongsTo(Masyarakat::class, 'id_user', 'id_user');
    }

    public function penawaran()
    {
        return $this->hasMany(Penawaran::class, 'id_lelang', 'id_lelang');
    }

    public function historyLelang()
    {
        return $this->hasMany(HistoryLelang::class, 'id_lelang', 'id_lelang');
    }

    // ── Helpers ────────────────────────────────────────────────────────────────

    public function penawaranTertinggi(): ?Penawaran
    {
        return $this->penawaran()->orderByDesc('harga_tawar')->first();
    }
}
