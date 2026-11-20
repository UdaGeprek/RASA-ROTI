<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();
        $totalCategories = Category::count();
        $totalSales = Sale::count();
        $totalRevenue = Sale::where('status', 'selesai')->sum('total_amount');
        $lowStockProducts = Product::where('stock', '<=', 10)->get();
        $recentSales = Sale::with('items.product')->latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalProducts',
            'totalCategories',
            'totalSales',
            'totalRevenue',
            'lowStockProducts',
            'recentSales'
        ));
    }

    public function salesIndex(Request $request)
    {
        $query = Sale::with('items.product');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('invoice_number', 'like', "%{$search}%")
                  ->orWhere('customer_name', 'like', "%{$search}%")
                  ->orWhere('customer_phone', 'like', "%{$search}%");
            });
        }

        $sales = $query->latest()->paginate(10)->withQueryString();
        $statusCounts = [
            'all'       => Sale::count(),
            'selesai'   => Sale::where('status', 'selesai')->count(),
            'diproses'  => Sale::where('status', 'diproses')->count(),
            'pending'   => Sale::where('status', 'pending')->count(),
            'dibatalkan'=> Sale::where('status', 'dibatalkan')->count(),
        ];

        return view('admin.sales.index', compact('sales', 'statusCounts'));
    }

    public function saleDetail($id)
    {
        $sale = Sale::with('items.product.category')->findOrFail($id);
        return view('admin.sales.show', compact('sale'));
    }

    public function updateSaleStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,diproses,selesai,dibatalkan',
        ]);

        $sale = Sale::findOrFail($id);
        $oldStatus = $sale->status;
        $sale->update(['status' => $request->status]);

        return back()->with('success', "Status invoice {$sale->invoice_number} diubah dari {$oldStatus} menjadi {$request->status}.");
    }
}
