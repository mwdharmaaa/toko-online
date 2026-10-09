<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'sku' => $this->sku,
            'price' => $this->price,
            'formatted_price' => $this->formatted_price,
            'stock' => $this->stock,
            'is_in_stock' => $this->in_stock,
            'summary' => $this->summary,
            'description' => $this->description,
            'specifications' => $this->specifications,
            'image_url' => $this->image_url,
            'is_featured' => $this->is_featured,
            'category' => new CategoryResource($this->whenLoaded('category')),
        ];
    }
}
