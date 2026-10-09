<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ApiProductController extends Controller
{
    public function index(Request $request): AnonymousResourceCollection
    {
        $query = Product::with('category')->active();

        if ($request->filled('q')) {
            $query->search($request->query('q'));
        }

        if ($request->filled('category')) {
            $query->whereHas('category', fn($q) => $q->where('slug', $request->query('category')));
        }

        return ProductResource::collection($query->latest('id')->paginate(12));
    }

    public function show(string $slug): ProductResource
    {
        $product = Product::with('category')->active()->where('slug', $slug)->firstOrFail();
        return new ProductResource($product);
    }
}
