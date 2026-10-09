<?php

namespace App\Listeners;

use App\Events\ProductCreatedEvent;
use Illuminate\Support\Facades\Log;

class LogProductCreationListener
{
    public function handle(ProductCreatedEvent $event): void
    {
        Log::info("Produk baru ditambahkan: {$event->product->name} (SKU: {$event->product->sku})");
    }
}
