@extends('layouts.app') {{-- Menggunakan layout app untuk konsistensi tema global --}}

@section('title', 'Tambah Produk Baru')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-semibold mb-4 text-gray-800">Tambah Produk Baru</h2>

    {{-- Notifikasi error validasi --}}
    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul class="list-disc pl-5 text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
        @csrf

        <div>
            <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Nama Varian:</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}"
                   class="shadow-sm appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        </div>

        <div>
            <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Deskripsi:</label>
            <textarea name="description" id="description" rows="4"
                      class="shadow-sm appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ old('description') }}</textarea>
        </div>

        <div>
            <label for="price" class="block text-gray-700 text-sm font-bold mb-2">Harga:</label>
            <input type="number" name="price" id="price" value="{{ old('price') }}"
                   class="shadow-sm appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required min="0">
        </div>

        <div>
            <label for="stok" class="block text-gray-700 text-sm font-bold mb-2">Stok:</label>
            <input type="number" name="stok" id="stok" value="{{ old('stok') }}"
                   class="shadow-sm appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required min="0">
        </div>

        <div>
            <label for="gambar" class="block text-gray-700 text-sm font-bold mb-2">Gambar Produk (Opsional):</label>
            <input type="file" name="gambar" id="gambar"
                   class="shadow-sm appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>

        <div class="flex items-center justify-between mt-6 pt-4 border-t border-gray-200">
            <button type="submit" class="cta-button bg-blue-600">
                Simpan Produk
            </button>
            <a href="{{ route('produk.index') }}" class="cta-button bg-gray-200 text-gray-800">Batal</a>
        </div>
    </form>
</div>
@endsection
