<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Petugas extends Authenticatable
{
    use Notifiable;

    protected $table      = 'tb_petugas';
    protected $primaryKey = 'id_petugas';

    protected $fillable = [
        'nama_petugas',
        'username',
        'password',
        'id_level',
    ];

    protected $hidden = [
        'password',
    ];
    protected $with = ['level'];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function level()
    {
        return $this->belongsTo(Level::class, 'id_level', 'id_level');
    }

    /*
    |--------------------------------------------------------------------------
    | Helpers
    |--------------------------------------------------------------------------
    */

    /** Cek apakah petugas ini adalah Administrator */
    public function isAdmin(): bool
    {
        return $this->level?->level === 'administrator';
    }

    /** Cek apakah petugas ini adalah Petugas biasa */
    public function isPetugas(): bool
    {
        return $this->level?->level === 'petugas';
    }
}