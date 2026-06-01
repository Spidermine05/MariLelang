<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tb_petugas', function (Blueprint $table) {
            $table->id('id_petugas');
            $table->string('nama_petugas', 25);
            $table->string('username', 25)->unique();
            $table->string('password', 255); // diperbesar untuk bcrypt hash
            $table->unsignedBigInteger('id_level');
            $table->timestamps();

            $table->foreign('id_level')
                  ->references('id_level')
                  ->on('tb_level')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tb_petugas');
    }
};
