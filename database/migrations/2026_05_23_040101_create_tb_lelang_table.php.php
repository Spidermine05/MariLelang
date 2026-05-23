<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tb_lelang', function (Blueprint $table) {
            $table->id('id_lelang');
            $table->unsignedBigInteger('id_barang');
            $table->date('tgl_lelang');
            $table->integer('harga_akhir')->nullable(); // nullable karena belum ada penawaran
            $table->unsignedBigInteger('id_user')->nullable(); // pemenang lelang
            $table->unsignedBigInteger('id_petugas');
            $table->enum('status', ['dibuka','berlangsung','ditutup'])->default('dibuka');
            // Tambahan yang disarankan
            $table->datetime('waktu_mulai');
            $table->datetime('waktu_selesai');
            $table->integer('harga_minimal_bid')->default(0); // minimal kenaikan bid
            $table->timestamps();

            $table->foreign('id_barang')
                  ->references('id_barang')
                  ->on('tb_barang')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');

            $table->foreign('id_user')
                  ->references('id_user')
                  ->on('tb_masyarakat')
                  ->onUpdate('cascade')
                  ->onDelete('set null');

            $table->foreign('id_petugas')
                  ->references('id_petugas')
                  ->on('tb_petugas')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tb_lelang');
    }
};