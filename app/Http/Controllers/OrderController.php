<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function checkout()
    {
        $carts = Cart::with('product')->where('user_id', auth()->id())->get();
        
        if ($carts->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Cart kosong!');
        }

        $total = $carts->sum(function($cart) {
            $price = $cart->product->discount_price ?? $cart->product->price;
            return $price * $cart->quantity;
        });

        return view('order.checkout', compact('carts', 'total'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'           => 'required|string|max:255',
            'telepon'        => 'required|string|max:20',
            'alamat'         => 'required|string',
            'payment_method' => 'required|string',
        ]);

        $carts = Cart::with('product')->where('user_id', auth()->id())->get();

        if ($carts->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Cart kosong!');
        }

        $total = $carts->sum(function($cart) {
            $price = $cart->product->discount_price ?? $cart->product->price;
            return $price * $cart->quantity;
        });

        $order = Order::create([
            'user_id'        => auth()->id(),
            'nama'           => $request->nama,
            'telepon'        => $request->telepon,
            'alamat'         => $request->alamat,
            'payment_method' => $request->payment_method,
            'total'          => $total,
            'status'         => 'pending',
        ]);

        foreach ($carts as $cart) {
            OrderItem::create([
                'order_id'   => $order->id,
                'product_id' => $cart->product_id,
                'quantity'   => $cart->quantity,
                'price'      => $cart->product->discount_price ?? $cart->product->price,
            ]);
        }

        Cart::where('user_id', auth()->id())->delete();

        return redirect()->route('order.success', $order)->with('success', 'Pesanan berhasil dibuat!');
    }

    public function success(Order $order)
    {
        return view('order.success', compact('order'));
    }

    public function history()
    {
        $orders = Order::with('items.product')->where('user_id', auth()->id())->latest()->get();
        return view('order.history', compact('orders'));
    }
}