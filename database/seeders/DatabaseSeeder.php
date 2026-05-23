<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Seed tb_level
        DB::table('tb_level')->insert([
            ['level' => 'administrator', 'created_at' => now(), 'updated_at' => now()],
            ['level' => 'petugas',       'created_at' => now(), 'updated_at' => now()],
        ]);

        // Seed tb_petugas (akun admin default)
        DB::table('tb_petugas')->insert([
            [
                'nama_petugas' => 'Administrator',
                'username'     => 'admin',
                'password'     => Hash::make('admin123'),
                'id_level'     => 1, // administrator
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'nama_petugas' => 'Petugas Satu',
                'username'     => 'petugas1',
                'password'     => Hash::make('petugas123'),
                'id_level'     => 2, // petugas
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
        ]);

        // Seed tb_kategori
        DB::table('tb_kategori')->insert([
            ['nama_kategori' => 'Elektronik',      'deskripsi_kategori' => 'Barang elektronik seperti HP, laptop, dll', 'created_at' => now(), 'updated_at' => now()],
            ['nama_kategori' => 'Kendaraan',        'deskripsi_kategori' => 'Motor, mobil, dan kendaraan lainnya',        'created_at' => now(), 'updated_at' => now()],
            ['nama_kategori' => 'Lainnya',          'deskripsi_kategori' => 'Kategori umum lainnya',                     'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}