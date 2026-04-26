<x-app-layout>

    <div class="max-w-4xl mx-auto p-6">

        <!-- HEADER -->
        <div class="bg-green-100 text-green-700 p-4 rounded-xl mb-6">
            <h2 class="text-xl font-bold">🎉 Pembayaran Berhasil!</h2>
            <p>Order #: {{ $order->order_number }}</p>
        </div>

        <!-- LIST PRODUK -->
        <div class="bg-white p-6 rounded-2xl shadow space-y-4">

            @foreach($order->order_item as $item)
                <div class="flex justify-between items-center border-b pb-3">

                    <div class="flex items-center gap-4">
                        <img src="{{ asset('storage/' . $item->produk->image) }}" class="w-16 h-16 object-cover rounded-xl">

                        <div>
                            <h3 class="font-bold">{{ $item->produk->name }}</h3>
                            <p class="text-sm text-gray-500">
                                Qty: {{ $item->quantity }}
                            </p>
                        </div>
                    </div>

                    <div class="font-bold">
                        Rp {{ number_format($item->subtotal) }}
                    </div>

                </div>
            @endforeach

            <!-- TOTAL -->
            <div class="flex justify-between font-bold text-lg pt-4">
                <span>Total</span>
                <span class="text-indigo-600">
                    Rp {{ number_format($order->total_price) }}
                </span>
            </div>

        </div>

        <!-- STATUS -->
        <div class="mt-6 text-center">
            <span class="px-4 py-2 bg-indigo-100 text-indigo-700 rounded-xl font-bold">
                Status: {{ strtoupper($order->status) }}
            </span>
        </div>

        <!-- BUTTON -->
        <div class="mt-6 text-center">
            <a href="/riwayat" class="bg-indigo-600 text-white px-6 py-3 rounded-xl">
                Lihat Riwayat
            </a>
        </div>

    </div>

</x-app-layout>