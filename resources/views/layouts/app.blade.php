<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'MONO ARCHIVE') - {{ $setting->store_name ?? 'Minimalist Online Store' }}</title>
    <meta name="description" content="@yield('meta_description', $setting->welcome_subtitle ?? 'Katalog produk esensial monokrom fungsional.')">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @stack('styles')
</head>
<body>
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
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path>
                    </svg>
                    <span>Hubungi Admin</span>
                </a>
                <a href="{{ route('admin.dashboard') }}" class="btn btn-outline btn-sm" title="Panel Administrator">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="3" width="7" height="7"></rect>
                        <rect x="14" y="3" width="7" height="7"></rect>
                        <rect x="14" y="14" width="7" height="7"></rect>
                        <rect x="3" y="14" width="7" height="7"></rect>
                    </svg>
                    <span>Admin</span>
                </a>
            </div>
        </div>
    </header>

    @if(session('success'))
        <div class="container" style="margin-top: 20px;">
            <div class="alert alert-success">
                <span>{{ session('success') }}</span>
                <button type="button" onclick="this.parentElement.remove()" style="background:none;border:none;cursor:pointer;">[x]</button>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="container" style="margin-top: 20px;">
            <div class="alert alert-error">
                <span>{{ session('error') }}</span>
                <button type="button" onclick="this.parentElement.remove()" style="background:none;border:none;cursor:pointer;">[x]</button>
            </div>
        </div>
    @endif

    <main>
        @yield('content')
    </main>

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
                    <li class="footer-link-item"><a href="{{ route('admin.dashboard') }}">Login Administrator</a></li>
                </ul>
            </div>

            <div>
                <h4 class="footer-heading">Layanan &amp; Order</h4>
                <ul class="footer-links">
                    <li class="footer-link-item"><a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $setting->whatsapp_number ?? '6281234567890') }}" target="_blank" rel="noopener">WhatsApp: +{{ $setting->whatsapp_number }}</a></li>
                    <li class="footer-link-item"><a href="mailto:{{ $setting->store_email ?? 'contact@monoarchive.id' }}">{{ $setting->store_email }}</a></li>
                    <li class="footer-link-item"><span style="color:#a1a1aa;">Pengiriman Seluruh Indonesia</span></li>
                </ul>
            </div>
        </div>

        <div class="container footer-bottom">
            <span>&copy; {{ date('Y') }} {{ $setting->store_name ?? 'MONO ARCHIVE' }}. All rights reserved.</span>
            <span>Estetika Monokrom Murni. Zero AI Slop.</span>
        </div>
    </footer>

    <div id="global-toast" class="toast"></div>

    <script src="{{ asset('js/app.js') }}"></script>
    @stack('scripts')
</body>
</html>
