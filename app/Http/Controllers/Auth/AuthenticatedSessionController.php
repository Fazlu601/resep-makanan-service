<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): JsonResponse
    {
        $request->authenticate();

        $user = $request->user();
        $user->tokens()->delete();
        $token = $user->createToken('api-token');

        return response()->json([
            "session" => true,
            "user" => $user,
            "token" => $token->plainTextToken
        ]);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): JsonResponse
    {
        Auth::guard('web')->logout();

        $user = $request->user();
        $user->tokens()->delete();

        return response()->json([
            "session" => false,
            "message" => "Berhasil Logout!"
        ]);
    }
}
