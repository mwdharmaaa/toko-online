<?php

namespace App\Actions\Categories;

use App\Models\Category;
use Illuminate\Support\Str;

class CreateCategoryAction
{
    public function execute(array $data): Category
    {
        $data['slug'] = Str::slug($data['name']);
        return Category::create($data);
    }
}
