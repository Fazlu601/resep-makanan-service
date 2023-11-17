<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    
    public function store(Request $request) : JsonResponse
    {
        $validateData = $request->validate([
            "user_id" => ["required"],
            "resep_makanan_id" => ["required"]
        ]);

        $data = Like::create($validateData);

        return response()->json([
            "message" => "Like Berhasil",
            "data" => $data
        ]);
    }

}
