<?php

namespace Database\Factories;

use App\Models\SiteSetting;
use Illuminate\Database\Eloquent\Factories\Factory;

class SiteSettingFactory extends Factory
{
    protected $model = SiteSetting::class;

    public function definition(): array
    {
        return [
            'store_name' => 'MONO ARCHIVE',
            'store_tagline' => 'Minimalist Essentials & Curated Objects',
            'welcome_title' => 'Koleksi Esensial Monokrom',
            'welcome_subtitle' => 'Kurasi produk fungsional harian.',
            'whatsapp_number' => '6281234567890',
            'whatsapp_message_template' => "Halo Admin {store_name}, saya ingin membeli {product_name} (SKU: {sku}) seharga {price} sejumlah {quantity} pcs.",
            'store_address' => 'Senopati No. 42, Jakarta',
            'store_email' => 'contact@monoarchive.id',
            'instagram_handle' => '@monoarchive',
        ];
    }
}
