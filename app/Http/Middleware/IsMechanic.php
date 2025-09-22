<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsMechanic
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check() && auth()->user()->id_rol == 2) {
            return $next($request); // Permite el acceso si el usuario es mecánico
        }

        return redirect('/')->with('error', 'No tienes permiso para acceder a esta sección.');
    }
}

