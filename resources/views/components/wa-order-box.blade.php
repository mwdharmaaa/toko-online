@props(['product', 'setting', 'initialWhatsAppUrl'])

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
        <a href="{{ $initialWhatsAppUrl }}" id="wa-submit-button" target="_blank" rel="noopener" class="btn btn-black btn-block" style="padding:13px 18px;">
            <span>Pesan via WhatsApp Sekarang</span>
        </a>
        <button type="button" id="wa-copy-button" class="btn btn-outline" style="padding:13px 18px;" title="Salin Teks">
            Salin
        </button>
    </div>
</div>
