@extends('layouts.app') {{-- Menggunakan layout utama, pastikan file ini ada --}}

@section('title', 'Keranjang Belanja')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-semibold mb-4">Keranjang Belanja</h2>

    @if (session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul class="list-disc pl-5 text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @auth
    <form method="POST" action="{{ route('orders.store') }}">
        @csrf
        @forelse($produks as $produk) {{-- Menggunakan $produks dan $produk --}}
            <div class="card mb-3 p-3 border rounded-lg shadow-sm">
                <h5 class="text-lg font-semibold">{{ $produk->name }}</h5> {{-- Menggunakan $produk->name --}}
                <p class="text-gray-700">Harga: Rp{{ number_format($produk->price) }}</p> {{-- Menggunakan $produk->price --}}
                <p class="text-gray-700">Stok Tersedia: {{ $produk->stok }}</p> {{-- Menampilkan stok --}}
                <input type="hidden" name="product_id[]" value="{{ $produk->id }}">
                <div class="form-group mt-2">
                    <label for="quantity-{{ $produk->id }}" class="block text-sm font-medium text-gray-700">Jumlah:</label>
                    <input type="text" name="quantity[]" id="quantity-{{ $produk->id }}"
                           class="form-control w-24 border rounded-md px-2 py-1 mt-1"
                           value="0"> {{-- Pastikan value="0" dan min="0" --}}
                </div>
            </div>
        @empty
            <p class="text-center text-gray-500">Tidak ada produk tersedia untuk ditambahkan ke keranjang.</p>
        @endforelse

        <div class="flex justify-between items-center mt-4"> {{-- Menggunakan flex untuk tata letak tombol --}}
            @if(!$produks->isEmpty())
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                    Proses Pesanan
                </button>
            @endif
            <a href="{{ route('orders.index') }}" class="bg-gray-200 text-gray-800 px-4 py-2 rounded hover:bg-gray-300">
                Lihat Riwayat Pesanan Saya
            </a>
        </div>
    </form>
    @else
    <p class="text-center text-gray-500">
        Silakan <a href="{{ route('login') }}" class="text-blue-600 underline">login</a> untuk menambahkan produk ke keranjang.
    </p>
    @endauth
</div>
@endsection
