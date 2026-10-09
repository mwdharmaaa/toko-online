<?php

namespace App\Models\Builders;

use Illuminate\Database\Eloquent\Builder;

class CategoryBuilder extends Builder
{
    public function active(): self
    {
        return $this->where('is_active', true);
    }

    public function withProductCount(): self
    {
        return $this->withCount(['products' => fn ($q) => $q->where('is_active', true)]);
    }
}
