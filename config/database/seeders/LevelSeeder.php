<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Level;

class LevelSeeder extends Seeder
{
    public function run(): void
    {
        Level::insert([
            ['level' => 'administrator', 'created_at' => now(), 'updated_at' => now()],
            ['level' => 'petugas',       'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}