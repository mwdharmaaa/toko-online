<?php

namespace App\Models\Builders;

use Illuminate\Database\Eloquent\Builder;

class BlogPostBuilder extends Builder
{
    public function published(): self
    {
        return $this->where('is_published', true)
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now());
    }

    public function search(?string $term): self
    {
        if (blank($term)) {
            return $this;
        }

        return $this->where(function ($query) use ($term) {
            $query->where('title', 'like', "%{$term}%")
                ->orWhere('excerpt', 'like', "%{$term}%")
                ->orWhere('content', 'like', "%{$term}%");
        });
    }
}
