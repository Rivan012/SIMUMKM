<x-app-layout>

    <div class="p-6 max-w-4xl mx-auto">

        <h2 class="text-2xl font-bold mb-6">Checkout</h2>

        <!-- LIST PRODUK -->
        <div class="bg-white rounded-2xl p-5 shadow mb-6">
            @php $total = 0; @endphp

            @foreach($cart->items as $item)
                @php
                    if (!$item->produk)
                        continue;
                    $subtotal = $item->produk->price * $item->qty;
                    $total += $subtotal;
                @endphp

                <div class="flex justify-between mb-3">
                    <div>
                        <p class="font-bold">{{ $item->produk->name }}</p>
                        <p class="text-sm text-gray-500">Qty: {{ $item->qty }}</p>
                    </div>
                    <p class="font-bold">
                        Rp {{ number_format($subtotal) }}
                    </p>
                </div>
            @endforeach

            <hr class="my-4">

            <div class="flex justify-between font-bold text-lg">
                <span>Total</span>
                <span>Rp {{ number_format($total) }}</span>
            </div>
        </div>

        <!-- BUTTON BAYAR -->
        <button id="pay-button" class="w-full bg-indigo-600 text-white py-4 rounded-xl font-bold hover:bg-indigo-700">
            Bayar Sekarang
        </button>

    </div>

    <!-- MIDTRANS -->
    <script src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('services.midtrans.client_key') }}">
        </script>

    <script>
        document.getElementById('pay-button').onclick = function () {
            snap.pay('{{ $snapToken }}', {

                onSuccess: function (result) {
                    window.location.href = "/order/success/" + result.order_id;
                },

                onPending: function (result) {
                    // 🔥 redirect juga walau pending
                    window.location.href = "/order/success/" + result.order_id;
                },

                onError: function (result) {
                    alert("Pembayaran gagal");
                }

            });
        };
    </script>

</x-app-layout>