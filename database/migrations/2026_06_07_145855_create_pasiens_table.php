<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pasiens', function (Blueprint $table) {
            $table->id();

            $table->string('nama');
            $table->string('email')->unique();
            $table->integer('usia')->nullable();
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan'])->nullable();
            $table->enum('status', ['Siswa', 'Mahasiswa', 'Umum'])->nullable();

            $table->string('status_screening')->default('Belum Screening');
            $table->string('risiko_terakhir')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pasiens');
    }
};