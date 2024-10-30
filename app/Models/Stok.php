<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stok extends Model // Mengubah nama kelas dari Barang menjadi Stok
{
    use HasFactory;

    protected $table = 'stok'; // Mengubah nama tabel dari 'barangs' menjadi 'stok'

    protected $fillable = [
        'nama_barang',
        'stok',
        'pelanggan', // Mengubah kategori menjadi pelanggan
        'tanggal_masuk',
        'tersedia',
    ];

    // Relasi One-to-Many dengan model Pelanggan
    public function pelanggan() // Mengubah nama relasi dari penjualans menjadi pelanggan
    {
        return $this->hasMany(Pelanggan::class, 'stok_id'); // Mengubah nama kelas relasi dan kolom dari barang_id menjadi stok_id
    }
}