@props(['setting'])

<header class="site-header">
    <div class="container nav-wrap">
        <a href="{{ route('home') }}" class="brand-link">
            <div class="brand-symbol">
                <div class="brand-symbol-inner"></div>
            </div>
            <span class="brand-name">{{ $setting->store_name ?? 'MONO ARCHIVE' }}</span>
        </a>

        <nav>
            <ul class="nav-links">
                <li><a href="{{ route('home') }}" class="nav-item-link {{ request()->routeIs('home') ? 'active' : '' }}">Beranda</a></li>
                <li><a href="{{ route('products.index') }}" class="nav-item-link {{ request()->routeIs('products.*') ? 'active' : '' }}">Katalog Produk</a></li>
                <li><a href="{{ route('blog.index') }}" class="nav-item-link {{ request()->routeIs('blog.*') ? 'active' : '' }}">Jurnal &amp; Blog</a></li>
            </ul>
        </nav>

        <div class="nav-actions">
            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $setting->whatsapp_number ?? '6281234567890') }}" target="_blank" rel="noopener" class="btn btn-black btn-sm">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path></svg>
                <span>Hubungi Admin</span>
            </a>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-outline btn-sm">Admin</a>
        </div>
    </div>
</header>
