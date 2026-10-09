<?php

namespace App\Domain\Contracts;

use App\Models\Product;

interface WhatsAppCompilerInterface
{
    public function compile(string $template, Product $product, int $quantity = 1, ?string $notes = null): string;
    public function buildUrl(string $phone, string $message): string;
}
