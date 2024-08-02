<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckVeterinaire
{

    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role === 'veterinaire') {
            return $next($request);
        }

        return $next($request);
    }
}
