<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Edukasi;
use Illuminate\Http\Request;

class EdukasiController extends Controller
{
    public function index()
    {
        $edukasis = Edukasi::latest()->get();

        return view('Admin.Edukasi.Edukasi', compact('edukasis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'kategori' => 'required|string|max:100',
            'ringkasan' => 'nullable|string|max:255',
            'narasi' => 'required|string',
            'status' => 'required|string',
            'icon' => 'nullable|string|max:20',
        ]);

        Edukasi::create($request->only([
            'judul',
            'kategori',
            'ringkasan',
            'narasi',
            'status',
            'icon',
        ]));

        return redirect()
            ->route('Admin.Edukasi.Edukasi')
            ->with('success', 'Data edukasi berhasil ditambahkan.');
    }
    public function update(Request $request, Edukasi $edukasi)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'kategori' => 'required|string|max:100',
            'ringkasan' => 'nullable|string|max:255',
            'narasi' => 'required|string',
            'status' => 'required|string',
            'icon' => 'nullable|string|max:20',
        ]);

        $edukasi->update($request->only([
            'judul',
            'kategori',
            'ringkasan',
            'narasi',
            'status',
            'icon',
        ]));

        return redirect()
            ->route('Admin.Edukasi.Edukasi')
            ->with('success', 'Data edukasi berhasil diperbarui.');
    }

    public function destroy(Edukasi $edukasi)
    {
        $edukasi->delete();

        return redirect()
            ->route('Admin.Edukasi.Edukasi')
            ->with('success', 'Data edukasi berhasil dihapus.');
    }
}