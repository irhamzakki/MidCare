<?php

namespace Database\Seeders;

use App\Models\Pasien;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PasienSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::updateOrCreate(
            ['email' => 'pasien@gmail.com'],
            [
                'name' => 'Pasien Tester',
                'password' => Hash::make('password'),
                'role' => 'pasien',
                'email_verified_at' => now(),
            ]
        );

        Pasien::updateOrCreate(
            ['user_id' => $user->id],
            [
                'nama' => $user->name,
                'email' => $user->email,
                'status_screening' => 'Belum Screening',
            ]
        );
    }
}
