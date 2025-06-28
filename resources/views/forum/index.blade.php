@extends('layouts.app') {{-- Pastikan ini konsisten dengan layout utama kamu, yaitu 'layouts.app' --}}

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
        @forelse($comments as $comment) {{-- Menggunakan variabel $comments dari controller --}}
            {{-- Menyertakan partials/comment.blade.php untuk menampilkan komentar dan balasan --}}
            @include('partials.comment', ['comment' => $comment, 'level' => 0])
        @empty
            <p class="text-center text-gray-500">Belum ada komentar.</p>
        @endforelse
    </div>

    {{-- Form kirim komentar --}}
    @auth
    {{-- Perhatikan atribut enctype="multipart/form-data" untuk upload file --}}
    <form action="{{ route('forum.store') }}" method="POST" class="space-y-4" enctype="multipart/form-data">
        @csrf
        <textarea name="content" rows="3" class="w-full border rounded px-4 py-2" placeholder="Tulis komentar..." required>{{ old('content') }}</textarea>
        {{-- Input untuk upload gambar --}}
        <label for="gambar" class="block text-sm font-medium text-gray-700 mt-2">Unggah Gambar:</label>
        <input type="file" name="gambar" id="gambar" class="w-full border rounded px-4 py-2">
        @error('gambar') {{-- Menampilkan error validasi gambar --}}
            <p style="color: red; font-size: 0.9em;">{{ $message }}</p>
        @enderror
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Kirim Komentar</button>
    </form>
    @else
    <p class="text-center text-gray-500">
        Silakan <a href="{{ route('login') }}" class="text-blue-600 underline">login</a> untuk berkomentar.
    </p>
    @endauth
</div>
@endsection
