<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BlogPostResource;
use App\Models\BlogPost;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ApiBlogController extends Controller
{
    public function index(Request $request): AnonymousResourceCollection
    {
        $query = BlogPost::published();
        if ($request->filled('q')) {
            $query->search($request->query('q'));
        }
        return BlogPostResource::collection($query->latest('published_at')->paginate(10));
    }

    public function show(string $slug): BlogPostResource
    {
        $post = BlogPost::published()->where('slug', $slug)->firstOrFail();
        return new BlogPostResource($post);
    }
}
