<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pasien;
use App\Models\Psikolog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function create()
    {
        return view('Admin.User.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'role' => 'required|in:pasien,psikolog',
            'password' => 'required|confirmed|min:8',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        if ($request->role === 'pasien') {
            Pasien::create([
                'user_id' => $user->id,
                'nama' => $user->name,
                'status_screening' => 'Belum Screening',
            ]);
        }

        if ($request->role === 'psikolog') {
            Psikolog::create([
                'user_id' => $user->id,
                'nama' => $user->name,
            ]);
        }

        return redirect()->back()->with('success', 'User berhasil dibuat');
    }
}
