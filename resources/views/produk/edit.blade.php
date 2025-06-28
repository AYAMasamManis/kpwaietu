@extends('layouts.app') {{-- Menggunakan layout app untuk konsistensi tema global --}}

@section('title', 'Edit Produk')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow-lg border border-gray-200">
    <h2 class="text-2xl font-semibold mb-4 text-gray-800 text-center">Edit Produk: {{ $produk->name }}</h2>

    {{-- Notifikasi sukses/error --}}
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-4">
            <ul class="list-disc pl-5 text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('produk.update', $produk->id) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
        @csrf
        @method('PUT')

        <div>
            <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Nama Varian:</label>
            <input type="text" name="name" id="name"
                   value="{{ old('name', $produk->name) }}"
                   class="shadow-sm appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        </div>

        <div>
            <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Deskripsi:</label>
            <textarea name="description" id="description" rows="4"
                      class="shadow-sm appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ old('description', $produk->description) }}</textarea>
        </div>

        <div>
            <label for="price" class="block text-gray-700 text-sm font-bold mb-2">Harga:</label>
            <input type="number" name="price" id="price"
                   value="{{ old('price', $produk->price) }}"
                   class="shadow-sm appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required min="0">
        </div>

        <div>
            <label for="stok" class="block text-gray-700 text-sm font-bold mb-2">Stok:</label>
            <input type="number" name="stok" id="stok" value="{{ old('stok', $produk->stok) }}"
                   class="shadow-sm appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required min="0">
        </div>

        <div class="mb-4">
            <label for="gambar" class="block text-gray-700 text-sm font-bold mb-2">Gambar Produk (Opsional):</label>
            @if($produk->gambar)
                <div class="mb-3 p-3 border border-gray-200 rounded-lg bg-gray-50 flex items-center space-x-4">
                    <img src="{{ asset('storage/produk_gambar/' . $produk->gambar) }}" alt="Gambar Produk Saat Ini" class="w-24 h-24 object-cover rounded shadow-sm">
                    <label class="text-gray-700 flex items-center">
                        <input type="checkbox" name="remove_image" value="1" class="mr-2 rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500"> Hapus gambar yang ada
                    </label>
                </div>
            @endif
            <input type="file" name="gambar" id="gambar"
                   class="shadow-sm appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>

        <div class="flex items-center justify-between mt-6 pt-4 border-t border-gray-200">
            <button type="submit" class="cta-button bg-blue-600">
                Simpan Perubahan
            </button>
            <a href="{{ route('produk.index') }}" class="cta-button bg-gray-200 text-gray-800">Batal</a>
        </div>
    </form>
</div>
@endsection
