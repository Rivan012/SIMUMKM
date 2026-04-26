<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $webConfig->name }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .bg-stitch {
            background-color: #2D5A9E;
        }

        .text-stitch {
            color: #2D5A9E;
        }
    </style>
</head>

<body class="bg-gray-50 font-sans text-gray-900">

    <nav class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between h-16 items-center">
                <div class="flex items-center gap-2">
                    <div
                        class="w-8 h-8 md:w-10 md:h-10 bg-stitch rounded-lg flex items-center justify-center text-white">
                        <i class="fas fa-utensils"></i>
                    </div>
                    <span class="text-lg md:text-xl font-bold text-stitch tracking-tight">{{$webConfig->name}}</span>
                </div>

                <div class="hidden md:flex space-x-8 font-medium">
                    <a href="#" class="text-stitch">Beranda</a>
                    <a href="#menu" class="hover:text-stitch transition">Menu</a>
                    <a href="#" class="hover:text-stitch transition">Lacak Order</a>
                </div>

                <div class="flex items-center gap-2 md:gap-4">
                    <a href="#" class="p-2 text-gray-600"><i class="fas fa-shopping-cart"></i></a>
                    <a href="/login"
                        class="bg-stitch text-white px-4 py-2 md:px-6 md:py-2 rounded-full text-sm font-medium hover:bg-blue-800 transition">Login</a>
                </div>
            </div>
        </div>
    </nav>

    <section class="relative bg-white pt-10 pb-16 md:py-20 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 flex flex-col md:flex-row items-center">
            <div class="w-full md:w-1/2 text-center md:text-left mb-10 md:mb-0">
                <h1 class="text-3xl sm:text-4xl md:text-6xl font-extrabold leading-tight mb-6">
                    {{$webConfig->judul}}
                </h1>
                <p class="text-sm md:text-lg text-gray-600 mb-8 max-w-md mx-auto md:mx-0">
                    {{$webConfig->description}}
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center md:justify-start">
                    <a href="#menu"
                        class="bg-stitch text-white px-8 py-4 rounded-2xl font-bold hover:shadow-lg transition text-center">Pesan
                        Sekarang</a>
                    <a href="#"
                        class="border-2 border-stitch text-stitch px-8 py-4 rounded-2xl font-bold hover:bg-blue-50 transition text-center text-sm md:text-base">Dashboard
                        POS</a>
                </div>
            </div>

            <div class="w-full md:w-1/2 px-4">
                <div class="relative max-w-[400px] md:max-w-full mx-auto">
                    <img src="{{ asset('storage/' . $webConfig->hero_image) }}"
                        class="rounded-[2rem] shadow-2xl w-full h-[250px] md:h-[400px] object-cover">
                    <div
                        class="absolute -bottom-4 -right-4 bg-white p-3 md:p-4 rounded-2xl shadow-xl border border-blue-50">
                        <div class="flex items-center gap-3">
                            <i class="fas fa-bolt text-yellow-400 text-xl"></i>
                            <div>
                                <p class="text-[10px] md:text-xs text-gray-500 uppercase font-bold tracking-widest">
                                    Delivery</p>
                                <p class="text-xs md:text-sm font-bold">Fast Response</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="menu" class="py-12 md:py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between items-end mb-8 md:mb-12">
                <div>
                    <h2 class="text-2xl md:text-3xl font-bold">Menu Spesial</h2>
                    <div class="w-12 h-1 bg-stitch mt-2 rounded-full"></div>
                </div>
                {{ $daftar_produk->fragment('menu')->links() }}

            </div>

            <div class="grid grid-cols-3 gap-6">
                @foreach($daftar_produk as $produk)
                    <div class="bg-white rounded-3xl p-3 shadow-sm hover:shadow-xl transition border border-gray-100 group">
                        <div class="relative overflow-hidden rounded-2xl h-44">
                            <img src="{{ asset('storage/' . $produk->image) }}"
                                class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                        </div>
                        <div class="p-3">
                            <div class="flex justify-between items-start">
                                <h3 class="font-bold text-lg">{{ $produk->name }}</h3>
                                <span class="text-stitch font-bold">{{ $produk->kategori->name }}</span>
                            </div>
                            <p class="text-gray-400 text-xs mt-1">{{ $produk->description }}</p>
                            <div class="flex justify-between items-center mt-5">
                                <span class="text-xl font-black text-gray-800">
                                    Rp. {{ number_format($produk->price) }}
                                </span>
                                <form action="{{ route('order.show', $produk->id) }}" method="get">
                               
                                    <input type="hidden" name="produk_id" value="{{ $produk->id }}">
                                    <input type="hidden" name="quantity" value="1">
                                    <button class="bg-stitch text-white p-3 rounded-xl hover:bg-blue-800 shadow-md">
                                        <i class="fas fa-cart-plus"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <div
        class="md:hidden fixed bottom-0 left-0 right-0 bg-white border-t border-gray-100 px-6 py-3 flex justify-between items-center z-50">
        <a href="#" class="text-stitch flex flex-col items-center"><i class="fas fa-home"></i><span
                class="text-[10px]">Home</span></a>
        <a href="#menu" class="text-gray-400 flex flex-col items-center"><i class="fas fa-utensils"></i><span
                class="text-[10px]">Menu</span></a>
        <a href="#" class="text-gray-400 flex flex-col items-center"><i class="fas fa-receipt"></i><span
                class="text-[10px]">Orders</span></a>
        <a href="#" class="text-gray-400 flex flex-col items-center"><i class="fas fa-user"></i><span
                class="text-[10px]">Profile</span></a>
    </div>

</body>

</html>