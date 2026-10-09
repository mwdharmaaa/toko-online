<?php

namespace App\Console\Commands;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ImportCatalogCommand extends Command
{
    protected $signature = 'store:import-catalog {path : Jalur file JSON katalog}';
    protected $description = 'Mengimpor katalog produk dari file JSON terstruktur';

    public function handle(): int
    {
        $path = $this->argument('path');
        if (!File::exists($path)) {
            $this->error("Berkas tidak ditemukan: {$path}");
            return self::FAILURE;
        }

        $data = json_decode(File::get($path), true);
        if (!is_array($data)) {
            $this->error("Format JSON tidak valid.");
            return self::FAILURE;
        }

        $imported = 0;
        foreach ($data as $item) {
            $catId = null;
            if (!empty($item['category'])) {
                $category = Category::firstOrCreate(
                    ['slug' => Str::slug($item['category'])],
                    ['name' => $item['category'], 'is_active' => true]
                );
                $catId = $category->id;
            }

            Product::updateOrCreate(
                ['sku' => $item['sku']],
                [
                    'category_id' => $catId,
                    'name' => $item['name'],
                    'slug' => Str::slug($item['name']),
                    'price' => $item['price'],
                    'stock' => $item['stock'] ?? 0,
                    'specifications' => $item['specifications'] ?? null,
                    'is_featured' => $item['is_featured'] ?? false,
                    'is_active' => $item['is_active'] ?? true,
                ]
            );
            $imported++;
        }

        $this->info("Berhasil mengimpor/memperbarui {$imported} produk.");
        return self::SUCCESS;
    }
}
