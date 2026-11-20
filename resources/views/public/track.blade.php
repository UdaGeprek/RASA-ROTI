@extends('layouts.app')

@section('title', 'Lacak Pesanan Roti - PT Rasa Roti Nusantara')

@section('content')

    <div class="max-w-3xl mx-auto px-4 py-12">
        <div class="text-center space-y-3 mb-8">
            <span class="text-xs font-bold uppercase tracking-widest text-bakery-600">Layanan Pelanggan</span>
            <h1 class="font-serif text-3xl sm:text-4xl font-bold text-bakery-900">Lacak Status Pesanan Roti</h1>
            <p class="text-xs sm:text-sm text-bakery-600 max-w-md mx-auto">
                Masukkan nomor invoice (contoh: <code>INV-20261120-001</code>) atau nomor WhatsApp pemesan untuk melihat status pesanan terkini.
            </p>
        </div>

        <div class="bg-white rounded-2xl border border-bakery-200 p-6 shadow-md mb-8">
            <form action="{{ route('public.track') }}" method="GET" class="flex flex-col sm:flex-row items-center gap-3">
                <input type="text" name="invoice" value="{{ request('invoice') }}" required placeholder="Nomor Invoice / No. WhatsApp..." class="w-full px-4 py-3 text-sm bg-bakery-50 border border-bakery-300 rounded-xl focus:ring-2 focus:ring-bakery-500 focus:outline-none">
                <button type="submit" class="w-full sm:w-auto px-8 py-3 bg-bakery-900 hover:bg-bakery-800 text-amber-300 text-sm font-semibold rounded-xl whitespace-nowrap transition-all shadow-sm">
                    Lacak Sekarang
                </button>
            </form>
        </div>

        @if(request('invoice'))
            @if($sale)
                <div class="bg-white rounded-2xl border border-bakery-200 p-6 sm:p-8 shadow-xl space-y-6">
                    <div class="flex items-center justify-between border-b border-bakery-100 pb-4">
                        <div>
                            <span class="text-xs text-bakery-500">Invoice:</span>
                            <span class="font-mono text-base font-bold text-bakery-900 block">{{ $sale->invoice_number }}</span>
                        </div>
                        <div>
                            @if($sale->status == 'selesai')
                                <span class="px-3 py-1 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-800">
                                    ✓ Selesai & Terkirim
                                </span>
                            @elseif($sale->status == 'diproses')
                                <span class="px-3 py-1 rounded-full text-xs font-semibold bg-amber-100 text-amber-800">
                                    ⏳ Sedang Dipanggang / Dikemas
                                </span>
                            @elseif($sale->status == 'pending')
                                <span class="px-3 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-800">
                                    ⏱ Menunggu Konfirmasi Baker
                                </span>
                            @else
                                <span class="px-3 py-1 rounded-full text-xs font-semibold bg-rose-100 text-rose-800">
                                    ✕ Dibatalkan
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs text-bakery-700">
                        <div>
                            <span class="font-bold text-bakery-900 block">Pemesan:</span>
                            {{ $sale->customer_name }}
                        </div>
                        <div>
                            <span class="font-bold text-bakery-900 block">Metode Pembayaran:</span>
                            {{ $sale->payment_method }}
                        </div>
                        <div class="sm:col-span-2">
                            <span class="font-bold text-bakery-900 block">Alamat Antar:</span>
                            {{ $sale->customer_address }}
                        </div>
                    </div>

                    <div class="border-t border-bakery-100 pt-4">
                        <span class="text-xs font-bold text-bakery-800 uppercase tracking-wider block mb-2">Item Roti yang Dipesan:</span>
                        <div class="space-y-2">
                            @foreach($sale->items as $item)
                                <div class="flex items-center justify-between text-xs sm:text-sm py-1 border-b border-dashed border-bakery-100 last:border-0">
                                    <span>{{ $item->product->name }} <span class="text-bakery-500">({{ $item->quantity }} pcs)</span></span>
                                    <span class="font-bold text-bakery-900">{{ $item->formatted_subtotal }}</span>
                                </div>
                            @endforeach
                        </div>

                        <div class="flex items-center justify-between pt-3 font-serif font-bold text-base text-bakery-900">
                            <span>Total Tagihan:</span>
                            <span>{{ $sale->formatted_total }}</span>
                        </div>
                    </div>
                </div>
            @else
                <div class="text-center py-12 bg-white rounded-2xl border border-bakery-200 p-6">
                    <div class="text-4xl mb-2">🔍</div>
                    <h3 class="font-serif text-lg font-bold text-bakery-900">Pesanan Tidak Ditemukan</h3>
                    <p class="text-xs text-bakery-600 mt-1">Pastikan nomor invoice atau nomor WhatsApp yang dimasukkan sudah benar.</p>
                </div>
            @endif
        @endif

    </div>

@endsection
