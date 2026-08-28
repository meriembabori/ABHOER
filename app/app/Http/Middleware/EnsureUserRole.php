<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserRole
{
    /**
     * Vérifie que l'utilisateur connecté possède un des rôles autorisés.
     *
     * Utilisation dans les routes : ->middleware('role:RESPONSABLE')
     * Plusieurs rôles possibles : ->middleware('role:RESPONSABLE,ADMINISTRATEUR')
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        if (!in_array($user->role, $roles, true)) {
            abort(403, "Vous n'avez pas accès à cette section.");
        }

        return $next($request);
    }
}
