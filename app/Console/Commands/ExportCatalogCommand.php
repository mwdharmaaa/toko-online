<?php

namespace App\Console\Commands;

use App\Services\CatalogExporter;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class ExportCatalogCommand extends Command
{
    protected $signature = 'store:export-catalog {--path=storage/app/catalog-backup.json : Jalur file ekspor}';
    protected $description = 'Mengekspor seluruh katalog produk aktif ke berkas JSON';

    public function handle(CatalogExporter $exporter): int
    {
        $path = base_path($this->option('path'));
        $json = $exporter->exportToJson();

        File::ensureDirectoryExists(dirname($path));
        File::put($path, $json);

        $this->info("Katalog produk berhasil diekspor ke: {$path}");
        return self::SUCCESS;
    }
}
