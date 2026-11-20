<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleItem;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PublicController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::withCount('products')->get();
        
        $query = Product::with('category');

        if ($request->filled('category')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('ingredients', 'like', "%{$search}%");
            });
        }

        $products = $query->latest()->get();
        $featuredProducts = Product::with('category')->where('is_featured', true)->take(4)->get();
        $totalSalesCount = Sale::where('status', 'selesai')->count();

        return view('public.index', compact('categories', 'products', 'featuredProducts', 'totalSalesCount'));
    }

    public function show($slug)
    {
        $product = Product::with('category')->where('slug', $slug)->firstOrFail();
        $relatedProducts = Product::with('category')
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->take(3)
            ->get();

        return view('public.show', compact('product', 'relatedProducts'));
    }

    public function order(Request $request, $slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();

        $validated = $request->validate([
            'customer_name'    => 'required|string|max:100',
            'customer_phone'   => 'required|string|max:20',
            'customer_address' => 'required|string|max:500',
            'quantity'         => 'required|integer|min:1|max:' . max(1, $product->stock),
            'payment_method'   => 'required|string|in:Transfer Bank (BCA),Transfer Bank (Mandiri),QRIS (GoPay/ShopeePay/OVO),Tunai di Toko (Pick Up)',
            'notes'            => 'nullable|string|max:500',
        ], [
            'customer_name.required'    => 'Nama lengkap pemesan wajib diisi.',
            'customer_phone.required'   => 'Nomor telepon/WhatsApp wajib diisi.',
            'customer_address.required' => 'Alamat pengantaran wajib diisi.',
            'quantity.required'         => 'Jumlah pesanan wajib diisi.',
            'quantity.max'              => 'Jumlah pesanan melebihi stok yang tersedia (' . $product->stock . ' pcs).',
            'payment_method.required'   => 'Silakan pilih metode pembayaran.',
        ]);

        $subtotal = $product->price * $validated['quantity'];
        $invoiceNumber = 'INV-' . date('Ymd') . '-' . strtoupper(Str::random(4));

        $sale = Sale::create([
            'invoice_number'   => $invoiceNumber,
            'customer_name'    => $validated['customer_name'],
            'customer_phone'   => $validated['customer_phone'],
            'customer_address' => $validated['customer_address'],
            'payment_method'   => $validated['payment_method'],
            'total_amount'     => $subtotal,
            'status'           => 'diproses',
            'notes'            => $validated['notes'],
        ]);

        SaleItem::create([
            'sale_id'    => $sale->id,
            'product_id' => $product->id,
            'quantity'   => $validated['quantity'],
            'unit_price' => $product->price,
            'subtotal'   => $subtotal,
        ]);

        if ($product->stock >= $validated['quantity']) {
            $product->decrement('stock', $validated['quantity']);
        }

        return redirect()->route('public.order.success', ['invoice' => $sale->invoice_number])
            ->with('success', 'Pesanan Anda berhasil dikirim! Silakan simpan nomor invoice.');
    }

    public function orderSuccess($invoice)
    {
        $sale = Sale::with('items.product.category')->where('invoice_number', $invoice)->firstOrFail();
        return view('public.order_success', compact('sale'));
    }

    public function trackOrder(Request $request)
    {
        $sale = null;
        if ($request->filled('invoice')) {
            $invoice = trim($request->invoice);
            $sale = Sale::with('items.product')->where('invoice_number', $invoice)
                ->orWhere('customer_phone', $invoice)
                ->first();
        }

        return view('public.track', compact('sale'));
    }
}
