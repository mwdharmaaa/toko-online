<?php

namespace App\Actions\Blog;

use App\Models\BlogPost;
use Illuminate\Support\Facades\Storage;

class DeleteBlogPostAction
{
    public function execute(BlogPost $post): bool
    {
        if ($post->cover_image && !str_starts_with($post->cover_image, 'http') && !str_starts_with($post->cover_image, 'images/')) {
            Storage::disk('public')->delete($post->cover_image);
        }

        return (bool) $post->delete();
    }
}
