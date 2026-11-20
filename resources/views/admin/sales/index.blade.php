@extends('layouts.admin')

@section('title', 'Data Penjualan - Panel Admin')
@section('page_title', 'Kelola Transaksi Penjualan Roti')

@section('content')

    <div class="mb-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h2 class="text-base font-bold text-stone-900">Catatan Penjualan (Orders)</h2>
            <p class="text-xs text-stone-500">Mencatat pesanan langsung dari pelanggan toko dan web publik</p>
        </div>
    </div>

    <div class="flex items-center gap-2 overflow-x-auto pb-4 no-scrollbar">
        <a href="{{ route('admin.sales.index') }}" class="px-3.5 py-1.5 rounded-xl text-xs font-semibold whitespace-nowrap {{ !request('status') ? 'bg-stone-900 text-white' : 'bg-white text-stone-700 hover:bg-stone-100 border border-stone-200' }}">
            Semua ({{ $statusCounts['all'] }})
        </a>
        <a href="{{ route('admin.sales.index', ['status' => 'selesai']) }}" class="px-3.5 py-1.5 rounded-xl text-xs font-semibold whitespace-nowrap {{ request('status') == 'selesai' ? 'bg-emerald-600 text-white' : 'bg-white text-emerald-700 hover:bg-emerald-50 border border-emerald-200' }}">
            Selesai ({{ $statusCounts['selesai'] }})
        </a>
        <a href="{{ route('admin.sales.index', ['status' => 'diproses']) }}" class="px-3.5 py-1.5 rounded-xl text-xs font-semibold whitespace-nowrap {{ request('status') == 'diproses' ? 'bg-amber-600 text-white' : 'bg-white text-amber-700 hover:bg-amber-50 border border-amber-200' }}">
            Diproses ({{ $statusCounts['diproses'] }})
        </a>
        <a href="{{ route('admin.sales.index', ['status' => 'pending']) }}" class="px-3.5 py-1.5 rounded-xl text-xs font-semibold whitespace-nowrap {{ request('status') == 'pending' ? 'bg-blue-600 text-white' : 'bg-white text-blue-700 hover:bg-blue-50 border border-blue-200' }}">
            Pending ({{ $statusCounts['pending'] }})
        </a>
        <a href="{{ route('admin.sales.index', ['status' => 'dibatalkan']) }}" class="px-3.5 py-1.5 rounded-xl text-xs font-semibold whitespace-nowrap {{ request('status') == 'dibatalkan' ? 'bg-rose-600 text-white' : 'bg-white text-rose-700 hover:bg-rose-50 border border-rose-200' }}">
            Dibatalkan ({{ $statusCounts['dibatalkan'] }})
        </a>
    </div>

    <div class="bg-white rounded-2xl border border-stone-200 p-4 mb-6 shadow-sm">
        <form action="{{ route('admin.sales.index') }}" method="GET" class="flex flex-col sm:flex-row gap-3">
            @if(request('status'))
                <input type="hidden" name="status" value="{{ request('status') }}">
            @endif
            <div class="relative flex-grow">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nomor invoice, nama pembeli, atau telepon..." class="w-full pl-9 pr-3 py-2 text-xs bg-stone-50 border border-stone-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-amber-500">
                <svg class="w-4 h-4 text-stone-400 absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </div>
            <button type="submit" class="px-5 py-2 bg-stone-800 hover:bg-stone-900 text-white rounded-xl text-xs font-semibold">
                Cari Transaksi
            </button>
            @if(request('search') || request('status'))
                <a href="{{ route('admin.sales.index') }}" class="px-3 py-2 text-stone-500 hover:text-stone-800 text-xs border border-stone-200 rounded-xl bg-stone-50 text-center">
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
                        <th class="py-3.5 px-4">No. Invoice</th>
                        <th class="py-3.5 px-4">Tanggal</th>
                        <th class="py-3.5 px-4">Pelanggan</th>
                        <th class="py-3.5 px-4">Item Roti</th>
                        <th class="py-3.5 px-4">Metode Bayar</th>
                        <th class="py-3.5 px-4">Total Biaya</th>
                        <th class="py-3.5 px-4">Status</th>
                        <th class="py-3.5 px-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-stone-100 font-medium text-stone-700">
                    @forelse($sales as $sale)
                        <tr class="hover:bg-stone-50/70 transition-colors">
                            <td class="py-3.5 px-4 font-mono font-bold text-stone-900">
                                <a href="{{ route('admin.sales.show', $sale->id) }}" class="text-amber-700 hover:underline">
                                    {{ $sale->invoice_number }}
                                </a>
                            </td>
                            <td class="py-3.5 px-4 text-[11px] text-stone-500 whitespace-nowrap">
                                {{ $sale->created_at->format('d M Y, H:i') }}
                            </td>
                            <td class="py-3.5 px-4">
                                <span class="font-bold text-stone-900 block">{{ $sale->customer_name }}</span>
                                <span class="text-[11px] text-stone-400 block">{{ $sale->customer_phone }}</span>
                            </td>
                            <td class="py-3.5 px-4 text-[11px]">
                                @foreach($sale->items as $it)
                                    <div>• {{ $it->product->name }} ({{ $it->quantity }}x)</div>
                                @endforeach
                            </td>
                            <td class="py-3.5 px-4 text-[11px] text-stone-600">
                                {{ $sale->payment_method }}
                            </td>
                            <td class="py-3.5 px-4 font-bold text-stone-900 text-sm">
                                {{ $sale->formatted_total }}
                            </td>
                            <td class="py-3.5 px-4">
                                @if($sale->status == 'selesai')
                                    <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-800">
                                        ✓ Selesai
                                    </span>
                                @elseif($sale->status == 'diproses')
                                    <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-amber-100 text-amber-800">
                                        ⏳ Diproses
                                    </span>
                                @elseif($sale->status == 'pending')
                                    <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-blue-100 text-blue-800">
                                        ⏱ Pending
                                    </span>
                                @else
                                    <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-rose-100 text-rose-800">
                                        ✕ Batal
                                    </span>
                                @endif
                            </td>
                            <td class="py-3.5 px-4 text-right">
                                <a href="{{ route('admin.sales.show', $sale->id) }}" class="px-3 py-1.5 rounded-lg bg-stone-100 hover:bg-stone-200 text-stone-800 font-semibold text-xs">
                                    Detail Invoice &rarr;
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="py-12 text-center text-stone-500">
                                Belum ada data transaksi penjualan sesuai filter ini.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($sales->hasPages())
            <div class="p-4 border-t border-stone-200">
                {{ $sales->links() }}
            </div>
        @endif
    </div>

@endsection
