<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FiturPengguna;
use App\Models\HasilClustering;
use App\Models\Pasien;
use App\Models\Screening;
use App\Models\User;
use App\Http\Controllers\ScreeningController;

class ScreeningDemoSeeder extends Seeder
{
    public function run(): void
    {
        $controller = app(ScreeningController::class);

        // Ambil atau buat akun Pasien utama untuk demo login pasien
        $pasienUser = User::where('email', 'pasien@gmail.com')->first();

        $demoProfiles = [
            [
                'nama' => $pasienUser ? $pasienUser->name : 'Pasien Tester',
                'user_id' => $pasienUser ? $pasienUser->id : null,
                'email' => 'pasien@gmail.com',
                'usia' => 21,
                'jenis_kelamin' => 'Laki-laki',
                'orangtua' => 'Lengkap',
                'scale_type' => 'rendah',
            ],
            [
                'nama' => 'Ahmad Fauzi (Demo Rendah)',
                'user_id' => null,
                'email' => null,
                'usia' => 21,
                'jenis_kelamin' => 'Laki-laki',
                'orangtua' => 'Lengkap',
                'scale_type' => 'rendah',
            ],
            [
                'nama' => 'Rina Astuti (Demo Moderat)',
                'user_id' => null,
                'email' => null,
                'usia' => 20,
                'jenis_kelamin' => 'Perempuan',
                'orangtua' => 'Lengkap',
                'scale_type' => 'moderat',
            ],
            [
                'nama' => 'Dimas Pratama (Demo Tinggi)',
                'user_id' => null,
                'email' => null,
                'usia' => 19,
                'jenis_kelamin' => 'Laki-laki',
                'orangtua' => 'Berpisah',
                'scale_type' => 'tinggi',
            ],
            [
                'nama' => 'Nadia Rahma (Demo Rendah)',
                'user_id' => null,
                'email' => null,
                'usia' => 22,
                'jenis_kelamin' => 'Perempuan',
                'orangtua' => 'Lengkap',
                'scale_type' => 'rendah',
            ],
            [
                'nama' => 'Bintang Surya (Demo Tinggi)',
                'user_id' => null,
                'email' => null,
                'usia' => 20,
                'jenis_kelamin' => 'Laki-laki',
                'orangtua' => 'Salah satu wafat',
                'scale_type' => 'tinggi',
            ],
        ];

        $daftarPertanyaan = $controller->getDaftarPertanyaan();
        $allKeys = [];
        foreach ($daftarPertanyaan as $kategori => $items) {
            foreach ($items as $k => $t) {
                $allKeys[] = $k;
            }
        }

        foreach ($demoProfiles as $p) {
            $jawaban = [];
            foreach ($allKeys as $key) {
                if ($p['scale_type'] === 'rendah') {
                    if (str_contains($key, 'marah') || str_contains($key, 'emosi_tidak') || str_contains($key, 'putus_asa') || str_contains($key, 'tidak_bisa') || str_contains($key, 'gundah')) {
                        $jawaban[$key] = rand(1, 2);
                    } else {
                        $jawaban[$key] = rand(4, 5);
                    }
                } elseif ($p['scale_type'] === 'tinggi') {
                    if (str_contains($key, 'marah') || str_contains($key, 'emosi_tidak') || str_contains($key, 'putus_asa') || str_contains($key, 'tidak_bisa') || str_contains($key, 'gundah')) {
                        $jawaban[$key] = rand(4, 5);
                    } else {
                        $jawaban[$key] = rand(1, 2);
                    }
                } else {
                    $jawaban[$key] = rand(2, 4);
                }
            }

            $dataSaves = [
                'nama' => $p['nama'],
                'usia' => $p['usia'],
                'jenis_kelamin' => $p['jenis_kelamin'],
                'orangtua' => $p['orangtua'],
            ];
            foreach ($jawaban as $k => $v) {
                $dataSaves[$k] = $v;
            }

            $fitur = FiturPengguna::create($dataSaves);

            $prediction = $controller->calculateClusterAndRiskPHP([
                'jenis kelamin' => strtolower($p['jenis_kelamin']) === 'laki-laki' ? 0 : 1,
                'ibu tidak bisa di andalkan' => $jawaban['ibu_tidak_bisa_diandalkan'] ?? 3,
                'orangtua' => strtolower($p['orangtua']) === 'lengkap' ? 3 : (strtolower($p['orangtua']) === 'berpisah' ? 2 : 1),
                'gundah dg ibu' => $jawaban['gundah_dengan_ibu'] ?? 3,
                'marah dg ibu' => $jawaban['marah_dengan_ibu'] ?? 3,
            ]);

            $cluster = $prediction['cluster'];
            $risiko = $prediction['risiko'];

            HasilClustering::create([
                'user_id' => $p['user_id'],
                'fitur_pengguna_id' => $fitur->id,
                'cluster' => $cluster,
                'tingkat_risiko' => $risiko,
            ]);

            $email = $p['email'];
            if (!$email) {
                $cleanName = strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $p['nama']));
                $email = $cleanName . rand(100, 9999) . '@demo.mindcare.com';
            }

            $pasien = Pasien::where('email', $email)->first();
            if ($pasien) {
                $pasien->update([
                    'status_screening' => 'Sudah Screening',
                    'risiko_terakhir' => $risiko,
                    'usia' => $p['usia'],
                    'jenis_kelamin' => $p['jenis_kelamin'],
                ]);
            } else {
                $pasien = Pasien::create([
                    'nama' => $p['nama'],
                    'email' => $email,
                    'usia' => $p['usia'],
                    'jenis_kelamin' => $p['jenis_kelamin'],
                    'status' => $p['user_id'] ? 'Mahasiswa' : 'Umum',
                    'status_screening' => 'Sudah Screening',
                    'risiko_terakhir' => $risiko,
                ]);
            }

            $kategoriRingkas = match($risiko) {
                'Risiko Rendah' => 'Ringan',
                'Risiko Sedang' => 'Sedang',
                'Risiko Tinggi' => 'Berat',
                default => 'Sedang'
            };

            Screening::create([
                'pasien_id' => $pasien->id,
                'skor_total' => array_sum($jawaban),
                'kategori_risiko' => $kategoriRingkas,
                'status' => 'Selesai',
                'catatan' => 'Data demo testing. Klaster AI: ' . $cluster . ' (' . $risiko . ').',
            ]);
        }
    }
}
