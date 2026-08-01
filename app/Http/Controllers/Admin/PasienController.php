<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pasien;
use Illuminate\Http\Request;

class PasienController extends Controller
{
    public function index()
    {
        $pasiens = Pasien::latest()->get();

        return view('Admin.Pasien.Pasien', compact('pasiens'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required|email|unique:pasiens,email',
        ]);

        Pasien::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'usia' => $request->usia,
            'jenis_kelamin' => $request->jenis_kelamin,
            'status' => $request->status,
            'status_screening' => 'Belum Screening',
            'risiko_terakhir' => null,
        ]);

        return redirect()
            ->route('Admin.Pasien.Pasien')
            ->with('success','Pasien berhasil ditambahkan');
    }
    
}