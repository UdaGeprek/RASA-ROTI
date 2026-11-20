<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@rasaroti.com'],
            [
                'name' => 'Admin Rasa Roti',
                'password' => Hash::make('admin123'),
                'email_verified_at' => now(),
            ]
        );

        $categories = [
            [
                'name' => 'Sourdough & Roti Tawar',
                'slug' => 'sourdough-roti-tawar',
                'description' => 'Roti fermentasi alami dengan crust renyah dan tekstur lembut kaya serat tanpa pengawet.',
                'icon' => 'bread-slice',
            ],
            [
                'name' => 'Viennoiserie & Pastry',
                'slug' => 'viennoiserie-pastry',
                'description' => 'Pastry mentega autentik Prancis dengan lipatan renyah keemasan dan butter aromatik.',
                'icon' => 'croissant',
            ],
            [
                'name' => 'Roti Manis & Buns',
                'slug' => 'roti-manis-buns',
                'description' => 'Roti manis bertekstur kapas dengan isian rempah, keju, dan butter premium.',
                'icon' => 'cookie',
            ],
            [
                'name' => 'Cakes & Tart',
                'slug' => 'cakes-tart',
                'description' => 'Kue tart lembut dengan couverture cokelat premium dan buah segar pilihan.',
                'icon' => 'birthday-cake',
            ],
        ];

        $catModels = [];
        foreach ($categories as $cat) {
            $catModels[$cat['slug']] = Category::create($cat);
        }

        $products = [
            [
                'category_id' => $catModels['sourdough-roti-tawar']->id,
                'name' => 'Roti Sourdough Artisan Klasik',
                'slug' => 'roti-sourdough-artisan-klasik',
                'sku' => 'RRN-SRD-01',
                'price' => 45000,
                'stock' => 15,
                'description' => 'Roti sourdough artisanal dengan fermentasi ragi alami 24 jam. Memiliki kerak renyah keemasan, remah berpori lembut, dan aroma asam khas yang menggugah selera. Dipanggang segar setiap pagi.',
                'ingredients' => 'Tepung Terigu Protein Tinggi Organik, Starter Ragi Alami, Air Murni Terfiltrasi, Garam Laut Bali.',
                'weight' => '600 gram',
                'image' => 'products/sourdough.jpg',
                'is_featured' => true,
            ],
            [
                'category_id' => $catModels['viennoiserie-pastry']->id,
                'name' => 'French Butter Croissant',
                'slug' => 'french-butter-croissant',
                'sku' => 'RRN-CRS-01',
                'price' => 28000,
                'stock' => 25,
                'description' => 'Croissant klasik Prancis dengan laminasi 27 lapisan adonan dan 100% Normandy French Butter AOP. Sangat renyah di luar dengan struktur sarang lebah lembut dan wangi mentega autentik di dalam.',
                'ingredients' => 'Tepung Gandum T55 Prancis, French Butter AOP Normandy, Susu Segar Pasteurisasi, Gula Tebu, Ragi.',
                'weight' => '95 gram',
                'image' => 'products/croissant.jpg',
                'is_featured' => true,
            ],
            [
                'category_id' => $catModels['viennoiserie-pastry']->id,
                'name' => 'Pain au Chocolat (Dark Choco Croissant)',
                'slug' => 'pain-au-chocolat',
                'sku' => 'RRN-CRS-02',
                'price' => 32000,
                'stock' => 20,
                'description' => 'Pastry berlipat khas Paris dengan isian 2 batang dark chocolate couverture 60% asal Belgia. Rasa manis pahit seimbang berpadu dengan gurihnya butter laminasi.',
                'ingredients' => 'Tepung Terigu T55, French Butter, Dark Chocolate Couverture Callebaut 60%, Telur Ayam Kampung Segar.',
                'weight' => '110 gram',
                'image' => 'products/pain-chocolat.jpg',
                'is_featured' => true,
            ],
            [
                'category_id' => $catModels['roti-manis-buns']->id,
                'name' => 'Cinnamon Roll Cream Cheese Glaze',
                'slug' => 'cinnamon-roll-cream-cheese',
                'sku' => 'RRN-BUN-01',
                'price' => 30000,
                'stock' => 18,
                'description' => 'Roti gulung manis lembut dengan rempah kayu manis Ceylon organik, gula aren pilihan, dan disiram frosting keju krim lembut yang lumer di lidah.',
                'ingredients' => 'Tepung Gandum Pilihan, Kayu Manis Asli Ceylon, Gula Aren Organik, Mentega Wijsman, Philadelphia Cream Cheese.',
                'weight' => '130 gram',
                'image' => 'products/cinnamon-roll.jpg',
                'is_featured' => true,
            ],
            [
                'category_id' => $catModels['cakes-tart']->id,
                'name' => 'Belgian Choco Truffle Cake',
                'slug' => 'belgian-choco-truffle-cake',
                'sku' => 'RRN-CAK-01',
                'price' => 185000,
                'stock' => 8,
                'description' => 'Kue cokelat premium dengan lapisan moist chocolate sponge, disiram ganache dark chocolate Belgia pekat 70%, dan taburan cocoa nibs renyah. Sangat cocok untuk selebrasi istimewa.',
                'ingredients' => 'Valrhona Cocoa Powder, Dark Chocolate Couverture 70%, Whipping Cream Dairy, Telur Organik, Mentega Prancis.',
                'weight' => '750 gram (Ø 16 cm)',
                'image' => 'products/choco-cake.jpg',
                'is_featured' => true,
            ],
            [
                'category_id' => $catModels['roti-manis-buns']->id,
                'name' => 'Roti Sisir Roombutter Klasik',
                'slug' => 'roti-sisir-roombutter-klasik',
                'sku' => 'RRN-BUN-02',
                'price' => 38000,
                'stock' => 22,
                'description' => 'Roti sisir tradisional bertekstur kapas super empuk dengan olesan roombutter harum dan taburan gula pasir kristal tipis. Cita rasa hangat nostalgia tempo dulu.',
                'ingredients' => 'Tepung Terigu Halus, Roombutter Golden Churn, Kuning Telur Segar, Susu Evaporasi, Gula Pasir Tebu.',
                'weight' => '350 gram',
                'image' => 'products/roti-sisir.jpg',
                'is_featured' => false,
            ],
            [
                'category_id' => $catModels['sourdough-roti-tawar']->id,
                'name' => 'Traditional French Baguette',
                'slug' => 'traditional-french-baguette',
                'sku' => 'RRN-SRD-02',
                'price' => 25000,
                'stock' => 15,
                'description' => 'Baguette khas Prancis dengan kerak garing berderak dan rongga terbuka. Dipanggang di atas batu oven tradisional, cocok disantap dengan keju, selai, atau sup hangat.',
                'ingredients' => 'Tepung Gandum T55, Air Terfiltrasi, Ragi Alami, Garam Laut.',
                'weight' => '250 gram',
                'image' => 'products/baguette.jpg',
                'is_featured' => false,
            ],
            [
                'category_id' => $catModels['viennoiserie-pastry']->id,
                'name' => 'Artisan Berry Almond Brioche',
                'slug' => 'artisan-berry-almond-brioche',
                'sku' => 'RRN-CRS-03',
                'price' => 35000,
                'stock' => 12,
                'description' => 'Roti brioche kaya telur dan mentega, dihiasi selai mixed berry segar buatan sendiri dan taburan kacang almond panggang gurih yang renyah.',
                'ingredients' => 'Butter Normandia, Telur Segar, Tepung Gandum, Selai Raspberry & Strawberry, Roasted Almond Slices.',
                'weight' => '140 gram',
                'image' => 'products/berry-brioche.jpg',
                'is_featured' => false,
            ],
        ];

        $productModels = [];
        foreach ($products as $p) {
            $productModels[] = Product::create($p);
        }

        $salesData = [
            [
                'invoice_number' => 'INV-20261120-001',
                'customer_name' => 'Rangga Pratama',
                'customer_phone' => '081234567890',
                'customer_address' => 'Jl. Senopati No. 42, Kebayoran Baru, Jakarta Selatan',
                'payment_method' => 'QRIS (GoPay / OVO)',
                'status' => 'selesai',
                'notes' => 'Tolong sertakan pita kado dan ucapan selamat ulang tahun.',
                'items' => [
                    ['product_index' => 4, 'quantity' => 1],
                    ['product_index' => 1, 'quantity' => 2],
                ],
            ],
            [
                'invoice_number' => 'INV-20261120-002',
                'customer_name' => 'Rina Salsabila',
                'customer_phone' => '082198765432',
                'customer_address' => 'Apartemen Sudirman Park Tower B Lt. 15, Jakarta Pusat',
                'payment_method' => 'Transfer Bank (BCA)',
                'status' => 'selesai',
                'notes' => 'Pesanan untuk sarapan pagi kantor jam 08:30 WIB.',
                'items' => [
                    ['product_index' => 0, 'quantity' => 2],
                    ['product_index' => 6, 'quantity' => 2],
                ],
            ],
            [
                'invoice_number' => 'INV-20261120-003',
                'customer_name' => 'Rahmat Hidayat',
                'customer_phone' => '085712349988',
                'customer_address' => 'Perumahan Graha Raya Bintaro Blok C3 No. 12, Tangerang Selatan',
                'payment_method' => 'Transfer Bank (Mandiri)',
                'status' => 'diproses',
                'notes' => 'Roti dipotong tebal sedang (sandwich slice).',
                'items' => [
                    ['product_index' => 3, 'quantity' => 4],
                    ['product_index' => 5, 'quantity' => 1],
                ],
            ],
            [
                'invoice_number' => 'INV-20261120-004',
                'customer_name' => 'Ratih Kusumaningrum',
                'customer_phone' => '081388776655',
                'customer_address' => 'Jl. Boulevard Kelapa Gading No. 88, Jakarta Utara',
                'payment_method' => 'QRIS (ShopeePay)',
                'status' => 'selesai',
                'notes' => 'Packing rapi per boks.',
                'items' => [
                    ['product_index' => 2, 'quantity' => 3],
                    ['product_index' => 7, 'quantity' => 2],
                ],
            ],
            [
                'invoice_number' => 'INV-20261120-005',
                'customer_name' => 'Rizky Ramadhan',
                'customer_phone' => '087811223344',
                'customer_address' => 'Komplek Duren Tiga Indah Blok A No. 5, Pancoran, Jakarta Selatan',
                'payment_method' => 'Tunai di Toko (Pick Up)',
                'status' => 'pending',
                'notes' => 'Akan diambil langsung sore nanti pukul 17:00.',
                'items' => [
                    ['product_index' => 1, 'quantity' => 4],
                    ['product_index' => 3, 'quantity' => 2],
                ],
            ],
        ];

        foreach ($salesData as $saleInfo) {
            $total = 0;
            $itemsToCreate = [];

            foreach ($saleInfo['items'] as $item) {
                $prod = $productModels[$item['product_index']];
                $subtotal = $prod->price * $item['quantity'];
                $total += $subtotal;

                $itemsToCreate[] = [
                    'product_id' => $prod->id,
                    'quantity' => $item['quantity'],
                    'unit_price' => $prod->price,
                    'subtotal' => $subtotal,
                ];
            }

            $sale = Sale::create([
                'invoice_number' => $saleInfo['invoice_number'],
                'customer_name' => $saleInfo['customer_name'],
                'customer_phone' => $saleInfo['customer_phone'],
                'customer_address' => $saleInfo['customer_address'],
                'payment_method' => $saleInfo['payment_method'],
                'total_amount' => $total,
                'status' => $saleInfo['status'],
                'notes' => $saleInfo['notes'],
            ]);

            foreach ($itemsToCreate as $it) {
                $sale->items()->create($it);
            }
        }
    }
}
