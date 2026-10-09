<?php

namespace Database\Seeders;

use App\Models\BlogPost;
use Illuminate\Database\Seeder;

class BlogPostSeeder extends Seeder
{
    public function run(): void
    {
        $posts = [
            [
                'title' => 'Filosofi Monokrom: Mengapa Hitam dan Putih Mengeliminasi Distraksi',
                'slug' => 'filosofi-monokrom-mengapa-hitam-dan-putih-mengeliminasi-distraksi',
                'excerpt' => 'Mengeksplorasi alasan psikologis dan fungsional di balik pemilihan palet biner hitam-putih dalam perancangan produk fungsional harian.',
                'content' => "Dalam hiruk pikuk visual era modern, warna kerap menjadi stimulus yang membebani kognisi manusia. Setiap hari kita dibombardir oleh ribuan gradien warna-warni yang berebut perhatian.

Pendekatan monokrom - membatasi palet visual hanya pada hitam, putih, dan spektrum abu-abu terkalibrasi - bukan sekadar pilihan gaya atau tren sesaat. Ini adalah sebuah komitmen reduksi esensial.

Ketika sebuah objek kehilangan warna kromatiknya, hal yang tersisa adalah esensi bentuk, proporsi, tekstur material, dan kejujuran konstruksi. Sebuah tas kanvas tidak lagi dinilai dari seberapa mencolok warnanya di jalan raya, melainkan dari kerapatan rajutan benang, ketebalan lapisan lilin pelindung cuaca, dan ketahanan sambungan bar-tack pada tali jinjingnya.

Dengan menghilangkan warna yang berlebihan, kita mengembalikan fokus pengguna pada apa yang benar-benar penting: fungsi objek dalam mendukung kehidupan sehari-hari secara tenang dan tanpa friksi.",
                'cover_image' => 'images/blog/blog-1.svg',
                'author_name' => 'Studio Editorial',
                'reading_time_minutes' => 4,
                'is_published' => true,
                'published_at' => now()->subDays(5),
            ],
            [
                'title' => 'Panduan Perawatan Material Kanvas Berat dan Kulit Nabati',
                'slug' => 'panduan-perawatan-material-kanvas-berat-dan-kulit-nabati',
                'excerpt' => 'Langkah praktis merawat objek harian berbahan natural agar bertahan lebih dari satu dekade pemakaian intensif.',
                'content' => "Barang-barang berkualitas tinggi tidak diciptakan untuk sekali pakai lalu dibuang. Mereka dirancang untuk menua dengan anggun bersama penggunanya.

1. Kanvas Katun Berat (16oz - 20oz)
Hindari mencuci tas kanvas menggunakan mesin cuci berkecepatan tinggi. Putaran mesin yang kasar dapat merusak struktur serat katun dan melemahkan pelapis pelindung air. Cukup gunakan sikat berbulu kuda halus, air dingin, dan sabun ber-pH netral untuk membersihkan noda setempat (spot clean). Keringkan di tempat teduh dengan sirkulasi udara yang baik.

2. Kulit Nabati (Vegetable Tanned Leather)
Kulit samak nabati adalah material hidup. Jauhkan dari paparan sinar matahari terik langsung dalam waktu lama dan hindari kontak cairan berkadar asam tinggi. Oleskan balsem kulit berbasis lilin lebah (beeswax conditioner) tipis-tipis setiap 4 hingga 6 bulan sekali untuk menjaga kelenturan dan mencegah retakan mikroskopis.

Dengan perawatan yang sadar, objek-objek ini tidak hanya awet, namun akan membentuk jejak pemakaian (patina) unik yang menjadi catatan perjalanan pemiliknya.",
                'cover_image' => 'images/blog/blog-2.svg',
                'author_name' => 'Workshop Artisan',
                'reading_time_minutes' => 5,
                'is_published' => true,
                'published_at' => now()->subDays(3),
            ],
            [
                'title' => 'Anatomi Daily Carry Urban: Menata Perlengkapan Tanpa Bobot Ekstra',
                'slug' => 'anatomi-daily-carry-urban-menata-perlengkapan-tanpa-bobot-ekstra',
                'excerpt' => 'Audit kritis terhadap barang bawaan dalam ransel kerja untuk efisiensi fisik dan kejernihan pikiran.',
                'content' => "Berapa banyak barang di dalam tas ransel Anda yang sebenarnya tidak pernah disentuh selama seminggu penuh?

Konsep Everyday Carry (EDC) modern sering terjebak dalam perangkap 'just in case' - kita membawa perkakas berlebih atas dasar kecemasan skenario hipotetis. Dampaknya adalah beban pundak yang berat dan energi mental yang terkuras hanya untuk mencari kabel pengisi daya di dasar tas.

Mulailah dengan audit biner 3 kategori:
- Mutlak Digunakan Setiap Hari: Laptop/alat kerja utama, dompet kartu ramping, botol hidrasi terisolasi, pena bermesin presisi.
- Diperlukan Secara Berkala: Pengisi daya berdaya tinggi yang ringkas (GaN), payung lipat monokrom, obat pribadi.
- Ilusi Kebutuhan: Tumpukan kartu nama kadaluwarsa, kabel cadangan ganda, notebook saku yang kosong.

Gunakan kompartemen organizer terdedikasi agar setiap benda memiliki rumah tetap. Saat tas terorganisir, mobilitas terasa ringan dan fokus kerja meningkat tajam.",
                'cover_image' => 'images/blog/blog-3.svg',
                'author_name' => 'Ergonomics Lab',
                'reading_time_minutes' => 4,
                'is_published' => true,
                'published_at' => now()->subDay(),
            ],
            [
                'title' => 'Mengapa Prinsip Less is More Selalu Bertahan Sepanjang Zaman',
                'slug' => 'mengapa-prinsip-less-is-more-selalu-bertahan-sepanjang-zaman',
                'excerpt' => 'Refleksi atas pemikiran Mies van der Rohe dan Dieter Rams dalam konteks konsumsi bertanggung jawab abad ke-21.',
                'content' => "Dieter Rams pernah merumuskan prinsip kesepuluhnya yang terkenal: 'Good design is as little design as possible'. Kesederhanaan bukan berarti ketiadaan fitur, melainkan kemurnian fungsi tanpa kepura-puraan.

Dalam dunia ritel dan e-commerce saat ini yang dipenuhi produk berumur pendek, komitmen untuk memproduksi dan mengonsumsi lebih sedikit namun dengan mutu yang jauh lebih baik adalah bentuk perlawanan rasional.

Objek esensial yang baik tidak berteriak mencari pengakuan. Ia hadir tenang di atas meja, menjalankan fungsinya dengan andal ketika dibutuhkan, dan berbaur harmonis dengan lingkungan sekitarnya. Itulah tujuan akhir dari setiap kurasi di Mono Archive.",
                'cover_image' => 'images/blog/blog-4.svg',
                'author_name' => 'Studio Editorial',
                'reading_time_minutes' => 3,
                'is_published' => true,
                'published_at' => now(),
            ],
        ];

        foreach ($posts as $data) {
            BlogPost::query()->updateOrCreate(['slug' => $data['slug']], $data);
        }
    }
}
