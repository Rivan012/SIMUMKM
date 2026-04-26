<x-app-layout>
    <!-- Header -->
    <header
        class="sticky top-0 z-30 glass-effect border-b border-slate-200 px-6 py-4 flex items-center justify-between">
        <div class="flex items-center gap-4">
            <button id="mobile-toggle" class="lg:hidden p-2 hover:bg-slate-100 rounded-lg">
                <i data-lucide="menu" class="w-6 h-6"></i>
            </button>
            <div>
                <h2 class="text-lg font-bold text-slate-800">Produk {{ $webConfig->name }}</h2>
                <p class="text-xs text-slate-500">{{ $webConfig->description }}</p>
            </div>
        </div>

        <div class="flex items-center gap-3">
            <a href="{{ route('cart.index') }}"
                class="flex items-center gap-2 bg-indigo-50 text-indigo-600 px-4 py-2 rounded-xl text-xs font-bold hover:bg-indigo-100 transition-all">
                <i data-lucide="shopping-cart" class="w-4 h-4"></i>
                Keranjang
            </a>
        </div>
    </header>

    <section id="menu" class="p-6 bg-slate-50">
        <div class="max-w-7xl mx-auto">

            <!-- Toolbar & Pagination -->
            <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
                <div class="relative w-full md:w-72">
                    <!-- <i data-lucide="search" class="absolute left-3 top-2.5 w-4 h-4 text-slate-400"></i> -->
                    <!-- <input type="text" placeholder="Cari produk..."  -->
                    <!-- class="w-full pl-10 pr-4 py-2 bg-white border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-indigo-500/10 outline-none"> -->
                </div>

                <div class="flex items-center gap-1 bg-white p-1 rounded-xl border border-slate-200 shadow-sm">
                    {{ $produk->links() }}
                </div>
            </div>

            <!-- Product Grid -->
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4">
                @forelse($produk as $item)

                    <div
                        class="bg-white rounded-3xl p-3 shadow-sm hover:shadow-xl transition-all duration-300 border border-slate-100 group flex flex-col">
                        <div class="relative overflow-hidden rounded-2xl h-44">
                            <img src="{{ asset('storage/' . $item->image) }}"
                                class="w-full h-full object-cover group-hover:scale-110 transition duration-500"
                                alt="{{ $item->name }}">
                            <div class="absolute top-2 right-2">
                                <span
                                    class="bg-white/90 backdrop-blur px-2 py-1 rounded-lg text-[10px] font-bold text-indigo-600 shadow-sm">
                                    {{ $item->kategori->name }}
                                </span>
                            </div>
                        </div>

                        <div class="p-3 flex flex-col flex-grow">
                            <div class="flex justify-between items-start gap-2">
                                <h3 class="font-bold text-sm line-clamp-1 text-slate-800">{{ $item->name }}</h3>
                            </div>
                            <p class="text-slate-400 text-[10px] mt-1 line-clamp-2">{{ $item->description }}</p>

                            <div class="flex justify-between items-center mt-auto pt-4">
                                <span class="text-sm font-black text-slate-900">
                                    Rp {{ number_format($item->price, 0, ',', '.') }}
                                </span>
                                @if ($item->stock <= 0)
                                    <button type="button" onclick="alert('kosong')"
                                        class="bg-indigo-600 hover:bg-indigo-700 text-white p-2.5 rounded-xl shadow-lg shadow-indigo-500/20 transition-all ">
                                        <i data-lucide="shopping-cart" class="w-4 h-4"></i></button>
                                @else
                                    <form action="{{ route('cart.add') }}" method="POST" class="inline">
                                        @csrf
                                        <input type="hidden" name="produk_id" value="{{ $item->id }}">
                                        <button type="submit"
                                            class="bg-indigo-600 hover:bg-indigo-700 text-white p-2.5 rounded-xl shadow-lg shadow-indigo-500/20 transition-all active:scale-95">
                                            <i data-lucide="shopping-cart" class="w-4 h-4"></i>
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12">
                        <i data-lucide="package" class="w-16 h-16 text-slate-400 mx-auto mb-4"></i>
                        <h3 class="text-lg font-bold text-slate-800 mb-2">Belum ada produk</h3>
                        <p class="text-slate-500">Produk akan muncul di sini setelah ditambahkan.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
</x-app-layout>