<?php

namespace App\Console\Commands;

use App\Models\Product;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class GenerateMissingSvgCommand extends Command
{
    protected $signature = 'store:generate-svg';
    protected $description = 'Membuat placeholder aset SVG monokrom untuk produk tanpa gambar';

    public function handle(): int
    {
        $dir = public_path('images/products');
        File::ensureDirectoryExists($dir);

        $products = Product::whereNull('image_path')->orWhere('image_path', '')->get();
        if ($products->isEmpty()) {
            $this->info("Semua produk telah memiliki aset gambar.");
            return self::SUCCESS;
        }

        $count = 0;
        foreach ($products as $p) {
            $filename = "images/products/{$p->slug}.svg";
            $svg = <<<SVG
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 400 400" width="400" height="400">
  <rect width="400" height="400" fill="#f8f8fa"/>
  <rect x="20" y="20" width="360" height="360" fill="none" stroke="#e4e4e7" stroke-width="1"/>
  <text x="200" y="200" text-anchor="middle" font-family="monospace" font-size="14" fill="#09090b">{$p->sku}</text>
</svg>
SVG;
            File::put(public_path($filename), $svg);
            $p->update(['image_path' => $filename]);
            $count++;
        }

        $this->info("Berhasil membuat {$count} aset SVG monokrom.");
        return self::SUCCESS;
    }
}
