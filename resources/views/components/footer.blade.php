@props(['setting'])

<footer class="site-footer">
    <div class="container footer-grid">
        <div>
            <div class="brand-link" style="margin-bottom: 12px;">
                <div class="brand-symbol" style="background-color:#ffffff;">
                    <div class="brand-symbol-inner" style="background-color:#09090b;"></div>
                </div>
                <span class="brand-name" style="color:#ffffff;">{{ $setting->store_name ?? 'MONO ARCHIVE' }}</span>
            </div>
            <p class="footer-text">{{ $setting->store_tagline ?? 'Minimalist Essentials & Curated Objects' }}</p>
            <p class="footer-text" style="font-size:13px; color:#71717a; margin-top:8px;">{{ $setting->store_address }}</p>
        </div>

        <div>
            <h4 class="footer-heading">Navigasi Katalog</h4>
            <ul class="footer-links">
                <li class="footer-link-item"><a href="{{ route('home') }}">Beranda Depan</a></li>
                <li class="footer-link-item"><a href="{{ route('products.index') }}">Semua Produk</a></li>
                <li class="footer-link-item"><a href="{{ route('blog.index') }}">Jurnal Redaksi</a></li>
            </ul>
        </div>

        <div>
            <h4 class="footer-heading">Layanan &amp; Order</h4>
            <ul class="footer-links">
                <li class="footer-link-item"><a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $setting->whatsapp_number ?? '6281234567890') }}" target="_blank">WhatsApp: +{{ $setting->whatsapp_number }}</a></li>
                <li class="footer-link-item"><a href="mailto:{{ $setting->store_email }}">{{ $setting->store_email }}</a></li>
            </ul>
        </div>
    </div>

    <div class="container footer-bottom">
        <span>&copy; {{ date('Y') }} {{ $setting->store_name ?? 'MONO ARCHIVE' }}. All rights reserved.</span>
        <span>Estetika Monokrom Murni. Zero AI Slop.</span>
    </div>
</footer>
