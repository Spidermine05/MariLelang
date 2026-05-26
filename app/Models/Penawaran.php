<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penawaran extends Model
{
    protected $table      = 'tb_penawaran';
    protected $primaryKey = 'id_penawaran';

    protected $fillable = [
        'id_lelang', 'id_user', 'harga_tawar', 'waktu_tawar', 'status_tawar',
    ];

    protected $casts = [
        'waktu_tawar' => 'datetime',
    ];

    // ── Relationships ──────────────────────────────────────────────────────────

    public function lelang()
    {
        return $this->belongsTo(Lelang::class, 'id_lelang', 'id_lelang');
    }

    public function masyarakat()
    {
        return $this->belongsTo(Masyarakat::class, 'id_user', 'id_user');
    }
}
