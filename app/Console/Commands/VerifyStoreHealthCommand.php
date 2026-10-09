<?php

namespace App\Console\Commands;

use App\Models\Product;
use App\Models\SiteSetting;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class VerifyStoreHealthCommand extends Command
{
    protected $signature = 'store:health';
    protected $description = 'Melakukan audit kesehatan sistem, database SQLite, dan aset toko';

    public function handle(): int
    {
        $this->info("[*] Memeriksa status database SQLite...");
        DB::connection()->getPdo();
        $this->line("    [OK] Database SQLite terkoneksi secara aktif.");

        $this->info("[*] Memeriksa integritas berkas publikasi...");
        $link = public_path('storage');
        $this->line("    " . (File::exists($link) ? "[OK] Storage symlink terpasang." : "[!] Storage symlink belum terhubung."));

        $this->info("[*] Memeriksa ketersediaan pengaturan toko...");
        $setting = SiteSetting::first();
        $this->line("    [OK] Toko: " . ($setting->store_name ?? 'N/A') . " // WA: " . ($setting->whatsapp_number ?? 'N/A'));

        $this->info("[*] Ringkasan data:");
        $this->line("    Total Produk : " . Product::count());

        return self::SUCCESS;
    }
}
