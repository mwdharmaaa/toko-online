<?php

namespace App\Actions\Blog;

use App\Models\BlogPost;
use App\Services\ReadingTimeEstimator;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UpdateBlogPostAction
{
    public function __construct(private ReadingTimeEstimator $estimator)
    {
    }

    public function execute(BlogPost $post, array $data, ?UploadedFile $file = null): BlogPost
    {
        $data['slug'] = Str::slug($data['title']);
        $data['reading_time_minutes'] = $data['reading_time_minutes'] ?? $this->estimator->estimate($data['content']);

        if (!empty($data['is_published']) && empty($post->published_at)) {
            $data['published_at'] = now();
        }

        if ($file) {
            if ($post->cover_image && !str_starts_with($post->cover_image, 'http') && !str_starts_with($post->cover_image, 'images/')) {
                Storage::disk('public')->delete($post->cover_image);
            }
            $data['cover_image'] = $file->store('blog', 'public');
        }

        $post->update($data);
        return $post;
    }
}
