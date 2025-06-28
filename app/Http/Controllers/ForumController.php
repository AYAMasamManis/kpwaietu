<?php

namespace App\Http\Controllers;

use App\Models\Comment; // Pastikan ini Comment model
use App\Models\CommentLike; // Model untuk like
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response; // Pastikan ini diimpor untuk abort()
use Illuminate\Support\Facades\Storage; // Tambahkan ini untuk fungsi upload gambar

class ForumController extends Controller
{
    /**
     * Menampilkan semua komentar utama di forum, termasuk yang sudah dihapus secara lunak.
     */
    public function index()
    {
        // Ambil semua komentar utama (yang parent_id-nya null),
        // TERMASUK yang sudah dihapus secara lunak (withTrashed()),
        // dan load relasi user, likes, serta balasan (replies) dari setiap komentar.
        // Balasan juga akan menyertakan komentar yang dihapus lunak jika mereka adalah induk.
        $comments = Comment::withTrashed() // Mengambil komentar yang dihapus lunak juga
                            ->with(['user', 'likes', 'replies' => function ($query) {
                                // Memastikan balasan juga diambil, termasuk yang dihapus lunak
                                $query->withTrashed()->with('user');
                            }])
                            ->whereNull('parent_id') // Hanya ambil komentar utama
                            ->orderBy('created_at', 'desc')
                            ->get();

        return view('forum.index', compact('comments')); // Mengarahkan ke resources/views/forum/index.blade.php
    }

    /**
     * Menyimpan komentar baru (utama atau balasan) (hanya untuk user login).
     */
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
            'parent_id' => 'nullable|exists:comments,id', // Validasi parent_id
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi untuk file gambar
        ]);

        // Cek apakah user sudah login
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Anda harus login untuk berkomentar.');
        }

        $gambarPath = null;
        if ($request->hasFile('gambar')) { // Logika upload gambar
            $gambarPath = $request->file('gambar')->store('komentar_gambar', 'public'); // Simpan di storage/app/public/komentar_gambar
            $gambarPath = basename($gambarPath); // Hanya ambil nama file
        }

        Comment::create([
            'user_id' => Auth::id(),
            'parent_id' => $request->parent_id,
            'content' => $request->content,
            'gambar' => $gambarPath, // Simpan path gambar ke database
        ]);

        return back()->with('success', 'Komentar berhasil ditambahkan!');
    }

    /**
     * Mengelola like/unlike pada komentar.
     */
    public function toggleLike(Comment $comment) // Gunakan Comment model binding
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Anda harus login untuk menyukai komentar.');
        }

        $user = Auth::user();

        $like = CommentLike::where('comment_id', $comment->id)
                           ->where('user_id', $user->id)
                           ->first();

        if ($like) {
            // Jika sudah ada, hapus (unlike)
            $like->delete();
            return back()->with('success', 'Like berhasil dihapus.');
        } else {
            // Jika belum ada, tambahkan (like)
            CommentLike::create([
                'comment_id' => $comment->id,
                'user_id' => $user->id,
            ]);
            return back()->with('success', 'Komentar disukai!');
        }
    }

    /**
     * Hapus komentar (hanya pemilik komentar atau admin yang bisa).
     * Jika komentar sudah dihapus lunak, akan dihapus permanen.
     */
    public function destroy(Comment $comment)
    {
        // Autorisasi: Hanya pemilik komentar atau admin yang bisa menghapus
        if (Auth::check() && (Auth::id() == $comment->user_id || (Auth::user() && Auth::user()->role === 'admin'))) {
            // Jika komentar memiliki gambar, hapus gambar dari storage sebelum dihapus
            if ($comment->gambar && Storage::disk('public')->exists('komentar_gambar/' . $comment->gambar)) {
                Storage::disk('public')->delete('komentar_gambar/' . $comment->gambar);
            }

            if ($comment->trashed()) {
                // Jika komentar sudah dihapus lunak, lakukan hapus permanen
                $comment->forceDelete();
                return back()->with('success', 'Komentar berhasil dihapus permanen.');
            } else {
                // Jika komentar belum dihapus lunak, lakukan soft delete
                $comment->delete();
                return back()->with('success', 'Komentar berhasil dihapus.');
            }
        }

        // Jika tidak memiliki otorisasi
        abort(Response::HTTP_FORBIDDEN, 'Anda tidak memiliki izin untuk menghapus komentar ini.');
    }
}
