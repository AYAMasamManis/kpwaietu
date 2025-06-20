@extends('layouts.app')

@section('title', 'Forum Diskusi')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-semibold mb-4">Forum Diskusi Pengguna</h2>

    {{-- Notifikasi sukses --}}
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    {{-- Validasi error --}}
    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded mb-4">
            <ul class="list-disc pl-5 text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Daftar komentar/testimoni --}}
    <div class="space-y-4 mb-6">
        @forelse($forums as $forum)
        <div class="border-b pb-3">
            <p class="font-semibold text-sm text-gray-700">
                {{ $forum->user->name ?? 'Anonim' }}
                <span class="text-gray-400 text-xs ml-2">
                    {{ $forum->created_at->diffForHumans() }}
                </span>
            </p>
            <p class="text-gray-800 mt-1">{{ $forum->content }}</p>
        </div>
        @empty
        <p class="text-center text-gray-500">Belum ada komentar.</p>
        @endforelse
    </div>

    {{-- Form kirim komentar --}}
    @auth
    <form action="{{ route('forum.comment') }}" method="POST" class="space-y-4">
        @csrf
        <textarea name="comment" rows="3" class="w-full border rounded px-4 py-2" placeholder="Tulis komentar..." required>{{ old('comment') }}</textarea>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Kirim Komentar</button>
    </form>
    @else
    <p class="text-center text-gray-500">
        Silakan <a href="{{ route('login') }}" class="text-blue-600 underline">login</a> untuk berkomentar.
    </p>
    @endauth
</div>
@endsection
