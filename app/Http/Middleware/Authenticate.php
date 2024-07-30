<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    protected function redirectTo(Request $request): ?string
{
    if ($request->expectsJson()) {
        // Gérer l'échec de l'authentification JSON (par exemple, renvoyer une réponse d'erreur)
        return response()->json(['error' => 'Non authentifié.'], 401);
    }

    return route('login'); // Redirection vers la connexion pour les requêtes Web
}

}
