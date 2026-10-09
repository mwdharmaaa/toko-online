@props(['product'])

<article class="product-card">
    <a href="{{ route('products.show', $product->slug) }}" class="product-thumb-wrap">
        @if($product->is_featured)
            <span class="card-badge">Pilihan</span>
        @elseif($product->stock <= 0)
            <span class="card-badge" style="background:#52525b;">Habis</span>
        @endif

        @if($product->image_url)
            <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="product-thumb" loading="lazy">
        @else
            <div style="display:flex;align-items:center;justify-content:center;width:100%;height:100%;background:#f4f4f5;color:#71717a;font-family:var(--font-mono);font-size:11px;">
                NO ASSET
            </div>
        @endif
    </a>

    <div class="card-body">
        <span class="card-category">{{ $product->category->name ?? 'Esensial' }}</span>
        <h3 class="card-title">
            <a href="{{ route('products.show', $product->slug) }}">{{ $product->name }}</a>
        </h3>

        <div class="card-footer">
            <span class="card-price">{{ $product->formatted_price }}</span>
            <span class="card-stock">
                @if($product->stock > 0)
                    Stok: {{ $product->stock }}
                @else
                    Stok Habis
                @endif
            </span>
        </div>
    </div>
</article>
