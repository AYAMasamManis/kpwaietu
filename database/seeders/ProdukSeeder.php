<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProdukSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('produks')->insert([
            [
                'name' => 'Waiteu Delima', // <<< UBAH DARI 'nama_varian' MENJADI 'name'
                'description' => 'Mengandung buah delima, ganggang merah, dan L-Glutathione. Cocok untuk pencerahan bertahap.', // <<< UBAH DARI 'deskripsi' MENJADI 'description'
                'price' => 75000, // <<< UBAH DARI 'harga' MENJADI 'price'
                'stok' => 100, // <<< TAMBAHKAN KOLOM 'stok' (dengan nilai default)
                'gambar' => 'delima.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Waiteu Walet', // <<< UBAH DARI 'nama_varian' MENJADI 'name'
                'description' => 'Mengandung sarang burung walet, bunga telang, dan biji anggur. Untuk hasil cepat dan perawatan intensif.', // <<< UBAH DARI 'deskripsi' MENJADI 'description'
                'price' => 85000, // <<< UBAH DARI 'harga' MENJADI 'price'
                'stok' => 120, // <<< TAMBAHKAN KOLOM 'stok' (dengan nilai default)
                'gambar' => 'walet.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
