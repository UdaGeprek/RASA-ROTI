@extends('layouts.app')

@section('title', 'Pesanan Diterima - ' . $sale->invoice_number)

@section('content')

    <div class="max-w-3xl mx-auto px-4 py-12">
        <div class="bg-white rounded-2xl border border-bakery-200 shadow-xl overflow-hidden p-8 sm:p-10 space-y-8">
            
            <div class="text-center space-y-3">
                <div class="w-16 h-16 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center text-3xl mx-auto shadow-inner">
                    ✓
                </div>
                <span class="text-xs font-bold uppercase tracking-widest text-emerald-600">Pesanan Roti Berhasil Dibuat</span>
                <h1 class="font-serif text-3xl font-bold text-bakery-900">Terima Kasih, {{ $sale->customer_name }}!</h1>
                <p class="text-xs sm:text-sm text-bakery-600 max-w-md mx-auto">
                    Pesanan Anda telah dicatat dalam sistem kasir kami dan sedang dipersiapkan oleh tim baker kami.
                </p>
            </div>

            <div class="p-6 rounded-xl bg-bakery-50 border border-bakery-200 space-y-4">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 border-b border-bakery-200 pb-4">
                    <div>
                        <span class="text-xs text-bakery-500 block">Nomor Invoice</span>
                        <span class="font-mono text-base font-bold text-bakery-900">{{ $sale->invoice_number }}</span>
                    </div>
                    <div>
                        <span class="text-xs text-bakery-500 block">Status Pesanan</span>
                        <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold bg-amber-100 text-amber-800 uppercase tracking-wide">
                            {{ ucfirst($sale->status) }}
                        </span>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs text-bakery-700">
                    <div>
                        <span class="font-bold block text-bakery-900">Penerima & Kontak:</span>
                        {{ $sale->customer_name }} ({{ $sale->customer_phone }})
                    </div>
                    <div>
                        <span class="font-bold block text-bakery-900">Metode Pembayaran:</span>
                        {{ $sale->payment_method }}
                    </div>
                    <div class="sm:col-span-2">
                        <span class="font-bold block text-bakery-900">Alamat Pengiriman:</span>
                        {{ $sale->customer_address }}
                    </div>
                    @if($sale->notes)
                        <div class="sm:col-span-2">
                            <span class="font-bold block text-bakery-900">Catatan Khusus:</span>
                            <span class="italic text-bakery-600">"{{ $sale->notes }}"</span>
                        </div>
                    @endif
                </div>

                <div class="border-t border-bakery-200 pt-4">
                    <h4 class="text-xs font-bold uppercase tracking-wider text-bakery-600 mb-3">Rincian Roti</h4>
                    <div class="space-y-3">
                        @foreach($sale->items as $item)
                            <div class="flex items-center justify-between text-sm">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-lg overflow-hidden bg-bakery-200 flex-shrink-0">
                                        <img src="{{ $item->product->image_url }}" alt="" class="w-full h-full object-cover">
                                    </div>
                                    <div>
                                        <span class="font-bold text-bakery-900 block">{{ $item->product->name }}</span>
                                        <span class="text-xs text-bakery-500">{{ $item->quantity }} pcs × {{ 'Rp ' . number_format($item->unit_price, 0, ',', '.') }}</span>
                                    </div>
                                </div>
                                <span class="font-bold text-bakery-900">{{ $item->formatted_subtotal }}</span>
                            </div>
                        @endforeach
                    </div>

                    <div class="border-t border-bakery-200 mt-4 pt-3 flex items-center justify-between">
                        <span class="font-serif text-base font-bold text-bakery-900">Total Pembayaran:</span>
                        <span class="font-serif text-xl font-bold text-bakery-900">{{ $sale->formatted_total }}</span>
                    </div>
                </div>
            </div>

            <div class="flex flex-col sm:flex-row items-center justify-center gap-4 pt-2">
                <a href="{{ route('public.home') }}" class="w-full sm:w-auto px-6 py-3 rounded-xl bg-bakery-900 hover:bg-bakery-800 text-amber-300 text-xs font-semibold text-center transition-all">
                    &larr; Kembali ke Katalog
                </a>
                <a href="{{ route('public.track', ['invoice' => $sale->invoice_number]) }}" class="w-full sm:w-auto px-6 py-3 rounded-xl bg-bakery-100 hover:bg-bakery-200 text-bakery-900 text-xs font-semibold text-center transition-all border border-bakery-300">
                    Cek Status di Halaman Tracking &rarr;
                </a>
            </div>

        </div>
    </div>

@endsection
