<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin - @yield('title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :root {
            --nude-bg: #f2e6e0; /* latar belakang utama */
            --nude-dark: #8b6f61; /* ornamen gelap */
            --nude-light: #fdf7f5; /* ornamen terang */
            --text-dark: #3e2c27;
        }
    </style>
</head>
<body class="bg-[var(--nude-bg)] text-[var(--text-dark)] min-h-screen">

    <nav class="bg-[var(--nude-dark)] text-white p-4 shadow">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-xl font-bold">Admin Panel - Waiteu</h1>
            <div class="space-x-4 text-sm">
                <a href="{{ route('dashboard') }}" class="hover:underline">Dashboard</a>
                <a href="{{ route('produk.index') }}" class="hover:underline">Produk</a>
                <a href="{{ route('forum.index') }}" class="hover:underline">Forum</a>
                <a href="{{ route('profile.edit') }}" class="hover:underline">Profil</a>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="hover:underline">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <main class="container mx-auto mt-8 bg-[var(--nude-light)] p-6 rounded shadow">
        @yield('content')
    </main>

</body>
</html>
