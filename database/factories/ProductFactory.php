<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        $name = fake()->unique()->words(3, true);
        return [
            'category_id' => Category::factory(),
            'name' => ucwords($name),
            'slug' => Str::slug($name),
            'sku' => 'MN-' . strtoupper(Str::random(6)),
            'price' => fake()->numberBetween(100, 900) * 1000,
            'stock' => fake()->numberBetween(0, 50),
            'summary' => fake()->sentence(),
            'description' => fake()->paragraphs(2, true),
            'specifications' => [
                'Material' => '100% Premium Cotton Canvas',
                'Dimensi' => '30cm x 40cm',
                'Garansi' => '1 Tahun',
            ],
            'image_path' => 'images/products/mono-tote.svg',
            'is_featured' => fake()->boolean(20),
            'is_active' => true,
        ];
    }
}
