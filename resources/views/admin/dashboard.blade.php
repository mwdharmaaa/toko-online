@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <div style="display:flex; justify-content:space-between; align-items:flex-end; margin-bottom: 28px;">
        <div>
            <span class="mono-label">RINGKASAN OPERASIONAL</span>
            <h1 style="font-size: 26px; margin-top: 4px;">Dashboard Administrator</h1>
            <p style="color: var(--text-muted); font-size: 14px; margin-top: 4px;">Status inventaris toko, katalog produk, dan publikasi jurnal.</p>
        </div>

        <div style="display:flex; gap:10px;">
            <a href="{{ route('admin.products.create') }}" class="btn btn-black btn-sm">+ Tambah Produk</a>
            <a href="{{ route('admin.settings.edit') }}" class="btn btn-outline btn-sm">Pengaturan WhatsApp</a>
        </div>
    </div>

    {{-- Stats Cards Grid --}}
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-label">Total Produk</div>
            <div class="stat-number">{{ $stats['total_products'] }}</div>
            <span class="mono-label" style="font-size:10px; color:var(--text-light);">{{ $stats['active_products'] }} Aktif di Katalog</span>
        </div>

        <div class="stat-card">
            <div class="stat-label">Peringatan Stok Rendah</div>
            <div class="stat-number" style="{{ $stats['low_stock'] > 0 ? 'color:#000000; font-weight:900;' : '' }}">
                {{ $stats['low_stock'] }}
            </div>
            <span class="mono-label" style="font-size:10px; color:var(--text-light);">&le; 5 Unit Tersisa</span>
        </div>

        <div class="stat-card">
            <div class="stat-label">Kategori Aktif</div>
            <div class="stat-number">{{ $stats['total_categories'] }}</div>
            <span class="mono-label" style="font-size:10px; color:var(--text-light);">Segmen Koleksi</span>
        </div>

        <div class="stat-card">
            <div class="stat-label">Artikel Jurnal</div>
            <div class="stat-number">{{ $stats['total_posts'] }}</div>
            <span class="mono-label" style="font-size:10px; color:var(--text-light);">{{ $stats['published_posts'] }} Terbit</span>
        </div>
    </div>

    {{-- Recent Products Table --}}
    <div class="table-card" style="margin-bottom: 32px;">
        <div class="table-header-box">
            <div>
                <span class="mono-label">INVENTARIS TERBARU</span>
                <h3 style="font-size: 16px; margin-top: 2px;">Daftar Produk Masuk</h3>
            </div>
            <a href="{{ route('admin.products.index') }}" class="btn btn-outline btn-sm">Buka Semua Produk</a>
        </div>

        <div class="table-responsive">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>SKU</th>
                        <th>Nama Produk</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Status</th>
                        <th style="text-align:right;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentProducts as $prod)
                        <tr>
                            <td><span class="mono-label">{{ $prod->sku }}</span></td>
                            <td>
                                <strong>{{ $prod->name }}</strong>
                            </td>
                            <td>{{ $prod->category->name ?? '-' }}</td>
                            <td><span style="font-family:var(--font-mono);">{{ $prod->formatted_price }}</span></td>
                            <td>
                                @if($prod->stock <= 5)
                                    <span class="badge badge-warning">{{ $prod->stock }} unit</span>
                                @else
                                    <span class="mono-label">{{ $prod->stock }} unit</span>
                                @endif
                            </td>
                            <td>
                                @if($prod->is_active)
                                    <span class="badge badge-dark">Aktif</span>
                                @else
                                    <span class="badge badge-subtle">Nonaktif</span>
                                @endif
                            </td>
                            <td style="text-align:right;">
                                <a href="{{ route('admin.products.edit', $prod->id) }}" class="btn btn-outline btn-sm" style="padding:4px 8px; font-size:11px;">Edit</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" style="text-align:center; padding:32px; color:var(--text-muted);">Belum ada data produk.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Recent Blog Articles Table --}}
    <div class="table-card">
        <div class="table-header-box">
            <div>
                <span class="mono-label">PUBLIKASI TERKINI</span>
                <h3 style="font-size: 16px; margin-top: 2px;">Artikel Jurnal Redaksi</h3>
            </div>
            <a href="{{ route('admin.blog.index') }}" class="btn btn-outline btn-sm">Buka Semua Artikel</a>
        </div>

        <div class="table-responsive">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Judul Artikel</th>
                        <th>Penulis</th>
                        <th>Estimasi Baca</th>
                        <th>Status</th>
                        <th style="text-align:right;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentPosts as $post)
                        <tr>
                            <td><strong>{{ $post->title }}</strong></td>
                            <td>{{ $post->author_name }}</td>
                            <td><span class="mono-label">{{ $post->reading_time_minutes }} Menit</span></td>
                            <td>
                                @if($post->is_published)
                                    <span class="badge badge-dark">Terbit</span>
                                @else
                                    <span class="badge badge-subtle">Draf</span>
                                @endif
                            </td>
                            <td style="text-align:right;">
                                <a href="{{ route('admin.blog.edit', $post->id) }}" class="btn btn-outline btn-sm" style="padding:4px 8px; font-size:11px;">Edit</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="text-align:center; padding:32px; color:var(--text-muted);">Belum ada artikel.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
