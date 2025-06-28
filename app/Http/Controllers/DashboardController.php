<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;
    use App\Models\Produk; // Impor model Produk
    use App\Models\Order;  // Impor model Order
    use App\Models\User;   // Impor model User

    class DashboardController extends Controller
    {
        public function index()
        {
            if (Auth::check() && Auth::user()->role === 'admin') {
                // Ambil data untuk dashboard admin
                $totalProduk = Produk::count();
                $totalPesanan = Order::count(); // Semua pesanan
                $totalUsers = User::count(); // Semua user
                $pendingOrders = Order::where('status', 'pending')->count(); // Pesanan pending

                return view('dashboard.admin', compact('totalProduk', 'totalPesanan', 'totalUsers', 'pendingOrders'));

            } else {
                // Ambil data untuk dashboard customer
                $totalPesananCustomer = Order::where('user_id', Auth::id())->count();
                $pendingOrdersCustomer = Order::where('user_id', Auth::id())->where('status', 'pending')->count();
                $completedOrdersCustomer = Order::where('user_id', Auth::id())->where('status', 'selesai')->count();

                return view('dashboard.customer', compact('totalPesananCustomer', 'pendingOrdersCustomer', 'completedOrdersCustomer'));
            }
        }
    }
    