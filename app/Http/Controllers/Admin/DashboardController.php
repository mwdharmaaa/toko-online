<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\Category;
use App\Models\Product;
use App\Models\SiteSetting;
use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $setting = SiteSetting::current();

        $stats = [
            'total_products' => Product::count(),
            'active_products' => Product::active()->count(),
            'low_stock' => Product::where('stock', '<=', 5)->count(),
            'total_categories' => Category::count(),
            'total_posts' => BlogPost::count(),
            'published_posts' => BlogPost::published()->count(),
        ];

        $recentProducts = Product::query()
            ->with('category')
            ->latest('id')
            ->take(6)
            ->get();

        $recentPosts = BlogPost::query()
            ->latest('id')
            ->take(4)
            ->get();

        return view('admin.dashboard', compact('setting', 'stats', 'recentProducts', 'recentPosts'));
    }
}
