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
        //Autentikasi Login
        $request->authenticate();

        //Mendapatkan data user yang login
        $user = $request->user();

        //Menghapus token sebelumnya jika ada
        $user->tokens()->delete();

        //Membuat token baru
        $token = $user->createToken('api-token');

        //Mengembalikan data dalam bentuk json
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
        //Keluarkan sesi user
        Auth::guard('web')->logout();

        //Ambil data user yang login
        $user = $request->user();

        //Hapus token
        $user->tokens()->delete();

        //Kembalikan data berupa dengan format json
        return response()->json([
            "session" => false,
            "message" => "Berhasil Logout!"
        ]);
    }
}
