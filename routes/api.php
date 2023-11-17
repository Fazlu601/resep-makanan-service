<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\ResepMakananController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['auth:sanctum'])->group( function() {

    Route::get('/user', function(Request $request) {
        $user = $request->user();
        return response()->json($user);
    });
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');

    Route::get('/resep-makanan', [ResepMakananController::class, 'index']);
    Route::post('/resep-makanan', [ResepMakananController::class, 'store']);
    Route::get('/resep-makanan/{id}/show', [ResepMakananController::class, 'show']);

    Route::post('/like', [LikeController::class, 'store']);
} );
