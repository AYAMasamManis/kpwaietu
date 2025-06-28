@extends('layouts.app') {{-- <<< UBAH DARI <x-app-layout> KE INI --}}

@section('title', 'Profil Saya') {{-- Tambahkan ini jika belum ada --}}

@section('content') {{-- <<< BUNGKUS SELURUH KONTEN DI DALAM INI --}}
    {{-- Hapus <x-slot name="header"> dan </x-slot> jika ada, karena @extends tidak menggunakannya --}}
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight mb-6">
        {{ __('Profil Saya') }}
    </h2>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        {{-- Bagian Informasi Umum Profil --}}
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <div class="max-w-xl">
                @include('profile.partials.update-profile-information-form')

                {{-- Menampilkan Role Pengguna --}}
                <div class="mt-6 border-t pt-4">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-2">Informasi Akun</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400">
                        <strong>Role:</strong> {{ ucfirst($user->role) }}
                    </p>
                </div>
            </div>
        </div>

        {{-- Bagian Ringkasan Riwayat Pesanan --}}
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <div class="max-w-xl">
                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                    {{ __('Riwayat Pesanan Terbaru') }}
                </h2>
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400 mb-4">
                    Lihat ringkasan pesanan Anda.
                </p>

                @if ($recentOrders->isEmpty())
                    <p class="text-sm text-gray-500">Anda belum memiliki pesanan aktif.</p>
                @else
                    <ul class="list-disc pl-5 space-y-2">
                        @foreach ($recentOrders as $order)
                            <li class="text-sm text-gray-600 dark:text-gray-400">
                                Pesanan #{{ $order->id }} ({{ $order->created_at->format('d M Y') }}) -
                                Total: Rp{{ number_format($order->total_price, 0, ',', '.') }} -
                                Status: <span class="font-semibold">{{ ucfirst($order->status) }}</span>
                            </li>
                        @endforeach
                    </ul>
                    <div class="mt-4">
                        <a href="{{ route('orders.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Lihat Semua Pesanan
                        </a>
                        {{-- Sesuaikan kelas button sesuai skema warna nude --}}
                    </div>
                @endif
            </div>
        </div>

        {{-- Bagian Ringkasan Aktivitas Forum --}}
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <div class="max-w-xl">
                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                    {{ __('Aktivitas Forum Anda') }}
                </h2>
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400 mb-4">
                    Lihat kontribusi Anda di forum.
                </p>
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    Anda telah membuat **{{ $commentCount }}** komentar di forum.
                </p>
            </div>
        </div>

        {{-- Bagian Update Password (dari Breeze) --}}
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <div class="max-w-xl">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        {{-- Bagian Delete User (dari Breeze) --}}
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <div class="max-w-xl">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
@endsection {{-- <<< BUNGKUS SELURUH KONTEN DI DALAM INI --}}
