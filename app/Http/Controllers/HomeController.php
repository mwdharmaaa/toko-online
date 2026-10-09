<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\Category;
use App\Models\Product;
use App\Models\SiteSetting;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $setting = SiteSetting::current();

        $featuredProducts = Product::query()
            ->with('category')
            ->active()
            ->featured()
            ->latest('id')
            ->take(4)
            ->get();

        $recentProducts = Product::query()
            ->with('category')
            ->active()
            ->latest('id')
            ->take(8)
            ->get();

        $categories = Category::query()
            ->active()
            ->withCount(['products' => fn ($q) => $q->active()])
            ->get();

        $latestPosts = BlogPost::query()
            ->published()
            ->latest('published_at')
            ->take(3)
            ->get();

        return view('home', compact(
            'setting',
            'featuredProducts',
            'recentProducts',
            'categories',
            'latestPosts'
        ));
    }
}
