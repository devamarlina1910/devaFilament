<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model 
{
    use HasFactory;

    protected $fillable = [
        'stok_id', 
        'jumlah_penjualan', 
        'tanggal_penjualan', 
    ];

    // Relasi dengan model Stok
    public function stoks() 
    {
        return $this->belongsTo(Stok::class, 'stok_id'); 
    }
}