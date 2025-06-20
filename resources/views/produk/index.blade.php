@extends('layouts.admin')

@section('title', 'Daftar Produk')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-semibold">Daftar Produk</h2>
    <a href="{{ route('produk.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
        + Tambah Produk
    </a>
</div>

@if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

<div class="overflow-x-auto">
    <table class="w-full table-auto border-collapse border border-gray-300">
        <thead class="bg-gray-100">
            <tr>
                <th class="border px-4 py-2">Gambar</th>
                <th class="border px-4 py-2">Nama</th>
                <th class="border px-4 py-2">Harga</th>
                <th class="border px-4 py-2">Stok</th>
                <th class="border px-4 py-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($products as $product)
            <tr class="text-center hover:bg-gray-50">
                <td class="border px-4 py-2">
                    @if($product->image)
                        <img src="{{ asset('storage/images/' . $product->image) }}" alt="Gambar Produk" class="w-16 h-16 object-cover mx-auto rounded">
                    @else
                        <span class="text-gray-400">-</span>
                    @endif
                </td>
                <td class="border px-4 py-2">{{ $product->name ?? '-' }}</td>
                <td class="border px-4 py-2">
                    Rp{{ number_format($product->price ?? 0, 0, ',', '.') }}
                </td>
                <td class="border px-4 py-2">{{ $product->stock ?? 0 }}</td>
                <td class="border px-4 py-2">
                    <a href="{{ route('produk.edit', $product->id) }}" class="text-blue-600 hover:underline mr-2">
                        Edit
                    </a>
                    <form action="{{ route('produk.destroy', $product->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:underline">
                            Hapus
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="border px-4 py-4 text-center text-gray-500">
                    Belum ada produk.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
