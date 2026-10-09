<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\SiteSetting;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request): View
    {
        $setting = SiteSetting::current();
        $query = BlogPost::query()->published();

        if ($request->filled('q')) {
            $query->search($request->query('q'));
        }

        $posts = $query->latest('published_at')->paginate(9)->withQueryString();

        return view('blog.index', compact('posts', 'setting'));
    }

    public function show(string $slug): View
    {
        $setting = SiteSetting::current();

        $post = BlogPost::query()
            ->published()
            ->where('slug', $slug)
            ->firstOrFail();

        $recentPosts = BlogPost::query()
            ->published()
            ->where('id', '!=', $post->id)
            ->latest('published_at')
            ->take(3)
            ->get();

        return view('blog.show', compact('post', 'setting', 'recentPosts'));
    }
}
