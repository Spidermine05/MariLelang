<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tb_masyarakat', function (Blueprint $table) {
            $table->id('id_user');
            $table->string('nama_lengkap', 25);
            $table->string('username', 25)->unique();
            $table->string('password', 255);
            $table->string('telp', 25)->nullable();
            $table->string('email', 100)->unique()->nullable();
            $table->string('alamat', 255)->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->enum('status_akun', ['aktif', 'nonaktif'])->default('aktif'); // tambah ini
            $table->rememberToken();                                               // tambah ini
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tb_masyarakat');
    }
};