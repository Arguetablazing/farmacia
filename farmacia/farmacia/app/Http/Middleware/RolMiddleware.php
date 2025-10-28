<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RolMiddleware
{
    public function handle($request, Closure $next, ...$roles)
    {
        if (!Auth::check()) {
            return redirect('/')->with('error', 'Debe iniciar sesión.');
        }

        $userRole = ucfirst(strtolower(trim(Auth::user()->rol)));
        $roles = array_map(fn($r) => ucfirst(strtolower(trim($r))), $roles);

        // ✅ Si el usuario es Administrador, se le permite todo
        if ($userRole === 'Administrador' || $userRole === 'Cajero') {
            return $next($request);
        }

        // 🚫 Si el rol no está autorizado
        if (!in_array($userRole, $roles)) {
            // Redirigir según su rol actual
            return match ($userRole) {
                'Empleado' => redirect()->route('dashboard.empleado')
                    ->with('error', 'Acceso restringido a empleados.'),
                'Supervisor' => redirect()->route('dashboard.supervisor')
                    ->with('error', 'Acceso restringido para supervisores.'),
                'Funcionario' => redirect()->route('dashboard.funcionario')
                    ->with('error', 'Acceso restringido para funcionarios.'),
                default => redirect()->route('dashboard')
                    ->with('error', 'Acceso restringido.'),
            };
        }

        return $next($request);
    }
}
