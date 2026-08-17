<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('hasil_clusterings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->cascadeOnDelete();
            $table->foreignId('fitur_pengguna_id')->constrained('fitur_pengguna')->cascadeOnDelete();
            $table->integer('cluster')->comment('Hasil clustering dari K-Means');
            $table->string('tingkat_risiko', 50)->comment('Kategori risiko dari cluster');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hasil_clusterings');
    }
};
