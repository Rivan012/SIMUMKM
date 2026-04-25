<x-app-layout>
    <header
        class="sticky top-0 z-30 glass-effect border-b border-slate-200 px-6 py-4 flex items-center justify-between">
        <div class="flex items-center gap-4">
            <button id="mobile-toggle" class="lg:hidden p-2 hover:bg-slate-100 rounded-lg">
                <i data-lucide="menu" class="w-6 h-6"></i>
            </button>
            <div>
                <h2 class="text-lg font-bold text-slate-800">Dashboard Utama</h2>
                <p class="text-xs text-slate-500">Selamat datang kembali, Ringkasan UMKM hari ini.</p>
            </div>
        </div>

        <div class="flex items-center gap-4">
            <div class="hidden md:flex items-center bg-slate-100 px-3 py-2 rounded-xl border border-slate-200">
                <i data-lucide="search" class="w-4 h-4 text-slate-400"></i>
                <input type="text" placeholder="Cari data..."
                    class="bg-transparent border-none focus:ring-0 text-sm ml-2 w-48 outline-none">
            </div>
            <div class="relative">
                <button
                    class="p-2 bg-white border border-slate-200 rounded-xl hover:shadow-md transition-shadow relative">
                    <i data-lucide="bell" class="w-5 h-5 text-slate-600"></i>
                    <span class="absolute top-1 right-1 w-2 h-2 bg-rose-500 rounded-full"></span>
                </button>
            </div>
        </div>
    </header>
    <div class="p-6 space-y-6">
        <!-- Stats Cards (Same as before) -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Card 1 -->
            <div
                class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm hover:shadow-md transition-shadow group">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-sm text-slate-500 font-medium">Total UMKM</p>
                        <h3 class="text-2xl font-bold mt-1 tracking-tight">1,284</h3>
                    </div>
                    <div
                        class="p-3 bg-indigo-50 text-indigo-600 rounded-xl group-hover:bg-indigo-600 group-hover:text-white transition-colors">
                        <i data-lucide="home" class="w-6 h-6"></i>
                    </div>
                </div>
                <div class="mt-4 flex items-center gap-2">
                    <span class="text-emerald-500 text-xs font-bold flex items-center">
                        <i data-lucide="trending-up" class="w-3 h-3 mr-1"></i> +12%
                    </span>
                </div>
            </div>
            <!-- Card 2 -->
            <div
                class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm hover:shadow-md transition-shadow group">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-sm text-slate-500 font-medium">Produk Terdaftar</p>
                        <h3 class="text-2xl font-bold mt-1 tracking-tight">4,520</h3>
                    </div>
                    <div
                        class="p-3 bg-emerald-50 text-emerald-600 rounded-xl group-hover:bg-emerald-600 group-hover:text-white transition-colors">
                        <i data-lucide="box" class="w-6 h-6"></i>
                    </div>
                </div>
                <div class="mt-4 flex items-center gap-2">
                    <span class="text-emerald-500 text-xs font-bold flex items-center">
                        <i data-lucide="trending-up" class="w-3 h-3 mr-1"></i> +5.4%
                    </span>
                </div>
            </div>
            <!-- Card 3 -->
            <div
                class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm hover:shadow-md transition-shadow group">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-sm text-slate-500 font-medium">Total Transaksi</p>
                        <h3 class="text-2xl font-bold mt-1 tracking-tight">214</h3>
                    </div>
                    <div
                        class="p-3 bg-orange-50 text-orange-600 rounded-xl group-hover:bg-orange-600 group-hover:text-white transition-colors">
                        <i data-lucide="shopping-bag" class="w-6 h-6"></i>
                    </div>
                </div>
                <div class="mt-4 flex items-center gap-2">
                    <span class="text-rose-500 text-xs font-bold flex items-center">
                        <i data-lucide="trending-down" class="w-3 h-3 mr-1"></i> -2%
                    </span>
                </div>
            </div>
            <!-- Card 4 -->
            <div
                class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm hover:shadow-md transition-shadow group">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-sm text-slate-500 font-medium">Pendapatan Daerah</p>
                        <h3 class="text-2xl font-bold mt-1 tracking-tight">Rp 84.2M</h3>
                    </div>
                    <div
                        class="p-3 bg-blue-50 text-blue-600 rounded-xl group-hover:bg-blue-600 group-hover:text-white transition-colors">
                        <i data-lucide="credit-card" class="w-6 h-6"></i>
                    </div>
                </div>
                <div class="mt-4 flex items-center gap-2">
                    <span class="text-emerald-500 text-xs font-bold flex items-center">
                        <i data-lucide="trending-up" class="w-3 h-3 mr-1"></i> +18%
                    </span>
                </div>
            </div>
        </div>

        <!-- Charts Section -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2 bg-white p-6 rounded-2xl border border-slate-200 shadow-sm">
                <h3 class="font-bold text-slate-800 mb-6">Pertumbuhan UMKM Baru</h3>
                <div class="h-64">
                    <canvas id="growthChart"></canvas>
                </div>
            </div>
            <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm">
                <h3 class="font-bold text-slate-800 mb-6">Kategori Terbanyak</h3>
                <div class="h-64 flex items-center justify-center">
                    <canvas id="categoryChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Table: Recent UMKM Registration -->
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="p-6 border-b border-slate-100">
                <h3 class="font-bold text-slate-800">Registrasi UMKM Terbaru</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-slate-50/50">
                        <tr>
                            <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase">Nama UMKM</th>
                            <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase">Pemilik</th>
                            <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase">Kategori</th>
                            <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        <tr>
                            <td class="px-6 py-4 text-sm font-semibold">Kopi Senja Utama</td>
                            <td class="px-6 py-4 text-sm">Budi Santoso</td>
                            <td class="px-6 py-4 text-sm">Kuliner</td>
                            <td class="px-6 py-4 text-xs font-bold text-emerald-600">AKTIF</td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 text-sm font-semibold">Batik Kencana</td>
                            <td class="px-6 py-4 text-sm">Siti Aminah</td>
                            <td class="px-6 py-4 text-sm">Fashion</td>
                            <td class="px-6 py-4 text-xs font-bold text-amber-600">PENDING</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</x-app-layout>