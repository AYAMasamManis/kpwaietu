<?php

namespace App\Http\Controllers; // KOREKSI: Gunakan \ (backslash)

use App\Models\Order; // KOREKSI: Gunakan \ (backslash)
use App\Models\OrderItem; // KOREKSI: Gunakan \ (backslash)
use App\Models\Produk; // KOREKSI: Gunakan \ (backslash)
use Illuminate\Http\Request; // KOREKSI: Gunakan \ (backslash)
use Illuminate\Support\Facades\Auth; // KOREKSI: Gunakan \ (backslash)
use Symfony\Component\HttpFoundation\Response; // KOREKSI: Gunakan \ (backslash)
use Illuminate\Support\Facades\Storage; // KOREKSI: Gunakan \ (backslash)
use Illuminate\Support\Carbon; // Ini sudah benar

class OrderController extends Controller
{
    /**
     * Menampilkan daftar pesanan.
     * Jika admin, tampilkan semua pesanan (termasuk diarsipkan). Jika customer, tampilkan pesanan yang belum diarsipkan.
     */
    public function index()
    {
        if (Auth::check() && Auth::user()->role === 'admin') {
            // Admin melihat semua pesanan, termasuk yang diarsipkan
            $orders = Order::withTrashed()->with('items.produk')->latest()->get();
        } elseif (Auth::check()) {
            // Customer hanya melihat pesanan yang BELUM diarsipkan
            $orders = Order::with('items.produk')->where('user_id', Auth::id())->latest()->get();
        } else {
            return redirect()->route('login')->with('error', 'Anda harus login untuk melihat riwayat pesanan.');
        }

        return view('order.index', compact('orders'));
    }

    /**
     * Menampilkan form untuk membuat pesanan baru (Keranjang Belanja).
     */
    public function create()
    {
        $produks = Produk::all();
        return view('order.create', compact('produks'));
    }

    /**
     * Menyimpan pesanan baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id.*' => 'exists:produks,id',
            'quantity.*' => 'integer|min:0'
        ]);

        $total = 0;
        $items = [];
        $hasItemsToOrder = false;

        foreach ($request->product_id as $index => $productId) {
            $qty = (int) $request->quantity[$index];

            if ($qty > 0) {
                $produk = Produk::findOrFail($productId);

                if ($produk->stok < $qty) {
                    return back()->with('error', 'Stok ' . $produk->name . ' (' . $qty . ') tidak mencukupi. Sisa stok: ' . $produk->stok . ' tersedia.');
                }

                $items[] = [
                    'product_id' => $produk->id,
                    'quantity' => $qty,
                    'price' => $produk->price,
                ];
                $total += $produk->price * $qty;
                $hasItemsToOrder = true;
            }
        }

        if (!$hasItemsToOrder) {
            return back()->with('error', 'Anda belum memilih produk atau kuantitas yang valid untuk dipesan.');
        }

        $order = Order::create([
            'user_id' => Auth::id(),
            'total_price' => $total,
            'status' => 'pending',
        ]);

        foreach ($items as $item) {
            $item['order_id'] = $order->id;
            OrderItem::create($item);

            $produk = Produk::find($item['product_id']);
            $produk->stok -= $item['quantity'];
            $produk->save();
        }

        return redirect()->route('orders.show', $order->id)->with('success', 'Pesanan Anda berhasil dibuat! Silakan lakukan pembayaran.');
    }

    /**
     * Menampilkan detail pesanan untuk konfirmasi pembayaran.
     */
    public function show(Order $order)
    {
        if (Auth::id() !== $order->user_id && Auth::user()->role !== 'admin') {
            abort(Response::HTTP_FORBIDDEN, 'Anda tidak memiliki izin untuk melihat pesanan ini.');
        }

        $order->load('items.produk');

        return view('order.show', compact('order'));
    }

