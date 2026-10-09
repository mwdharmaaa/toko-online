<?php

namespace App\Console\Commands;

use App\Models\Category;
use Illuminate\Console\Command;

class PurgeInactiveCategoriesCommand extends Command
{
    protected $signature = 'store:purge-empty-categories';
    protected $description = 'Menghapus kategori nonaktif yang tidak memiliki produk terkait';

    public function handle(): int
    {
        $categories = Category::where('is_active', false)->doesntHave('products')->get();
        $count = $categories->count();

        foreach ($categories as $cat) {
            $cat->delete();
        }

        $this->info("Dihapus {$count} kategori kosong yang nonaktif.");
        return self::SUCCESS;
    }
}
