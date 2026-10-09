<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class SiteSettingSeeder extends Seeder
{
    public function run(): void
    {
        SiteSetting::query()->updateOrCreate(
            ['id' => 1],
            [
                'store_name' => 'MONO ARCHIVE',
                'store_tagline' => 'Minimalist Essentials & Curated Objects',
                'welcome_title' => 'Koleksi Esensial Berkelanjutan untuk Hidup Terstruktur',
                'welcome_subtitle' => 'Kami mengkurasi produk harian dengan estetika monokrom murni, presisi material kelas industri, dan utilitas maksimal tanpa distraksi visual.',
                'whatsapp_number' => '6281234567890',
                'whatsapp_message_template' => "Halo Admin {store_name},\n\nSaya ingin memesan produk berikut:\n- Nama: {product_name}\n- SKU: {sku}\n- Harga: {price}\n- Jumlah: {quantity} pcs\n- Total: {total_price}\n- Catatan: {customer_notes}\n\nLink: {product_url}\n\nMohon info ketersediaan stok dan prosedur pembayarannya. Terima kasih!",
                'store_address' => 'Studio Mono Archive, Senopati Selatan No. 42, Jakarta Selatan',
                'store_email' => 'order@monoarchive.id',
                'instagram_handle' => '@monoarchive.id',
            ]
        );
    }
}
