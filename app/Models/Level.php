<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    protected $table      = 'tb_level';
    protected $primaryKey = 'id_level';

    protected $fillable = [
        'level',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function petugas()
    {
        return $this->hasMany(Petugas::class, 'id_level', 'id_level');
    }
}