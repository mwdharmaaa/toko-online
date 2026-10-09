<?php

namespace Database\Factories;

use App\Models\BlogPost;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class BlogPostFactory extends Factory
{
    protected $model = BlogPost::class;

    public function definition(): array
    {
        $title = fake()->unique()->sentence(5);
        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'excerpt' => fake()->paragraph(),
            'content' => fake()->paragraphs(4, true),
            'cover_image' => 'images/blog/blog-1.svg',
            'author_name' => 'Studio Editorial',
            'reading_time_minutes' => fake()->numberBetween(2, 6),
            'is_published' => true,
            'published_at' => now(),
        ];
    }
}
