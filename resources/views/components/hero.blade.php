@props(['setting', 'productCount' => 0])

<section class="hero-box">
    <div class="container hero-grid">
        <div>
            <div class="hero-eyebrow">
                <span class="hero-dot"></span>
                <span>{{ $setting->store_tagline ?? 'Minimalist Online Store' }}</span>
            </div>
            <h1 class="hero-title">{{ $setting->welcome_title ?? 'Selamat Datang di Mono Archive' }}</h1>
            <p class="hero-subtitle">{{ $setting->welcome_subtitle ?? 'Katalog kurasi produk fungsional dengan material berkualitas tinggi.' }}</p>

            <div class="hero-cta-group">
                <a href="{{ route('products.index') }}" class="btn btn-black btn-lg">Jelajahi Katalog</a>
                <a href="{{ route('blog.index') }}" class="btn btn-outline btn-lg">Baca Jurnal</a>
            </div>
        </div>

        <div class="hero-stats-panel">
            <span class="mono-label">SPESIFIKASI OPERASIONAL</span>
            <div class="hero-stat-row" style="margin-top:14px;">
                <span style="font-size:13px; color:var(--text-muted);">Pemesanan Langsung</span>
                <span class="hero-stat-val">WhatsApp Admin</span>
            </div>
            <div class="hero-stat-row">
                <span style="font-size:13px; color:var(--text-muted);">Koleksi Aktif</span>
                <span class="hero-stat-val">{{ $productCount }}+ Item</span>
            </div>
        </div>
    </div>
</section>
