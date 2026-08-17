<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PsikologController extends Controller
{
    /**
     * Menampilkan daftar psikolog
     */
    public function index()
    {
        $psikologs = User::where('role', 'psikolog')
            ->latest()
            ->get();

        return view('Admin.psikolog.index', compact('psikologs'));
    }

    /**
     * Menyimpan akun psikolog baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'spesialisasi' => 'required|string|max:255',
            'no_str' => 'required|string|max:100|unique:users,no_str',
        ]);

        User::create([
            'name' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make('psikolog123'),
            'role' => 'psikolog',
            'spesialisasi' => $request->spesialisasi,
            'no_str' => $request->no_str,
        ]);

        return back()->with(
            'success',
            'Akun psikolog berhasil dibuat'
        );
    }

    /**
     * Menghapus akun psikolog
     */
    public function destroy($id)
    {
        $psikolog = User::where('id', $id)
            ->where('role', 'psikolog')
            ->firstOrFail();

        $psikolog->delete();

        return back()->with(
            'success',
            'Akun psikolog berhasil dihapus'
        );
    }
}