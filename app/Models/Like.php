<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function User()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function ResepMakanan()
    {
        return $this->belongsTo(ResepMakanan::class, 'resep_makanan_id', 'id');
    }

}
