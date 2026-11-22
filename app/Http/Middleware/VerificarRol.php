<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerificarRol
{
    public function handle(Request $request, Closure $next, string $rol): Response
    {
        if (!$request->user() || $request->user()->rol !== $rol) {
            abort(403, 'No tienes permiso para acceder a esta pagina.');
        }

        if ($rol === 'administrador') {

            $verificado = $request->session()->get('administrador_verificado') === true;

            if (!$verificado && !$request->routeIs('verificacion.*')) {
                return redirect()->route('verificacion.form');
            }

            if ($verificado && $request->routeIs('verificacion.*')) {
                return redirect()->route('administrador.inicio');
            }
        }

        return $next($request);
    }
}
