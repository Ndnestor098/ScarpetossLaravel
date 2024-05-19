<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Verificar si el usuario está autenticado y es un administrador
        if ($request->user() && $request->user()->is_admin) {
            return $next($request); // Permitir que la solicitud continúe
        }

        // Si el usuario no es un administrador, redirigirlo a una ruta específica o mostrar un error
        return redirect()->route('home'); // Por ejemplo, redirigir a una vista de error "no autorizado"
    }
}
