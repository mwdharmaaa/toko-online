<?php

namespace App\Actions\Blog;

use App\Models\BlogPost;
use App\Services\ReadingTimeEstimator;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

class CreateBlogPostAction
{
    public function __construct(private ReadingTimeEstimator $estimator)
    {
    }

    public function execute(array $data, ?UploadedFile $file = null): BlogPost
    {
        $data['slug'] = Str::slug($data['title']);
        $data['reading_time_minutes'] = $data['reading_time_minutes'] ?? $this->estimator->estimate($data['content']);
        $data['published_at'] = !empty($data['is_published']) ? now() : null;

        if ($file) {
            $data['cover_image'] = $file->store('blog', 'public');
        }

        return BlogPost::create($data);
    }
}
