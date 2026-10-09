<?php

namespace App\Services;

use App\Domain\Contracts\WhatsAppCompilerInterface;
use App\Models\Product;

class WhatsAppMessageCompiler implements WhatsAppCompilerInterface
{
    public function compile(string $template, Product $product, int $quantity = 1, ?string $notes = null): string
    {
        $quantity = max(1, $quantity);
        $totalPrice = 'Rp ' . number_format($product->price * $quantity, 0, ',', '.');
        $customerNotes = filled($notes) ? trim($notes) : '-';
        $productUrl = url('/products/' . $product->slug);

        $replacements = [
            '{store_name}' => config('app.name', 'MONO ARCHIVE'),
            '{product_name}' => $product->name,
            '{sku}' => $product->sku,
            '{price}' => $product->formatted_price,
            '{quantity}' => (string) $quantity,
            '{total_price}' => $totalPrice,
            '{customer_notes}' => $customerNotes,
            '{product_url}' => $productUrl,
        ];

        return strtr($template, $replacements);
    }

    public function buildUrl(string $phone, string $message): string
    {
        $cleanPhone = preg_replace('/[^0-9]/', '', $phone);
        if (str_starts_with($cleanPhone, '0')) {
            $cleanPhone = '62' . substr($cleanPhone, 1);
        }
        return 'https://wa.me/' . $cleanPhone . '?text=' . rawurlencode($message);
    }
}
