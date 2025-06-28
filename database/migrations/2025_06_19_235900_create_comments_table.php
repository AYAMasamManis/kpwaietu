<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id(); // Ini akan membuat UNSIGNED BIGINT PRIMARY KEY
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Foreign Key ke tabel users
            $table->text('content'); // Kolom untuk isi komentar
            $table->foreignId('parent_id')->nullable()->constrained('comments')->onDelete('cascade'); // Untuk balasan (threaded)
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};