<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FiturPengguna;

class KuesionerController extends Controller
{
    public function index()
    {
        $fiturPengguna = FiturPengguna::latest()->get();

        return view('pengguna.kuesioner', compact('fiturPengguna'));
    }

    public function show($id)
    {
        $data = FiturPengguna::findOrFail($id);

        return view('pengguna.hasil-detail', [
            'hasil' => $data
        ]);
    }

    public function edit($id)
    {
        $data = FiturPengguna::findOrFail($id);

        return view('pengguna.kuesioner-edit', compact('data'));
    }

    public function destroy($id)
    {
        FiturPengguna::findOrFail($id)->delete();

        return redirect()
            ->route('admin.kuesioner.index')
            ->with('success','Data berhasil dihapus.');
    }
}