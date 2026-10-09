<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Carry & Bags',
                'slug' => 'carry-and-bags',
                'description' => 'Tas jinjing, ransel harian, dan organizer multifungsi berbahan kanvas dan balistik nilon premium.',
                'is_active' => true,
            ],
            [
                'name' => 'Apparel & Wear',
                'slug' => 'apparel-and-wear',
                'description' => 'Pakaian esensial dengan potongan rileks, material katun berat, dan konstruksi jahitan presisi.',
                'is_active' => true,
            ],
            [
                'name' => 'Stationery & Desk',
                'slug' => 'stationery-and-desk',
                'description' => 'Alat tulis, notebook bersampul keras, dan aksesori meja kerja bernuansa monokrom.',
                'is_active' => true,
            ],
            [
                'name' => 'Living & Objects',
                'slug' => 'living-and-objects',
                'description' => 'Tumbler stainless, cangkir keramik matte, dan objek dekoratif fungsional untuk ruang harian.',
                'is_active' => true,
            ],
            [
                'name' => 'Accessories',
                'slug' => 'accessories',
                'description' => 'Dompet kartu kulit, gantungan kunci matte, dan pelengkap gaya hidup minimalis.',
                'is_active' => true,
            ],
        ];

        foreach ($categories as $data) {
            Category::query()->updateOrCreate(['slug' => $data['slug']], $data);
        }
    }
}
