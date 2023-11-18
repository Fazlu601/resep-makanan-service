<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LangkahPembuatan extends Model
{
    use HasFactory;
    //lindungi dan gunakan id sebagai kunci
    protected $guarded = ['id'];

    public function ResepMakanan()
    {
        //Membuat relasi many to one ke data resep makanan berdasarkan referensi id
        return $this->belongsTo(ResepMakanan::class, 'resep_makanan_id', 'id');
    }
}
