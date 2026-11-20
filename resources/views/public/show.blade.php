@extends('layouts.app')

@section('title', $product->name . ' - PT Rasa Roti Nusantara')

@section('content')

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        
        <nav class="flex items-center gap-2 text-xs text-bakery-500 mb-8">
            <a href="{{ route('public.home') }}" class="hover:text-bakery-900 transition-colors">Beranda</a>
            <span>/</span>
            <a href="{{ route('public.home', ['category' => $product->category->slug]) }}#katalog" class="hover:text-bakery-900 transition-colors">
                {{ $product->category->name }}
            </a>
            <span>/</span>
            <span class="text-bakery-900 font-semibold">{{ $product->name }}</span>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">
            
            <div class="lg:col-span-6 space-y-4">
                <div class="relative rounded-2xl overflow-hidden bg-white border border-bakery-200 shadow-xl aspect-square">
                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                    
                    <div class="absolute top-4 left-4 flex flex-col gap-2 items-start">
                        <span class="px-3 py-1 rounded-lg bg-bakery-900/90 text-amber-300 text-xs font-bold tracking-wider backdrop-blur-sm uppercase">
                            {{ $product->category->name }}
                        </span>
                        @if($product->is_featured)
                            <span class="px-2.5 py-1 rounded-md bg-amber-400 text-bakery-950 text-xs font-bold shadow-sm">
                                Produk Rekomendasi ★
                            </span>
                        @endif
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="p-4 rounded-xl bg-white border border-bakery-200">
                        <span class="text-[11px] font-semibold text-bakery-400 uppercase tracking-wider block">Bobot Bersih</span>
                        <span class="text-sm font-bold text-bakery-900 mt-0.5 block">{{ $product->weight ?? 'Standar Baker' }}</span>
                    </div>
                    <div class="p-4 rounded-xl bg-white border border-bakery-200">
                        <span class="text-[11px] font-semibold text-bakery-400 uppercase tracking-wider block">Kode Produk</span>
                        <span class="text-sm font-mono font-bold text-bakery-900 mt-0.5 block">{{ $product->sku ?? '-' }}</span>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-6 space-y-8">
                
                <div>
                    <h1 class="font-serif text-3xl sm:text-4xl font-bold text-bakery-900 leading-tight">
                        {{ $product->name }}
                    </h1>
                    <div class="flex items-center gap-4 mt-3">
                        <span class="font-serif text-3xl font-bold text-bakery-900">
                            {{ $product->formatted_price }}
                        </span>
                        @if($product->stock > 0)
                            <span class="px-3 py-1 rounded-full bg-emerald-50 text-emerald-700 text-xs font-semibold border border-emerald-200 flex items-center gap-1.5">
                                <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                                Tersedia ({{ $product->stock }} pcs)
                            </span>
                        @else
                            <span class="px-3 py-1 rounded-full bg-rose-50 text-rose-700 text-xs font-semibold border border-rose-200">
                                Stok Habis
                            </span>
                        @endif
                    </div>
                </div>

                <div class="border-t border-b border-bakery-200 py-6 space-y-4">
                    <h3 class="font-serif text-base font-bold text-bakery-900">Deskripsi Roti</h3>
                    <p class="text-sm text-bakery-700 leading-relaxed">
                        {{ $product->description }}
                    </p>

                    @if($product->ingredients)
                        <div class="pt-2">
                            <h4 class="text-xs font-bold uppercase tracking-wider text-bakery-500 mb-1">Bahan Utama & Komposisi</h4>
                            <p class="text-xs text-bakery-700 italic bg-bakery-100/60 p-3 rounded-lg border border-bakery-200">
                                {{ $product->ingredients }}
                            </p>
                        </div>
                    @endif
                </div>

                <div class="bg-white rounded-2xl border-2 border-bakery-300 p-6 shadow-lg">
                    <div class="flex items-center justify-between pb-4 border-b border-bakery-100 mb-4">
                        <div class="flex items-center gap-2">
                            <span class="text-xl">🛍️</span>
                            <h3 class="font-serif text-lg font-bold text-bakery-900">Pesan Sekarang</h3>
                        </div>
                        <span class="text-xs text-emerald-600 font-semibold bg-emerald-50 px-2.5 py-1 rounded-md">
                            Pesanan Langsung Diproses
                        </span>
                    </div>

                    @if($errors->any())
                        <div class="mb-4 p-3.5 bg-rose-50 border border-rose-200 rounded-xl text-rose-800 text-xs space-y-1">
                            <span class="font-bold block">Mohon periksa data formulir:</span>
                            @foreach($errors->all() as $err)
                                <div>• {{ $err }}</div>
                            @endforeach
                        </div>
                    @endif

                    @if($product->stock > 0)
                        <form action="{{ route('public.product.order', $product->slug) }}" method="POST" class="space-y-4">
                            @csrf
                            
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-semibold text-bakery-800 mb-1">Nama Pemesan *</label>
                                    <input type="text" name="customer_name" value="{{ old('customer_name') }}" required placeholder="Contoh: Budi Santoso" class="w-full px-3 py-2 text-sm bg-bakery-50 border border-bakery-300 rounded-lg focus:ring-2 focus:ring-bakery-500 focus:outline-none">
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-bakery-800 mb-1">Nomor WhatsApp / HP *</label>
                                    <input type="tel" name="customer_phone" value="{{ old('customer_phone') }}" required placeholder="Contoh: 08123456789" class="w-full px-3 py-2 text-sm bg-bakery-50 border border-bakery-300 rounded-lg focus:ring-2 focus:ring-bakery-500 focus:outline-none">
                                </div>
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-bakery-800 mb-1">Alamat Pengiriman *</label>
                                <textarea name="customer_address" rows="2" required placeholder="Alamat lengkap tujuan pengantaran..." class="w-full px-3 py-2 text-sm bg-bakery-50 border border-bakery-300 rounded-lg focus:ring-2 focus:ring-bakery-500 focus:outline-none">{{ old('customer_address') }}</textarea>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-semibold text-bakery-800 mb-1">Jumlah Pesanan (Pcs) *</label>
                                    <input type="number" name="quantity" min="1" max="{{ $product->stock }}" value="{{ old('quantity', 1) }}" required class="w-full px-3 py-2 text-sm bg-bakery-50 border border-bakery-300 rounded-lg focus:ring-2 focus:ring-bakery-500 focus:outline-none">
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-bakery-800 mb-1">Metode Pembayaran *</label>
                                    <select name="payment_method" required class="w-full px-3 py-2 text-sm bg-bakery-50 border border-bakery-300 rounded-lg focus:ring-2 focus:ring-bakery-500 focus:outline-none">
                                        <option value="Transfer Bank (BCA)">Transfer Bank (BCA)</option>
                                        <option value="Transfer Bank (Mandiri)">Transfer Bank (Mandiri)</option>
                                        <option value="QRIS (GoPay/ShopeePay/OVO)">QRIS (GoPay / ShopeePay / OVO)</option>
                                        <option value="Tunai di Toko (Pick Up)">Tunai di Toko (Pick Up)</option>
                                    </select>
                                </div>
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-bakery-800 mb-1">Catatan Tambahan (Opsional)</label>
                                <input type="text" name="notes" value="{{ old('notes') }}" placeholder="Contoh: jangan terlalu gosong, sertakan pita kado" class="w-full px-3 py-2 text-sm bg-bakery-50 border border-bakery-300 rounded-lg focus:ring-2 focus:ring-bakery-500 focus:outline-none">
                            </div>

                            <button type="submit" class="w-full py-3.5 bg-bakery-900 hover:bg-bakery-800 text-amber-300 text-sm font-semibold rounded-xl shadow-lg shadow-bakery-900/10 transition-all flex items-center justify-center gap-2">
                                <span>Konfirmasi Pesanan Roti</span>
                                <span>&rarr;</span>
                            </button>
                        </form>
                    @else
                        <div class="text-center py-6 text-sm text-bakery-600">
                            Maaf, stok roti ini sedang habis dipanggang kembali besok pagi. Silakan hubungi admin kami untuk pre-order.
                        </div>
                    @endif
                </div>

            </div>

        </div>

        @if($relatedProducts->isNotEmpty())
            <div class="mt-20 pt-12 border-t border-bakery-200">
                <div class="flex items-center justify-between mb-8">
                    <div>
                        <span class="text-xs font-bold uppercase tracking-wider text-bakery-600">Menu Serupa</span>
                        <h3 class="font-serif text-2xl font-bold text-bakery-900 mt-1">Produk Terkait di Kategori Ini</h3>
                    </div>
                    <a href="{{ route('public.home', ['category' => $product->category->slug]) }}#katalog" class="text-xs font-semibold text-bakery-800 hover:underline">
                        Lihat Semua &rarr;
                    </a>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                    @foreach($relatedProducts as $rel)
                        <div class="bg-white rounded-xl border border-bakery-200 overflow-hidden group hover:shadow-md transition-shadow">
                            <div class="aspect-video overflow-hidden bg-bakery-100">
                                <img src="{{ $rel->image_url }}" alt="{{ $rel->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                            </div>
                            <div class="p-4">
                                <h4 class="font-serif font-bold text-bakery-900 text-sm group-hover:text-bakery-700">
                                    <a href="{{ route('public.product.show', $rel->slug) }}">{{ $rel->name }}</a>
                                </h4>
                                <div class="mt-2 flex items-center justify-between">
                                    <span class="text-sm font-bold text-bakery-900">{{ $rel->formatted_price }}</span>
                                    <a href="{{ route('public.product.show', $rel->slug) }}" class="text-xs text-bakery-600 hover:text-bakery-900 font-semibold">
                                        Detail &rarr;
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

    </div>

@endsection
