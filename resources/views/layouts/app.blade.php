<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Waiteu Collagen Drink - @yield('title')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>
<body class="bg-gray-50 text-gray-800 min-h-screen flex flex-col">

    <!-- Navbar -->
    <nav class="bg-white shadow-md px-6 py-4 flex justify-between items-center">
        <div>
            <a href="{{ url('/') }}" class="text-xl font-bold text-pink-600">Waiteu Collagen Drink</a>
        </div>
        <div class="space-x-4 flex items-center">
            <a href="{{ url('/') }}" class="hover:underline">Home</a>
            <a href="{{ route('produk.index') }}" class="hover:underline">Produk</a>
            <a href="{{ url('/forum') }}" class="hover:underline">Forum</a>

            @auth
                @if(Auth::user()->is_admin)
                    <a href="{{ route('admin.dashboard') }}" class="hover:underline">Admin Panel</a>
                @else
                    <a href="{{ url('/keranjang') }}" class="hover:underline">Keranjang</a>
                @endif
                <a href="{{ route('profile.edit') }}" class="hover:underline">Profil</a>

                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="hover:underline text-red-600 ml-2">Logout</button>
                </form>
            @endauth

            @guest
                <a href="{{ route('login') }}" class="hover:underline text-blue-600">Login</a>
                <a href="{{ route('register') }}" class="hover:underline text-green-600">Register</a>
            @endguest
        </div>
    </nav>

    <!-- Konten Utama -->
    <main class="flex-1 p-6">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t text-center text-sm py-4 text-gray-500">
        &copy; {{ date('Y') }} Waiteu Collagen Drink. All rights reserved.
    </footer>

</body>
</html>
