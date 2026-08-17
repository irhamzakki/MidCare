<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Pasien;
use App\Models\Psikolog;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }


    /**
     * Handle an incoming registration request.
     */
    public function store(Request $request): RedirectResponse
    {

        // Validasi data register
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'role' => ['required', 'in:pasien,psikolog,admin'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $role = strtolower((string) $request->role);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $role,
        ]);

        if ($role === 'pasien') {
            Pasien::firstOrCreate(
                ['user_id' => $user->id],
                [
                    'nama' => $request->name,
                    'email' => $request->email,
                    'status_screening' => 'Belum Screening',
                ]
            );
        }

        if ($role === 'psikolog') {
            $user->update([
                'spesialisasi' => $request->spesialisasi ?? 'Umum',
                'no_str' => $request->no_str ?? null,
            ]);
        }



        /*
        |--------------------------------------------------------------------------
        | Event dan Login
        |--------------------------------------------------------------------------
        */

        event(new Registered($user));

        Auth::login($user);

        return redirect($this->redirectToDashboard($user));
    }

    protected function redirectToDashboard(User $user): string
    {
        return match (strtolower($user->role)) {
            'admin' => route('Admin.dashboard'),
            'psikolog' => route('psikolog.dashboard'),
            'pasien' => route('pasien.dashboard'),
            default => route('home'),
        };
    }
}