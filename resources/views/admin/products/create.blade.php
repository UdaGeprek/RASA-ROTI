@extends('layouts.admin')

@section('title', 'Tambah Produk Roti Baru - Panel Admin')
@section('page_title', 'Form Tambah Produk Roti')

@section('content')

    <div class="max-w-4xl mx-auto">
        <div class="mb-6 flex items-center justify-between">
            <div>
                <a href="{{ route('admin.products.index') }}" class="text-xs text-stone-500 hover:text-stone-800 font-semibold flex items-center gap-1">
                    &larr; Kembali ke Daftar Produk
                </a>
                <h2 class="text-lg font-bold text-stone-900 mt-1">Unggah & Daftarkan Menu Baru</h2>
            </div>
        </div>

        <div class="bg-white rounded-2xl border border-stone-200 shadow-sm p-6 sm:p-8">
            
            @if($errors->any())
                <div class="mb-6 p-4 rounded-xl bg-rose-50 border border-rose-200 text-rose-800 text-xs space-y-1">
                    <span class="font-bold block">Mohon periksa kembali formulir berikut:</span>
                    @foreach($errors->all() as $error)
                        <div>• {{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    
                    <div>
                        <label class="block text-xs font-bold text-stone-700 mb-1">
                            Nama Produk Roti / Pastry *
                        </label>
                        <input type="text" name="name" value="{{ old('name') }}" required placeholder="Contoh: Danish Cinnamon Swirl" class="w-full px-3.5 py-2.5 text-xs sm:text-sm bg-stone-50 border @error('name') border-rose-400 bg-rose-50/50 @else border-stone-200 @enderror rounded-xl focus:ring-2 focus:ring-amber-500 focus:outline-none">
                        @error('name')
                            <span class="text-[11px] text-rose-600 mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-stone-700 mb-1">
                            Kategori Menu *
                        </label>
                        <select name="category_id" required class="w-full px-3.5 py-2.5 text-xs sm:text-sm bg-stone-50 border @error('category_id') border-rose-400 bg-rose-50/50 @else border-stone-200 @enderror rounded-xl focus:ring-2 focus:ring-amber-500 focus:outline-none">
                            <option value="">-- Pilih Kategori Roti --</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <span class="text-[11px] text-rose-600 mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-stone-700 mb-1">
                            Harga Satuan (Rupiah) *
                        </label>
                        <input type="number" name="price" value="{{ old('price') }}" min="0" required placeholder="Contoh: 35000" class="w-full px-3.5 py-2.5 text-xs sm:text-sm bg-stone-50 border @error('price') border-rose-400 bg-rose-50/50 @else border-stone-200 @enderror rounded-xl focus:ring-2 focus:ring-amber-500 focus:outline-none">
                        @error('price')
                            <span class="text-[11px] text-rose-600 mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-stone-700 mb-1">
                            Jumlah Stok Harian *
                        </label>
                        <input type="number" name="stock" value="{{ old('stock', 15) }}" min="0" required placeholder="Contoh: 20" class="w-full px-3.5 py-2.5 text-xs sm:text-sm bg-stone-50 border @error('stock') border-rose-400 bg-rose-50/50 @else border-stone-200 @enderror rounded-xl focus:ring-2 focus:ring-amber-500 focus:outline-none">
                        @error('stock')
                            <span class="text-[11px] text-rose-600 mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-stone-700 mb-1">
                            Bobot Bersih (Opsional)
                        </label>
                        <input type="text" name="weight" value="{{ old('weight') }}" placeholder="Contoh: 450 gram / Ø 18 cm" class="w-full px-3.5 py-2.5 text-xs sm:text-sm bg-stone-50 border border-stone-200 rounded-xl focus:ring-2 focus:ring-amber-500 focus:outline-none">
                    </div>

                    <div class="flex items-center pt-6">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }} class="w-4 h-4 text-amber-600 border-stone-300 rounded focus:ring-amber-500">
                            <span class="text-xs font-bold text-stone-700">Tandai Sebagai Menu Unggulan (Featured)</span>
                        </label>
                    </div>

                </div>

                <div>
                    <label class="block text-xs font-bold text-stone-700 mb-1">
                        Deskripsi Lengkap Produk *
                    </label>
                    <textarea name="description" rows="3" required placeholder="Jelaskan aroma, tekstur kerak/remah, dan keistimewaan roti ini..." class="w-full px-3.5 py-2.5 text-xs sm:text-sm bg-stone-50 border @error('description') border-rose-400 bg-rose-50/50 @else border-stone-200 @enderror rounded-xl focus:ring-2 focus:ring-amber-500 focus:outline-none">{{ old('description') }}</textarea>
                    @error('description')
                        <span class="text-[11px] text-rose-600 mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label class="block text-xs font-bold text-stone-700 mb-1">
                        Bahan Baku & Komposisi Utama (Opsional)
                    </label>
                    <input type="text" name="ingredients" value="{{ old('ingredients') }}" placeholder="Contoh: Tepung T55, Butter Normandia, Garam Laut, Ragi Alami" class="w-full px-3.5 py-2.5 text-xs sm:text-sm bg-stone-50 border border-stone-200 rounded-xl focus:ring-2 focus:ring-amber-500 focus:outline-none">
                </div>

                <div>
                    <label class="block text-xs font-bold text-stone-700 mb-1">
                        Upload Foto Produk (Disimpan di storage/public) *
                    </label>
                    <div class="flex flex-col sm:flex-row items-center gap-4 p-4 border-2 border-dashed border-stone-300 rounded-2xl bg-stone-50">
                        <div id="preview-box" class="w-24 h-24 rounded-xl bg-stone-200 border border-stone-300 overflow-hidden flex items-center justify-center text-stone-400 flex-shrink-0">
                            <span id="preview-text" class="text-[10px] text-center px-1">Pratinjau Foto</span>
                            <img id="image-preview" src="#" alt="Preview" class="w-full h-full object-cover hidden">
                        </div>
                        <div class="space-y-1 text-center sm:text-left">
                            <input type="file" name="image" id="image-input" accept="image/jpeg,image/png,image/jpg,image/webp" required class="text-xs text-stone-600 file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-bakery-900 file:text-amber-300 hover:file:bg-bakery-800 cursor-pointer">
                            <p class="text-[11px] text-stone-500">Maksimal ukuran: 2MB (2048 KB). Format yang diizinkan: JPG, PNG, WEBP.</p>
                        </div>
                    </div>
                    @error('image')
                        <span class="text-[11px] text-rose-600 mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <div class="pt-4 border-t border-stone-200 flex items-center justify-end gap-3">
                    <a href="{{ route('admin.products.index') }}" class="px-5 py-2.5 rounded-xl border border-stone-300 text-stone-700 hover:bg-stone-100 text-xs font-semibold">
                        Batal
                    </a>
                    <button type="submit" class="px-6 py-2.5 rounded-xl bg-bakery-900 hover:bg-bakery-800 text-amber-300 text-xs font-semibold shadow-md transition-all">
                        Simpan Produk ke Database &rarr;
                    </button>
                </div>

            </form>
        </div>
    </div>

    <script>
        document.getElementById('image-input').onchange = function (evt) {
            const [file] = this.files;
            if (file) {
                const preview = document.getElementById('image-preview');
                const previewText = document.getElementById('preview-text');
                preview.src = URL.createObjectURL(file);
                preview.classList.remove('hidden');
                previewText.classList.add('hidden');
            }
        };
    </script>

@endsection
