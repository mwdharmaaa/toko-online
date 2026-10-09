<?php

namespace App\Listeners;

use App\Events\BlogPostPublishedEvent;
use Illuminate\Support\Facades\Cache;

class WarmStorefrontCacheListener
{
    public function handle(BlogPostPublishedEvent $event): void
    {
        Cache::forget('storefront_latest_posts');
    }
}
