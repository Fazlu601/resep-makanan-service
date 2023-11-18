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
//Auth Group membutuhkan Token Untuk dapat akses
Route::middleware(['auth:sanctum'])->group( function() {
    //Router untuk mengambil data user yang login berdasarkan Token
    Route::get('/user', function(Request $request) {
        $user = $request->user();
        return response()->json($user);
    });
    //Router Logout dari sistem serta menghapus Token
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');
    //Router untuk mengambil data Resep Makanan
    Route::get('/resep-makanan', [ResepMakananController::class, 'index']);
     //Router untuk menambahkan data Resep Makanan
    Route::post('/resep-makanan', [ResepMakananController::class, 'store']);
    //Router untuk mengambil data Resep Makanan Berdasarkan id
    Route::get('/resep-makanan/{id}/show', [ResepMakananController::class, 'show']);
    //Router untuk mengirimkan Like berdasarkan data user dan resep makanan yang dituju
    Route::post('/like', [LikeController::class, 'store']);
} );
