<?php

namespace Tests\Feature\Admin;

use App\Http\Controllers\Admin\PasienController;
use App\Models\Pasien;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PasienControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_controller_exposes_index_action(): void
    {
        $this->assertTrue(method_exists(PasienController::class, 'index'));
    }

    public function test_admin_can_store_new_pasien_and_creates_user_account(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);

        $response = $this->actingAs($admin)->post(route('Admin.Pasien.store'), [
            'nama' => 'Pasien Baru Test',
            'email' => 'pasien.baru@test.com',
            'usia' => 22,
            'jenis_kelamin' => 'Laki-laki',
            'status' => 'Mahasiswa',
            'password' => 'secret123',
        ]);

        $response->assertRedirect(route('Admin.Pasien.Pasien'));
        $this->assertDatabaseHas('pasiens', [
            'nama' => 'Pasien Baru Test',
            'email' => 'pasien.baru@test.com',
            'usia' => 22,
            'jenis_kelamin' => 'Laki-laki',
        ]);
        $this->assertDatabaseHas('users', [
            'email' => 'pasien.baru@test.com',
            'role' => 'pasien',
        ]);
    }

    public function test_admin_can_update_pasien(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);

        $user = User::factory()->create([
            'name' => 'Pasien Awal',
            'email' => 'pasien.awal@test.com',
            'role' => 'pasien',
        ]);

        $pasien = Pasien::create([
            'nama' => 'Pasien Awal',
            'email' => 'pasien.awal@test.com',
            'usia' => 20,
            'jenis_kelamin' => 'Perempuan',
            'status' => 'Siswa',
        ]);

        $response = $this->actingAs($admin)->put(route('Admin.Pasien.update', $pasien->id), [
            'nama' => 'Pasien Diperbarui',
            'email' => 'pasien.update@test.com',
            'usia' => 21,
            'jenis_kelamin' => 'Perempuan',
            'status' => 'Mahasiswa',
        ]);

        $response->assertRedirect(route('Admin.Pasien.Pasien'));
        $this->assertDatabaseHas('pasiens', [
            'id' => $pasien->id,
            'nama' => 'Pasien Diperbarui',
            'email' => 'pasien.update@test.com',
        ]);
        $this->assertDatabaseHas('users', [
            'name' => 'Pasien Diperbarui',
            'email' => 'pasien.update@test.com',
        ]);
    }

    public function test_admin_can_delete_pasien_and_user_account(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);

        User::factory()->create([
            'name' => 'Pasien Hapus',
            'email' => 'pasien.hapus@test.com',
            'role' => 'pasien',
        ]);

        $pasien = Pasien::create([
            'nama' => 'Pasien Hapus',
            'email' => 'pasien.hapus@test.com',
            'usia' => 20,
            'jenis_kelamin' => 'Laki-laki',
        ]);

        $response = $this->actingAs($admin)->delete(route('Admin.Pasien.destroy', $pasien->id));

        $response->assertRedirect(route('Admin.Pasien.Pasien'));
        $this->assertDatabaseMissing('pasiens', [
            'id' => $pasien->id,
        ]);
        $this->assertDatabaseMissing('users', [
            'email' => 'pasien.hapus@test.com',
        ]);
    }
}
