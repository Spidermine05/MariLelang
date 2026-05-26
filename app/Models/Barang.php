<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Barang extends Model
{
    protected $table      = 'tb_barang';
    protected $primaryKey = 'id_barang';

    protected $fillable = [
        'nama_barang', 'tgl', 'harga_awal', 'deskripsi_barang',
        'id_kategori', 'foto_barang', 'kondisi', 'status_barang', 'id_petugas',
    ];

    // ── Relationships ──────────────────────────────────────────────────────────

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori', 'id_kategori');
    }

    public function petugas()
    {
        return $this->belongsTo(Petugas::class, 'id_petugas', 'id_petugas');
    }

    public function lelang()
    {
        return $this->hasMany(Lelang::class, 'id_barang', 'id_barang');
    }

    // ── Accessor ───────────────────────────────────────────────────────────────

    public function getFotoUrlAttribute(): string
    {
        if ($this->foto_barang && Storage::disk('public')->exists('barang/' . $this->foto_barang)) {
            return asset('storage/barang/' . $this->foto_barang);
        }
        return 'https://placehold.co/400x300/EEF2FF/4F46E5?text=' . urlencode($this->nama_barang ?? 'Barang');
    }
}