    /**
     * Mengubah status pesanan (Hanya untuk Admin).
     */
    public function updateStatus(Request $request, Order $order)
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(Response::HTTP_FORBIDDEN, 'Anda tidak memiliki izin untuk mengubah status pesanan.');
        }

        $request->validate([
            'status' => 'required|in:pending,terbayar,diproses,dikirim,selesai,dibatalkan,menunggu_verifikasi',
            'catatan_admin' => 'nullable|string|max:500', // Validasi catatan admin (jika ada)
        ]);

        $order->status = $request->status;
        $order->catatan_admin = $request->catatan_admin; // Simpan catatan admin (jika ada)
        $order->save();

        return back()->with('success', 'Status pesanan berhasil diperbarui menjadi ' . $request->status . '.');
    }

    /**
     * Mengarsipkan pesanan (soft delete) (Admin atau Pemilik Pesanan).
     */
    public function archive(Order $order)
    {
        // Hanya pemilik pesanan atau admin yang bisa mengarsipkan
        if (Auth::id() !== $order->user_id && Auth::user()->role !== 'admin') {
            abort(Response::HTTP_FORBIDDEN, 'Anda tidak memiliki izin untuk mengarsipkan pesanan ini.');
        }

        $order->delete(); // Ini akan melakukan soft delete karena trait SoftDeletes
        return back()->with('success', 'Pesanan berhasil diarsipkan.');
    }

    /**
     * Mengunggah bukti transfer untuk pesanan.
     */
    public function uploadBukti(Request $request, Order $order)
    {
        // Pastikan hanya pemilik pesanan yang bisa upload bukti (atau admin)
        if (Auth::id() !== $order->user_id && Auth::user()->role !== 'admin') {
            abort(Response::HTTP_FORBIDDEN, 'Anda tidak memiliki izin untuk mengunggah bukti transfer ini.');
        }

        // Validasi file bukti
        $request->validate([
            'bukti' => 'required|image|mimes:jpeg,png,jpg,pdf|max:5048', // Max 5MB
        ]);

        // Hapus bukti lama jika ada
        if ($order->bukti_transfer && Storage::disk('public')->exists('bukti_transfer/' . $order->bukti_transfer)) {
            Storage::disk('public')->delete('bukti_transfer/' . $order->bukti_transfer);
        }

        // Simpan file bukti transfer
        $buktiPath = $request->file('bukti')->store('bukti_transfer', 'public');
        $order->bukti_transfer = basename($buktiPath);
        $order->status = 'menunggu_verifikasi'; // Ubah status pesanan setelah bukti diunggah
        $order->save();

        return back()->with('success', 'Bukti transfer berhasil diunggah! Pesanan Anda menunggu verifikasi.');
    }

    /**
     * Mengekspor data pesanan ke file CSV. (Hanya untuk Admin)
     */
    public function export()
    {
        // Otorisasi: hanya admin yang bisa mengekspor
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(Response::HTTP_FORBIDDEN, 'Anda tidak memiliki izin untuk mengekspor data.');
        }

        $headers = [
            'Content-type'        => 'text/csv',
            'Content-Disposition' => 'attachment; filename=histori_penjualan_waiteu_' . Carbon::now()->format('Ymd_His') . '.csv',
            'Pragma'              => 'no-cache',
            'Cache-Control'       => 'must-revalidate, post-check=0, pre-check=0',
            'Expires'             => '0',
        ];

        $orders = Order::withTrashed()->with('user', 'items.produk')->get(); // Ambil semua pesanan

        $callback = function() use ($orders)
        {
            $file = fopen('php://output', 'w');

            // Tulis header CSV
            fputcsv($file, [
                'ID Pesanan',
                'Nama Pelanggan',
                'Email Pelanggan',
                'Total Harga',
                'Status',
                'URL Bukti Transfer',
                'Tanggal Pesanan',
                'Detail Produk',
            ]);

            // Tulis setiap baris data
            foreach ($orders as $order) {
                $productDetails = $order->items->map(function ($item) {
                    return $item->produk->name . ' (' . $item->quantity . 'x Rp' . number_format($item->price, 0, ',', '.') . ')';
                })->implode('; ');

                $data = [
                    $order->id,
                    $order->user->name ?? 'N/A',
                    $order->user->email ?? 'N/A',
                    $order->total_price,
                    ucfirst(str_replace('_', ' ', $order->status)),
                    $order->bukti_transfer ? url('storage/bukti_transfer/' . $order->bukti_transfer) : '-',
                    Carbon::parse($order->created_at)->format('d-m-Y H:i:s'),
                    $productDetails,
                ];
                fputcsv($file, $data);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
