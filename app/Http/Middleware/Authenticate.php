<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Redirect user ke halaman login kalau belum autentikasi.
     */
    protected function redirectTo($request): ?string
    {
        // Jika request bukan API, arahkan ke route 'login'
        if (! $request->expectsJson()) {
            return route('login');
        }

        // Jika API, kembalikan null agar API balas JSON 401
        return null;
    }
}
