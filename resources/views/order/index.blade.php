@extends('layouts.admin')

@section('title', 'Daftar Pesanan')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-semibold">Daftar Pesanan</h2>
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
                <th class="border px-4 py-2">ID</th>
                <th class="border px-4 py-2">Nama User</th>
                <th class="border px-4 py-2">Total Harga</th>
                <th class="border px-4 py-2">Status</th>
                <th class="border px-4 py-2">Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @forelse($orders as $order)
                <tr class="text-center hover:bg-gray-50">
                    <td class="border px-4 py-2">{{ $order->id }}</td>
                    <td class="border px-4 py-2">{{ $order->user->name ?? '-' }}</td>
                    <td class="border px-4 py-2">Rp{{ number_format($order->total_price, 0, ',', '.') }}</td>
                    <td class="border px-4 py-2 capitalize">{{ $order->status }}</td>
                    <td class="border px-4 py-2">{{ $order->created_at->format('d-m-Y') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="border px-4 py-4 text-center text-gray-500">
                        Belum ada pesanan.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
