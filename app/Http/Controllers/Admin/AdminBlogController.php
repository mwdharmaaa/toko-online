<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBlogPostRequest;
use App\Http\Requests\UpdateBlogPostRequest;
use App\Models\BlogPost;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminBlogController extends Controller
{
    public function index(Request $request): View
    {
        $query = BlogPost::query();

        if ($request->filled('q')) {
            $query->search($request->query('q'));
        }

        $posts = $query->latest('id')->paginate(15)->withQueryString();

        return view('admin.blog.index', compact('posts'));
    }

    public function create(): View
    {
        return view('admin.blog.create');
    }

    public function store(StoreBlogPostRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($data['title']);
        $data['is_published'] = $request->boolean('is_published');
        $data['published_at'] = $data['is_published'] ? now() : null;

        if ($request->hasFile('image')) {
            $data['cover_image'] = $request->file('image')->store('blog', 'public');
        } elseif ($request->filled('cover_image_url')) {
            $data['cover_image'] = $request->input('cover_image_url');
        }

        BlogPost::create($data);

        return redirect()->route('admin.blog.index')
            ->with('success', 'Artikel blog berhasil diterbitkan.');
    }

    public function edit(BlogPost $post): View
    {
        return view('admin.blog.edit', compact('post'));
    }

    public function update(UpdateBlogPostRequest $request, BlogPost $post): RedirectResponse
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($data['title']);
        $data['is_published'] = $request->boolean('is_published');

        if ($data['is_published'] && empty($post->published_at)) {
            $data['published_at'] = now();
        }

        if ($request->hasFile('image')) {
            if ($post->cover_image && !str_starts_with($post->cover_image, 'http') && !str_starts_with($post->cover_image, 'images/')) {
                Storage::disk('public')->delete($post->cover_image);
            }
            $data['cover_image'] = $request->file('image')->store('blog', 'public');
        } elseif ($request->filled('cover_image_url')) {
            $data['cover_image'] = $request->input('cover_image_url');
        }

        $post->update($data);

        return redirect()->route('admin.blog.index')
            ->with('success', 'Artikel blog berhasil diperbarui.');
    }

    public function destroy(BlogPost $post): RedirectResponse
    {
        if ($post->cover_image && !str_starts_with($post->cover_image, 'http') && !str_starts_with($post->cover_image, 'images/')) {
            Storage::disk('public')->delete($post->cover_image);
        }

        $post->delete();

        return redirect()->route('admin.blog.index')
            ->with('success', 'Artikel blog berhasil dihapus.');
    }
}
