<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Artikel;
use Illuminate\Http\Request;

class ArtikelController extends Controller
{
    public function index()
    {
        $artikels = Artikel::latest()->get();

        return view('Admin.Artikel.Artikel', compact('artikels'));
    }

    public function create()
    {
        return view('Admin.Artikel.Tambah');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'kategori' => 'required|string|max:100',
            'ringkasan' => 'nullable|string|max:255',
            'isi' => 'required|string',
            'status' => 'required|in:Publish,Draft',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $gambar = null;

        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar')->store('artikel', 'public');
        }

        Artikel::create([
            'judul' => $request->judul,
            'kategori' => $request->kategori,
            'ringkasan' => $request->ringkasan,
            'isi' => $request->isi,
            'gambar' => $gambar,
            'status' => $request->status ?? 'Draft',
        ]);

        return redirect()
            ->route('Admin.Artikel.Artikel')
            ->with('success', 'Artikel berhasil ditambahkan.');
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'kategori' => 'required|string|max:100',
            'ringkasan' => 'nullable|string|max:255',
            'isi' => 'required|string',
            'status' => 'required|in:Publish,Draft',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $artikel = Artikel::findOrFail($id);

        $data = [
            'judul' => $request->judul,
            'kategori' => $request->kategori,
            'ringkasan' => $request->ringkasan,
            'isi' => $request->isi,
            'status' => $request->status ?? 'Draft',
        ];

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('artikel', 'public');
        }

        $artikel->update($data);

        return redirect()
            ->route('Admin.Artikel.Artikel')
            ->with('success', 'Artikel berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        Artikel::findOrFail($id)->delete();

        return redirect()
            ->route('Admin.Artikel.Artikel')
            ->with('success', 'Artikel berhasil dihapus.');
    }
}