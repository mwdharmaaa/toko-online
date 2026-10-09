<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\SiteSetting;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ConsoleCommandsTest extends TestCase
{
    use RefreshDatabase;

    public function test_check_stock_command_runs_successfully(): void
    {
        SiteSetting::current();
        Product::create([
            'name' => 'Low Stock Bag',
            'slug' => 'low-stock-bag',
            'sku' => 'MN-LOW01',
            'price' => 200000,
            'stock' => 2,
            'description' => 'Low stock',
        ]);

        $this->artisan('store:check-stock')
            ->assertExitCode(0);
    }
}
