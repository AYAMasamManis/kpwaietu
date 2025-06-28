<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany; 

class Produk extends Model
{
    use HasFactory;

    // Tambahkan properti $table jika belum ada, untuk kejelasan.
    // Laravel akan otomatis mencari tabel 'produks' dari model 'Produk', jadi ini opsional.
    protected $table = 'produks';

    protected $fillable = [
        'name',        // Nama produk (sesuai yang kita sepakati)
        'description', // Deskripsi produk
        'price',       // Harga produk
        'stok',       
        'gambar',      
    ];

    // Tambahkan $casts untuk memastikan tipe data yang benar, terutama untuk angka.
    protected $casts = [
        'price' => 'integer',
        'stok' => 'integer', // Pastikan 'stok' di-cast sebagai integer
    ];

    // ✅ Tambahkan relasi ke OrderItem
    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}
