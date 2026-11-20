@extends('layouts.admin')

@section('title', 'Dashboard Manajemen - PT Rasa Roti Nusantara')
@section('page_title', 'Ringkasan Eksekutif & Statistik')

@section('content')

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        
        <div class="bg-white rounded-2xl p-6 border border-stone-200 shadow-sm flex items-center justify-between">
            <div>
                <span class="text-xs font-bold text-stone-500 uppercase tracking-wider block">Total Produk Roti</span>
                <span class="text-3xl font-extrabold text-stone-900 mt-1 block">{{ $totalProducts }}</span>
                <span class="text-[11px] text-stone-400 mt-0.5 block">Di dalam 4 Kategori</span>
            </div>
            <div class="w-12 h-12 rounded-xl bg-amber-100 text-amber-800 flex items-center justify-center text-2xl font-bold">
                🍞
            </div>
        </div>

        <div class="bg-white rounded-2xl p-6 border border-stone-200 shadow-sm flex items-center justify-between">
            <div>
                <span class="text-xs font-bold text-stone-500 uppercase tracking-wider block">Kategori Menu</span>
                <span class="text-3xl font-extrabold text-stone-900 mt-1 block">{{ $totalCategories }}</span>
                <span class="text-[11px] text-stone-400 mt-0.5 block">Sourdough, Pastry, Cakes</span>
            </div>
            <div class="w-12 h-12 rounded-xl bg-blue-100 text-blue-800 flex items-center justify-center text-2xl font-bold">
                📑
            </div>
        </div>

        <div class="bg-white rounded-2xl p-6 border border-stone-200 shadow-sm flex items-center justify-between">
            <div>
                <span class="text-xs font-bold text-stone-500 uppercase tracking-wider block">Transaksi Penjualan</span>
                <span class="text-3xl font-extrabold text-stone-900 mt-1 block">{{ $totalSales }}</span>
                <span class="text-[11px] text-stone-400 mt-0.5 block">Pesanan tercatat di database</span>
            </div>
            <div class="w-12 h-12 rounded-xl bg-emerald-100 text-emerald-800 flex items-center justify-center text-2xl font-bold">
                🛒
            </div>
        </div>

        <div class="bg-white rounded-2xl p-6 border border-stone-200 shadow-sm flex items-center justify-between">
            <div>
                <span class="text-xs font-bold text-stone-500 uppercase tracking-wider block">Omset Selesai</span>
                <span class="text-2xl font-extrabold text-stone-900 mt-1 block">{{ 'Rp ' . number_format($totalRevenue, 0, ',', '.') }}</span>
                <span class="text-[11px] text-emerald-600 font-semibold mt-0.5 block">Pendapatan Terverifikasi</span>
            </div>
            <div class="w-12 h-12 rounded-xl bg-stone-900 text-amber-300 flex items-center justify-center text-xl font-bold">
                💰
            </div>
        </div>

    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        
        <div class="lg:col-span-8 bg-white rounded-2xl border border-stone-200 shadow-sm p-6 space-y-4">
            <div class="flex items-center justify-between border-b border-stone-100 pb-4">
                <div>
                    <h3 class="text-base font-bold text-stone-900">5 Transaksi Penjualan Terbaru</h3>
                    <p class="text-xs text-stone-500">Data pesanan pelanggan yang masuk ke database toko</p>
                </div>
                <a href="{{ route('admin.sales.index') }}" class="text-xs font-semibold text-amber-700 hover:text-amber-800 hover:underline">
                    Lihat Semua Penjualan &rarr;
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead>
                        <tr class="text-stone-400 uppercase tracking-wider border-b border-stone-100">
                            <th class="py-3 px-2">Invoice</th>
                            <th class="py-3 px-2">Pelanggan</th>
                            <th class="py-3 px-2">Produk</th>
                            <th class="py-3 px-2">Total Biaya</th>
                            <th class="py-3 px-2">Status</th>
                            <th class="py-3 px-2 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-stone-100 font-medium text-stone-700">
                        @foreach($recentSales as $sale)
                            <tr class="hover:bg-stone-50/80 transition-colors">
                                <td class="py-3 px-2 font-mono font-bold text-stone-900">
                                    {{ $sale->invoice_number }}
                                </td>
                                <td class="py-3 px-2">
                                    <span class="font-bold text-stone-900 block">{{ $sale->customer_name }}</span>
                                    <span class="text-[11px] text-stone-400">{{ $sale->customer_phone }}</span>
                                </td>
                                <td class="py-3 px-2 text-[11px] text-stone-600">
                                    @foreach($sale->items as $it)
                                        <div>• {{ $it->product->name }} ({{ $it->quantity }}x)</div>
                                    @endforeach
                                </td>
                                <td class="py-3 px-2 font-bold text-stone-900">
                                    {{ $sale->formatted_total }}
                                </td>
                                <td class="py-3 px-2">
                                    @if($sale->status == 'selesai')
                                        <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-800">Selesai</span>
                                    @elseif($sale->status == 'diproses')
                                        <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-amber-100 text-amber-800">Diproses</span>
                                    @elseif($sale->status == 'pending')
                                        <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-blue-100 text-blue-800">Pending</span>
                                    @else
                                        <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-rose-100 text-rose-800">Batal</span>
                                    @endif
                                </td>
                                <td class="py-3 px-2 text-right">
                                    <a href="{{ route('admin.sales.show', $sale->id) }}" class="px-2.5 py-1 rounded-lg bg-stone-100 hover:bg-stone-200 text-stone-800 text-[11px] font-semibold">
                                        Rincian
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="lg:col-span-4 space-y-6">
            
            <div class="bg-gradient-to-br from-bakery-900 to-bakery-800 text-white rounded-2xl p-6 shadow-md space-y-4">
                <span class="text-xs font-bold text-amber-300 uppercase tracking-widest block">Aksi Cepat Admin</span>
                <h4 class="font-serif text-xl font-bold">Kelola Etalase Roti</h4>
                <p class="text-xs text-bakery-200 leading-relaxed">
                    Tambahkan menu roti atau pastry baru dengan mengunggah foto produk langsung ke etalase toko.
                </p>
                <div class="pt-2">
                    <a href="{{ route('admin.products.create') }}" class="w-full inline-flex items-center justify-center gap-2 px-4 py-3 bg-amber-400 hover:bg-amber-300 text-bakery-950 font-bold rounded-xl text-xs transition-all shadow-md">
                        <span>+ Tambah Roti Baru</span>
                    </a>
                </div>
            </div>

            <div class="bg-white rounded-2xl border border-stone-200 p-6 shadow-sm space-y-4">
                <div class="flex items-center justify-between">
                    <h4 class="text-sm font-bold text-stone-900">Perhatian Stok Menipis</h4>
                    <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-amber-100 text-amber-800">
                        {{ $lowStockProducts->count() }} Produk
                    </span>
                </div>

                @if($lowStockProducts->isEmpty())
                    <p class="text-xs text-stone-500">Semua produk memiliki stok yang aman (&gt; 10 pcs).</p>
                @else
                    <div class="space-y-3">
                        @foreach($lowStockProducts as $low)
                            <div class="flex items-center justify-between text-xs p-2 rounded-lg bg-stone-50 border border-stone-100">
                                <div>
                                    <span class="font-bold text-stone-900 block">{{ $low->name }}</span>
                                    <span class="text-stone-400 text-[11px]">{{ $low->category->name }}</span>
                                </div>
                                <span class="font-bold px-2 py-0.5 rounded bg-rose-100 text-rose-700">
                                    {{ $low->stock }} pcs
                                </span>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

        </div>

    </div>

@endsection
