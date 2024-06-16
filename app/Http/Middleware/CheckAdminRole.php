<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckAdminRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Verifica si el usuario está autenticado y es administrador
        if (Auth::check() && Auth::user()->isAdmin()) {
            return $next($request);
        }

        // Si el usuario no es un administrador, redirige o responde con un error
        return redirect()->route('login')->with('error', 'No tienes permiso para acceder a esta página.');
    }
}
