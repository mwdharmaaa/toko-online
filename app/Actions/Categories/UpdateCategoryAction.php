<?php

namespace App\Actions\Categories;

use App\Models\Category;
use Illuminate\Support\Str;

class UpdateCategoryAction
{
    public function execute(Category $category, array $data): Category
    {
        $data['slug'] = Str::slug($data['name']);
        $category->update($data);
        return $category;
    }
}
