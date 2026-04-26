<?php

namespace App\Http\Controllers\Produk;

use App\Models\Produk;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cart = Auth::user()->cart()->with('items.produk')->first();
        return view('cart.cart', compact('cart'));
    }

    public function add(Request $request)
    {
        $user = Auth::user();

        // ambil / buat cart
        $cart = $user->cart()->firstOrCreate([]);

        $item = $cart->items()->where('produk_id', $request->produk_id)->first();

        if ($item) {
            $item->increment('qty');
        } else {
            $cart->items()->create([
                'produk_id' => $request->produk_id,
                'qty' => 1
            ]);
        }

        return back()->with('success', 'Masuk keranjang 🔥');
    }

    public function updateQty(Request $request, $id)
    {
        try {

            $user = auth()->user();

            if (!$user) {
                return response()->json(['error' => 'Unauthenticated'], 401);
            }

            $item = CartItem::find($id);

            if (!$item) {
                return response()->json(['error' => 'Item tidak ditemukan']);
            }

            // 🔥 ambil cart user
            $cart = $user->cart()->firstOrCreate([]);

            // 🔥 pastikan item milik cart ini
            if ($item->cart_id != $cart->id) {
                $item->cart_id = $cart->id;
                $item->save();
            }

            $change = (int) ($request->change ?? 0);
            $newQty = $item->qty + $change;

            if ($newQty <= 0) {
                $item->delete();
            } else {
                $item->qty = $newQty;
                $item->save();
            }

            $cart = $user->cart()->with('items.produk')->first();

            $subtotal = 0;

            foreach ($cart->items as $i) {
                if (!$i->produk)
                    continue;
                $subtotal += $i->produk->price * $i->qty;
            }

            $pajak = $subtotal * 0.11;
            $total = $subtotal + $pajak;

            return response()->json([
                'status' => 'ok',
                'subtotal' => $subtotal,
                'pajak' => $pajak,
                'total' => $total
            ]);

        } catch (\Throwable $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'line' => $e->getLine()
            ], 500);
        }
    }
    public function remove($id)
    {
        $user = auth()->user();

        $cart = $user->cart()->firstOrCreate([]);

        $item = CartItem::where('id', $id)
            ->where('cart_id', $cart->id)
            ->firstOrFail();

        $item->delete();

        return back();
    }
}