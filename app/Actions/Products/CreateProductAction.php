<?php

namespace App\Actions\Products;

use App\Models\Product;
use App\Services\SpecificationParser;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

class CreateProductAction
{
    public function __construct(private SpecificationParser $parser)
    {
    }

    public function execute(array $data, ?UploadedFile $file = null): Product
    {
        $data['slug'] = Str::slug($data['name']);
        if (isset($data['specifications_raw'])) {
            $data['specifications'] = $this->parser->parse($data['specifications_raw']);
            unset($data['specifications_raw']);
        }

        if ($file) {
            $data['image_path'] = $file->store('products', 'public');
        }

        return Product::create($data);
    }
}
