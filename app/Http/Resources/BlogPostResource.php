<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BlogPostResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'excerpt' => $this->excerpt,
            'content' => $this->content,
            'cover_image_url' => $this->cover_image_url,
            'author_name' => $this->author_name,
            'reading_time_minutes' => $this->reading_time_minutes,
            'published_at' => $this->published_at?->toIso8601String(),
        ];
    }
}
