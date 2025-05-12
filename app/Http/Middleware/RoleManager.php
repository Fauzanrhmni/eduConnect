<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleManager
{
    public function handle(Request $request, Closure $next, $role): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $authUserRole = Auth::user()->role;

        if ($role === 'admin' && $authUserRole === 0) {
            return $next($request);
        }

        if ($role === 'user' && in_array($authUserRole, [1, 2])) {
            return $next($request);
        }

        // Redirect fallback
        return $authUserRole === 0
            ? redirect()->route('admin.dashboard')
            : redirect()->route('pengguna.forum');
    }
}