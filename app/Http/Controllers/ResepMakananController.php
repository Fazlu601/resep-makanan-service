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
        //Aambil semua data Resep Makanan dari tanggal terbaru beserta data like dari relasi model like
        $data_recipe = ResepMakanan::with('Like')->latest()->get();

        //Kirim dengan respon json
        return response()->json($data_recipe);
    }

    public function store(Request $request) : JsonResponse
    {
        try {
            //Validasi Data dari request
            $validateData = $request->validate([
                "user_id" => ["required"],
                "judul" => ["required", "min:5"],
                "deskripsi" => ["required", "min:10"],
                "bahan" => ["required"],
                "langkah" => ["required"],
                "foto" => ["required", "image", "mimes:jpg,png", "max:1024"]
            ], [//Terjemahkan keterangan error di tiap validasi
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
            //Jika entitas foto ada
            if($validateData['foto']){
                //kirim file foto ke folder path "public/img-recipe"
                $path = $validateData['foto']->store("public/img-recipe");
                //Ambil nama enkripsi dari file gambar lalu timpa kembali ke array index foto sebelumnya
                $validateData['foto'] = str_replace('public/img-recipe', '', $path);
            }
            //Jika lolos validasi insert data resep makanan ke model ResepMakanan
            $data = ResepMakanan::create($validateData);
            //Konversi ke array asosiatif string obj yang berisi data-data nama bahan dari request user
            $arrayBahan = json_decode($validateData['bahan'], true);
             //Konversi ke array asosiatif string obj yang berisi data langkah-langkah dari request user
            $arrayLangkah = json_decode($validateData['langkah'], true);
            //Looping dan masukan id resep makanan ke tiap entitas pada array, lalu insert ke model BahanPembuatan
            foreach( $arrayBahan as $items) {
                $items['resep_makanan_id'] = $data->id;
                BahanPembuatan::create($items);
            } 
            //Looping dan masukan id resep makanan ke tiap entitas pada array, lalu insert ke model LangkahPembuatan
            foreach( $arrayLangkah as $items) {
                $items['resep_makanan_id'] = $data->id;
                LangkahPembuatan::create($items);
            } 
            //kembalikan respon berupa json
            return response()->json([
                "message" => "Resep Baru Berhasil Dibuat!",
                "data" => $data
            ]);
            //Tangkap jika ada error dari validasi ataupun gagal insert ke model database, lalu kirimkan dalam bentuk json
        }catch(ValidationException $e) {
            return response()->json([
                "message" => "Validasi gagal.",
                "errors" => $e->errors(),
            ], 422);
        }
    }

    public function show($id)
    {
        //Tangkap data resep Makanan berdasarkan id, sekaligus bawa data bahan pembuatan dan langkah-langkah berdasarkan relasi yang sudah dibangun
        $data_recipe = ResepMakanan::with(['BahanPembuatan', 'LangkahPembuatan'])->find($id);
        //Kirimkan data dalam bentuk json
        return response()->json($data_recipe);
    }
}
