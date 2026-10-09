<?php

namespace App\Listeners;

use App\Events\LowStockDetectedEvent;
use Illuminate\Support\Facades\Log;

class AlertAdministratorLowStockListener
{
    public function handle(LowStockDetectedEvent $event): void
    {
        Log::warning("PERINGATAN STOK RENDAH: SKU {$event->product->sku} tersisa {$event->remainingStock} unit.");
    }
}
