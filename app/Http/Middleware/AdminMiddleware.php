<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Pastikan user login dan punya role admin
        if (! $request->user() || $request->user()->role !== 'admin') {
            // Jika request via web, redirect
            if (! $request->expectsJson()) {
                return redirect('/')->with('error', 'Akses ditolak. Hanya untuk admin.');
            }

            // Jika request via API, kirim JSON error
            return response()->json(['message' => 'Akses ditolak. Hanya untuk admin.'], 403);
        }

        return $next($request);
    }
}
