<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('items.product')->where('user_id', Auth::id())->latest()->get();
        return view('order.index', compact('orders'));
    }

    public function create()
    {
        $products = Product::all();
        return view('order.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id.*' => 'required|exists:products,id',
            'quantity.*' => 'required|integer|min:1'
        ]);

        $total = 0;
        $items = [];

        foreach ($request->product_id as $index => $productId) {
            $product = Product::findOrFail($productId);
            $qty = $request->quantity[$index];
            $items[] = [
                'product_id' => $product->id,
                'quantity' => $qty,
                'price' => $product->price,
            ];
            $total += $product->price * $qty;
        }

        $order = Order::create([
            'user_id' => Auth::id(),
            'total_price' => $total,
        ]);

        foreach ($items as $item) {
            $item['order_id'] = $order->id;
            OrderItem::create($item);
        }

        return redirect()->route('orders.index')->with('success', 'Pesanan berhasil dibuat');
    }
}

