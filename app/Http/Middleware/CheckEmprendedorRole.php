<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckEmprendedorRole
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
        // Verifica si el usuario está autenticado y es emprendedor
        if (Auth::check() && Auth::user()->isEmprendedor()) {
            return $next($request);
        }

        // Si el usuario no es un emprendedor, redirige o responde con un error
        return redirect()->route('login')->with('error', 'No tienes permiso para acceder a esta página.');
    }
}
