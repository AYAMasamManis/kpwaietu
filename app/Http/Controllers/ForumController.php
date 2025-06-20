<?php

namespace App\Http\Controllers;

use App\Models\Forum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ForumController extends Controller
{
    /**
     * Menampilkan semua postingan forum (bisa dilihat publik).
     */
    public function index()
    {
        // Ambil semua komentar forum beserta user-nya
        $forums = Forum::with('user')->latest()->get();

        return view('forum.index', compact('forums'));
    }

    /**
     * Menyimpan komentar baru (hanya untuk user login).
     */
    public function storeComment(Request $request)
    {
        $request->validate([
            'comment' => 'required|string|max:1000',
        ]);

        Forum::create([
            'user_id' => Auth::id(),
            'content' => $request->comment,
            // judul sudah nullable, tidak perlu diisi
        ]);

        return redirect()->route('forum.index')->with('success', 'Komentar berhasil dikirim.');
    }
}
