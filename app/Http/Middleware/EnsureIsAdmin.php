<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class EnsureIsAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! Auth::guard('petugas')->check() || ! Auth::guard('petugas')->user()->isAdmin()) {
            return redirect()->route('admin.login')->with('error', 'Anda tidak punya akses.');
        }

        return $next($request);
    }
}
