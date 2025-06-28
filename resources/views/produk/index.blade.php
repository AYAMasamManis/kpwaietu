@extends('layouts.app')

@section('title', 'Daftar Produk')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-semibold mb-4 text-gray-800">Daftar Produk Waiteu</h2>

    {{-- Notifikasi sukses --}}
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @auth
        @if(Auth::user()->role === 'admin')
            <div class="mb-6 text-right">
                <a href="{{ route('produk.create') }}" class="cta-button bg-blue-600">
                    + Tambah Produk Baru
                </a>
            </div>
        @endif
    @endauth

    @if ($produks->isEmpty())
        <p class="text-center text-gray-500">Tidak ada produk tersedia saat ini.</p>
    @else
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border-collapse border border-gray-200">
                <thead>
                    <tr>
                        <th class="border px-4 py-2 text-left bg-gray-100 text-gray-800">Gambar</th>
                        <th class="border px-4 py-2 text-left bg-gray-100 text-gray-800">Nama</th>
                        <th class="border px-4 py-2 text-left bg-gray-100 text-gray-800">Deskripsi</th>
                        <th class="border px-4 py-2 text-right bg-gray-100 text-gray-800">Harga</th>
                        <th class="border px-4 py-2 text-right bg-gray-100 text-gray-800">Stok</th>
                        @auth
                            @if(Auth::user()->role === 'admin')
                                <th class="border px-4 py-2 bg-gray-100 text-gray-800">Aksi</th>
                            @endif
                        @endauth
                    </tr>
                </thead>
                <tbody>
                    @forelse($produks as $produk)
                    <tr class="text-center hover:bg-gray-50">
                        <td class="border px-4 py-2">
                            @if($produk->gambar)
                                <img src="{{ asset('storage/produk_gambar/' . $produk->gambar) }}" alt="Gambar Produk" class="h-16 w-16 object-cover rounded mx-auto"> {{-- PASTIKAN PATHNYA /produk_gambar/ --}}
                            @else
                                <span class="text-gray-400">-</span>
                            @endif
                        </td>
                        <td class="border px-4 py-2 text-left text-gray-700">{{ $produk->name }}</td>
                        <td class="border px-4 py-2 text-left text-gray-700">{{ $produk->description }}</td>
                        <td class="border px-4 py-2 text-right text-gray-700">Rp{{ number_format($produk->price, 0, ',', '.') }}</td>
                        <td class="border px-4 py-2 text-right text-gray-700">{{ $produk->stok }}</td>
                        @auth
                            @if(Auth::user()->role === 'admin')
                                <td class="border px-4 py-2">
                                    <a href="{{ route('produk.edit', $produk->id) }}" class="cta-button bg-yellow-500 px-3 py-1 text-sm mr-2">Edit</a>
                                    <form action="{{ route('produk.destroy', $produk->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus produk ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="cta-button bg-red-600 px-3 py-1 text-sm">Hapus</button>
                                    </form>
                                </td>
                            @endif
                        @endauth
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="border px-4 py-2 text-center text-gray-500">Tidak ada produk ditemukan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
