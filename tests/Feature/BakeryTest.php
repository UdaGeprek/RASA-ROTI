<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Category;
use App\Models\Product;
use App\Models\Sale;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class BakeryTest extends TestCase
{
    public function test_public_homepage_displays_products(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('Rasa Roti');
        $response->assertSee('Roti Sourdough Artisan Klasik');
    }

    public function test_product_detail_page_loads(): void
    {
        $product = Product::first();
        $response = $this->get('/produk/' . $product->slug);
        $response->assertStatus(200);
        $response->assertSee($product->name);
        $response->assertSee('Pesan Sekarang');
    }

    public function test_customer_can_place_order(): void
    {
        $product = Product::first();
        $initialStock = $product->stock;

        $response = $this->post('/produk/' . $product->slug . '/pesan', [
            'customer_name'    => 'Pelanggan Uji Coba',
            'customer_phone'   => '081299998888',
            'customer_address' => 'Jl. Pengujian No. 10, Jakarta',
            'quantity'         => 1,
            'payment_method'   => 'Transfer Bank (BCA)',
            'notes'            => 'Pesanan uji otomatis',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('sales', [
            'customer_name' => 'Pelanggan Uji Coba',
        ]);
        
        $this->assertEquals($initialStock - 1, $product->fresh()->stock);
    }

    public function test_guest_is_redirected_to_login_when_accessing_admin(): void
    {
        $response = $this->get('/admin');
        $response->assertRedirect(route('admin.login'));
    }

    public function test_login_page_renders_with_demo_button(): void
    {
        $response = $this->get('/admin/login');
        $response->assertStatus(200);
        $response->assertSee('Panel Pengelola Toko');
        $response->assertSee('Demo Akun');
        $response->assertSee('admin@rasaroti.com');
    }

    public function test_admin_can_login_with_demo_credentials(): void
    {
        $response = $this->post('/admin/login', [
            'email'    => 'admin@rasaroti.com',
            'password' => 'admin123',
        ]);

        $response->assertRedirect(route('admin.dashboard'));
        $this->assertAuthenticated();
    }

    public function test_admin_dashboard_loads_for_authenticated_user(): void
    {
        $admin = User::first();
        $response = $this->actingAs($admin)->get('/admin');
        $response->assertStatus(200);
        $response->assertSee('Ringkasan Eksekutif');
    }

    public function test_admin_can_create_product_with_upload(): void
    {
        Storage::fake('public');
        $admin = User::first();
        $category = Category::first();

        $file = UploadedFile::fake()->image('test-bread.jpg');

        $response = $this->actingAs($admin)->post('/admin/products', [
            'category_id' => $category->id,
            'name'        => 'Roti Keju Spesial Test',
            'price'       => 35000,
            'stock'       => 20,
            'description' => 'Deskripsi roti keju yang sangat lembut dan lezat untuk pengujian.',
            'ingredients' => 'Tepung terigu, Keju Cheddar, Mentega',
            'weight'      => '200 gram',
            'image'       => $file,
        ]);

        $response->assertRedirect('/admin/products');
        $this->assertDatabaseHas('products', [
            'name' => 'Roti Keju Spesial Test',
        ]);
    }

    public function test_admin_can_logout(): void
    {
        $admin = User::first();
        $response = $this->actingAs($admin)->post('/admin/logout');
        $response->assertRedirect(route('admin.login'));
        $this->assertGuest();
    }
}
