<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\SiteSetting;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request): View
    {
        $setting = SiteSetting::current();
        $query = Product::query()->with('category')->active();

        $selectedCategory = null;
        if ($request->filled('category')) {
            $selectedCategory = Category::where('slug', $request->query('category'))->first();
            if ($selectedCategory) {
                $query->where('category_id', $selectedCategory->id);
            }
        }

        if ($request->filled('q')) {
            $query->search($request->query('q'));
        }

        $sort = $request->query('sort', 'latest');
        match ($sort) {
            'price_asc' => $query->orderBy('price', 'asc'),
            'price_desc' => $query->orderBy('price', 'desc'),
            'name_asc' => $query->orderBy('name', 'asc'),
            default => $query->latest('id'),
        };

        $products = $query->paginate(12)->withQueryString();

        $categories = Category::query()
            ->active()
            ->withCount(['products' => fn ($q) => $q->active()])
            ->get();

        return view('products.index', compact(
            'products',
            'categories',
            'selectedCategory',
            'setting'
        ));
    }

    public function show(string $slug): View
    {
        $product = Product::query()
            ->with('category')
            ->where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        $setting = SiteSetting::current();

        $relatedProducts = Product::query()
            ->with('category')
            ->active()
            ->where('id', '!=', $product->id)
            ->when($product->category_id, fn ($q) => $q->where('category_id', $product->category_id))
            ->latest('id')
            ->take(4)
            ->get();

        $initialWhatsAppUrl = $setting->generateWhatsAppLink($product, 1);

        return view('products.show', compact(
            'product',
            'setting',
            'relatedProducts',
            'initialWhatsAppUrl'
        ));
    }
}
