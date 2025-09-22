<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        // Verifica si el usuario tiene el rol adecuado
        if (Auth::check() && Auth::user()->id_rol == $role) {
            return $next($request);  // Deja pasar la solicitud si el rol es válido
        }

        // Redirige si el rol no es válido
        return redirect('/')->with('error', 'No tienes permisos para acceder a esta sección.');
    }
}


