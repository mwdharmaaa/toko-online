<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use App\Models\SiteSetting;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminPanelTest extends TestCase
{
    use RefreshDatabase;

    private User $admin;

    protected function setUp(): void
    {
        parent::setUp();

        SiteSetting::current();

        $this->admin = User::create([
            'name' => 'Admin Test',
            'email' => 'admin@test.com',
            'password' => bcrypt('password123'),
            'is_admin' => true,
        ]);
    }

    public function test_guest_is_redirected_from_admin_dashboard(): void
    {
        $response = $this->get('/admin/dashboard');
        $response->assertRedirect('/admin/login');
    }

    public function test_admin_can_login_successfully(): void
    {
        $response = $this->post('/admin/login', [
            'email' => 'admin@test.com',
            'password' => 'password123',
        ]);

        $response->assertRedirect('/admin/dashboard');
        $this->assertAuthenticatedAs($this->admin);
    }

    public function test_admin_can_crud_product(): void
    {
        $category = Category::create([
            'name' => 'Test Cat',
            'slug' => 'test-cat',
        ]);

        $storeResponse = $this->actingAs($this->admin)->post('/admin/products', [
            'category_id' => $category->id,
            'name' => 'New Test Product',
            'sku' => 'MN-PROD99',
            'price' => 300000,
            'stock' => 15,
            'description' => 'Test product description',
            'specifications_raw' => "Material: Katun\nDimensi: 10x10 cm",
            'is_featured' => 1,
            'is_active' => 1,
        ]);

        $storeResponse->assertRedirect('/admin/products');
        $this->assertDatabaseHas('products', ['sku' => 'MN-PROD99', 'name' => 'New Test Product']);

        $product = Product::where('sku', 'MN-PROD99')->first();
        $this->assertEquals(['Material' => 'Katun', 'Dimensi' => '10x10 cm'], $product->specifications);

        $updateResponse = $this->actingAs($this->admin)->put("/admin/products/{$product->id}", [
            'category_id' => $category->id,
            'name' => 'Updated Product Name',
            'sku' => 'MN-PROD99',
            'price' => 350000,
            'stock' => 20,
            'description' => 'Updated description',
        ]);

        $updateResponse->assertRedirect('/admin/products');
        $this->assertDatabaseHas('products', ['sku' => 'MN-PROD99', 'name' => 'Updated Product Name']);

        $deleteResponse = $this->actingAs($this->admin)->delete("/admin/products/{$product->id}");
        $deleteResponse->assertRedirect('/admin/products');
        $this->assertDatabaseMissing('products', ['id' => $product->id]);
    }

    public function test_admin_can_update_settings(): void
    {
        $response = $this->actingAs($this->admin)->put('/admin/settings', [
            'store_name' => 'MONO UPDATE',
            'welcome_title' => 'Judul Baru',
            'whatsapp_number' => '628999999999',
            'whatsapp_message_template' => 'Pesan Beli: {product_name}',
        ]);

        $response->assertRedirect('/admin/settings');
        $this->assertDatabaseHas('site_settings', [
            'store_name' => 'MONO UPDATE',
            'whatsapp_number' => '628999999999',
        ]);
    }
}
