<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class SlugService
{
    public function makeUnique(string $title, string $modelClass, ?int $ignoreId = null, string $field = 'slug'): string
    {
        $slug = Str::slug($title);
        $original = $slug;
        $count = 1;

        while ($modelClass::where($field, $slug)->when($ignoreId, fn($q) => $q->where('id', '!=', $ignoreId))->exists()) {
            $slug = "{$original}-{$count}";
            $count++;
        }

        return $slug;
    }
}
