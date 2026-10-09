<?php

namespace App\Console\Commands;

use App\Models\Product;
use Illuminate\Console\Command;

class CheckLowStockCommand extends Command
{
    protected $signature = 'store:check-stock {--threshold=5 : Ambang batas unit stok}';
    protected $description = 'Menampilkan daftar produk dengan stok kritis atau habis';

    public function handle(): int
    {
        $threshold = (int) $this->option('threshold');
        $products = Product::where('stock', '<=', $threshold)->get(['sku', 'name', 'stock', 'price']);

        if ($products->isEmpty()) {
            $this->info("Semua inventaris aman. Tidak ada produk dengan stok <= {$threshold}.");
            return self::SUCCESS;
        }

        $this->warn("Ditemukan {$products->count()} produk dengan ketersediaan kritis:");
        $rows = $products->map(fn($p) => [$p->sku, $p->name, $p->stock, $p->formatted_price])->toArray();
        $this->table(['SKU', 'Nama Produk', 'Stok', 'Harga'], $rows);

        return self::SUCCESS;
    }
}
