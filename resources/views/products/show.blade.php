@extends('layouts.app')

@section('title', $product->name)
@section('meta_description', Str::limit($product->summary ?? $product->description, 150))

@section('content')
    <div class="container" style="padding-top: 36px; padding-bottom: 70px;">
        {{-- Breadcrumb --}}
        <div style="display:flex; align-items:center; gap:8px; font-size:13px; color:var(--text-muted); margin-bottom: 28px;">
            <a href="{{ route('home') }}">Beranda</a>
            <span>/</span>
            <a href="{{ route('products.index') }}">Katalog</a>
            <span>/</span>
            <a href="{{ route('products.index', ['category' => $product->category->slug ?? '']) }}">{{ $product->category->name ?? 'Esensial' }}</a>
            <span>/</span>
            <span style="color:var(--text-main);">{{ $product->name }}</span>
        </div>

        <div class="product-detail-grid">
            {{-- Left Column: Product Visuals & Specs --}}
            <div>
                <div class="detail-gallery-main">
                    @if($product->image_url)
                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}" id="main-product-image">
                    @else
                        <div style="font-family:var(--font-mono); color:var(--text-muted);">TIDAK ADA GAMBAR</div>
                    @endif
                </div>

                @if(!empty($product->specifications))
                    <div style="margin-top: 36px;">
                        <span class="mono-label">SPESIFIKASI TEKNIS</span>
                        <table class="detail-specs-table">
                            <tbody>
                                @foreach($product->specifications as $specKey => $specVal)
                                    <tr>
                                        <th>{{ $specKey }}</th>
                                        <td>{{ $specVal }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>

            {{-- Right Column: Information & WhatsApp Order Box --}}
            <div>
                <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom: 8px;">
                    <span class="mono-label">{{ $product->category->name ?? 'Produk Esensial' }} // SKU: {{ $product->sku }}</span>
                    @if($product->stock > 0)
                        <span class="badge badge-dark">Stok Tersedia ({{ $product->stock }})</span>
                    @else
                        <span class="badge badge-warning">Stok Habis</span>
                    @endif
                </div>

                <h1 style="font-size: 32px; margin-bottom: 12px; line-height: 1.2;">{{ $product->name }}</h1>

                <div style="margin-bottom: 20px;">
                    <span style="font-family:var(--font-mono); font-size: 26px; font-weight:800;">{{ $product->formatted_price }}</span>
                </div>

                @if($product->summary)
                    <p style="font-size: 15px; color: var(--text-muted); line-height: 1.6; margin-bottom: 20px; border-left: 2px solid var(--border-strong); padding-left: 14px;">
                        {{ $product->summary }}
                    </p>
                @endif

                <div style="border-top: 1px solid var(--border-hairline); padding-top: 20px; margin-bottom: 24px;">
                    <span class="mono-label" style="margin-bottom: 8px; display:block;">DESKRIPSI DETAIL</span>
                    <div style="font-size: 14px; line-height: 1.7; color: var(--text-main); white-space: pre-line;">{{ $product->description }}</div>
                </div>

                {{-- Interactive WhatsApp Order Box --}}
                <div class="wa-order-box"
                     id="wa-order-builder"
                     data-template="{{ $setting->whatsapp_message_template }}"
                     data-phone="{{ $setting->whatsapp_number }}"
                     data-product-name="{{ $product->name }}"
                     data-product-sku="{{ $product->sku }}"
                     data-price="{{ $product->price }}"
                     data-product-url="{{ url()->current() }}"
                     data-store-name="{{ $setting->store_name }}"
                     data-stock="{{ $product->stock }}">

                    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:12px;">
                        <span class="mono-label" style="color:var(--text-main); font-weight:700;">PEMESANAN VIA WHATSAPP RESMI</span>
                        <span class="badge badge-subtle">Admin Online</span>
                    </div>

                    <div style="display:grid; grid-template-columns: auto 1fr; gap:16px; align-items:flex-end; margin-bottom:14px;">
                        <div>
                            <label class="form-label" style="font-size:12px;">Jumlah (Qty):</label>
                            <div class="qty-control">
                                <button type="button" class="qty-btn" id="wa-qty-minus">-</button>
                                <input type="number" id="wa-qty-input" value="1" min="1" max="{{ max(1, $product->stock) }}" class="qty-input">
                                <button type="button" class="qty-btn" id="wa-qty-plus">+</button>
                            </div>
                        </div>

                        <div>
                            <label class="form-label" style="font-size:12px;">Catatan Khusus (Opsi/Ukuran):</label>
                            <input type="text" id="wa-notes-input" placeholder="Contoh: Warna Hitam / Ukuran L" class="form-control" style="padding:7px 12px; font-size:13px;">
                        </div>
                    </div>

                    <label class="form-label" style="font-size:12px; margin-bottom:4px;">Pratinjau Format Pesan Otomatis:</label>
                    <pre class="wa-preview-box" id="wa-message-preview"></pre>

                    <div style="display:flex; gap:10px; margin-top:14px;">
                        <a href="{{ $initialWhatsAppUrl }}"
                           id="wa-submit-button"
                           target="_blank"
                           rel="noopener"
                           class="btn btn-black btn-block"
                           style="padding:13px 18px; font-size:14px;">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path>
                            </svg>
                            <span>Pesan via WhatsApp Sekarang</span>
                        </a>

                        <button type="button" id="wa-copy-button" class="btn btn-outline" style="padding:13px 18px;" title="Salin Teks Pesan">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path></svg>
                        </button>
                    </div>

                    <p style="font-size:11px; color:var(--text-muted); margin-top:10px; text-align:center;">
                        Klik tombol untuk langsung membuka WhatsApp chat bersama nomor admin +{{ $setting->whatsapp_number }}.
                    </p>
                </div>
            </div>
        </div>

        {{-- Related Products --}}
        @if($relatedProducts->isNotEmpty())
            <div style="margin-top: 80px; border-top: 1px solid var(--border-hairline); padding-top: 40px;">
                <div style="display:flex; justify-content:space-between; align-items:flex-end; margin-bottom: 24px;">
                    <div>
                        <span class="mono-label">KOLEKSI SERUPA</span>
                        <h2 style="font-size: 22px; margin-top: 4px;">Produk Terkait Lainnya</h2>
                    </div>
                    <a href="{{ route('products.index', ['category' => $product->category->slug ?? '']) }}" class="btn btn-outline btn-sm">Lihat Kategori Ini</a>
                </div>

                <div class="products-grid">
                    @foreach($relatedProducts as $rel)
                        <x-product-card :product="$rel" />
                    @endforeach
                </div>
            </div>
        @endif
    </div>
@endsection
