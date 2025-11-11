<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $roles  Roles permitidos separados por |
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, string $roles): Response
    {
        // Si no hay usuario logueado, lo bloqueamos
        if (! $request->user()) {
            abort(403, 'Acceso denegado: usuario no autenticado.');
        }

        // Separamos roles por "|", ej: "admin|cliente"
        $rolesArray = explode('|', $roles);

        // Revisamos si el usuario tiene alguno de los roles permitidos
        foreach ($rolesArray as $role) {
            if ($request->user()->hasRole(trim($role))) {
                return $next($request);
            }
        }

        // Si no tiene ningún rol permitido, abortamos
        abort(403, 'Acceso denegado: no tiene el rol requerido.');
    }
}
