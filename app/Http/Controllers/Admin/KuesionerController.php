<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FiturPengguna;
use App\Models\HasilClustering;

class KuesionerController extends Controller
{
    public function index()
    {
        $fiturPengguna = FiturPengguna::with('hasilClustering')->latest()->get();

        return view('pengguna.kuesioner', compact('fiturPengguna'));
    }

    public function show($id)
    {
        $hasil = HasilClustering::where('id', $id)
            ->orWhere('fitur_pengguna_id', $id)
            ->with('fiturPengguna')
            ->first();

        if (!$hasil) {
            $fitur = FiturPengguna::findOrFail($id);
            $hasil = new HasilClustering([
                'fitur_pengguna_id' => $fitur->id,
                'cluster' => 0,
                'tingkat_risiko' => 'Kondisi Baik / Risiko Rendah',
            ]);
            $hasil->setRelation('fiturPengguna', $fitur);
        }

        return view('pengguna.hasil-detail', compact('hasil'));
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