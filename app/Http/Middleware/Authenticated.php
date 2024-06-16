<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Authenticated
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            // Si el usuario no está autenticado, redirigirlo al inicio de sesión
            return redirect()->route('login');
        }

        return $next($request);
    }
}
