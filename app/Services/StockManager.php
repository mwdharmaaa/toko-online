<?php

namespace App\Services;

use App\Models\Product;
use RuntimeException;

class StockManager
{
    public function decrement(Product $product, int $quantity = 1): void
    {
        if ($product->stock < $quantity) {
            throw new RuntimeException("Stok tidak mencukupi untuk SKU: {$product->sku}");
        }

        $product->decrement('stock', $quantity);
    }

    public function increment(Product $product, int $quantity = 1): void
    {
        $product->increment('stock', $quantity);
    }
}
