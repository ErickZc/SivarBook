<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckTuristaRole
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
        // Verifica si el usuario está autenticado y es turista
        if (Auth::check() && Auth::user()->isTurista()) {
            return $next($request);
        }

        // Si el usuario no es un turista, redirige o responde con un error
        return redirect()->route('login')->with('error', 'No tienes permiso para acceder a esta página.');
    }
}
