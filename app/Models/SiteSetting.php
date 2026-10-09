<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'store_name',
        'store_tagline',
        'welcome_title',
        'welcome_subtitle',
        'whatsapp_number',
        'whatsapp_message_template',
        'store_address',
        'store_email',
        'instagram_handle',
    ];

    public static function current(): self
    {
        return static::query()->firstOrCreate(
            ['id' => 1],
            [
                'store_name' => 'MONO ARCHIVE',
                'store_tagline' => 'Minimalist Essentials & Curated Objects',
                'welcome_title' => 'Koleksi Produk Esensial Berkelanjutan',
                'welcome_subtitle' => 'Pilihan produk fungsional dengan material premium dan estetika monokrom murni untuk kebutuhan harian.',
                'whatsapp_number' => '6281234567890',
                'whatsapp_message_template' => "Halo Admin {store_name},\n\nSaya ingin memesan produk:\n• Nama: {product_name}\n• SKU: {sku}\n• Harga Satuan: {price}\n• Jumlah: {quantity} pcs\n• Estimasi Subtotal: {total_price}\n• Catatan: {customer_notes}\n\nLink Produk: {product_url}\n\nMohon info ketersediaan stok serta instruksi pembayarannya. Terima kasih!",
                'store_address' => 'Jl. Senopati No. 42, Kebayoran Baru, Jakarta Selatan',
                'store_email' => 'contact@monoarchive.id',
                'instagram_handle' => '@monoarchive',
            ]
        );
    }

    public function sanitizeWhatsAppNumber(): string
    {
        $cleaned = preg_replace('/[^0-9]/', '', (string) $this->whatsapp_number);
        if (str_starts_with($cleaned, '0')) {
            $cleaned = '62' . substr($cleaned, 1);
        }
        return $cleaned;
    }

    public function formatWhatsAppMessage(Product $product, int $quantity = 1, ?string $notes = null): string
    {
        $quantity = max(1, $quantity);
        $totalPrice = 'Rp ' . number_format($product->price * $quantity, 0, ',', '.');
        $customerNotes = filled($notes) ? trim($notes) : '-';
        $productUrl = url('/products/' . $product->slug);

        $replacements = [
            '{store_name}' => $this->store_name,
            '{product_name}' => $product->name,
            '{sku}' => $product->sku,
            '{price}' => $product->formatted_price,
            '{quantity}' => (string) $quantity,
            '{total_price}' => $totalPrice,
            '{customer_notes}' => $customerNotes,
            '{product_url}' => $productUrl,
        ];

        return strtr($this->whatsapp_message_template, $replacements);
    }

    public function generateWhatsAppLink(Product $product, int $quantity = 1, ?string $notes = null): string
    {
        $phone = $this->sanitizeWhatsAppNumber();
        $message = $this->formatWhatsAppMessage($product, $quantity, $notes);
        return 'https://wa.me/' . $phone . '?text=' . rawurlencode($message);
    }
}
