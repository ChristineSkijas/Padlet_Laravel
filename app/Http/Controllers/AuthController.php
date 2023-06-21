<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function __construct() {
        //wenn die Route "login" ist, dann braucht man die Middleware nicht, sie ist öffentlich
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    /** Login-Methode -> post-Request wird an den LoginController geschickt, der ihn überprüft */
    public function login() {
        $credentials = request(['email', 'password']);
        //bekommen wir einen token zurück, gehts weiter, ansonsten wird er zurück geworfen
        if (! $token = auth()->attempt($credentials)) {
            //nicht-Erfolgsfall, also wenn es keinen Token gibt
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        //wenns geklappt hat
        return $this->respondWithToken($token);
    }
    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me() {
        return response()->json(auth()->user());
    }
    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }
    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }
    /**
     * respondWithToken -> jsonwebtoken wird in ein JsonObjekt gepackt
     * und an den Client zurück gesendet
     */
    protected function respondWithToken($token)
    {
        //Antwortobjekt
        return response()->json([
            //hier ist der JsonToken drin
            'access_token' => $token,
            //dem Token-Typ
            'token_type' => 'bearer',
            //und wann läuft der Token ab
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
