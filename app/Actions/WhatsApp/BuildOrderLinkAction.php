<?php

namespace App\Actions\WhatsApp;

use App\Models\Product;
use App\Models\SiteSetting;
use App\Services\WhatsAppMessageCompiler;

class BuildOrderLinkAction
{
    public function __construct(private WhatsAppMessageCompiler $compiler)
    {
    }

    public function execute(SiteSetting $setting, Product $product, int $quantity = 1, ?string $notes = null): string
    {
        $message = $this->compiler->compile($setting->whatsapp_message_template, $product, $quantity, $notes);
        return $this->compiler->buildUrl($setting->whatsapp_number, $message);
    }
}
