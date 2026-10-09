<?php

namespace App\Models\Builders;

use Illuminate\Database\Eloquent\Builder;

class ProductBuilder extends Builder
{
    public function active(): self
    {
        return $this->where('is_active', true);
    }

    public function featured(): self
    {
        return $this->where('is_featured', true);
    }

    public function inStock(): self
    {
        return $this->where('stock', '>', 0);
    }

    public function lowStock(int $threshold = 5): self
    {
        return $this->where('stock', '<=', $threshold);
    }

    public function search(?string $term): self
    {
        if (blank($term)) {
            return $this;
        }

        return $this->where(function ($query) use ($term) {
            $query->where('name', 'like', "%{$term}%")
                ->orWhere('sku', 'like', "%{$term}%")
                ->orWhere('summary', 'like', "%{$term}%")
                ->orWhere('description', 'like', "%{$term}%");
        });
    }
}
