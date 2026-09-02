<?php

namespace Tests\Feature;

use App\Models\FiturPengguna;
use App\Models\HasilClustering;
use App\Models\Pasien;
use App\Models\Screening;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ScreeningResultTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_stores_screening_and_populates_all_database_tables_for_guest(): void
    {
        $response = $this->from('/screening')->post('/screening', [
            'nama' => 'Budi Guest',
            'usia' => 20,
            'jenis_kelamin' => 'Laki-laki',
            'orangtua' => 'Lengkap',
            'jawaban' => [
                'rasional' => 4,
                'mampu_menyelesaikan_masalah_sendiri' => 3,
                'mudah_putus_asa' => 2,
                'ibu_tidak_bisa_diandalkan' => 2,
                'gundah_dengan_ibu' => 2,
                'marah_dengan_ibu' => 2,
            ],
        ]);

        $response->assertRedirect('/screening');
        $this->assertNotNull(session('screening_result'));
        $this->assertArrayHasKey('profil', session('screening_result'));
        $this->assertArrayHasKey('ai', session('screening_result'));

        // Pastikan tabel fitur_pengguna terisi
        $this->assertDatabaseHas('fitur_pengguna', [
            'nama' => 'Budi Guest',
            'usia' => 20,
            'jenis_kelamin' => 'Laki-laki',
            'orangtua' => 'Lengkap',
        ]);

        // Pastikan tabel hasil_clusterings terisi
        $this->assertEquals(1, HasilClustering::count());
        $hasil = HasilClustering::first();
        $this->assertNotNull($hasil->cluster);
        $this->assertNotNull($hasil->tingkat_risiko);
        $this->assertEquals('Budi Guest', $hasil->fiturPengguna->nama);

        // Pastikan tabel pasiens terisi
        $this->assertDatabaseHas('pasiens', [
            'nama' => 'Budi Guest',
            'status_screening' => 'Sudah Screening',
        ]);

        // Pastikan tabel screenings terisi
        $this->assertEquals(1, Screening::count());
        $screening = Screening::first();
        $this->assertNotNull($screening->kategori_risiko);
        $this->assertGreaterThan(0, $screening->skor_total);
    }

    public function test_it_stores_screening_for_authenticated_patient_and_displays_results(): void
    {
        $user = User::factory()->create([
            'name' => 'Siti Pasien',
            'email' => 'siti@example.com',
            'role' => 'pasien',
        ]);

        $response = $this->actingAs($user)->from('/screening')->post('/screening', [
            'nama' => 'Siti Pasien',
            'usia' => 22,
            'jenis_kelamin' => 'Perempuan',
            'orangtua' => 'Lengkap',
            'jawaban' => [
                'rasional' => 4,
                'mampu_menyelesaikan_masalah_sendiri' => 4,
                'mudah_putus_asa' => 1,
                'ibu_tidak_bisa_diandalkan' => 1,
                'gundah_dengan_ibu' => 1,
                'marah_dengan_ibu' => 1,
            ],
        ]);

        $response->assertRedirect('/screening');

        // Pastikan terhubung dengan user_id
        $this->assertDatabaseHas('hasil_clusterings', [
            'user_id' => $user->id,
        ]);

        // Buka halaman hasil pasien
        $hasilResponse = $this->actingAs($user)->get('/pengguna/hasil');
        $hasilResponse->assertStatus(200);
        $hasilResponse->assertSee('Siti Pasien');
        $hasilResponse->assertSee('Hasil Terbaru');

        // Buka detail hasil
        $hasil = HasilClustering::where('user_id', $user->id)->first();
        $detailResponse = $this->actingAs($user)->get('/pengguna/hasil/' . $hasil->id);
        $detailResponse->assertStatus(200);
        $detailResponse->assertSee('Siti Pasien');
        $detailResponse->assertSee('Hasil Analisis K-Means');
    }
}

