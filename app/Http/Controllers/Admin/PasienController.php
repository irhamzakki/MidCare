<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Pasien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PasienController extends Controller
{
    public function index()
    {
        $pasiens = Pasien::orderBy('created_at', 'desc')->get();

        return view('Admin.Pasien.Pasien', compact('pasiens'));
    }

    public function create()
    {
        return view('admin.pasien.create');
    }

    public function store(Request $request)
    {

        $request->validate([

            'nama' => 'required',

            'email' => 'required|email|unique:users',

            'tanggal_lahir'=>'required',

            'jenis_kelamin'=>'required',

        ]);



        // Membuat akun login pasien

        $user = User::create([
            'name' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password ?? 'pasien123'),
            'role' => 'pasien',
            'email_verified_at' => now(),
        ]);

        Pasien::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'usia' => $request->usia ?? 20,
            'jenis_kelamin' => $request->jenis_kelamin,
            'status' => $request->status ?? 'Umum',
            'status_screening' => 'Belum Screening',
            'risiko_terakhir' => null,
        ]);

        return redirect()
            ->route('Admin.Pasien.Pasien')
            ->with('success', 'Data pasien berhasil dibuat.');
    }

    public function update(Request $request, string $id)
    {
        $pasien = Pasien::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'usia' => 'nullable|integer',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'status' => 'nullable|in:Siswa,Mahasiswa,Umum',
        ]);

        $pasien->update([
            'nama' => $request->nama,
            'email' => $request->email,
            'usia' => $request->usia,
            'jenis_kelamin' => $request->jenis_kelamin,
            'status' => $request->status ?? $pasien->status,
        ]);

        // Update corresponding user record if exists
        User::where('email', $pasien->email)->update([
            'name' => $request->nama,
        ]);

        return redirect()
            ->route('Admin.Pasien.Pasien')
            ->with('success', 'Data pasien berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $pasien = Pasien::findOrFail($id);
        $email = $pasien->email;
        $pasien->delete();

        // Optionally delete corresponding user
        User::where('email', $email)->where('role', 'pasien')->delete();

        return redirect()
            ->route('Admin.Pasien.Pasien')
            ->with('success', 'Data pasien berhasil dihapus.');
    }
}