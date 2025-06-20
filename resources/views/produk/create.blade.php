@extends('layouts.admin')

@section('title', 'Tambah Produk')

@section('content')
<h2 class="text-2xl font-semibold mb-4">Tambah Produk Baru</h2>

@if ($errors->any())
    <div class="bg-red-100 text-red-800 p-2 rounded mb-4">
        <ul class="list-disc pl-4">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
    @csrf
    <div>
        <label class="block">Nama Produk</label>
        <input type="text" name="name" class="w-full border px-4 py-2 rounded" required>
    </div>

    <div>
        <label class="block">Harga (Rp)</label>
        <input type="number" name="price" class="w-full border px-4 py-2 rounded" required>
    </div>

    <div>
        <label class="block">Stok</label>
        <input type="number" name="stock" class="w-full border px-4 py-2 rounded" required>
    </div>

    <div>
        <label class="block">Deskripsi</label>
        <textarea name="description" class="w-full border px-4 py-2 rounded" rows="4"></textarea>
    </div>

    <div>
        <label class="block">Gambar Produk</label>
        <input type="file" name="image" class="w-full border px-4 py-2 rounded">
    </div>

    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
        Simpan
    </button>
</form>
@endsection
