<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('edukasis', function (Blueprint $table) {
            $table->id();

            $table->string('judul');
            $table->string('kategori');
            $table->string('ringkasan')->nullable();
            $table->longText('narasi');
            $table->string('status')->default('Aktif');
            $table->string('icon')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('edukasis');
    }
};