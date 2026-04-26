<?php

namespace App\Http\Controllers\Produk;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Produk;
use Illuminate\Http\Request;
use Midtrans\Snap;
use App\Models\OrderItem;
use Midtrans\Config;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $id)
    {
        $produkdibeli = Produk::find($id);
        return view("order.co", compact("produkdibeli"));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function callback(Request $request)
    {
        $serverKey = config('services.midtrans.server_key');

        // 1. Validasi Signature
        $signature = hash(
            "sha512",
            $request->order_id . $request->status_code . $request->gross_amount . $serverKey
        );

        if ($signature !== $request->signature_key) {
            return response()->json(['error' => 'Invalid signature'], 403);
        }

        // 2. Cari Order
        $order = Order::where('order_number', $request->order_id)->first();

        if (!$order) {
            return response()->json(['error' => 'Order tidak ditemukan'], 404);
        }

        $status = $request->transaction_status;

        // 3. Logic Status Switching
        switch ($status) {
            case 'capture':
            case 'settlement':
                // Hanya proses jika status saat ini 'pending' (mencegah double stok decrement)
                if ($order->status == 'pending') {
                    $order->update([
                        'status' => 'processing',
                        'payment_method' => $request->payment_type
                    ]);

                    foreach ($order->order_item as $item) {
                        Produk::where('id', $item->produk_id)->decrement('stock', $item->quantity);
                    }

                    if ($order->user && $order->user->cart) {
                        $order->user->cart->items()->delete();
                    }
                }
                break;

            case 'pending':
                // Tetap pending
                $order->update(['status' => 'pending']);
                break;

            case 'deny':
            case 'expire':
            case 'cancel':
                // Ubah status ke cancelled HANYA JIKA belum sukses/processing
                // Agar jika ada delay callback, transaksi yang sudah sukses tidak tertimpa jadi 'cancelled'
                if ($order->status == 'pending') {
                    $order->update(['status' => 'cancelled']);
                }
                break;
        }

        return response()->json(['success' => true]);
    }
    public function checkout()
    {
        $user = auth()->user();
        $cart = $user->cart()->with('items.produk')->first();

        foreach ($cart->items as $item) {

            if ($item->produk->stock < $item->qty) {
                return back()->with('error', 'Stok tidak cukup untuk ' . $item->produk->name);
            }
        }
        if (!$cart || $cart->items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Keranjang kosong');
        }
        // 🔥 hitung total
        $total = 0;
        foreach ($cart->items as $item) {
            if (!$item->produk)
                continue;
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
            if (!$item->produk)
                continue;

            $order->order_item()->create([
                'produk_id' => $item->produk->id,
                'quantity' => $item->qty,
                'price' => $item->produk->price,
                'subtotal' => $item->produk->price * $item->qty
            ]);
        }

        // 🔥 Midtrans config
        Config::$serverKey = config('services.midtrans.server_key');
        Config::$isProduction = config('services.midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;

        // 🔥 request ke Midtrans
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

        return view('checkout.index', compact('snapToken', 'order', 'cart'));
    }
    public function success($orderId)
    {

        $order = Order::with('order_item.produk')
            ->where('order_number', $orderId)
            ->firstOrFail();


        return view('order.success', compact('order'));
    }

    public function riwayat()
    {
        $user = auth()->user();
        $order = Order::with('order_item', 'order_item.produk')->where('user_id', $user->id)->orderByAsc('created_at')->first();

        return view('order.riwayat', compact('order'));
    }
}
