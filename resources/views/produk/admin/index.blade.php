<x-app-layout>
    <header class="sticky top-0 z-30 glass-effect px-6 py-4 flex items-center justify-between">
        <div class="flex items-center gap-4">
            <button id="mobile-toggle" class="lg:hidden p-2 hover:bg-slate-100 rounded-lg">
                <i data-lucide="menu" class="w-6 h-6"></i>
            </button>
            <div>
                <h2 class="text-lg font-bold text-slate-800">Manajemen Produk</h2>
                <p class="text-xs text-slate-500">{{ $webConfig->judul  }}</p>
            </div>
        </div>

        <div class="flex items-center gap-3">
            <button onclick="openProdukModal()"
                class="flex items-center gap-2 px-4 py-2 rounded-xl bg-indigo-600 text-white text-sm font-bold shadow-lg shadow-indigo-500/20 hover:bg-indigo-700 hover:scale-[1.02] active:scale-95 transition-all">

                <i data-lucide="plus" class="w-4 h-4"></i>
                Tambah Produk
            </button>
        </div>
        <script>
            function openProdukModal() {
                openModal('produk-modal');

                const form = document.getElementById('produk-form');
                if (!form) return;

                form.action = "/admin/produk";
                form.reset();

                setMethod('POST');
                setTitle('Tambah Produk');
            }
        </script>
    </header>

    <div class="p-6 space-y-6">
        @if($errors->any())
            <div class="bg-rose-500 text-white p-3 rounded-lg">
                <ul class="list-disc pl-5">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <!-- Statistik Produk -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div class="bg-white p-5 rounded-3xl border border-slate-200 shadow-sm flex items-center gap-4">
                <div class="p-3 bg-indigo-50 text-indigo-600 rounded-xl"><i data-lucide="package" class="w-5 h-5"></i>
                </div>
                <div>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Total Produk</p>
                    <h4 class="text-lg font-bold text-slate-800">{{ $totalProduk }} Item</h4>
                </div>
            </div>
            <div class="bg-white p-5 rounded-3xl border border-slate-200 shadow-sm border-l-4 border-l-amber-400">
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Stok Menipis</p>
                <h4 class="text-lg font-bold text-slate-800">{{ $produkSedikit }} Produk</h4>
            </div>
            <div class="bg-white p-5 rounded-3xl border border-slate-200 shadow-sm border-l-4 border-l-emerald-400">
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Aktif di Web</p>
                <h4 class="text-lg font-bold text-slate-800">{{ $produkAktif }} Produk</h4>
            </div>
            <div class="bg-white p-5 rounded-3xl border border-slate-200 shadow-sm border-l-4 border-l-rose-400">
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Non-Aktif</p>
                <h4 class="text-lg font-bold text-slate-800">{{ $produkNonAktif }} Produk</h4>
            </div>
        </div>

        <!-- Tabel Produk -->
        <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">


            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50/50">
                            <th class="px-6 py-4 text-[10px] font-bold text-slate-500 uppercase tracking-wider">Info
                                Produk</th>
                            <th class="px-6 py-4 text-[10px] font-bold text-slate-500 uppercase tracking-wider">Kategori
                            </th>
                            <th class="px-6 py-4 text-[10px] font-bold text-slate-500 uppercase tracking-wider">Harga
                            </th>
                            <th class="px-6 py-4 text-[10px] font-bold text-slate-500 uppercase tracking-wider">Stok
                            </th>
                            <th class="px-6 py-4 text-[10px] font-bold text-slate-500 uppercase tracking-wider">
                                Visibilitas</th>
                            <th
                                class="px-6 py-4 text-[10px] font-bold text-slate-500 uppercase tracking-wider text-center">
                                Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm font-medium">
                        @forelse($produk as $pr)
                            <tr class="hover:bg-slate-50/80 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-10 h-10 bg-slate-100 rounded-lg overflow-hidden border border-slate-200">
                                            <img src="{{ asset('storage/' . $pr->image) }}" alt="Produk"
                                                class="w-full h-full object-cover">
                                        </div>
                                        <div>
                                            <p class="font-bold text-slate-800">{{ $pr->name }}</p>
                                            <p class="text-[10px] text-slate-400">{{ $pr->description }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span
                                        class="px-2 py-0.5 bg-indigo-50 text-indigo-600 font-bold rounded text-[10px]">{{ $pr->kategori->name }}</span>
                                </td>
                                <td class="px-6 py-4 text-slate-700">Rp {{ number_format($pr->price, 0, true) }}</td>
                                <td class="px-6 py-4 text-slate-600">{{ $pr->stock }}</td>
                                <td class="px-6 py-4">
                                    @if ($pr->is_active)
                                        <span class="flex items-center gap-1.5 text-emerald-600">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                            <span class="text-[10px] font-bold uppercase">Aktif</span>
                                        </span>
                                    @else
                                        <span class="flex items-center gap-1.5 text-rose-600">
                                            <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span>
                                            <span class="text-[10px] font-bold uppercase">Nonaktif</span>
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <div class="flex justify-center gap-2">
                                        <button class="p-2 text-slate-400 hover:text-amber-600 transition-colors"><i
                                                data-lucide="edit-3" class="w-4 h-4"></i></button>
                                        <button class="p-2 text-slate-400 hover:text-rose-600 transition-colors"><i
                                                data-lucide="trash-2" class="w-4 h-4"></i></button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <span>Tidak ada produk</span>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <x-modal-form id="produk-modal" title="Tambah Produk" action="{{ route('produkadmin.store') }}" formId="produk-form"
        enctype="multipart/form-data">

        <input type="text" name="name" placeholder="Nama Produk" class="input">
        <textarea name="description" placeholder="Masukkan Deskripsi Produk" class="input" id=""></textarea>
        <select name="kategori_id" class="input">
            <option value="">Pilih Kategori</option>
            @forelse($kategorilist as $k)
                <option value="{{ $k->id }}">{{ $k->name }}</option>
            @empty
                <option value="">Tidak ada kategori</option>
            @endforelse
        </select>
        <input type="number" name="price" placeholder="Harga" class="input">
        <input type="file" accept="image/*" name="image" class="input">

        <input type="number" name="stock" placeholder="Stok" class="input">
        <select name="is_active" class="input" id="">
            <option value="1">Aktif</option>
            <option value="0">Tidak Aktif</option>
        </select>

    </x-modal-form>

</x-app-layout>