<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Masyarakat extends Authenticatable
{
    use Notifiable;

    protected $table      = 'tb_masyarakat';
    protected $primaryKey = 'id_user';

    protected $fillable = [
        'nama_lengkap', 'username', 'email', 'password',
        'telp', 'alamat', 'status_akun',
    ];

    protected $hidden = ['password', 'remember_token'];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    // ── Relationships ──────────────────────────────────────────────────────────

    public function penawaran()
    {
        return $this->hasMany(Penawaran::class, 'id_user', 'id_user');
    }

    public function lelangDimenangkan()
    {
        return $this->hasMany(Lelang::class, 'id_user', 'id_user');
    }

    public function historyLelang()
    {
        return $this->hasMany(HistoryLelang::class, 'id_user', 'id_user');
    }
}
