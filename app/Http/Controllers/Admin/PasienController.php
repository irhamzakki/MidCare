<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pasien;
use App\Models\User;
use App\Models\Screening;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class PasienController extends Controller
{
    public function index(?Request $request = null)
    {
        $request = $request ?? request();
        $search = $request->query('search');

        $query = Pasien::orderBy('created_at', 'desc');

        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'LIKE', "%{$search}%")
                  ->orWhere('email', 'LIKE', "%{$search}%")
                  ->orWhere('status', 'LIKE', "%{$search}%")
                  ->orWhere('status_screening', 'LIKE', "%{$search}%")
                  ->orWhere('risiko_terakhir', 'LIKE', "%{$search}%");
            });
        }

        $pasiens = $query->get();

        return view('Admin.Pasien.Pasien', compact('pasiens', 'search'));
    }

    public function create()
    {
        return view('Admin.Pasien.Pasien');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email|unique:pasiens,email',
            'usia' => 'nullable|integer|min:1|max:120',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'status' => 'nullable|in:Siswa,Mahasiswa,Umum',
            'password' => 'nullable|string|min:6',
        ], [
            'email.unique' => 'Email ini sudah terdaftar di sistem.',
            'jenis_kelamin.required' => 'Silakan pilih jenis kelamin.',
            'password.min' => 'Password minimal harus 6 karakter.',
        ]);

        $password = $request->filled('password') ? $request->password : 'password';

        // Buat akun user login untuk pasien
        $user = User::create([
            'name' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($password),
            'role' => 'pasien',
            'email_verified_at' => now(),
        ]);

        // Buat data profil pasien
        Pasien::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'usia' => $request->usia,
            'jenis_kelamin' => $request->jenis_kelamin,
            'status' => $request->status ?? 'Umum',
            'status_screening' => 'Belum Screening',
            'risiko_terakhir' => null,
        ]);

        return redirect()
            ->route('Admin.Pasien.Pasien')
            ->with('success', 'Data pasien dan akun login (' . $request->email . ') berhasil ditambahkan.');
    }

    public function update(Request $request, string $id)
    {
        $pasien = Pasien::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('pasiens', 'email')->ignore($pasien->id),
            ],
            'usia' => 'nullable|integer|min:1|max:120',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'status' => 'nullable|in:Siswa,Mahasiswa,Umum',
            'password' => 'nullable|string|min:6',
        ], [
            'email.unique' => 'Email ini sudah digunakan oleh pasien lain.',
            'password.min' => 'Password baru minimal harus 6 karakter.',
        ]);

        $oldEmail = $pasien->email;

        $pasien->update([
            'nama' => $request->nama,
            'email' => $request->email,
            'usia' => $request->usia,
            'jenis_kelamin' => $request->jenis_kelamin,
            'status' => $request->status ?? $pasien->status,
        ]);

        // Sinkronisasi data ke User akun login
        $user = User::where('email', $oldEmail)->first();
        if ($user) {
            $userUpdateData = [
                'name' => $request->nama,
                'email' => $request->email,
            ];
            if ($request->filled('password')) {
                $userUpdateData['password'] = Hash::make($request->password);
            }
            $user->update($userUpdateData);
        }

        return redirect()
            ->route('Admin.Pasien.Pasien')
            ->with('success', 'Data pasien berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $pasien = Pasien::findOrFail($id);
        $email = $pasien->email;

        // Hapus relasi screening jika ada
        Screening::where('pasien_id', $pasien->id)->delete();

        // Hapus data pasien
        $pasien->delete();

        // Hapus akun user jika bertipe pasien
        User::where('email', $email)->where('role', 'pasien')->delete();

        return redirect()
            ->route('Admin.Pasien.Pasien')
            ->with('success', 'Data pasien dan akun terkait berhasil dihapus.');
    }
}