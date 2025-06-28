<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Order;    // Impor model Order
use App\Models\Comment;  // Impor model Comment
use App\Models\User;     // Impor model User

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     *
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function edit(Request $request) // Hapus ': View' di sini
    {
        // Pastikan user terautentikasi
        $user = Auth::user(); // Gunakan Auth::user() untuk kepastian

        if (!$user) {
            // Ini seharusnya tidak terjadi jika middleware 'auth' berfungsi,
            // tetapi sebagai fallback jika ada masalah
            return Redirect::route('login');
        }

        // Mengambil 5 pesanan terbaru (belum diarsipkan) dari user yang sedang login
        $recentOrders = $user->orders()->whereNull('deleted_at')->latest()->take(5)->get();

        // Mengambil jumlah total komentar yang dibuat user yang sedang login
        $commentCount = $user->comments()->count();

        return view('profile.edit', [
            'user' => $user, // Mengirimkan objek user ke view
            'recentOrders' => $recentOrders, // Kirim ke view
            'commentCount' => $commentCount, // Kirim ke view
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        // Pastikan user terautentikasi
        $user = Auth::user(); // Gunakan Auth::user()

        if (!$user) {
            return Redirect::route('login');
        }

        $user->fill($request->validated());

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        // Pastikan user terautentikasi
        $user = Auth::user(); // Gunakan Auth::user()

        if (!$user) {
            return Redirect::to('/'); // Atau redirect ke halaman login
        }

        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        Auth::logout(); // Logout user sebelum menghapus

        $user->delete(); // Hapus user dari database

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/'); // Redirect ke halaman utama setelah hapus
    }
}
