@extends('layouts.app')

@section('title', 'Katalog Roti & Pastry - PT Rasa Roti Nusantara')

@section('content')

    <section class="relative overflow-hidden bg-gradient-to-b from-bakery-100 to-bakery-50/50 border-b border-bakery-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 sm:py-24">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                
                <div class="lg:col-span-7 space-y-6 text-center lg:text-left">
                    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-bakery-200/80 text-bakery-800 text-xs font-semibold tracking-wide border border-bakery-300">
                        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                        Oven Hangat Setiap Pukul 05.00 WIB
                    </div>
                    
                    <h1 class="font-serif text-4xl sm:text-5xl lg:text-6xl font-bold text-bakery-900 tracking-tight leading-[1.15]">
                        Rasa Sejati Roti Artisan, <br>
                        <span class="text-bakery-700 italic font-medium">Dipanggang Segar Tiap Subuh.</span>
                    </h1>

                    <p class="text-base sm:text-lg text-bakery-800/80 leading-relaxed max-w-xl mx-auto lg:mx-0">
                        Selamat datang di <strong class="text-bakery-900">PT Rasa Roti Nusantara</strong>. Kami mengolah tepung organik, ragi sourdough alami yang dirawat teliti, dan mentega Prancis murni untuk menghasilkan pastry dan roti terbaik di meja makan Anda.
                    </p>

                    <div class="pt-2 flex flex-wrap items-center justify-center lg:justify-start gap-4">
                        <a href="#katalog" class="px-7 py-3.5 rounded-xl bg-bakery-900 hover:bg-bakery-800 text-amber-300 text-sm font-semibold tracking-wide transition-all shadow-lg shadow-bakery-900/10 hover:-translate-y-0.5">
                            Jelajahi Menu Hari Ini &rarr;
                        </a>
                        <a href="#tentang-kami" class="px-7 py-3.5 rounded-xl bg-white hover:bg-bakery-100 text-bakery-900 text-sm font-semibold tracking-wide transition-all border border-bakery-300 hover:-translate-y-0.5">
                            Filosofi Kami
                        </a>
                    </div>

                    <div class="pt-6 grid grid-cols-3 gap-4 border-t border-bakery-200/80 text-left">
                        <div>
                            <span class="font-serif text-2xl font-bold text-bakery-900">100%</span>
                            <span class="block text-xs text-bakery-600">Alami Tanpa Pengawet</span>
                        </div>
                        <div>
                            <span class="font-serif text-2xl font-bold text-bakery-900">24 Jam</span>
                            <span class="block text-xs text-bakery-600">Fermentasi Ragi Lambat</span>
                        </div>
                        <div>
                            <span class="font-serif text-2xl font-bold text-bakery-900">AOP</span>
                            <span class="block text-xs text-bakery-600">Butter Prancis Murni</span>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-5 relative">
                    <div class="relative mx-auto max-w-md lg:max-w-none">
                        <div class="relative rounded-2xl overflow-hidden shadow-2xl border-4 border-white bg-bakery-200 aspect-[4/3] group">
                            <img src="{{ asset('storage/products/sourdough.jpg') }}" alt="Roti Sourdough Artisan" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                            <div class="absolute inset-0 bg-gradient-to-t from-bakery-950/70 via-transparent to-transparent flex flex-col justify-end p-6 text-white">
                                <span class="text-xs uppercase tracking-widest text-amber-300 font-semibold">Produk Utama Hari Ini</span>
                                <h3 class="font-serif text-xl font-bold">Roti Sourdough Artisan Klasik</h3>
                                <p class="text-xs text-bakery-200 mt-1">Crust garing dengan remah kenyal berpori sarang lebah sempurna.</p>
                            </div>
                        </div>

                        <div class="absolute -bottom-5 -left-5 bg-white p-3.5 rounded-xl shadow-xl border border-bakery-200 hidden sm:flex items-center gap-3">
                            <div class="w-10 h-10 rounded-lg bg-amber-100 flex items-center justify-center text-xl">
                                🥖
                            </div>
                            <div>
                                <span class="block text-xs font-bold text-bakery-900">Fresh from the Oven</span>
                                <span class="text-[11px] text-bakery-500">Kapasitas 120 batch per hari</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section id="katalog" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 sm:py-20">
        
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 pb-8 border-b border-bakery-200">
            <div>
                <span class="text-xs font-bold tracking-widest text-bakery-600 uppercase">Daftar Menu Pilihan</span>
                <h2 class="font-serif text-3xl sm:text-4xl font-bold text-bakery-900 mt-1">
                    Koleksi Roti & Pastry Segar
                </h2>
                <p class="text-sm text-bakery-600 mt-2 max-w-xl">
                    Semua produk diolah langsung di dapur terbuka kami menggunakan bahan-bahan bersertifikasi tanpa perisa sintetis.
                </p>
            </div>

            <form action="{{ route('public.home') }}#katalog" method="GET" class="flex items-center gap-2 w-full md:w-auto">
                @if(request('category'))
                    <input type="hidden" name="category" value="{{ request('category') }}">
                @endif
                <div class="relative flex-grow md:w-72">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama roti / bahan..." class="w-full pl-10 pr-4 py-2.5 text-sm bg-white border border-bakery-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-bakery-500 focus:border-transparent">
                    <svg class="w-4 h-4 text-bakery-400 absolute left-3.5 top-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                <button type="submit" class="px-4 py-2.5 bg-bakery-900 text-white rounded-xl text-sm font-semibold hover:bg-bakery-800 transition-colors">
                    Cari
                </button>
                @if(request('search') || request('category'))
                    <a href="{{ route('public.home') }}#katalog" class="px-3 py-2.5 text-xs text-bakery-600 hover:text-bakery-900 border border-bakery-200 rounded-xl bg-white" title="Reset Filter">
                        Reset
                    </a>
                @endif
            </form>
        </div>

        <div class="flex items-center gap-2 overflow-x-auto py-6 no-scrollbar">
            <a href="{{ route('public.home', request('search') ? ['search' => request('search')] : []) }}#katalog" class="px-4 py-2 rounded-xl text-xs sm:text-sm font-semibold whitespace-nowrap transition-all {{ !request('category') ? 'bg-bakery-900 text-amber-300 shadow-md shadow-bakery-900/10' : 'bg-white text-bakery-700 hover:bg-bakery-100 border border-bakery-200' }}">
                Semua Menu ({{ $products->count() }})
            </a>
            @foreach($categories as $cat)
                <a href="{{ route('public.home', array_merge(request('search') ? ['search' => request('search')] : [], ['category' => $cat->slug])) }}#katalog" class="px-4 py-2 rounded-xl text-xs sm:text-sm font-semibold whitespace-nowrap transition-all {{ request('category') == $cat->slug ? 'bg-bakery-900 text-amber-300 shadow-md shadow-bakery-900/10' : 'bg-white text-bakery-700 hover:bg-bakery-100 border border-bakery-200' }}">
                    {{ $cat->name }} ({{ $cat->products_count }})
                </a>
            @endforeach
        </div>

        @if($products->isEmpty())
            <div class="text-center py-20 bg-white rounded-2xl border border-bakery-200 p-8">
                <div class="text-5xl mb-3">🥐</div>
                <h3 class="font-serif text-xl font-bold text-bakery-900">Tidak ada produk yang ditemukan</h3>
                <p class="text-sm text-bakery-600 mt-1">Coba gunakan kata kunci lain atau pilih kategori yang berbeda.</p>
                <a href="{{ route('public.home') }}#katalog" class="inline-block mt-4 text-xs font-semibold text-bakery-800 underline">
                    Tampilkan Semua Produk
                </a>
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($products as $product)
                    <div class="bg-white rounded-2xl border border-bakery-200 overflow-hidden flex flex-col hover:shadow-xl hover:border-bakery-300 hover:-translate-y-1 transition-all duration-300 group">
                        
                        <div class="relative aspect-square overflow-hidden bg-bakery-100">
                            <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            
                            <div class="absolute top-3 left-3 flex flex-col gap-1.5 items-start">
                                <span class="px-2.5 py-1 rounded-lg bg-bakery-900/85 backdrop-blur-sm text-amber-300 text-[10px] font-bold uppercase tracking-wider">
                                    {{ $product->category->name }}
                                </span>
                                @if($product->is_featured)
                                    <span class="px-2 py-0.5 rounded-md bg-amber-400 text-bakery-950 text-[10px] font-bold">
                                        Favorit ★
                                    </span>
                                @endif
                            </div>

                            <div class="absolute bottom-3 right-3">
                                @if($product->stock > 0)
                                    <span class="px-2 py-1 rounded-md bg-emerald-500/90 text-white text-[10px] font-semibold backdrop-blur-sm shadow-sm">
                                        Stok: {{ $product->stock }}
                                    </span>
                                @else
                                    <span class="px-2 py-1 rounded-md bg-rose-500 text-white text-[10px] font-semibold">
                                        Habis
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="p-5 flex-grow flex flex-col justify-between space-y-4">
                            <div>
                                <span class="text-[11px] font-mono text-bakery-400 tracking-wider">{{ $product->sku }}</span>
                                <h3 class="font-serif text-lg font-bold text-bakery-900 group-hover:text-bakery-700 transition-colors line-clamp-1 mt-0.5">
                                    <a href="{{ route('public.product.show', $product->slug) }}">
                                        {{ $product->name }}
                                    </a>
                                </h3>
                                <p class="text-xs text-bakery-600 line-clamp-2 mt-1 leading-relaxed">
                                    {{ $product->description }}
                                </p>
                            </div>

                            <div class="pt-3 border-t border-bakery-100 flex items-center justify-between">
                                <div>
                                    <span class="block text-[10px] text-bakery-400 font-medium">Harga Satuan</span>
                                    <span class="font-serif text-lg font-bold text-bakery-900">
                                        {{ $product->formatted_price }}
                                    </span>
                                </div>
                                <a href="{{ route('public.product.show', $product->slug) }}" class="px-3.5 py-2 rounded-xl bg-bakery-100 hover:bg-bakery-900 text-bakery-900 hover:text-amber-300 text-xs font-semibold transition-all">
                                    Detail &rarr;
                                </a>
                            </div>
                        </div>

                    </div>
                @endforeach
            </div>
        @endif

    </section>

    <section id="tentang-kami" class="bg-white border-t border-b border-bakery-200 py-16 sm:py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                
                <div class="lg:col-span-5 relative">
                    <div class="relative rounded-2xl overflow-hidden shadow-xl border-4 border-bakery-100 aspect-square">
                        <img src="{{ asset('storage/products/berry-brioche.jpg') }}" alt="Proses Pembuatan Roti" class="w-full h-full object-cover">
                    </div>
                </div>

                <div class="lg:col-span-7 space-y-6">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-amber-100 text-amber-900 text-xs font-semibold">
                        Tentang Kami
                    </div>

                    <h2 class="font-serif text-3xl sm:text-4xl font-bold text-bakery-900 leading-tight">
                        PT Rasa Roti Nusantara
                    </h2>

                    <p class="text-sm sm:text-base text-bakery-700 leading-relaxed">
                        Didirikan di Jakarta, <strong>PT Rasa Roti Nusantara</strong> lahir dari kerinduan akan roti tradisional yang dibuat dengan dedikasi murni. Kami menolak jalan pintas: adonan difermentasi perlahan selama 24 hingga 36 jam agar ragi liar dapat mengurai gluten dan menciptakan cita rasa kompleks yang ramah bagi pencernaan.
                    </p>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2">
                        <div class="p-4 rounded-xl bg-bakery-50 border border-bakery-200">
                            <h4 class="font-serif font-bold text-bakery-900 text-base">🌾 Gandum Organik</h4>
                            <p class="text-xs text-bakery-600 mt-1">Menggunakan tepung gandum bermutu tinggi tanpa zat pemutih sintetis.</p>
                        </div>
                        <div class="p-4 rounded-xl bg-bakery-50 border border-bakery-200">
                            <h4 class="font-serif font-bold text-bakery-900 text-base">🧈 Mentega Prancis Asli</h4>
                            <p class="text-xs text-bakery-600 mt-1">Laminasi pastry menggunakan butter AOP murni dengan aroma gurih khas.</p>
                        </div>
                    </div>

                    <div class="pt-4 flex flex-wrap items-center gap-6 text-xs text-bakery-600">
                        <div>
                            <span class="font-bold text-bakery-900 block">Dapur Utama & Toko:</span>
                            Jl. Senopati No. 42, Kebayoran Baru, Jakarta Selatan
                        </div>
                        <div>
                            <span class="font-bold text-bakery-900 block">Layanan Konsumen:</span>
                            WhatsApp: +62 812-3456-7890 (08.00 - 20.00 WIB)
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

@endsection
