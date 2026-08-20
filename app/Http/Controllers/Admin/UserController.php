<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pasien;
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
            'email' => 'required|email|unique:users,email',
            'role' => 'required|in:pasien,psikolog',
            'password' => 'required|confirmed|min:8',
            'spesialisasi' => 'nullable|string|max:255',
            'no_str' => 'nullable|string|max:100',
        ]);

        $userData = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ];

        if ($request->role === 'psikolog') {
            $userData['spesialisasi'] = $request->spesialisasi ?? 'Kesehatan Mental';
            $userData['no_str'] = $request->no_str ?? ('STR-' . strtoupper(uniqid()));
        }

        $user = User::create($userData);

        if ($request->role === 'pasien') {
            Pasien::create([
                'nama' => $user->name,
                'email' => $user->email,
                'status_screening' => 'Belum Screening',
            ]);
        }

        return redirect()->back()->with('success', 'User berhasil dibuat');
    }
}
