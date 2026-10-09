<?php

namespace App\Actions\Products;

use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class DeleteProductAction
{
    public function execute(Product $product): bool
    {
        if ($product->image_path && !str_starts_with($product->image_path, 'http') && !str_starts_with($product->image_path, 'images/')) {
            Storage::disk('public')->delete($product->image_path);
        }

        return (bool) $product->delete();
    }
}
