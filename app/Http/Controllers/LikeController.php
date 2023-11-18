<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    
    public function store(Request $request) : JsonResponse
    {
        //Validasi data dari request
        $validateData = $request->validate([
            "user_id" => ["required"],
            "resep_makanan_id" => ["required"]
        ]);

        //insert ke database jika lolos validasi sekligus tangkap ke variabel $data
        $data = Like::create($validateData);

        //Kembalikan respon dalam bentuk json
        return response()->json([
            "message" => "Like Berhasil",
            "data" => $data
        ]);
    }

}
