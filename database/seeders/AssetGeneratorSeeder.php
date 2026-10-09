<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class AssetGeneratorSeeder extends Seeder
{
    public function run(): void
    {
        $productsDir = public_path('images/products');
        $blogDir = public_path('images/blog');

        File::ensureDirectoryExists($productsDir);
        File::ensureDirectoryExists($blogDir);

        $productAssets = [
            'mono-tote.svg' => ['MN-001', 'HEAVY CANVAS TOTE BAG', 'carry', 'RECT_BAG'],
            'mono-backpack.svg' => ['MN-002', 'URBAN ROLLTOP PACK', 'carry', 'BACKPACK'],
            'mono-tee.svg' => ['MN-003', 'HEAVYWEIGHT BOX TEE', 'apparel', 'TEE'],
            'mono-hoodie.svg' => ['MN-004', 'ARCHIVE PULLOVER HOODIE', 'apparel', 'HOODIE'],
            'mono-cap.svg' => ['MN-005', 'STRUCTURED 6-PANEL CAP', 'apparel', 'CAP'],
            'mono-notebook.svg' => ['MN-006', 'HARDCOVER GRID JOURNAL', 'desk', 'NOTEBOOK'],
            'mono-pen.svg' => ['MN-007', 'MACHINED ALUMINUM ROLLERBALL', 'desk', 'PEN'],
            'mono-organizer.svg' => ['MN-008', 'DESK MAT & TRAY SET', 'desk', 'TRAY'],
            'mono-bottle.svg' => ['MN-009', 'INSULATED VACUUM FLASK', 'living', 'BOTTLE'],
            'mono-mug.svg' => ['MN-010', 'MATTE CERAMIC COFFEE MUG', 'living', 'MUG'],
            'mono-wallet.svg' => ['MN-011', 'SLIM LEATHER CARD SLEEVE', 'accessories', 'WALLET'],
            'mono-watch.svg' => ['MN-012', 'MONOCHROME ANALOG WATCH', 'accessories', 'WATCH'],
        ];

        foreach ($productAssets as $filename => [$sku, $title, $type, $shape]) {
            $svgContent = $this->generateProductSvg($sku, $title, $type, $shape);
            File::put($productsDir . '/' . $filename, $svgContent);
        }

        $blogAssets = [
            'blog-1.svg' => ['ARCHIVE ESSAY 01', 'FILOSOFI MONOKROM & MINIMALISME', 'DESIGN CULTURE'],
            'blog-2.svg' => ['ARCHIVE ESSAY 02', 'PERAWATAN KANVAS & KULIT ALAMI', 'CARE & CRAFT'],
            'blog-3.svg' => ['ARCHIVE ESSAY 03', 'ANATOMI DAILY CARRY URBAN', 'EQUIPMENT GUIDE'],
            'blog-4.svg' => ['ARCHIVE ESSAY 04', 'MENGAPA LESS IS MORE RELEVAN', 'LIFESTYLE ESSAY'],
        ];

        foreach ($blogAssets as $filename => [$tag, $title, $category]) {
            $svgContent = $this->generateBlogSvg($tag, $title, $category);
            File::put($blogDir . '/' . $filename, $svgContent);
        }
    }

    private function generateProductSvg(string $sku, string $title, string $type, string $shape): string
    {
        $shapeSvg = match ($shape) {
            'RECT_BAG' => '<rect x="180" y="240" width="240" height="230" rx="6" fill="#18181b" /><path d="M240 240 V170 C240 140 360 140 360 170 V240" fill="none" stroke="#18181b" stroke-width="14" stroke-linecap="round" /><line x1="180" y1="310" x2="420" y2="310" stroke="#27272a" stroke-width="2" stroke-dasharray="6,4" />',
            'BACKPACK' => '<rect x="200" y="190" width="200" height="280" rx="28" fill="#18181b" /><rect x="230" y="320" width="140" height="120" rx="12" fill="#27272a" /><circle cx="300" cy="240" r="16" fill="#3f3f46" /><path d="M260 190 V150 C260 135 340 135 340 150 V190" fill="none" stroke="#18181b" stroke-width="10" />',
            'TEE' => '<path d="M220 180 L140 240 L180 290 L220 260 V450 H380 V260 L420 290 L460 240 L380 180 C360 210 240 210 220 180 Z" fill="#18181b" /><path d="M260 182 C280 200 320 200 340 182" fill="none" stroke="#ffffff" stroke-width="3" stroke-linecap="round" />',
            'HOODIE' => '<path d="M210 210 L130 270 L170 320 L210 290 V470 H390 V290 L430 320 L470 270 L390 210 Z" fill="#18181b" /><path d="M240 210 C240 150 360 150 360 210" fill="none" stroke="#18181b" stroke-width="20" stroke-linecap="round" /><rect x="250" y="360" width="100" height="70" rx="8" fill="#27272a" />',
            'CAP' => '<path d="M190 320 C190 230 410 230 410 320 Z" fill="#18181b" /><path d="M380 320 C420 320 470 330 490 350 H240 Z" fill="#27272a" /><circle cx="300" cy="230" r="8" fill="#18181b" />',
            'NOTEBOOK' => '<rect x="180" y="160" width="220" height="310" rx="8" fill="#18181b" /><rect x="180" y="160" width="30" height="310" fill="#27272a" /><line x1="240" y1="240" x2="360" y2="240" stroke="#52525b" stroke-width="2" /><line x1="240" y1="270" x2="360" y2="270" stroke="#52525b" stroke-width="2" /><line x1="240" y1="300" x2="320" y2="300" stroke="#52525b" stroke-width="2" />',
            'PEN' => '<rect x="290" y="140" width="20" height="320" rx="4" fill="#18181b" /><polygon points="290,460 310,460 300,500" fill="#27272a" /><rect x="288" y="170" width="24" height="60" rx="2" fill="#52525b" />',
            'TRAY' => '<rect x="140" y="240" width="320" height="170" rx="16" fill="#18181b" /><rect x="170" y="270" width="130" height="110" rx="8" fill="#27272a" /><rect x="320" y="270" width="110" height="110" rx="8" fill="#27272a" />',
            'BOTTLE' => '<rect x="240" y="200" width="120" height="260" rx="20" fill="#18181b" /><rect x="260" y="150" width="80" height="50" rx="6" fill="#27272a" /><line x1="240" y1="260" x2="360" y2="260" stroke="#3f3f46" stroke-width="3" />',
            'MUG' => '<rect x="200" y="220" width="180" height="200" rx="14" fill="#18181b" /><path d="M380 250 H430 C450 250 450 360 430 360 H380" fill="none" stroke="#18181b" stroke-width="22" stroke-linecap="round" />',
            'WALLET' => '<rect x="180" y="220" width="240" height="180" rx="12" fill="#18181b" /><path d="M180 270 Q300 290 420 270" fill="none" stroke="#27272a" stroke-width="4" /><rect x="340" y="290" width="60" height="40" rx="6" fill="#3f3f46" />',
            'WATCH' => '<circle cx="300" cy="300" r="100" fill="#ffffff" stroke="#18181b" stroke-width="12" /><rect x="270" y="120" width="60" height="80" fill="#18181b" rx="4" /><rect x="270" y="400" width="60" height="80" fill="#18181b" rx="4" /><line x1="300" y1="300" x2="300" y2="240" stroke="#18181b" stroke-width="6" stroke-linecap="round" /><line x1="300" y1="300" x2="345" y2="300" stroke="#18181b" stroke-width="4" stroke-linecap="round" /><circle cx="300" cy="300" r="8" fill="#18181b" />',
            default => '<rect x="200" y="200" width="200" height="200" fill="#18181b" />'
        };

        return <<<SVG
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 600 600" width="600" height="600">
  <rect width="600" height="600" fill="#f8f8fa"/>
  <defs>
    <pattern id="grid" width="40" height="40" patternUnits="userSpaceOnUse">
      <path d="M 40 0 L 0 0 0 40" fill="none" stroke="#ececed" stroke-width="1"/>
    </pattern>
  </defs>
  <rect width="600" height="600" fill="url(#grid)" />
  <rect x="24" y="24" width="552" height="552" fill="none" stroke="#e4e4e7" stroke-width="1"/>
  <text x="44" y="58" font-family="monospace" font-size="12" fill="#71717a" letter-spacing="2">{$sku} // {$type}</text>
  <circle cx="550" cy="52" r="4" fill="#09090b" />
  {$shapeSvg}
  <rect x="44" y="520" width="512" height="1" fill="#e4e4e7" />
  <text x="44" y="546" font-family="system-ui, -apple-system, sans-serif" font-weight="700" font-size="13" fill="#09090b" letter-spacing="1">{$title}</text>
  <text x="556" y="546" text-anchor="end" font-family="monospace" font-size="11" fill="#71717a">STUDIO SPEC</text>
</svg>
SVG;
    }

    private function generateBlogSvg(string $tag, string $title, string $category): string
    {
        return <<<SVG
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 630" width="1200" height="630">
  <rect width="1200" height="630" fill="#f8f8fa"/>
  <defs>
    <pattern id="bgrid" width="60" height="60" patternUnits="userSpaceOnUse">
      <path d="M 60 0 L 0 0 0 60" fill="none" stroke="#ececed" stroke-width="1"/>
    </pattern>
  </defs>
  <rect width="1200" height="630" fill="url(#bgrid)" />
  <rect x="40" y="40" width="1120" height="550" fill="none" stroke="#18181b" stroke-width="2"/>
  <text x="80" y="110" font-family="monospace" font-size="16" fill="#71717a" letter-spacing="4">{$tag} // {$category}</text>
  <line x1="80" y1="140" x2="1120" y2="140" stroke="#e4e4e7" stroke-width="2" />
  <rect x="80" y="200" width="80" height="80" fill="#18181b" />
  <circle cx="210" cy="240" r="40" fill="none" stroke="#18181b" stroke-width="8" />
  <polygon points="280,280 320,200 360,280" fill="#18181b" />
  <text x="80" y="400" font-family="system-ui, -apple-system, sans-serif" font-weight="800" font-size="42" fill="#09090b" letter-spacing="-1">{$title}</text>
  <text x="80" y="445" font-family="monospace" font-size="15" fill="#52525b">MONO ARCHIVE ESSENTIAL PERSPECTIVES ON FORM, UTILITY &amp; SIMPLICITY</text>
  <line x1="80" y1="510" x2="1120" y2="510" stroke="#e4e4e7" stroke-width="1" />
  <text x="80" y="545" font-family="monospace" font-size="13" fill="#71717a">CURATED BY MONO STUDIO EDITORIAL</text>
  <text x="1120" y="545" text-anchor="end" font-family="monospace" font-size="13" fill="#09090b">READING ARCHIVE</text>
</svg>
SVG;
    }
}
