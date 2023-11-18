<?php

namespace App\Http\Controllers;

use App\Models\ResepMakanan;
use Illuminate\Http\Request;
use App\Models\BahanPembuatan;
use App\Models\LangkahPembuatan;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class ResepMakananController extends Controller
{

    public function index() : JsonResponse
    {
        $data_recipe = ResepMakanan::with('Like')->latest()->get();
        return response()->json($data_recipe);
    }

    public function store(Request $request) : JsonResponse
    {
        try {
            $validateData = $request->validate([
                "user_id" => ["required"],
                "judul" => ["required", "min:5"],
                "deskripsi" => ["required", "min:10"],
                "bahan" => ["required"],
                "langkah" => ["required"],
                "foto" => ["required", "image", "mimes:jpg,png", "max:1024"]
            ], [
                "judul.required" => "Field judul harus diisi.",
                "judul.min" => "Judul harus berisi minimal 5 karakter",
                "deskripsi.required" => "Field deskripsi harus diisi.",
                "deskripsi.min" => "Deskripsi harus berisi minimal 10 karakter.",
                "bahan.required" => "Field bahan harus diisi.",
                "langkah.required" => "Field langkah harus diisi.",
                "foto.required" => "Field foto harus diisi.",
                "foto.image" => "Field foto harus berupa gambar.",
                "foto.mimes" => "Field foto harus berupa file dengan ekstensi jpg atau png.",
                "foto.max" => "Ukuran file foto tidak boleh melebihi 1024 KB.",
            ]);
            if($validateData['foto']){
                $path = $validateData['foto']->store("public/img-recipe");
                $validateData['foto'] = str_replace('public/img-recipe', '', $path);
            }
            $data = ResepMakanan::create($validateData);
            $arrayBahan = json_decode($validateData['bahan'], true);
            $arrayLangkah = json_decode($validateData['langkah'], true);
            foreach( $arrayBahan as $items) {
                $items['resep_makanan_id'] = $data->id;
                BahanPembuatan::create($items);
            } 
            foreach( $arrayLangkah as $items) {
                $items['resep_makanan_id'] = $data->id;
                LangkahPembuatan::create($items);
            } 
            return response()->json([
                "message" => "Resep Baru Berhasil Dibuat!",
                "data" => $data
            ]);
        }catch(ValidationException $e) {
            return response()->json([
                "message" => "Validasi gagal.",
                "errors" => $e->errors(),
            ], 422);
        }
    }

    public function show($id)
    {
        $data_recipe = ResepMakanan::with(['BahanPembuatan', 'LangkahPembuatan'])->find($id);
        return response()->json($data_recipe);
    }
}
