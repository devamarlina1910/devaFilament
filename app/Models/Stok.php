<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stok extends Model
{
    use HasFactory;

    protected $table = 'stoks'; 

    protected $fillable = [
        'nama_barang',
        'stok',
        'pelanggan',
        'tanggal_masuk',
        'tersedia',
    ];

    public function pelanggans() 
    {
        return $this->hasMany(Pelanggan::class, 'stok_id'); 
    }
}