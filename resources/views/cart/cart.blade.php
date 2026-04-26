<x-app-layout>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <header
        class="sticky top-0 z-30 glass-effect border-b border-slate-200 px-6 py-4 flex items-center justify-between">
        <div class="flex items-center gap-4">
            <button id="mobile-toggle" class="lg:hidden p-2 hover:bg-slate-100 rounded-lg">
                <i data-lucide="menu" class="w-6 h-6"></i>
            </button>
            <div>
                <h2 class="text-lg font-bold text-slate-800">Keranjang {{ auth()->user()->name }}</h2>
                <p class="text-xs text-slate-500">{{ $webConfig->description }}</p>
            </div>
        </div>
    </header>
    <div class="p-6">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <!-- LEFT: CART ITEMS -->
            <div class="lg:col-span-2 space-y-4">

                <div class="flex justify-between mb-2 px-2">
                    <h3 class="font-bold text-slate-800">
                        Daftar Item ({{ $cart ? $cart->items->count() : 0 }})
                    </h3>
                </div>

                @php $subtotal = 0; @endphp

                @forelse($cart->items ?? [] as $item)
                    @php
                        $harga = optional($item->produk)->price ?? 0;
                        $totalItem = $harga * $item->qty;
                        $subtotal += $totalItem;
                    @endphp

                    <div class="bg-white p-5 rounded-3xl border flex gap-6 items-center">

                        <!-- IMAGE -->
                        <div class="w-24 h-24 rounded-2xl overflow-hidden">
                            <img src="{{ asset('storage/' . $item->produk->image) }}" class="w-full h-full object-cover">
                        </div>

                        <!-- CONTENT -->
                        <div class="flex-1">

                            <div class="flex justify-between">
                                <div>
                                    <p class="text-xs text-indigo-600 font-bold">
                                        {{ optional($item->produk->kategori)->name ?? '-' }}
                                    </p>
                                    <h4 class="font-bold text-lg">
                                        {{ $item->produk->name ?? '-' }}
                                    </h4>
                                </div>

                                <!-- HAPUS -->
                                <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                    @csrf
                                    <button class="text-red-500 text-xl">×</button>
                                </form>
                            </div>

                            <div class="mt-3 flex justify-between items-center">

                                <!-- HARGA -->
                                <p class="text-lg font-black text-slate-900">
                                    Rp {{ number_format($harga) }}
                                </p>

                                <!-- QTY CONTROL -->
                                <div class="flex items-center border rounded-xl p-1" data-id="{{ $item->id }}">

                                    <button onclick="changeQty(this, -1)"
                                        class="w-8 h-8 hover:bg-gray-100 rounded-lg">-</button>

                                    <span class="w-10 text-center font-bold">
                                        {{ $item->qty }}
                                    </span>

                                    <button onclick="changeQty(this, 1)"
                                        class="w-8 h-8 hover:bg-gray-100 rounded-lg">+</button>

                                </div>

                            </div>
                        </div>
                    </div>

                @empty
                    <p class="text-gray-400">Keranjang kosong 😢</p>
                @endforelse

            </div>

            <!-- RIGHT: SUMMARY -->
            <div>
                <div class="bg-white p-6 rounded-3xl border sticky top-24">

                    <h3 class="font-bold mb-6">Ringkasan Pesanan</h3>

                    @php
                        $pajak = $subtotal * 0.11;
                        $total = $subtotal + $pajak;
                    @endphp

                    <div class="space-y-4">

                        <div class="flex justify-between">
                            <span>Subtotal</span>
                            <span id="subtotal">Rp {{ number_format($subtotal) }}</span>
                        </div>

                        <div class="flex justify-between">
                            <span>Pajak (11%)</span>
                            <span id="pajak">Rp {{ number_format($pajak) }}</span>
                        </div>

                        <div class="flex justify-between font-bold text-xl">
                            <span>Total</span>
                            <span id="total" class="text-indigo-600">
                                Rp {{ number_format($total) }}
                            </span>
                        </div>

                    </div>

                    <a href="{{ route('checkout') }}"
                        class="w-full bg-indigo-600 text-white py-3 rounded-xl text-center block">
                        Checkout
                    </a>

                </div>
            </div>

        </div>
    </div>

    <!-- 💥 JS FINAL -->
    <script>
        function formatRupiah(angka) {
            return 'Rp ' + angka.toLocaleString('id-ID');
        }

        // 🔥 INI KUNCINYA
        window.changeQty = function (btn, delta) {

            const wrapper = btn.closest('[data-id]');
            const id = wrapper.dataset.id;

            const span = wrapper.querySelector('span');
            let current = parseInt(span.innerText);

            current += delta;
            if (current < 1) current = 1;

            span.innerText = current;

            fetch(`/cart/update/${id}`, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "Accept": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ change: delta })
            })
                .then(res => res.json())
                .then(data => {

                    if (data.status === 'ok' || data.status === 'empty') {
                        document.getElementById('subtotal').innerText = formatRupiah(data.subtotal);
                        document.getElementById('pajak').innerText = formatRupiah(data.pajak);
                        document.getElementById('total').innerText = formatRupiah(data.total);
                    }

                    // 🔥 kalau item dihapus
                    if (data.status === 'deleted' || data.subtotal === 0) {
                        const card = btn.closest('.bg-white');
                        if (card) card.remove();
                    }

                })
                .catch(err => console.error(err));
        }
    </script>

</x-app-layout>