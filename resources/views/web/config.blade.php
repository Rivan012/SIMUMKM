<x-app-layout>
    <!-- Topbar -->
    <header
        class="sticky top-0 z-30 glass-effect border-b border-slate-200 px-6 py-4 flex items-center justify-between">
        <div class="flex items-center gap-4">
            <button id="mobile-toggle" class="lg:hidden p-2 hover:bg-slate-100 rounded-lg">
                <i data-lucide="menu" class="w-6 h-6"></i>
            </button>
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="text-slate-400 text-sm">Admin</li>
                    <li><i data-lucide="chevron-right" class="w-4 h-4 text-slate-300"></i></li>
                    <li class="text-slate-800 text-sm font-semibold">Pengaturan Website</li>
                </ol>
            </nav>
        </div>
        <form id="settings-form" action="{{ route('web-settings.post') }}" method="POST" enctype="multipart/form-data">

            @csrf

            <input type="hidden" name="social_media" id="social_media">
            <button type="submit" form="settings-form"
                class="bg-indigo-600 text-white px-6 py-2 rounded-xl text-sm font-bold shadow-lg shadow-indigo-500/20 hover:bg-indigo-700 transition-all flex items-center gap-2">
                <i data-lucide="save" class="w-4 h-4"></i>
                Simpan Perubahan
            </button>
    </header>

    <div class="p-6 max-w-5xl mx-auto">

        <!-- Section 1: Identitas Website -->
        <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="p-6 border-b border-slate-100 bg-slate-50/50">
                <h3 class="font-bold text-slate-800 flex items-center gap-2">
                    <i data-lucide="info" class="w-5 h-5 text-indigo-600"></i>
                    Identitas Dasar
                </h3>
            </div>
            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="text-xs font-bold text-slate-500 uppercase tracking-wider">Nama
                        Aplikasi/Situs</label>
                    <input type="text" name="name" value="{{ old('name', $webConfig->name ?? '') }}"
                        class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 outline-none transition-all text-sm">
                </div>
                <div class="space-y-2">
                    <label class="text-xs font-bold text-slate-500 uppercase tracking-wider">Judul (Tagline)</label>
                    <input type="text" name="judul" value="{{$webConfig->judul}}"
                        class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 outline-none transition-all text-sm">
                </div>
                <div class="md:col-span-2 space-y-2">
                    <label class="text-xs font-bold text-slate-500 uppercase tracking-wider">Deskripsi
                        Website</label>
                    <textarea name="description" rows="3"
                        class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 outline-none transition-all text-sm">{{$webConfig->description}}
                    </textarea>
                </div>
            </div>
        </div>

        <!-- Section 2: Kontak & Alamat -->
        <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="p-6 border-b border-slate-100 bg-slate-50/50">
                <h3 class="font-bold text-slate-800 flex items-center gap-2">
                    <i data-lucide="map-pin" class="w-5 h-5 text-indigo-600"></i>
                    Informasi Kontak
                </h3>
            </div>
            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="text-xs font-bold text-slate-500 uppercase tracking-wider">Nomor Telepon /
                        WhatsApp</label>
                    <div class="relative">
                        <i data-lucide="phone" class="absolute left-4 top-3.5 w-4 h-4 text-slate-400"></i>
                        <input type="text" name="phone" value="{{$webConfig->phone}}"
                            class="w-full pl-11 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500/20 outline-none text-sm">
                    </div>
                </div>
                <div class="space-y-2 md:row-span-2">
                    <label class="text-xs font-bold text-slate-500 uppercase tracking-wider">Alamat Lengkap
                        Kantor</label>
                    <textarea name="address" rows="4"
                        class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500/20 outline-none text-sm">{{$webConfig->address}}</textarea>
                </div>
            </div>
        </div>

        <!-- Section 3: Media & Aset Visual -->
        <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="p-6 border-b border-slate-100 bg-slate-50/50">
                <h3 class="font-bold text-slate-800 flex items-center gap-2">
                    <i data-lucide="image" class="w-5 h-5 text-indigo-600"></i>
                    Media & Aset Visual
                </h3>
            </div>
            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Logo Upload -->
                <div class="space-y-4">
                    <label class="text-xs font-bold text-slate-500 uppercase tracking-wider">
                        Logo Website
                    </label>

                    <div class="flex items-center gap-6">

                        <div class="w-28 h-28 bg-slate-100 rounded-2xl border-2 border-dashed border-slate-200 
                flex items-center justify-center overflow-hidden">

                            @if(!empty($webConfig?->logo))
                                <img src="{{ asset('storage/' . $webConfig->logo) }}"
                                    class="w-full h-full object-contain p-2">
                            @else
                                <i data-lucide="camera" class="w-8 h-8 text-slate-400"></i>
                            @endif

                        </div>

                        <div class="flex-1 space-y-2">
                            <input type="file" id="logo-input" name="logo" class="hidden" accept="image/*">

                            <button type="button" onclick="document.getElementById('logo-input').click()"
                                class="text-xs font-bold text-indigo-600 bg-indigo-50 px-4 py-2 rounded-lg hover:bg-indigo-100">
                                Pilih File Logo
                            </button>

                            <p class="text-xs text-slate-400 italic">
                                PNG transparan, 512x512px, max 2MB
                            </p>
                        </div>

                    </div>
                    <script>
                        document.getElementById('logo-input').addEventListener('change', function (e) {
                            const file = e.target.files[0];
                            if (!file) return;

                            const reader = new FileReader();

                            reader.onload = function (e) {
                                const container = document.querySelector('#logo-input')
                                    .closest('.flex')
                                    .querySelector('.w-24');

                                container.innerHTML = `
            <img src="${e.target.result}" 
                 class="w-full h-full object-cover rounded-xl">
        `;
                            };

                            reader.readAsDataURL(file);
                        });
                    </script>
                </div>

                <!-- Hero Image Upload -->
                <div class="space-y-4">
                    <label class="text-xs font-bold text-slate-500 uppercase tracking-wider">
                        Banner Utama (Hero Image)
                    </label>

                    <div onclick="document.getElementById('hero-input').click()" class="w-full h-40 rounded-2xl border-2 border-dashed border-slate-200 
               flex items-center justify-center relative overflow-hidden cursor-pointer group">

                        <!-- PREVIEW IMAGE -->
                        @if(!empty($webConfig?->hero_image))
                            <img id="hero-preview" src="{{ asset('storage/' . $webConfig->hero_image) }}"
                                class="w-full h-full object-cover">
                        @else
                            <img id="hero-preview" class="hidden w-full h-full object-cover">

                            <div id="hero-placeholder" class="flex flex-col items-center text-slate-400">
                                <i data-lucide="upload-cloud" class="w-8 h-8 mb-2"></i>
                                <span class="text-xs font-bold uppercase">
                                    Klik untuk unggah banner
                                </span>
                            </div>
                        @endif

                        <input type="file" id="hero-input" name="hero_image" class="hidden" accept="image/*">
                    </div>
                </div>
                <script>
                    document.getElementById('hero-input').addEventListener('change', function (e) {
                        const file = e.target.files[0];
                        if (!file) return;

                        const reader = new FileReader();

                        reader.onload = function (e) {
                            const preview = document.getElementById('hero-preview');
                            const placeholder = document.getElementById('hero-placeholder');

                            preview.src = e.target.result;
                            preview.classList.remove('hidden');

                            if (placeholder) {
                                placeholder.style.display = 'none';
                            }
                        };

                        reader.readAsDataURL(file);
                    });
                </script>
            </div>
        </div>

        <!-- Section 4: Social Media (Dynamic JSON Handler) -->
        <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="p-6 border-b border-slate-100 bg-slate-50/50 flex items-center justify-between">
                <h3 class="font-bold text-slate-800 flex items-center gap-2">
                    <i data-lucide="share-2" class="w-5 h-5 text-indigo-600"></i>
                    Media Sosial
                </h3>
                <button type="button" onclick="addSocialRow()"
                    class="text-xs font-bold text-indigo-600 flex items-center gap-1 hover:underline">
                    <i data-lucide="plus" class="w-3 h-3"></i> Tambah Sosmed
                </button>
            </div>
            <div id="social-container" class="p-6 space-y-4">

                @php
                    $socials = $webConfig->social_media;

                    if (is_string($socials)) {
                        $socials = json_decode($socials, true);
                    }
                @endphp

                @if(!empty($socials))
                    @foreach($socials as $item)
                        <div class="social-row grid grid-cols-1 sm:grid-cols-7 gap-4 items-center">

                            <div class="sm:col-span-2">
                                <select class="w-full px-4 py-2.5 bg-slate-50 border rounded-xl text-sm">
                                    <option value="instagram" {{ $item['platform'] == 'instagram' ? 'selected' : '' }}>Instagram
                                    </option>
                                    <option value="facebook" {{ $item['platform'] == 'facebook' ? 'selected' : '' }}>Facebook
                                    </option>
                                    <option value="twitter" {{ $item['platform'] == 'twitter' ? 'selected' : '' }}>Twitter / X
                                    </option>
                                    <option value="youtube" {{ $item['platform'] == 'youtube' ? 'selected' : '' }}>YouTube
                                    </option>
                                </select>
                            </div>

                            <div class="sm:col-span-4">
                                <input type="text" value="{{ $item['url'] }}" placeholder="https://..."
                                    class="w-full px-4 py-2.5 bg-slate-50 border rounded-xl text-sm">
                            </div>

                            <div class="sm:col-span-1 flex justify-end">
                                <button type="button" onclick="this.closest('.social-row').remove()"
                                    class="p-2 text-rose-500 hover:bg-rose-50 rounded-lg">
                                    <i data-lucide="trash-2" class="w-4 h-4"></i>
                                </button>
                            </div>

                        </div>
                    @endforeach
                @else
                    {{-- hanya tampil kalau belum ada data --}}
                    <div class="social-row grid grid-cols-1 sm:grid-cols-7 gap-4 items-center">

                        <div class="sm:col-span-2">
                            <select class="w-full px-4 py-2.5 bg-slate-50 border rounded-xl text-sm">
                                <option value="instagram">Instagram</option>
                                <option value="facebook">Facebook</option>
                                <option value="twitter">Twitter / X</option>
                                <option value="youtube">YouTube</option>
                            </select>
                        </div>

                        <div class="sm:col-span-4">
                            <input type="text" placeholder="https://..."
                                class="w-full px-4 py-2.5 bg-slate-50 border rounded-xl text-sm">
                        </div>

                        <div class="sm:col-span-1 flex justify-end">
                            <button type="button" onclick="this.closest('.social-row').remove()"
                                class="p-2 text-rose-500 hover:bg-rose-50 rounded-lg">
                                <i data-lucide="trash-2" class="w-4 h-4"></i>
                            </button>
                        </div>

                    </div>
                @endif

            </div>

        </div>

        </form>
    </div>

</x-app-layout>