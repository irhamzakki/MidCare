<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('screenings', function (Blueprint $table) {
            $table->id();

            $table->foreignId('pasien_id')
                ->constrained('pasiens')
                ->onDelete('cascade');

            $table->integer('skor_total')->default(0);
            $table->enum('kategori_risiko', ['Ringan', 'Sedang', 'Berat']);
            $table->string('status')->default('Selesai');
            $table->text('catatan')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('screenings');
    }
};