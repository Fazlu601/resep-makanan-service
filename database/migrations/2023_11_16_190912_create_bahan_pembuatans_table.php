<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bahan_pembuatans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('resep_makanan_id');
            $table->string('nama_bahan');
            $table->timestamps();
            $table->foreign('resep_makanan_id')->references('id')->on('resep_makanans');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bahan_pembuatans');
    }
};
