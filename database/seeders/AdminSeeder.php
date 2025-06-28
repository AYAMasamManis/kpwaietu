<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Admin Waiteu',
            'email' => 'admin@waiteu.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin', // Pastikan kolom 'role' sudah ada dan terisi 'admin'
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}