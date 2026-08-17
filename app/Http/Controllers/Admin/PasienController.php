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

            'name'=>$request->nama,

            'email'=>$request->email,

            // password default
            'password'=>Hash::make('pasien123'),

            'role'=>'pasien'

        ]);




        // Membuat biodata pasien

        Pasien::create([

            'user_id'=>$user->id,

            'nama'=>$request->nama,

            'tanggal_lahir'=>$request->tanggal_lahir,

            'jenis_kelamin'=>$request->jenis_kelamin,

            'no_hp'=>$request->no_hp,

            'alamat'=>$request->alamat,

            'status_screening'=>'Belum Screening'

        ]);



        return redirect()
            ->route('admin.pasien.index')
            ->with(
                'success',
                'Pasien dan akun berhasil dibuat'
            );

    }

}