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
        'nama_lengkap',
        'username',
        'email',
        'password',
        'telp',
        'alamat',
    ];

    protected $hidden = ['password', 'remember_token'];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }
}
