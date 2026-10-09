<?php

namespace App\Events;

use App\Models\BlogPost;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class BlogPostPublishedEvent
{
    use Dispatchable, SerializesModels;

    public function __construct(public BlogPost $post)
    {
    }
}
