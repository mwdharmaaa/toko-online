<?php

namespace Tests\Feature;

use App\Models\BlogPost;
use App\Models\Category;
use App\Models\Product;
use App\Models\SiteSetting;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StorefrontTest extends TestCase
{
    use RefreshDatabase;

    private SiteSetting $setting;

    protected function setUp(): void
    {
        parent::setUp();

        $this->setting = SiteSetting::current();

        $category = Category::create([
            'name' => 'Carry Gear',
            'slug' => 'carry-gear',
            'description' => 'Bags and carry goods',
            'is_active' => true,
        ]);

        Product::create([
            'category_id' => $category->id,
            'name' => 'Canvas Tote Bag',
            'slug' => 'canvas-tote-bag',
            'sku' => 'MN-TEST01',
            'price' => 250000,
            'stock' => 10,
            'summary' => 'Durable canvas tote bag',
            'description' => 'Full specifications and details.',
            'is_featured' => true,
            'is_active' => true,
        ]);

        BlogPost::create([
            'title' => 'Minimalist Philosophy',
            'slug' => 'minimalist-philosophy',
            'excerpt' => 'Short summary of minimalism',
            'content' => 'Full article content for testing.',
            'author_name' => 'Editorial',
            'reading_time_minutes' => 3,
            'is_published' => true,
            'published_at' => now(),
        ]);
    }

    public function test_homepage_renders_successfully(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Canvas Tote Bag');
        $response->assertSee($this->setting->welcome_title);
        $response->assertSee('Minimalist Philosophy');
    }

    public function test_product_catalog_displays_products(): void
    {
        $response = $this->get('/products');

        $response->assertStatus(200);
        $response->assertSee('Canvas Tote Bag');
        $response->assertSee('MN-TEST01');
    }

    public function test_product_detail_page_includes_whatsapp_link(): void
    {
        $response = $this->get('/products/canvas-tote-bag');

        $response->assertStatus(200);
        $response->assertSee('Canvas Tote Bag');
        $response->assertSee('MN-TEST01');
        $response->assertSee('https://wa.me/', false);
        $response->assertSee('wa-order-builder');
    }

    public function test_blog_index_and_show_pages(): void
    {
        $responseIndex = $this->get('/blog');
        $responseIndex->assertStatus(200);
        $responseIndex->assertSee('Minimalist Philosophy');

        $responseShow = $this->get('/blog/minimalist-philosophy');
        $responseShow->assertStatus(200);
        $responseShow->assertSee('Full article content for testing.');
    }
}
