@extends('layouts.admin')

@section('title', 'Detail Produk - ' . $product->name)
@section('page_title', 'Rincian Produk & Riwayat Penjualan')

@section('content')

    <div class="max-w-4xl mx-auto space-y-6">
        <div class="flex items-center justify-between">
            <a href="{{ route('admin.products.index') }}" class="text-xs text-stone-500 hover:text-stone-800 font-semibold flex items-center gap-1">
                &larr; Kembali ke Daftar Produk
            </a>
            <div class="flex items-center gap-2">
                <a href="{{ route('admin.products.edit', $product->id) }}" class="px-4 py-2 rounded-xl bg-blue-600 hover:bg-blue-700 text-white text-xs font-semibold">
                    Ubah Data
                </a>
                <a href="{{ route('public.product.show', $product->slug) }}" target="_blank" class="px-4 py-2 rounded-xl bg-stone-100 hover:bg-stone-200 text-stone-800 text-xs font-semibold">
                    Tinjau di Web Publik &rarr;
                </a>
            </div>
        </div>

        <div class="bg-white rounded-2xl border border-stone-200 shadow-sm p-6 sm:p-8">
            <div class="grid grid-cols-1 sm:grid-cols-12 gap-8 items-start">
                <div class="sm:col-span-4 aspect-square rounded-xl overflow-hidden bg-stone-100 border border-stone-200">
                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                </div>
                <div class="sm:col-span-8 space-y-4">
                    <div class="flex items-center gap-2">
                        <span class="px-2.5 py-1 rounded-lg bg-stone-100 text-stone-800 text-xs font-semibold">
                            {{ $product->category->name }}
                        </span>
                        <span class="font-mono text-xs text-stone-400">{{ $product->sku }}</span>
                    </div>

                    <h2 class="text-2xl font-bold text-stone-900">{{ $product->name }}</h2>
                    <span class="text-2xl font-extrabold text-stone-900 block">{{ $product->formatted_price }}</span>

                    <div class="grid grid-cols-2 gap-4 text-xs">
                        <div class="p-3 rounded-lg bg-stone-50 border border-stone-100">
                            <span class="text-stone-400 block font-semibold">Stok Saat Ini</span>
                            <span class="font-bold text-stone-900 text-sm mt-0.5 block">{{ $product->stock }} pcs</span>
                        </div>
                        <div class="p-3 rounded-lg bg-stone-50 border border-stone-100">
                            <span class="text-stone-400 block font-semibold">Bobot Bersih</span>
                            <span class="font-bold text-stone-900 text-sm mt-0.5 block">{{ $product->weight ?? '-' }}</span>
                        </div>
                    </div>

                    <div>
                        <span class="text-xs font-bold text-stone-700 block mb-1">Deskripsi:</span>
                        <p class="text-xs text-stone-600 leading-relaxed">{{ $product->description }}</p>
                    </div>

                    @if($product->ingredients)
                        <div>
                            <span class="text-xs font-bold text-stone-700 block mb-1">Komposisi Bahan:</span>
                            <p class="text-xs text-stone-600 italic">{{ $product->ingredients }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl border border-stone-200 shadow-sm p-6">
            <h3 class="text-sm font-bold text-stone-900 mb-3">Riwayat Transaksi Penjualan Produk Ini</h3>
            @if($product->saleItems->isEmpty())
                <p class="text-xs text-stone-500">Belum ada transaksi penjualan yang tercatat untuk produk ini.</p>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs">
                        <thead>
                            <tr class="text-stone-400 uppercase border-b border-stone-100">
                                <th class="py-2.5 px-2">Invoice</th>
                                <th class="py-2.5 px-2">Pelanggan</th>
                                <th class="py-2.5 px-2">Jumlah</th>
                                <th class="py-2.5 px-2">Subtotal</th>
                                <th class="py-2.5 px-2">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-stone-100 text-stone-700">
                            @foreach($product->saleItems as $item)
                                <tr>
                                    <td class="py-2.5 px-2 font-mono font-bold text-stone-900">
                                        <a href="{{ route('admin.sales.show', $item->sale_id) }}" class="hover:underline">
                                            {{ $item->sale->invoice_number }}
                                        </a>
                                    </td>
                                    <td class="py-2.5 px-2">{{ $item->sale->customer_name }}</td>
                                    <td class="py-2.5 px-2 font-bold">{{ $item->quantity }} pcs</td>
                                    <td class="py-2.5 px-2 font-bold">{{ $item->formatted_subtotal }}</td>
                                    <td class="py-2.5 px-2">
                                        <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-stone-100 text-stone-800">
                                            {{ ucfirst($item->sale->status) }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>

@endsection
