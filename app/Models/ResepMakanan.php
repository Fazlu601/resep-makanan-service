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
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function BahanPembuatan()
    {
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
