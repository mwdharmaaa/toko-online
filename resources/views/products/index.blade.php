@extends('layouts.app')

@section('title', 'Katalog Produk')

@section('content')
    <div class="container" style="padding-top: 40px; padding-bottom: 60px;">
        <div style="margin-bottom: 32px;">
            <span class="mono-label">ARSIP LENGKAP</span>
            <h1 style="font-size: 32px; margin-top: 4px;">Katalog Produk Mono Archive</h1>
            <p style="color: var(--text-muted); font-size: 15px; margin-top: 6px;">
                Eksplorasi seluruh pilihan produk bergaransi dengan spesifikasi industri dan kurasi monokrom.
            </p>
        </div>

        {{-- Filter & Search Bar --}}
        <div class="filter-bar">
            <div class="category-tabs">
                <a href="{{ route('products.index', array_merge(request()->except('category', 'page'))) }}"
                   class="cat-tab {{ !request('category') ? 'active' : '' }}">
                   Semua ({{ $products->total() }})
                </a>
                @foreach($categories as $cat)
                    <a href="{{ route('products.index', array_merge(request()->except('page'), ['category' => $cat->slug])) }}"
                       class="cat-tab {{ request('category') === $cat->slug ? 'active' : '' }}">
                       {{ $cat->name }} ({{ $cat->products_count }})
                    </a>
                @endforeach
            </div>

            <form action="{{ route('products.index') }}" method="GET" style="display:flex; align-items:center; gap:8px;">
                @if(request('category'))
                    <input type="hidden" name="category" value="{{ request('category') }}">
                @endif
                <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari produk / SKU..."
                       class="form-control" style="width: 220px; padding: 7px 12px; font-size: 13px;">

                <select name="sort" class="form-control" style="width: 170px; padding: 7px 10px; font-size: 13px;" onchange="this.form.submit()">
                    <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Urut: Terbaru</option>
                    <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Harga: Terendah</option>
                    <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Harga: Tertinggi</option>
                    <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Nama: A-Z</option>
                </select>

                <button type="submit" class="btn btn-black btn-sm" style="padding: 7px 14px;">Cari</button>
            </form>
        </div>

        {{-- Products Grid --}}
        @if($products->isEmpty())
            <div style="text-align: center; padding: 80px 20px; border: 1px dashed var(--border-hairline); margin-top: 32px;">
                <span class="mono-label">PENCARIAN KOSONG</span>
                <h3 style="margin-top: 8px;">Tidak ada produk yang cocok</h3>
                <p style="color: var(--text-muted); font-size: 14px; margin-top: 4px;">Coba gunakan kata kunci lain atau reset filter kategori.</p>
                <a href="{{ route('products.index') }}" class="btn btn-outline btn-sm" style="margin-top: 16px;">Reset Filter</a>
            </div>
        @else
            <div class="products-grid" style="margin-top: 32px;">
                @foreach($products as $product)
                    <x-product-card :product="$product" />
                @endforeach
            </div>

            {{-- Custom Clean Pagination --}}
            @if($products->hasPages())
                <div class="pagination-wrap">
                    @if($products->onFirstPage())
                        <span class="pagination-item" style="color:var(--text-light);">&laquo; Sebelumnya</span>
                    @else
                        <a href="{{ $products->previousPageUrl() }}" class="pagination-item">&laquo; Sebelumnya</a>
                    @endif

                    @foreach(range(1, $products->lastPage()) as $page)
                        @if($page == $products->currentPage())
                            <span class="pagination-item active">{{ $page }}</span>
                        @else
                            <a href="{{ $products->url($page) }}" class="pagination-item">{{ $page }}</a>
                        @endif
                    @endforeach

                    @if($products->hasMorePages())
                        <a href="{{ $products->nextPageUrl() }}" class="pagination-item">Berikutnya &raquo;</a>
                    @else
                        <span class="pagination-item" style="color:var(--text-light);">Berikutnya &raquo;</span>
                    @endif
                </div>
            @endif
        @endif
    </div>
@endsection
