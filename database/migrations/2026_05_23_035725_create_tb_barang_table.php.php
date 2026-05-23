<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tb_barang', function (Blueprint $table) {
            $table->id('id_barang');
            $table->string('nama_barang', 25);
            $table->date('tgl');
            $table->integer('harga_awal');
            $table->string('deskripsi_barang', 100);
            // Tambahan yang disarankan
            $table->unsignedBigInteger('id_kategori')->nullable();
            $table->string('foto_barang', 255)->nullable(); // foto utama
            $table->string('kondisi', 20)->default('bekas'); // baru / bekas
            $table->enum('status_barang', ['tersedia', 'dilelang', 'terjual'])->default('tersedia');
            $table->unsignedBigInteger('id_petugas')->nullable(); // petugas yg menginput
            $table->timestamps();

            $table->foreign('id_kategori')
                  ->references('id_kategori')
                  ->on('tb_kategori')
                  ->onUpdate('cascade')
                  ->onDelete('set null');

            $table->foreign('id_petugas')
                  ->references('id_petugas')
                  ->on('tb_petugas')
                  ->onUpdate('cascade')
                  ->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tb_barang');
    }
};
