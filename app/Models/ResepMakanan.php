<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResepMakanan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function User()
    {
          //Membuat relasi many to one ke data user berdasarkan referensi id
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function BahanPembuatan()
    {
          //Membuat relasi one to many ke data bahan makanan berdasarkan referensi id
        return $this->hasMany(BahanPembuatan::class, 'resep_makanan_id');
    }

    public function LangkahPembuatan()
    {
        return $this->hasMany(LangkahPembuatan::class, 'resep_makanan_id');
    }

    public function Like()
    {
        return $this->hasMany(Like::class, 'resep_makanan_id');
    }
}
