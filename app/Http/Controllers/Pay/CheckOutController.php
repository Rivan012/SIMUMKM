<?php

namespace App\Http\Controllers\Pay;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;
use App\Models\Order;
use App\Models\OrderItem;

class CheckOutController extends Controller
{
    //
    public function checkout()
    {
        $user = auth()->user();
        $cart = $user->cart()->with('items.produk')->first();

        if (!$cart || $cart->items->isEmpty()) {
            return back()->with('error', 'Keranjang kosong');
        }

        // 🔥 hitung total
        $total = 0;
        foreach ($cart->items as $item) {
            $total += $item->produk->price * $item->qty;
        }

        // 🔥 buat order
        $order = Order::create([
            'user_id' => $user->id,
            'order_number' => 'ORD-' . time(),
            'total_price' => $total,
            'status' => 'pending',
            'channel' => 'web',
            'payment_method' => 'midtrans'
        ]);

        // 🔥 simpan order items
        foreach ($cart->items as $item) {
            $order->items()->create([
                'produk_id' => $item->produk->id,
                'quantity' => $item->qty,
                'price' => $item->produk->price,
                'subtotal' => $item->produk->price * $item->qty
            ]);
        }

        // 🔥 config midtrans
        Config::$serverKey = config('services.midtrans.server_key');
        Config::$isProduction = config('services.midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;

        // 🔥 kirim ke midtrans
        $params = [
            'transaction_details' => [
                'order_id' => $order->order_number,
                'gross_amount' => (int) $total,
            ],
            'customer_details' => [
                'name' => $user->name,
                'email' => $user->email,
            ],
        ];

        $snapToken = Snap::getSnapToken($params);

        return view('checkout', compact('snapToken', 'order'));
    }
}
