@extends('layouts.admin')

@section('title', 'Invoice ' . $sale->invoice_number)
@section('page_title', 'Rincian Transaksi Penjualan')

@section('content')

    <style>
        @media print {
            /* Sembunyikan elemen non-invoice */
            aside, header, nav, footer, .no-print {
                display: none !important;
            }
            .print-only {
                display: block !important;
            }
            body {
                background: #ffffff !important;
                color: #111827 !important;
                margin: 0 !important;
                padding: 0 !important;
            }
            main {
                padding: 0 !important;
                margin: 0 !important;
            }
            .max-w-4xl {
                max-width: 100% !important;
                width: 100% !important;
                margin: 0 !important;
                padding: 0 !important;
            }
            #invoice-paper {
                border: none !important;
                box-shadow: none !important;
                padding: 15px 25px !important;
                margin: 0 !important;
                width: 100% !important;
            }
            table {
                width: 100% !important;
                border-collapse: collapse !important;
            }
            th, td {
                border-bottom: 1px solid #e5e5e5 !important;
            }
            a[href]:after {
                content: none !important;
            }
        }
    </style>

    <div class="max-w-4xl mx-auto space-y-6">
        
        <div class="no-print flex items-center justify-between">
            <a href="{{ route('admin.sales.index') }}" class="text-xs text-stone-500 hover:text-stone-800 font-semibold flex items-center gap-1">
                &larr; Kembali ke Daftar Penjualan
            </a>
            <button onclick="window.print()" class="px-4 py-2 bg-stone-900 hover:bg-stone-800 text-white rounded-xl text-xs font-semibold flex items-center gap-2 shadow-sm transition-all hover:scale-105">
                <svg class="w-4 h-4 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                <span>Cetak Invoice</span>
            </button>
        </div>

        <div id="invoice-paper" class="bg-white rounded-2xl border border-stone-200 shadow-sm p-6 sm:p-10 space-y-8">
            
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b border-stone-200 pb-6">
                <div>
                    <div class="flex items-center gap-3 mb-1.5">
                        <img src="{{ asset('images/logo.svg') }}" alt="Logo" class="w-12 h-12 object-contain">
                        <div>
                            <span class="font-bold text-stone-900 text-lg leading-tight block">PT Rasa Roti Nusantara</span>
                            <span class="text-[11px] text-amber-700 font-semibold uppercase tracking-wider block">Artisan Bakery & Patisserie</span>
                        </div>
                    </div>
                    <p class="text-xs text-stone-500">Jl. Senopati No. 42, Kebayoran Baru, Jakarta Selatan</p>
                    <p class="text-xs text-stone-500">Layanan Konsumen / WhatsApp: +62 812-3456-7890</p>
                </div>

                <div class="sm:text-right">
                    <span class="text-xs uppercase tracking-widest text-stone-400 font-bold block">Faktur Penjualan</span>
                    <span class="font-mono text-xl font-bold text-stone-900 block mt-0.5">{{ $sale->invoice_number }}</span>
                    <span class="text-xs text-stone-500 block">{{ $sale->created_at->format('d F Y, H:i') }} WIB</span>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 text-xs text-stone-700 bg-stone-50 p-5 rounded-xl border border-stone-100">
                <div>
                    <span class="font-bold text-stone-900 block uppercase tracking-wider text-[10px] text-stone-400 mb-1">Data Pembeli:</span>
                    <span class="font-bold text-stone-900 block text-sm">{{ $sale->customer_name }}</span>
                    <span class="text-stone-500 block">{{ $sale->customer_phone }}</span>
                    <p class="text-stone-600 mt-1 leading-relaxed">{{ $sale->customer_address }}</p>
                </div>

                <div>
                    <span class="font-bold text-stone-900 block uppercase tracking-wider text-[10px] text-stone-400 mb-1">Pembayaran:</span>
                    <span class="font-bold text-stone-900 block text-sm">{{ $sale->payment_method }}</span>
                    <span class="text-stone-500 block mt-1">Status: Terverifikasi</span>
                    @if($sale->notes)
                        <div class="mt-2 text-stone-600 italic">
                            Catatan: "{{ $sale->notes }}"
                        </div>
                    @endif
                </div>

                <div>
                    <span class="font-bold text-stone-900 block uppercase tracking-wider text-[10px] text-stone-400 mb-1">Status Pesanan:</span>
                    
                    <div class="no-print mt-1">
                        <form action="{{ route('admin.sales.status', $sale->id) }}" method="POST" class="space-y-2">
                            @csrf
                            @method('PATCH')
                            <select name="status" class="w-full px-3 py-1.5 text-xs font-semibold bg-white border border-stone-300 rounded-lg focus:outline-none">
                                <option value="pending" {{ $sale->status == 'pending' ? 'selected' : '' }}>Pending (Menunggu)</option>
                                <option value="diproses" {{ $sale->status == 'diproses' ? 'selected' : '' }}>Diproses (Dipanggang)</option>
                                <option value="selesai" {{ $sale->status == 'selesai' ? 'selected' : '' }}>Selesai (Terkirim)</option>
                                <option value="dibatalkan" {{ $sale->status == 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                            </select>
                            <button type="submit" class="w-full py-1.5 px-3 bg-stone-900 hover:bg-stone-800 text-white rounded-lg text-xs font-semibold transition-all">
                                Perbarui Status
                            </button>
                        </form>
                    </div>

                    <div class="print-only hidden pt-1">
                        <span class="font-bold text-sm uppercase text-stone-900 tracking-wider">
                            {{ ucfirst($sale->status) }}
                        </span>
                    </div>
                </div>
            </div>

            <div>
                <h4 class="text-xs font-bold uppercase tracking-wider text-stone-500 mb-3">Daftar Roti yang Dibeli</h4>
                <div class="border border-stone-200 rounded-xl overflow-hidden">
                    <table class="w-full text-left text-xs">
                        <thead class="bg-stone-50 text-stone-500 uppercase border-b border-stone-200">
                            <tr>
                                <th class="py-3 px-4">Menu Roti</th>
                                <th class="py-3 px-4">Kategori</th>
                                <th class="py-3 px-4 text-center">Qty</th>
                                <th class="py-3 px-4 text-right">Harga Satuan</th>
                                <th class="py-3 px-4 text-right">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-stone-100 font-medium text-stone-700">
                            @foreach($sale->items as $item)
                                <tr>
                                    <td class="py-3 px-4">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 rounded-lg overflow-hidden bg-stone-100 border border-stone-200 flex-shrink-0">
                                                <img src="{{ $item->product->image_url }}" alt="" class="w-full h-full object-cover">
                                            </div>
                                            <div>
                                                <span class="font-bold text-stone-900 block">{{ $item->product->name }}</span>
                                                <span class="text-[10px] text-stone-400 font-mono">{{ $item->product->sku }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-3 px-4 text-stone-500">{{ $item->product->category->name }}</td>
                                    <td class="py-3 px-4 text-center font-bold">{{ $item->quantity }} pcs</td>
                                    <td class="py-3 px-4 text-right">{{ 'Rp ' . number_format($item->unit_price, 0, ',', '.') }}</td>
                                    <td class="py-3 px-4 text-right font-bold text-stone-900">{{ $item->formatted_subtotal }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="bg-stone-50 border-t border-stone-200 font-bold text-sm text-stone-900">
                            <tr>
                                <td colspan="4" class="py-3 px-4 text-right font-serif">Total Transaksi:</td>
                                <td class="py-3 px-4 text-right font-serif text-base text-amber-800">{{ $sale->formatted_total }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

            <div class="border-t border-stone-200 pt-6 text-[11px] text-stone-400 text-center">
                Bukti transaksi sah diterbitkan secara otomatis oleh sistem kasir PT Rasa Roti Nusantara.
            </div>

        </div>
    </div>

@endsection
