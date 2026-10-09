<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Str;

class SkuGenerator
{
    public function generate(string $prefix = 'MN'): string
    {
        do {
            $sku = $prefix . '-' . strtoupper(Str::random(6));
        } while (Product::where('sku', $sku)->exists());

        return $sku;
    }
}
