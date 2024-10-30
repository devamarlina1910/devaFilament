<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('stoks', function (Blueprint $table) {
            $table->id();
            $table->string('nama_barang');
            $table->integer('stok');
            $table->enum('pelanggan', ['makanan', 'minuman', 'kebutuhan_rumah_tangga', 'lainnya']); 
            $table->date('tanggal_masuk');
            $table->boolean('tersedia');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('stoks');
    }
};