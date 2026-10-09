<?php

namespace App\Actions\Products;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class FilterCatalogProductsAction
{
    public function execute(?string $categorySlug = null, ?string $searchTerm = null, string $sort = 'latest', int $perPage = 12): LengthAwarePaginator
    {
        $query = Product::query()->with('category')->active();

        if (filled($categorySlug)) {
            $cat = Category::where('slug', $categorySlug)->first();
            if ($cat) {
                $query->where('category_id', $cat->id);
            }
        }

        if (filled($searchTerm)) {
            $query->search($searchTerm);
        }

        match ($sort) {
            'price_asc' => $query->orderBy('price', 'asc'),
            'price_desc' => $query->orderBy('price', 'desc'),
            'name_asc' => $query->orderBy('name', 'asc'),
            default => $query->latest('id'),
        };

        return $query->paginate($perPage);
    }
}
