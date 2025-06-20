@extends('layouts.app')

@section('title', 'Profil')

@section('content')
<div class="max-w-xl mx-auto bg-white p-6 rounded shadow mt-8">
    <h2 class="text-2xl font-semibold mb-4">Edit Profil</h2>

    @if(session('success') || session('status') === 'profile-updated')
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded mb-4">
            {{ session('success') ?? 'Profil berhasil diperbarui.' }}
        </div>
    @endif

    {{-- Form Update Profil --}}
    <form method="POST" action="{{ route('profile.update') }}" class="space-y-4">
        @csrf
        @method('PATCH')

        <div>
            <label class="block">Nama</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}"
                   class="w-full border px-4 py-2 rounded" required>
        </div>

        <div>
            <label class="block">Email</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}"
                   class="w-full border px-4 py-2 rounded" required>
        </div>

        <div>
            <label class="block">Password Baru (opsional)</label>
            <input type="password" name="password" class="w-full border px-4 py-2 rounded">
        </div>

        <div>
            <label class="block">Konfirmasi Password Baru</label>
            <input type="password" name="password_confirmation" class="w-full border px-4 py-2 rounded">
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Simpan Perubahan
        </button>
    </form>

    {{-- Garis Pemisah --}}
    <hr class="my-6">

    {{-- Form Hapus Akun --}}
    <form method="POST" action="{{ route('profile.destroy') }}"
          onsubmit="return confirm('Yakin ingin hapus akun?')" class="mt-4">
        @csrf
        @method('DELETE')

        <div>
            <label class="block mb-1 text-red-600 font-semibold">Konfirmasi Password untuk Hapus Akun</label>
            <input type="password" name="password" class="w-full border px-4 py-2 rounded mb-2" required>

            <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
                Hapus Akun
            </button>
        </div>
    </form>
</div>
@endsection
