<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('history_lelang', function (Blueprint $table) {
            $table->id('id_history');
            $table->unsignedBigInteger('id_lelang');
            $table->unsignedBigInteger('id_barang');
            $table->unsignedBigInteger('id_user');
            $table->integer('penawaran_harga');
            // Tambahan yang disarankan
            $table->enum('status_history', ['menang', 'kalah'])->default('kalah');
            $table->datetime('tgl_history')->useCurrent();
            $table->timestamps();

            $table->foreign('id_lelang')
                  ->references('id_lelang')
                  ->on('tb_lelang')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');

            $table->foreign('id_barang')
                  ->references('id_barang')
                  ->on('tb_barang')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');

            $table->foreign('id_user')
                  ->references('id_user')
                  ->on('tb_masyarakat')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('history_lelang');
    }
};
