<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ScreeningResultTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_stores_screening_and_flashes_result_profile(): void
    {
        $response = $this->post('/screening', [
            'nama' => 'Budi Test',
            'usia' => 20,
            'jenis_kelamin' => 'Laki-laki',
            'orangtua' => 'Lengkap',
            'jawaban' => [
                'rasional' => 4,
                'mampu_menyelesaikan_masalah_sendiri' => 3,
                'mudah_putus_asa' => 2,
            ],
        ]);

        $response->assertRedirect('/screening');
        $this->assertNotNull(session('screening_result'));
        $this->assertArrayHasKey('profil', session('screening_result'));
        $this->assertArrayHasKey('detail_jawaban', session('screening_result'));
    }
}
