# PT Rasa Roti Nusantara — Website Dinamis UMKM (UTS Pemrograman Web)

Website resmi dan sistem manajemen **PT Rasa Roti Nusantara**, sebuah UMKM Bakery & Patisserie artisanal yang dibangun menggunakan **Laravel 10**, **MySQL**, dan **Tailwind CSS** dengan standar antarmuka **Anti-Slop** (bebas template generik AI).

---

## 📋 Pemenuhan Ketentuan Soal UTS

| No | Ketentuan Soal UTS | Status | Implementasi |
|:---|:---|:---:|:---|
| 1 | **Project Laravel berjalan tanpa error** | ✅ Tuntas | Laravel 10 berjalan normal di `http://127.0.0.1:8000` |
| 2 | **Database + migration minimal 2 tabel berelasi** | ✅ Tuntas | 4 tabel saling berelasi: `categories`, `products`, `sales`, `sale_items` |
| 3 | **Model + relasi Eloquent via Controller** | ✅ Tuntas | Eager loading `with('category')` dan `with('items.product')` |
| 4 | **Halaman dinamis (Publik + Admin)** | ✅ Tuntas | Publik (Katalog, Filter, Detail, Checkout, Tracking) & Admin (Dashboard, CRUD Produk, Kelola Penjualan) |
| 5 | **Upload foto disimpan di `storage/public`** | ✅ Tuntas | Upload via controller ke `storage/app/public/products`, terhubung dengan `storage:link` |
| 6 | **Validasi server-side minimal 3 aturan** | ✅ Tuntas | `required`, `max:255`, `numeric`, `min:0`, `image`, `mimes:jpeg,png,jpg,webp`, `exists:categories,id` |
| 7 | **Tampilan responsif (Anti-Slop)** | ✅ Tuntas | Desain ramah mobile & desktop, tipografi Playfair + Plus Jakarta Sans, palet hangat khas bakery |
| 8 | **Seeder minimal 5 data contoh** | ✅ Tuntas | 8 data produk riil + foto HD di storage, 4 kategori, dan 5 data transaksi penjualan |

---

## 🏢 Identitas UMKM

- **Nama Perusahaan**: PT Rasa Roti Nusantara (Inisial **"R"**)
- **Bidang Usaha**: Artisan Bakery & Patisserie (Sourdough, Viennoiserie Croissant, Cakes, Roti Manis)
- **Lokasi Toko**: Jl. Senopati No. 42, Kebayoran Baru, Jakarta Selatan
- **Layanan Konsumen**: WhatsApp +62 812-3456-7890

---

## 🚀 Panduan Menjalankan Proyek

### 1. Prasyarat Sistem
- PHP 8.1+
- Composer
- MySQL Server (Laragon / XAMPP)

### 2. Konfigurasi Database
Pastikan database MySQL bernama `uts_bakery` sudah dibuat:
```sql
CREATE DATABASE uts_bakery;
```

Konfigurasi pada `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=uts_bakery
DB_USERNAME=root
DB_PASSWORD=
```

### 3. Migrasi & Seeding Data
Jalankan migrasi dan seeder untuk mengisi 8 produk dan 5 data penjualan:
```bash
php artisan migrate:fresh --seed
php artisan storage:link
```

### 4. Menjalankan Server
```bash
php artisan serve
```
Akses di browser:
- **Halaman Publik**: `http://127.0.0.1:8000/`
- **Lacak Pesanan**: `http://127.0.0.1:8000/lacak-pesanan`
- **Login Admin**: `http://127.0.0.1:8000/admin/login`
- **Dashboard Admin**: `http://127.0.0.1:8000/admin` (membutuhkan login)
- **Kelola Produk (CRUD)**: `http://127.0.0.1:8000/admin/products`
- **Kelola Penjualan**: `http://127.0.0.1:8000/admin/sales`

### 🔑 Kredensial Akun Admin & Fitur Demo

Pada halaman login (`/admin/login`), tersedia tombol **"Demo Akun"** untuk mengisi username dan password secara otomatis dalam 1 kali klik.

- **Email**: `admin@rasaroti.com`
- **Password**: `admin123`
