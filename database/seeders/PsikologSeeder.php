<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PsikologSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'psikolog@gmail.com'],
            [
                'name' => 'Psikolog Tester',
                'password' => Hash::make('password'),
                'role' => 'psikolog',
                'spesialisasi' => 'Kesehatan Mental',
                'no_str' => 'STR-PSIKOLOG-001',
                'email_verified_at' => now(),
            ]
        );
    }
}
