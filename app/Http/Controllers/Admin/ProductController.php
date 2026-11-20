<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('category');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('sku', 'like', "%{$search}%");
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        $products = $query->latest()->paginate(10)->withQueryString();
        $categories = Category::all();

        return view('admin.products.index', compact('products', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
            'description' => 'required|string|max:2000',
            'ingredients' => 'nullable|string|max:500',
            'weight'      => 'nullable|string|max:50',
            'image'       => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'is_featured' => 'nullable|boolean',
        ], [
            'name.required'        => 'Nama produk wajib diisi.',
            'name.max'             => 'Nama produk maksimal 255 karakter.',
            'category_id.required' => 'Kategori produk wajib dipilih.',
            'category_id.exists'   => 'Kategori yang dipilih tidak valid.',
            'price.required'       => 'Harga produk wajib diisi.',
            'price.numeric'        => 'Harga produk harus berupa angka nominal.',
            'stock.required'       => 'Jumlah stok wajib diisi.',
            'stock.integer'        => 'Stok harus berupa bilangan bulat.',
            'description.required' => 'Deskripsi produk wajib diisi.',
            'image.required'       => 'Foto produk wajib diunggah.',
            'image.image'          => 'Berkas harus berupa file gambar.',
            'image.mimes'          => 'Format gambar harus berupa jpeg, png, jpg, atau webp.',
            'image.max'            => 'Ukuran gambar maksimal 2MB (2048 KB).',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        $slug = Str::slug($validated['name']);
        if (Product::where('slug', $slug)->exists()) {
            $slug .= '-' . Str::lower(Str::random(4));
        }

        $sku = 'RRN-' . strtoupper(Str::random(3)) . '-' . rand(10, 99);

        Product::create([
            'category_id' => $validated['category_id'],
            'name'        => $validated['name'],
            'slug'        => $slug,
            'sku'         => $sku,
            'price'       => $validated['price'],
            'stock'       => $validated['stock'],
            'description' => $validated['description'],
            'ingredients' => $validated['ingredients'] ?? null,
            'weight'      => $validated['weight'] ?? null,
            'image'       => $imagePath,
            'is_featured' => $request->boolean('is_featured'),
        ]);

        return redirect()->route('admin.products.index')
            ->with('success', "Produk \"{$validated['name']}\" berhasil ditambahkan.");
    }

    public function show(Product $product)
    {
        $product->load('category', 'saleItems.sale');
        return view('admin.products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
            'description' => 'required|string|max:2000',
            'ingredients' => 'nullable|string|max:500',
            'weight'      => 'nullable|string|max:50',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'is_featured' => 'nullable|boolean',
        ], [
            'name.required'        => 'Nama produk wajib diisi.',
            'name.max'             => 'Nama produk maksimal 255 karakter.',
            'category_id.required' => 'Kategori produk wajib dipilih.',
            'category_id.exists'   => 'Kategori yang dipilih tidak valid.',
            'price.required'       => 'Harga produk wajib diisi.',
            'price.numeric'        => 'Harga produk harus berupa angka nominal.',
            'stock.required'       => 'Jumlah stok wajib diisi.',
            'stock.integer'        => 'Stok harus berupa bilangan bulat.',
            'description.required' => 'Deskripsi produk wajib diisi.',
            'image.image'          => 'Berkas harus berupa file gambar.',
            'image.mimes'          => 'Format gambar harus berupa jpeg, png, jpg, atau webp.',
            'image.max'            => 'Ukuran gambar maksimal 2MB (2048 KB).',
        ]);

        $imagePath = $product->image;
        if ($request->hasFile('image')) {
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }
            $imagePath = $request->file('image')->store('products', 'public');
        }

        $slug = $product->slug;
        if ($product->name !== $validated['name']) {
            $slug = Str::slug($validated['name']);
            if (Product::where('slug', $slug)->where('id', '!=', $product->id)->exists()) {
                $slug .= '-' . Str::lower(Str::random(4));
            }
        }

        $product->update([
            'category_id' => $validated['category_id'],
            'name'        => $validated['name'],
            'slug'        => $slug,
            'price'       => $validated['price'],
            'stock'       => $validated['stock'],
            'description' => $validated['description'],
            'ingredients' => $validated['ingredients'] ?? null,
            'weight'      => $validated['weight'] ?? null,
            'image'       => $imagePath,
            'is_featured' => $request->boolean('is_featured'),
        ]);

        return redirect()->route('admin.products.index')
            ->with('success', "Produk \"{$product->name}\" berhasil diperbarui.");
    }

    public function destroy(Product $product)
    {
        $name = $product->name;
        
        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->route('admin.products.index')
            ->with('success', "Produk \"{$name}\" berhasil dihapus dari database.");
    }
}
