<x-app-layout>
    <!-- Header -->
    <header class="sticky top-0 z-30 glass-effect px-6 py-4 flex items-center justify-between">
        <div class="flex items-center gap-4">
            <button id="mobile-toggle" class="lg:hidden p-2 hover:bg-slate-100 rounded-lg">
                <i data-lucide="menu" class="w-6 h-6"></i>
            </button>
            <div>
                <h2 class="text-lg font-bold text-slate-800">Manajemen Kategori</h2>
                <p class="text-xs text-slate-500">Atur pengelompokan produk UMKM Anda secara cerdas.</p>
            </div>
        </div>

        <div class="flex items-center gap-3">
            <button onclick="openCreateModal()"
                class="flex items-center gap-2 px-4 py-2 rounded-xl bg-indigo-600 text-white text-sm font-bold shadow-lg shadow-indigo-500/20 hover:bg-indigo-700 hover:scale-[1.02] active:scale-95 transition-all">

                <i data-lucide="plus" class="w-4 h-4"></i>
                Tambah Kategori
            </button>
        </div>
    </header>

    <div class="p-6 space-y-6">
        <!-- Statistik Singkat -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white p-6 rounded-3xl border border-slate-200 shadow-sm flex items-center gap-4">
                <div class="p-3 bg-indigo-50 text-indigo-600 rounded-2xl"><i data-lucide="layers" class="w-6 h-6"></i>
                </div>
                <div>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Total Kategori</p>
                    <h4 class="text-xl font-bold text-slate-800">{{ $totalKategori }} Kategori</h4>
                </div>
            </div>
            <div class="bg-white p-6 rounded-3xl border border-slate-200 shadow-sm flex items-center gap-4">
                <div class="p-3 bg-emerald-50 text-emerald-600 rounded-2xl"><i data-lucide="trending-up"
                        class="w-6 h-6"></i></div>
                <div>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Kategori Populer</p>
                    <h4 class="text-xl font-bold text-slate-800">{{ $kategoriTerbanyak->name }}</h4>
                </div>
            </div>
            <div class="bg-white p-6 rounded-3xl border border-slate-200 shadow-sm flex items-center gap-4">
                <div class="p-3 bg-amber-50 text-amber-600 rounded-2xl"><i data-lucide="alert-circle"
                        class="w-6 h-6"></i></div>
                <div>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Tanpa Produk</p>
                    <h4 class="text-xl font-bold text-slate-800">
                        {{ $totalKosong }} Kategori
                    </h4>
                </div>
            </div>
        </div>

        <!-- Tabel Section -->
        <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">


            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50/50">
                            <th class="px-6 py-4 text-[10px] font-bold text-slate-500 uppercase tracking-wider">Nama
                                Kategori</th>
                            <th class="px-6 py-4 text-[10px] font-bold text-slate-500 uppercase tracking-wider">Slug
                            </th>
                            <th class="px-6 py-4 text-[10px] font-bold text-slate-500 uppercase tracking-wider">Produk
                            </th>
                            <th
                                class="px-6 py-4 text-[10px] font-bold text-slate-500 uppercase tracking-wider text-center">
                                Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm">
                        @forelse($kategori as $kt)
                            <tr class="hover:bg-slate-50/80 transition-colors">
                                <td class="px-6 py-4 font-bold">{{ $kt->name }}</td>
                                <td class="px-6 py-4 text-slate-500 font-mono">{{ $kt->slug }}</td>
                                <td class="px-6 py-4"><span
                                        class="px-3 py-1 bg-slate-100 rounded-full font-bold text-xs">{{ $kt->produk()->count()  }}</span>
                                </td>

                                <td class="px-6 py-4 text-center">
                                    <div class="flex justify-center gap-2">
                                        <button onclick="openEditModal({{ $kt->id }}, @js($kt->name), @js($kt->slug))"
                                            class="p-2 text-slate-400 hover:text-amber-600">

                                            <i data-lucide="edit-3" class="w-4 h-4"></i>
                                        </button>
                                        <form action="{{ route('kategori.destroy', $kt->id) }}" method="POST"
                                            onsubmit="return confirm('Yakin mau hapus kategori ini?')">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="p-2 text-slate-400 hover:text-rose-600">
                                                <i data-lucide="trash-2" class="w-4 h-4"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <span>Tidak ada kategori yang ditemukan.</span>
                        @endforelse
                        <!-- Baris lain... -->
                    </tbody>
                </table>
            </div>
            <!-- Pagination... -->
        </div>
    </div>

    <!-- FIXED MODAL: Rata Tengah dengan Flex -->
    <x-modal-form id="category-modal" title="Tambah Kategori" action="{{ route('kategori.store') }}"
        formId="category-form">

        <input type="text" name="name" placeholder="Nama Kategori" class="input">

    </x-modal-form>
    <x-modal-form id="edit-category-modal" title="Edit Kategori" formId="edit-category-form"
        method='<input type="hidden" name="_method" value="PUT">'>

        <input id="category-name" name="name" type="text">

    </x-modal-form>

</x-app-layout>