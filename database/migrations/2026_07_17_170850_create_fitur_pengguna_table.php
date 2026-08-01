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
        Schema::create('fitur_pengguna', function (Blueprint $table) {
            // I. Profil Dasar
            $table->id();
            $table->string('nama', 100)->nullable();
            $table->integer('usia')->nullable();
            $table->string('jenis_kelamin', 20)->nullable();
            $table->string('orangtua', 50)->nullable();

            // II. Karakter & Regulasi Emosi (Skala Likert 1-5)
            $table->tinyInteger('rasional')->nullable()->comment('1=Sangat Tidak Setuju, 5=Sangat Setuju');
            $table->tinyInteger('mampu_menyelesaikan_masalah_sendiri')->nullable();
            $table->tinyInteger('mudah_putus_asa')->nullable();
            $table->tinyInteger('emosional')->nullable();
            $table->tinyInteger('mengontrol_emosi')->nullable();
            $table->tinyInteger('agresif')->nullable();
            $table->tinyInteger('diam_marah')->nullable();
            $table->tinyInteger('kontrol_fisik')->nullable();
            $table->tinyInteger('emosi_tidak_terkontrol')->nullable();
            $table->tinyInteger('fisik_sulit_dikontrol')->nullable();
            $table->tinyInteger('perilaku_baik_situasi_rumit')->nullable();
            $table->tinyInteger('tenang_saat_emosi')->nullable();
            $table->tinyInteger('kontrol_diri_saat_emosi')->nullable();
            $table->tinyInteger('kontrol_bicara')->nullable();
            $table->tinyInteger('tingkah_tidak_terkontrol')->nullable();
            $table->tinyInteger('nilai_emosi')->nullable();

            // III. Koping & Penerimaan (Skala Likert 1-5)
            $table->tinyInteger('terima_peristiwa')->nullable();
            $table->tinyInteger('cari_dukungan')->nullable();
            $table->tinyInteger('tidak_terima_peristiwa')->nullable();
            $table->tinyInteger('terima_peristiwa_buruk')->nullable();
            $table->tinyInteger('ubah_mindset')->nullable();
            $table->tinyInteger('terima_emosi')->nullable();
            $table->tinyInteger('tidak_malu_menangis')->nullable();
            $table->tinyInteger('tidak_terima_emosi')->nullable();
            $table->tinyInteger('malu_menangis')->nullable();

            // IV. Hubungan dengan Ayah (Skala Likert 1-5)
            $table->tinyInteger('ayah_hargai_perasaan')->nullable();
            $table->tinyInteger('ayah_baik')->nullable();
            $table->tinyInteger('ingin_ortu_berbeda')->nullable();
            $table->tinyInteger('ayah_terima_saya')->nullable();
            $table->tinyInteger('senang_masukan_ayah')->nullable();
            $table->tinyInteger('percuma_perlihatkan_ayah')->nullable();
            $table->tinyInteger('ayah_tahu_marah')->nullable();
            $table->tinyInteger('malu_bodoh_dengan_ayah')->nullable();
            $table->tinyInteger('ayah_hargai_pendapat')->nullable();
            $table->tinyInteger('ayah_percaya_saya')->nullable();
            $table->tinyInteger('tak_mau_merepotkan_ayah')->nullable();
            $table->tinyInteger('ayah_bantu_pahami')->nullable();
            $table->tinyInteger('cerita_pada_ayah')->nullable();
            $table->tinyInteger('kurang_perhatian_ayah')->nullable();
            $table->tinyInteger('ayah_dorong_cerita')->nullable();
            $table->tinyInteger('ayah_pahami_saya')->nullable();
            $table->tinyInteger('ayah_pahami_marah')->nullable();
            $table->tinyInteger('percaya_ayah')->nullable();
            $table->tinyInteger('ayah_tidak_paham')->nullable();
            $table->tinyInteger('ayah_tidak_bisa_diandalkan')->nullable();
            $table->tinyInteger('ayah_peduli')->nullable();

            // V. Hubungan dengan Ibu (Skala Likert 1-5)
            $table->tinyInteger('ibu_hargai_perasaan')->nullable();
            $table->tinyInteger('ibu_baik')->nullable();
            $table->tinyInteger('ingin_ibu_berbeda')->nullable();
            $table->tinyInteger('ibu_terima_saya')->nullable();
            $table->tinyInteger('senang_masukan_ibu')->nullable();
            $table->tinyInteger('percuma_perlihatkan_ibu')->nullable();
            $table->tinyInteger('ibu_tahu_marah')->nullable();
            $table->tinyInteger('malu_bodoh_dengan_ibu')->nullable();
            $table->tinyInteger('gundah_dengan_ibu')->nullable();
            $table->tinyInteger('ibu_tahu_sedikit')->nullable();
            $table->tinyInteger('ibu_hargai_pendapat')->nullable();
            $table->tinyInteger('ibu_percaya_saya')->nullable();
            $table->tinyInteger('tak_mau_repotkan_ibu')->nullable();
            $table->tinyInteger('ibu_bantu_pahami')->nullable();
            $table->tinyInteger('cerita_ibu')->nullable();
            $table->tinyInteger('marah_dengan_ibu')->nullable();
            $table->tinyInteger('kurang_perhatian_ibu')->nullable();
            $table->tinyInteger('ibu_dorong_cerita')->nullable();
            $table->tinyInteger('ibu_pahami_saya')->nullable();
            $table->tinyInteger('ibu_pahami_marah_saya')->nullable();
            $table->tinyInteger('percaya_ibu')->nullable();
            $table->tinyInteger('ibu_tidak_paham')->nullable();
            $table->tinyInteger('ibu_tidak_bisa_diandalkan')->nullable();
            $table->tinyInteger('ibu_peduli')->nullable();
            
            // Kolom waktu bawaan Laravel (created_at & updated_at)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fitur_pengguna');
    }
};