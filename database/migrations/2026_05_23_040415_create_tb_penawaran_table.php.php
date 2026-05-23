<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// TAMBAHAN: Tabel riwayat setiap penawaran (bid) per user per lelang
// Berbeda dengan history_lelang yg mencatat hasil akhir,
// tb_penawaran mencatat setiap bid yang masuk secara real-time
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tb_penawaran', function (Blueprint $table) {
            $table->id('id_penawaran');
            $table->unsignedBigInteger('id_lelang');
            $table->unsignedBigInteger('id_user');
            $table->integer('harga_tawar');
            $table->datetime('waktu_tawar');
            $table->enum('status_tawar', ['aktif', 'kalah', 'menang'])->default('aktif');
            $table->timestamps();

            $table->foreign('id_lelang')
                  ->references('id_lelang')
                  ->on('tb_lelang')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');

            $table->foreign('id_user')
                  ->references('id_user')
                  ->on('tb_masyarakat')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tb_penawaran');
    }
};