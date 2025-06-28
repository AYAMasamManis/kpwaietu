@extends('layouts.app')

@section('title', 'Riwayat Pesanan')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-semibold mb-4 text-gray-800">Riwayat Pesanan Anda</h2>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    {{-- Tombol Ekspor (Hanya untuk Admin) --}}
    @auth
        @if(Auth::user()->role === 'admin')
            <div class="mb-4 text-right">
                {{-- UBAH JADI LINK <a>, BUKAN FORM --}}
                <a href="{{ route('orders.export') }}" class="cta-button bg-green-600">Ekspor Histori Penjualan</a>
            </div>
        @endif
    @endauth

    @if ($orders->isEmpty())
        <p class="text-center text-gray-500">Anda belum memiliki pesanan.</p>
    @else
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border-collapse border border-gray-300">
                <thead>
                    <tr>
                        <th class="border px-4 py-2 text-left bg-gray-100 text-gray-800">ID Pesanan</th>
                        <th class="border px-4 py-2 text-left bg-gray-100 text-gray-800">Tanggal</th>
                        <th class="border px-4 py-2 text-left bg-gray-100 text-gray-800">Produk</th>
                        <th class="border px-4 py-2 text-right bg-gray-100 text-gray-800">Total Harga</th>
                        <th class="border px-4 py-2 text-left bg-gray-100 text-gray-800">Status</th>
                        <th class="border px-4 py-2 text-left bg-gray-100 text-gray-800">Bukti Transfer</th>
                        <th class="border px-4 py-2 text-left bg-gray-100 text-gray-800">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td class="border px-4 py-2">{{ $order->id }}</td>
                            <td class="border px-4 py-2">{{ $order->created_at->format('d M Y') }}</td>
                            <td class="border px-4 py-2">
                                <ul class="list-disc pl-5">
                                    @foreach ($order->items as $item)
                                        <li>{{ $item->produk->name }} ({{ $item->quantity }} x Rp{{ number_format($item->price, 0, ',', '.') }})</li>
                                    @endforeach
                                </ul>
                            </td>
                            <td class="border px-4 py-2 text-right">Rp{{ number_format($order->total_price, 0, ',', '.') }}</td>
                            <td class="border px-4 py-2">
                                @php
                                    $statusClass = '';
                                    switch($order->status) {
                                        case 'pending': $statusClass = 'bg-gray-200 text-gray-800'; break;
                                        case 'menunggu_verifikasi': $statusClass = 'bg-yellow-200 text-yellow-800'; break;
                                        case 'terbayar': $statusClass = 'bg-green-200 text-green-800'; break;
                                        case 'diproses': $statusClass = 'bg-blue-200 text-blue-800'; break;
                                        case 'dikirim': $statusClass = 'bg-purple-200 text-purple-800'; break;
                                        case 'selesai': $statusClass = 'bg-green-200 text-green-800'; break;
                                        case 'dibatalkan': $statusClass = 'bg-red-200 text-red-800'; break;
                                        default: $statusClass = 'bg-gray-200 text-gray-800'; break;
                                    }
                                @endphp
                                <span class="px-2 py-1 rounded text-xs font-semibold {{ $statusClass }}">
                                    {{ ucfirst(str_replace('_', ' ', $order->status)) }}
                                </span>
                            </td>
                            <td class="border px-4 py-2 text-center">
                                @if($order->bukti_transfer)
                                    <a href="{{ asset('storage/bukti_transfer/' . $order->bukti_transfer) }}" target="_blank" class="text-blue-600 hover:underline">Lihat</a>
                                @else
                                    <span class="text-gray-400">-</span>
                                @endif
                            </td>
                            <td class="border px-4 py-2">
                                <a href="{{ route('orders.show', $order->id) }}" class="text-blue-600 hover:underline mr-2">Detail</a>
                                @if (!$order->trashed())
                                    <form action="{{ route('orders.archive', $order->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin mengarsipkan pesanan ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline text-sm">Arsipkan</button>
                                    </form>
                                @else
                                    <span class="text-gray-500 text-sm ml-2">Diarsipkan</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
