<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     * Usage in routes: ->middleware(['auth', 'role:admin']) or 'role:admin,psikolog'
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  $roles
     */
    public function handle(Request $request, Closure $next, ?string $roles = null)
    {
        // Jika user belum login, biarkan middleware 'auth' meng-handle. Namun tetap cek untuk safety
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();
        $userRole = strtolower((string) ($user->role ?? ''));

        if (empty($roles)) {
            // Jika tidak diberikan parameter role, tolak akses
            abort(403, 'Akses ditolak. Role tidak terdefinisi.');
        }

        $allowed = array_map('trim', explode(',', strtolower($roles)));

        if (!in_array($userRole, $allowed, true)) {
            abort(403, 'Anda tidak memiliki izin untuk mengakses halaman ini.');
        }

        return $next($request);
    }
}
