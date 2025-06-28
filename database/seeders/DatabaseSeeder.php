<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            ProdukSeeder::class, // Pastikan ProdukSeeder juga dipanggil jika kamu ingin data produk terisi
            AdminSeeder::class,  // Pastikan baris ini ada
        ]);
    }
}