@extends('layouts.admin')

@section('title', 'Daftar Produk - Panel Admin')
@section('page_title', 'Kelola Produk Roti & Pastry (CRUD)')

@section('content')

    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
        <div>
            <h2 class="text-base font-bold text-stone-900">Katalog Produk Terdaftar</h2>
            <p class="text-xs text-stone-500">Menampilkan seluruh data produk, stok, harga, dan foto dari database</p>
        </div>

        <a href="{{ route('admin.products.create') }}" class="inline-flex items-center gap-2 px-4 py-2.5 bg-bakery-900 hover:bg-bakery-800 text-amber-300 font-semibold rounded-xl text-xs shadow-sm transition-all self-start sm:self-auto">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            <span>+ Tambah Roti Baru</span>
        </a>
    </div>

    <div class="bg-white rounded-2xl border border-stone-200 p-4 mb-6 shadow-sm">
        <form action="{{ route('admin.products.index') }}" method="GET" class="flex flex-col sm:flex-row gap-3">
            <div class="relative flex-grow">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama atau kode SKU..." class="w-full pl-9 pr-3 py-2 text-xs bg-stone-50 border border-stone-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-amber-500">
                <svg class="w-4 h-4 text-stone-400 absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </div>

            <div class="sm:w-60">
                <select name="category_id" class="w-full px-3 py-2 text-xs bg-stone-50 border border-stone-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-amber-500">
                    <option value="">Semua Kategori</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="px-5 py-2 bg-stone-800 hover:bg-stone-900 text-white rounded-xl text-xs font-semibold">
                Filter
            </button>
            @if(request('search') || request('category_id'))
                <a href="{{ route('admin.products.index') }}" class="px-3 py-2 text-stone-500 hover:text-stone-800 text-xs border border-stone-200 rounded-xl bg-stone-50 text-center">
                    Reset
                </a>
            @endif
        </form>
    </div>

    <div class="bg-white rounded-2xl border border-stone-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead>
                    <tr class="bg-stone-50 text-stone-500 uppercase tracking-wider border-b border-stone-200">
                        <th class="py-3.5 px-4">Foto Produk</th>
                        <th class="py-3.5 px-4">SKU / Nama Roti</th>
                        <th class="py-3.5 px-4">Kategori</th>
                        <th class="py-3.5 px-4">Harga Satuan</th>
                        <th class="py-3.5 px-4">Stok</th>
                        <th class="py-3.5 px-4">Status Unggulan</th>
                        <th class="py-3.5 px-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-stone-100 font-medium text-stone-700">
                    @forelse($products as $prod)
                        <tr class="hover:bg-stone-50/70 transition-colors">
                            
                            <td class="py-3 px-4">
                                <div class="w-12 h-12 rounded-xl overflow-hidden bg-stone-100 border border-stone-200 shadow-sm flex-shrink-0">
                                    <img src="{{ $prod->image_url }}" alt="{{ $prod->name }}" class="w-full h-full object-cover">
                                </div>
                            </td>

                            <td class="py-3 px-4">
                                <span class="font-mono text-[10px] text-stone-400 block">{{ $prod->sku }}</span>
                                <a href="{{ route('admin.products.show', $prod->id) }}" class="font-bold text-stone-900 hover:text-amber-700 text-sm">
                                    {{ $prod->name }}
                                </a>
                                <span class="text-[11px] text-stone-500 block line-clamp-1">{{ $prod->weight ?? 'Berat Standar' }}</span>
                            </td>

                            <td class="py-3 px-4">
                                <span class="px-2.5 py-1 rounded-lg bg-stone-100 text-stone-800 text-[11px] font-semibold border border-stone-200">
                                    {{ $prod->category->name }}
                                </span>
                            </td>

                            <td class="py-3 px-4 font-bold text-stone-900 text-sm">
                                {{ $prod->formatted_price }}
                            </td>

                            <td class="py-3 px-4">
                                @if($prod->stock > 10)
                                    <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-800">
                                        {{ $prod->stock }} pcs
                                    </span>
                                @elseif($prod->stock > 0)
                                    <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-amber-100 text-amber-800">
                                        {{ $prod->stock }} pcs (Menipis)
                                    </span>
                                @else
                                    <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-rose-100 text-rose-800">
                                        Habis
                                    </span>
                                @endif
                            </td>

                            <td class="py-3 px-4">
                                @if($prod->is_featured)
                                    <span class="text-amber-600 font-bold text-xs">★ Unggulan</span>
                                @else
                                    <span class="text-stone-400 text-xs">Biasa</span>
                                @endif
                            </td>

                            <td class="py-3 px-4 text-right">
                                <div class="flex items-center justify-end gap-1.5">
                                    <a href="{{ route('admin.products.show', $prod->id) }}" class="p-1.5 text-stone-600 hover:text-stone-900 hover:bg-stone-100 rounded-lg" title="Lihat Detail">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                    </a>
                                    <a href="{{ route('admin.products.edit', $prod->id) }}" class="p-1.5 text-blue-600 hover:text-blue-900 hover:bg-blue-50 rounded-lg" title="Ubah Data">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                    </a>
                                    <form action="{{ route('admin.products.destroy', $prod->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk {{ $prod->name }}? File foto juga akan dihapus.');" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-1.5 text-rose-600 hover:text-rose-900 hover:bg-rose-50 rounded-lg" title="Hapus Produk">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-12 text-center text-stone-500">
                                Belum ada data produk. Klik "+ Tambah Roti Baru" untuk menambahkan produk pertama.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($products->hasPages())
            <div class="p-4 border-t border-stone-200">
                {{ $products->links() }}
            </div>
        @endif
    </div>

@endsection
