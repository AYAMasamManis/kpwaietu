@extends('layouts.admin')

@section('title', 'Edit Produk')

@section('content')
<h2 class="text-2xl font-semibold mb-4">Edit Produk</h2>

@if ($errors->any())
    <div class="bg-red-100 text-red-800 p-2 rounded mb-4">
        <ul class="list-disc pl-4">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('produk.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
    @csrf
    @method('PUT')

    <div>
        <label class="block">Nama Produk</label>
        <input type="text" name="name" value="{{ old('name', $product->name) }}" class="w-full border px-4 py-2 rounded" required>
    </div>

    <div>
        <label class="block">Harga (Rp)</label>
        <input type="number" name="price" value="{{ old('price', $product->price) }}" class="w-full border px-4 py-2 rounded" required>
    </div>

    <div>
        <label class="block">Stok</label>
        <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" class="w-full border px-4 py-2 rounded" required>
    </div>

    <div>
        <label class="block">Deskripsi</label>
        <textarea name="description" class="w-full border px-4 py-2 rounded" rows="4">{{ old('description', $product->description) }}</textarea>
    </div>

    <div>
        <label class="block mb-1">Gambar Produk</label>
        @if ($product->image)
            <div class="mb-2">
                <img src="{{ asset('storage/images/' . $product->image) }}" alt="Gambar Produk" class="w-24 h-24 object-cover rounded shadow">
            </div>
        @endif
        <input type="file" name="image" class="w-full border px-4 py-2 rounded">
        <p class="text-sm text-gray-500 mt-1">Biarkan kosong jika tidak ingin mengganti gambar.</p>
    </div>

    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
        Simpan Perubahan
    </button>
</form>
@endsection
