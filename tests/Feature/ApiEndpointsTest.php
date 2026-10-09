<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use App\Models\SiteSetting;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ApiEndpointsTest extends TestCase
{
    use RefreshDatabase;

    public function test_api_products_list_and_detail(): void
    {
        SiteSetting::current();
        $cat = Category::create(['name' => 'Bags', 'slug' => 'bags']);
        $product = Product::create([
            'category_id' => $cat->id,
            'name' => 'API Tote',
            'slug' => 'api-tote',
            'sku' => 'MN-API01',
            'price' => 120000,
            'stock' => 5,
            'description' => 'API Description',
        ]);

        $response = $this->getJson('/api/v1/products');
        $response->assertStatus(200);
        $response->assertJsonFragment(['name' => 'API Tote']);

        $single = $this->getJson('/api/v1/products/api-tote');
        $single->assertStatus(200);
        $single->assertJsonFragment(['sku' => 'MN-API01']);
    }
}
