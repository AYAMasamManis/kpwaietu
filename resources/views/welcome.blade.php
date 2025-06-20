@extends('layouts.app')

@section('title', 'Selamat Datang di Waiteu')

@section('content')
<div class="flex flex-col items-center justify-center min-h-screen bg-pink-50">
    <h1 class="text-4xl font-bold mb-6 text-pink-700">Waiteu Collagen Drink</h1>

    @auth
        <p class="mb-4 text-green-700">Halo, {{ Auth::user()->name }}!</p>

        <div class="flex gap-4">
            <a href="{{ route('dashboard') }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Dashboard</a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">Logout</button>
            </form>
        </div>
    @else
        <div class="space-x-4">
            <a href="{{ route('login') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Login</a>
            <a href="{{ route('register') }}" class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">Register</a>
        </div>
    @endauth
</div>
@endsection
