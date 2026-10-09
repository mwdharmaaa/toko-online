<?php

namespace App\Services;

use App\Models\Product;

class CatalogExporter
{
    public function exportToJson(): string
    {
        $products = Product::with('category')->get()->map(function (Product $p) {
            return [
                'sku' => $p->sku,
                'name' => $p->name,
                'category' => $p->category?->name,
                'price' => $p->price,
                'stock' => $p->stock,
                'specifications' => $p->specifications,
                'is_featured' => $p->is_featured,
                'is_active' => $p->is_active,
            ];
        });

        return json_encode($products, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    }
}
