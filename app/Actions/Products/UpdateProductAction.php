<?php

namespace App\Actions\Products;

use App\Models\Product;
use App\Services\SpecificationParser;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UpdateProductAction
{
    public function __construct(private SpecificationParser $parser)
    {
    }

    public function execute(Product $product, array $data, ?UploadedFile $file = null): Product
    {
        $data['slug'] = Str::slug($data['name']);
        if (isset($data['specifications_raw'])) {
            $data['specifications'] = $this->parser->parse($data['specifications_raw']);
            unset($data['specifications_raw']);
        }

        if ($file) {
            if ($product->image_path && !str_starts_with($product->image_path, 'http') && !str_starts_with($product->image_path, 'images/')) {
                Storage::disk('public')->delete($product->image_path);
            }
            $data['image_path'] = $file->store('products', 'public');
        }

        $product->update($data);
        return $product;
    }
}
