<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAdminAuthenticated
{
    public function handle(Request $request, Closure $next)
    {
        // Jika sudah login sebagai petugas (admin), redirect ke dashboard
        if (Auth::guard('petugas')->check()) {
            return redirect()->route('admin.dashboard');
        }

        return $next($request);
    }
}