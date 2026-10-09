@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
    {{-- Hero Section: Ucapan Selamat Datang --}}
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
                    <a href="{{ route('products.index') }}" class="btn btn-black btn-lg">
                        <span>Jelajahi Katalog Produk</span>
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                    </a>
                    <a href="{{ route('blog.index') }}" class="btn btn-outline btn-lg">Baca Jurnal</a>
                </div>
            </div>

            <div class="hero-stats-panel">
                <span class="mono-label">SPESIFIKASI OPERASIONAL TOKO</span>
                <div class="hero-stat-row" style="margin-top:14px;">
                    <span style="font-size:13px; color:var(--text-muted);">Pemesanan Langsung</span>
                    <span class="hero-stat-val">WhatsApp Admin</span>
                </div>
                <div class="hero-stat-row">
                    <span style="font-size:13px; color:var(--text-muted);">Format Pesan Otomatis</span>
                    <span class="hero-stat-val">Tersedia Instant</span>
                </div>
                <div class="hero-stat-row">
                    <span style="font-size:13px; color:var(--text-muted);">Total Koleksi Aktif</span>
                    <span class="hero-stat-val">{{ $recentProducts->count() }}+ Item</span>
                </div>
                <div class="hero-stat-row">
                    <span style="font-size:13px; color:var(--text-muted);">Jangkauan Kirim</span>
                    <span class="hero-stat-val">Seluruh Indonesia</span>
                </div>
            </div>
        </div>
    </section>

    {{-- Value Proposition Bar --}}
    <section class="border-b" style="background-color: var(--bg-surface); padding: 24px 0;">
        <div class="container" style="display: flex; justify-content: space-between; flex-wrap: wrap; gap: 20px;">
            <div style="display:flex; align-items:center; gap:12px;">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"></polyline></svg>
                <span style="font-size:13px; font-weight:600;">Jaminan Material Orisinal</span>
            </div>
            <div style="display:flex; align-items:center; gap:12px;">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>
                <span style="font-size:13px; font-weight:600;">Respon WhatsApp Cepat &amp; Ramah</span>
            </div>
            <div style="display:flex; align-items:center; gap:12px;">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="3" width="15" height="13"></rect><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon><circle cx="5.5" cy="18.5" r="2.5"></circle><circle cx="18.5" cy="18.5" r="2.5"></circle></svg>
                <span style="font-size:13px; font-weight:600;">Pengemasan Ekstra Aman</span>
            </div>
        </div>
    </section>

    {{-- Featured Products Showcase --}}
    @if($featuredProducts->isNotEmpty())
        <section class="section-spacer border-b">
            <div class="container">
                <div style="display:flex; justify-content:space-between; align-items:flex-end; margin-bottom: 28px;">
                    <div>
                        <span class="mono-label">KURASI PILIHAN</span>
                        <h2 style="font-size: 26px; margin-top: 4px;">Produk Unggulan</h2>
                    </div>
                    <a href="{{ route('products.index') }}" class="btn btn-outline btn-sm">Lihat Semua Katalog</a>
                </div>

                <div class="products-grid">
                    @foreach($featuredProducts as $product)
                        <x-product-card :product="$product" />
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- Latest Products Section --}}
    <section class="section-spacer border-b">
        <div class="container">
            <div style="display:flex; justify-content:space-between; align-items:flex-end; margin-bottom: 24px;">
                <div>
                    <span class="mono-label">DAFTAR PRODUK TERBARU</span>
                    <h2 style="font-size: 26px; margin-top: 4px;">Koleksi yang Dijual</h2>
                </div>
                <div class="category-tabs">
                    <a href="{{ route('products.index') }}" class="cat-tab active">Semua Kategori</a>
                    @foreach($categories->take(4) as $cat)
                        <a href="{{ route('products.index', ['category' => $cat->slug]) }}" class="cat-tab">{{ $cat->name }}</a>
                    @endforeach
                </div>
            </div>

            <div class="products-grid">
                @foreach($recentProducts as $product)
                    <x-product-card :product="$product" />
                @endforeach
            </div>

            <div style="text-align: center; margin-top: 40px;">
                <a href="{{ route('products.index') }}" class="btn btn-black btn-lg">Buka Katalog Lengkap ({{ $recentProducts->count() }}+ Produk)</a>
            </div>
        </div>
    </section>

    {{-- Latest Blog Posts Preview --}}
    @if($latestPosts->isNotEmpty())
        <section class="section-spacer">
            <div class="container">
                <div style="display:flex; justify-content:space-between; align-items:flex-end; margin-bottom: 28px;">
                    <div>
                        <span class="mono-label">JURNAL REDAKSI</span>
                        <h2 style="font-size: 26px; margin-top: 4px;">Artikel &amp; Catatan Desain</h2>
                    </div>
                    <a href="{{ route('blog.index') }}" class="btn btn-outline btn-sm">Buka Halaman Blog</a>
                </div>

                <div class="blog-grid">
                    @foreach($latestPosts as $post)
                        <article class="blog-card">
                            <a href="{{ route('blog.show', $post->slug) }}" class="blog-thumb-wrap">
                                @if($post->cover_image_url)
                                    <img src="{{ $post->cover_image_url }}" alt="{{ $post->title }}" loading="lazy">
                                @endif
                            </a>
                            <div class="blog-body">
                                <span class="mono-label" style="font-size:10px;">{{ $post->published_at ? $post->published_at->format('d M Y') : 'Terbit' }} &bull; {{ $post->reading_time_minutes }} Menit Baca</span>
                                <h3 class="blog-title">
                                    <a href="{{ route('blog.show', $post->slug) }}">{{ $post->title }}</a>
                                </h3>
                                <p class="blog-excerpt">{{ Str::limit($post->excerpt, 110) }}</p>
                                <a href="{{ route('blog.show', $post->slug) }}" class="btn btn-outline btn-sm" style="margin-top:auto; width:fit-content;">Baca Artikel &rarr;</a>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
@endsection
