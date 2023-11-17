<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BahanPembuatan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function ResepMakanan()
    {
        return $this->belongsTo(ResepMakanan::class, 'resep_makanan_id', 'id');
    }
}
