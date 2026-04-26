<x-app-layout>
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-6">Riwayat Pesanan</h1>

        @forelse($order->get() as $item)
                <div class="bg-white shadow-md rounded-lg p-6 mb-4 border border-gray-200">
                    <div class="flex justify-between items-center border-b pb-4 mb-4">
                        <div>
                            <span class="text-sm text-gray-500">ID Pesanan: #{{ $item->order_number }}</span>
                            <p class="text-sm font-semibold">{{ $item->created_at->format('d M Y, H:i') }}</p>
                        </div>
                        <span class="px-3 py-1 rounded-full text-xs font-bold 
            {{ $item->status == 'processing' ? 'bg-green-100 text-green-700' : '' }}
            {{ $item->status == 'pending' ? 'bg-yellow-100 text-yellow-700' : '' }}
            {{ $item->status == 'cancelled' ? 'bg-red-100 text-red-700' : '' }}
            {{ $item->status == 'shipped' ? 'bg-blue-100 text-blue-700' : '' }}">
                            {{ strtoupper($item->status) }}
                        </span>
                    </div>

                    <div class="space-y-4">

                    </div>

                    <div class="border-t mt-4 pt-4 flex justify-between items-center">
                        <span class="font-bold text-lg">Total Pembayaran</span>
                        <span class="font-bold text-xl text-orange-600">
                            Rp
                            {{ number_format($item->total_price ?? $item->order_item->sum(fn($i) => $i->jumlah * $i->harga), 0, ',', '.') }}
                        </span>
                    </div>
                </div>
        @empty
            <div class="text-center py-10">
                <p class="text-gray-500 text-lg">Belum ada riwayat pesanan.</p>
                <a href="/produk" class="text-blue-600 hover:underline">Mulai belanja sekarang</a>
            </div>
        @endforelse
    </div>
</x-app-layout>