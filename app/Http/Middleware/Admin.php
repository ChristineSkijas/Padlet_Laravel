<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PHPOpenSourceSaver\JWTAuth\JWTAuth;

/**
class Admin
{
    /**
     * Klasse noch in Bearbeitung

    /** Request kommt rein - aktuelles UserObject wird auf Basis des übermittelten Token von der Middleware geholt
     * existiert der User und hat die rolle "admin" geht es zur nächsten Middleware bzw. zur nächsten Kontrolle,
     * ansonsten wird er zurück geschickt
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();
        if($user == null || $user->role != "admin") {
            return response()->json(['Nutzer:in hat nicht dir Rolle Admin'], 401);
        }
        return $next($request);
        }
}
*/
