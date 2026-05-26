<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table      = 'tb_kategori';
    protected $primaryKey = 'id_kategori';

    protected $fillable = ['nama_kategori', 'deskripsi_kategori'];

    public function barang()
    {
        return $this->hasMany(Barang::class, 'id_kategori', 'id_kategori');
    }
}
