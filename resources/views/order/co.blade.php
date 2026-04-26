<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - {{ $webConfig->name }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .bg-stitch { background-color: #2D5A9E; }
        .text-stitch { color: #2D5A9E; }
        .border-stitch { border-color: #2D5A9E; }
        .focus-stitch:focus { border-color: #2D5A9E; ring-color: #2D5A9E; }
    </style>
</head>

<body class="bg-gray-50 font-sans text-gray-900">

    <nav class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between h-16 items-center">
                <div class="flex items-center gap-2">
                    <a href="/" class="w-8 h-8 md:w-10 md:h-10 bg-stitch rounded-lg flex items-center justify-center text-white">
                        <i class="fas fa-chevron-left text-xs"></i>
                    </a>
                    <span class="text-lg font-bold text-stitch tracking-tight">Checkout</span>
                </div>
                <div class="text-sm text-gray-500 hidden md:block">
                    Selesaikan pesanan Anda
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4 py-8 md:py-12">
        <div class="flex flex-col lg:flex-row gap-8">
            
            <div class="w-full lg:w-2/3 space-y-6">
                <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100">
                    <h2 class="text-xl font-bold mb-6 flex items-center gap-3">
                        <i class="fas fa-map-marker-alt text-stitch"></i> Informasi Pengiriman
                    </h2>
                    
                    <form action="#" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="col-span-full">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                            <input type="text" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:border-stitch" placeholder="Masukkan nama penerima">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nomor WhatsApp</label>
                            <input type="tel" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:border-stitch" placeholder="0812xxxx">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Metode Ambil</label>
                            <select class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:border-stitch">
                                <option>Delivery (Antar)</option>
                                <option>Take Away (Ambil Sendiri)</option>
                                <option>Dine In (Makan di Tempat)</option>
                            </select>
                        </div>

                        <div class="col-span-full">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Alamat Lengkap / Nomor Meja</label>
                            <textarea rows="3" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:border-stitch" placeholder="Detail alamat atau nomor meja jika makan di tempat"></textarea>
                        </div>

                        <div class="col-span-full">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Catatan Pesanan (Opsional)</label>
                            <input type="text" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:border-stitch" placeholder="Contoh: Jangan terlalu pedas">
                        </div>
                    </form>
                </div>

                <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100">
                    <h2 class="text-xl font-bold mb-6 flex items-center gap-3">
                        <i class="fas fa-wallet text-stitch"></i> Metode Pembayaran
                    </h2>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                        <label class="relative border-2 border-stitch bg-blue-50 rounded-2xl p-4 cursor-pointer">
                            <input type="radio" name="payment" class="hidden" checked>
                            <div class="text-center">
                                <i class="fas fa-money-bill-wave mb-2 text-stitch"></i>
                                <p class="text-xs font-bold">Tunai/COD</p>
                            </div>
                        </label>
                        <label class="relative border border-gray-200 rounded-2xl p-4 cursor-pointer hover:border-stitch transition">
                            <input type="radio" name="payment" class="hidden">
                            <div class="text-center">
                                <i class="fas fa-qrcode mb-2 text-gray-400"></i>
                                <p class="text-xs font-bold text-gray-600">QRIS</p>
                            </div>
                        </label>
                        <label class="relative border border-gray-200 rounded-2xl p-4 cursor-pointer hover:border-stitch transition">
                            <input type="radio" name="payment" class="hidden">
                            <div class="text-center">
                                <i class="fas fa-university mb-2 text-gray-400"></i>
                                <p class="text-xs font-bold text-gray-600">Transfer Bank</p>
                            </div>
                        </label>
                    </div>
                </div>
            </div>

            <div class="w-full lg:w-1/3">
                <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100 sticky top-24">
                    <h2 class="text-xl font-bold mb-6">Ringkasan Pesanan</h2>
                    
                    <div class="space-y-4 mb-6">
                        <div class="flex gap-4">
                            <img src="https://via.placeholder.com/100" class="w-16 h-16 rounded-2xl object-cover">
                            <div class="flex-1">
                                <h4 class="font-bold text-sm">Nama Produk Produk</h4>
                                <p class="text-xs text-gray-400">1 x Rp. 25.000</p>
                            </div>
                            <p class="font-bold text-sm">Rp. 25.000</p>
                        </div>
                        </div>

                    <hr class="border-gray-100 mb-6">

                    <div class="space-y-3 mb-8">
                        <div class="flex justify-between text-gray-600">
                            <span>Subtotal</span>
                            <span>Rp. 25.000</span>
                        </div>
                        <div class="flex justify-between text-gray-600">
                            <span>Ongkos Kirim / Biaya Layanan</span>
                            <span class="text-green-500 font-medium">Gratis</span>
                        </div>
                        <div class="flex justify-between text-lg font-black pt-3 border-t border-dashed">
                            <span>Total Tagihan</span>
                            <span class="text-stitch">Rp. 25.000</span>
                        </div>
                    </div>

                    <button class="w-full bg-stitch text-white py-4 rounded-2xl font-bold shadow-lg shadow-blue-200 hover:bg-blue-800 transition flex items-center justify-center gap-3">
                        <i class="fas fa-shopping-bag"></i> Konfirmasi & Bayar
                    </button>
                    
                    <p class="text-[10px] text-gray-400 text-center mt-4 uppercase tracking-widest font-semibold">
                        Aman & Terenkripsi <i class="fas fa-lock ml-1"></i>
                    </p>
                </div>
            </div>

        </div>
    </main>

    <div class="md:hidden h-20"></div>

</body>

</html>