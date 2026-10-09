<aside class="admin-sidebar">
    <div class="admin-sidebar-header">
        <a href="{{ route('admin.dashboard') }}" class="brand-link">
            <div class="brand-symbol"><div class="brand-symbol-inner"></div></div>
            <span class="brand-name">ADMIN STUDIO</span>
        </a>
    </div>

    <nav class="admin-nav">
        <a href="{{ route('admin.dashboard') }}" class="admin-nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">Dashboard</a>
        <a href="{{ route('admin.products.index') }}" class="admin-nav-item {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">Kelola Produk</a>
        <a href="{{ route('admin.categories.index') }}" class="admin-nav-item {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">Kategori</a>
        <a href="{{ route('admin.blog.index') }}" class="admin-nav-item {{ request()->routeIs('admin.blog.*') ? 'active' : '' }}">Artikel Blog</a>
        <a href="{{ route('admin.settings.edit') }}" class="admin-nav-item {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">Pengaturan &amp; WA</a>
    </nav>
</aside>
