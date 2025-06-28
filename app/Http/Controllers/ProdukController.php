<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth; // Tambahkan ini
use Symfony\Component\HttpFoundation\Response; // Tambahkan ini untuk abort()

class ProdukController extends Controller
{
    // Menampilkan semua produk
    public function index()
    {
        // Biasanya halaman index produk ingin dilihat publik/customer juga,
        // jadi tidak perlu pengecekan role di sini.
        $produks = Produk::all();
        return view('produk.index', compact('produks'));
    }

    // Menampilkan form untuk menambah produk baru
    public function create()
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') { // <<< CHECK ADMIN DI SINI
            abort(Response::HTTP_FORBIDDEN, 'Anda tidak memiliki izin untuk mengakses halaman ini.');
        }
        return view('produk.create');
    }

    // Menyimpan produk baru ke database
    public function store(Request $request)
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') { // <<< CHECK ADMIN DI SINI
            abort(Response::HTTP_FORBIDDEN, 'Anda tidak memiliki izin untuk mengakses halaman ini.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only(['name', 'description', 'price', 'stok']);

        if ($request->hasFile('gambar')) {
            $imagePath = $request->file('gambar')->store('produk_gambar', 'public');
            $data['gambar'] = basename($imagePath);
        } else {
            $data['gambar'] = null;
        }

        Produk::create($data);

        return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    // Menampilkan form untuk mengedit produk yang sudah ada
    public function edit(Produk $produk)
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') { // <<< CHECK ADMIN DI SINI
            abort(Response::HTTP_FORBIDDEN, 'Anda tidak memiliki izin untuk mengakses halaman ini.');
        }
        return view('produk.edit', compact('produk'));
    }

    // Memperbarui data produk di database
    public function update(Request $request, Produk $produk)
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') { // <<< CHECK ADMIN DI SINI
            abort(Response::HTTP_FORBIDDEN, 'Anda tidak memiliki izin untuk mengakses halaman ini.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'remove_image' => 'boolean',
        ]);

        $data = $request->only(['name', 'description', 'price', 'stok']);

        if ($request->hasFile('gambar')) {
            if ($produk->gambar && Storage::disk('public')->exists('produk_gambar/' . $produk->gambar)) {
                Storage::disk('public')->delete('produk_gambar/' . $produk->gambar);
            }
            $imagePath = $request->file('gambar')->store('produk_gambar', 'public');
            $data['gambar'] = basename($imagePath);
        } elseif ($request->boolean('remove_image')) {
            if ($produk->gambar && Storage::disk('public')->exists('produk_gambar/' . $produk->gambar)) {
                Storage::disk('public')->delete('produk_gambar/' . $produk->gambar);
            }
            $data['gambar'] = null;
        }

        $produk->update($data);

        return redirect()->route('produk.index')->with('success', 'Produk berhasil diperbarui.');
    }

    // Menghapus produk dari database
    public function destroy(Produk $produk)
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') { // <<< CHECK ADMIN DI SINI
            abort(Response::HTTP_FORBIDDEN, 'Anda tidak memiliki izin untuk mengakses halaman ini.');
        }

        if ($produk->gambar && Storage::disk('public')->exists('produk_gambar/' . $produk->gambar)) {
            Storage::disk('public')->delete('produk_gambar/' . $produk->gambar);
        }

        $produk->delete();

        return redirect()->route('produk.index')->with('success', 'Produk berhasil dihapus.');
    }
}
