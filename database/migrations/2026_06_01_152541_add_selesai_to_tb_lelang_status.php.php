<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("ALTER TABLE tb_lelang MODIFY COLUMN status ENUM('dibuka','berlangsung','selesai','ditutup') NOT NULL DEFAULT 'dibuka'");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE tb_lelang MODIFY COLUMN status ENUM('dibuka','berlangsung','ditutup') NOT NULL DEFAULT 'dibuka'");
    }
};
