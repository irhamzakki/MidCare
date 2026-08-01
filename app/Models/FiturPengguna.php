<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FiturPengguna extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika berbeda dengan konvensi plural jamak Laravel
    protected $table = 'fitur_pengguna'; 

    // Daftarkan semua kolom yang ada di database Anda agar bisa di-insert bersamaan
    protected $fillable = [
        'nama',
        'usia',
        'jenis_kelamin',
        'orangtua',
        
        // Karakter & Regulasi Emosi
        'rasional', 'mampu_menyelesaikan_masalah_sendiri', 'mudah_putus_asa', 'emosional', 
        'mengontrol_emosi', 'agresif', 'diam_marah', 'kontrol_fisik', 'emosi_tidak_terkontrol', 
        'fisik_sulit_dikontrol', 'perilaku_baik_situasi_rumit', 'tenang_saat_emosi', 
        'kontrol_diri_saat_emosi', 'kontrol_bicara', 'tingkah_tidak_terkontrol', 'nilai_emosi',

        // Koping & Penerimaan
        'terima_peristiwa', 'cari_dukungan', 'tidak_terima_peristiwa', 'terima_peristiwa_buruk', 
        'ubah_mindset', 'terima_emosi', 'tidak_malu_menangis', 'tidak_terima_emosi', 'malu_menangis',

        // Hubungan dengan Ayah
        'ayah_hargai_perasaan', 'ayah_baik', 'ingin_ortu_berbeda', 'ayah_terima_saya', 
        'senang_masukan_ayah', 'percuma_perlihatkan_ayah', 'ayah_tahu_marah', 'malu_bodoh_dengan_ayah', 
        'ayah_hargai_pendapat', 'ayah_percaya_saya', 'tak_mau_merepotkan_ayah', 'ayah_bantu_pahami', 
        'cerita_pada_ayah', 'kurang_perhatian_ayah', 'ayah_dorong_cerita', 'ayah_pahami_saya', 
        'ayah_pahami_marah', 'percaya_ayah', 'ayah_tidak_paham', 'ayah_tidak_bisa_diandalkan', 'ayah_peduli',

        // Hubungan dengan Ibu
        'ibu_hargai_perasaan', 'ibu_baik', 'ingin_ibu_berbeda', 'ibu_terima_saya', 
        'senang_masukan_ibu', 'percuma_perlihatkan_ibu', 'ibu_tahu_marah', 'malu_bodoh_with_ibu', 
        'gundah_dengan_ibu', 'ibu_tahu_sedikit', 'ibu_hargai_pendapat', 'ibu_percaya_saya', 
        'tak_mau_repotkan_ibu', 'ibu_bantu_pahami', 'cerita_ibu', 'marah_dengan_ibu', 
        'kurang_perhatian_ibu', 'ibu_dorong_cerita', 'ibu_pahami_saya', 'ibu_pahami_marah_saya', 
        'percaya_ibu', 'ibu_tidak_paham', 'ibu_tidak_bisa_diandalkan', 'ibu_peduli'
    ];
}