<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ForumController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ⛩ Halaman awal
Route::get('/', function () {
    return view('welcome');
});

// 🛡 Dashboard pengguna (login & email terverifikasi)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// 🗣 Forum publik (komentar/testimoni bisa dibaca siapa saja)
Route::get('/forum', [ForumController::class, 'index'])->name('forum.index');

// 🔐 Route untuk user login
Route::middleware('auth')->group(function () {
    // 👤 Halaman edit profil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // 💬 Kirim komentar forum
    Route::post('/forum/comment', [ForumController::class, 'storeComment'])->name('forum.comment');

    // ❤️ Like komentar (opsional, nanti diaktifkan kalau fitur like sudah siap)
    // Route::post('/forum/{id}/like', [ForumController::class, 'like'])->name('forum.like');
});

// 🧑‍💼 Route khusus untuk admin
Route::middleware(['auth', 'isAdmin'])->group(function () {
    // 📊 Dashboard Admin
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    // 📦 CRUD Produk
    Route::resource('/produk', ProductController::class);

    // 📑 Melihat daftar pesanan
    Route::resource('/orders', OrderController::class)->only(['index']);
});

// 🧱 Auth route default dari Laravel Breeze (login, register, dll)
require __DIR__.'/auth.php';
