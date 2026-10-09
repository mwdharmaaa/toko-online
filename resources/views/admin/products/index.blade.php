@extends('layouts.admin')

@section('title', 'Kelola Produk')

@section('content')
    <div style="display:flex; justify-content:space-between; align-items:flex-end; margin-bottom: 28px;">
        <div>
            <span class="mono-label">MANAJEMEN INVENTARIS</span>
            <h1 style="font-size: 26px; margin-top: 4px;">Katalog Produk</h1>
            <p style="color: var(--text-muted); font-size: 14px; margin-top: 4px;">Kelola harga, stok, spesifikasi, dan aset foto seluruh produk.</p>
        </div>

        <a href="{{ route('admin.products.create') }}" class="btn btn-black btn-sm">+ Tambah Produk Baru</a>
    </div>

    {{-- Filter Bar --}}
    <div class="table-card" style="margin-bottom: 24px; padding: 16px 20px;">
        <form action="{{ route('admin.products.index') }}" method="GET" style="display:flex; gap:12px; align-items:center; flex-wrap:wrap;">
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari nama atau SKU..." class="form-control" style="width:240px; padding:7px 12px; font-size:13px;">

            <select name="category" class="form-control" style="width:200px; padding:7px 12px; font-size:13px;" onchange="this.form.submit()">
                <option value="">Semua Kategori</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                @endforeach
            </select>

            <button type="submit" class="btn btn-black btn-sm">Filter</button>
            @if(request('q') || request('category'))
                <a href="{{ route('admin.products.index') }}" class="btn btn-outline btn-sm">Reset</a>
            @endif
        </form>
    </div>

    {{-- Products Table --}}
    <div class="table-card">
        <div class="table-responsive">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th style="width:60px;">Foto</th>
                        <th>SKU</th>
                        <th>Nama Produk</th>
                        <th>Kategori</th>
                        <th>Harga Satuan</th>
                        <th>Stok</th>
                        <th>Status</th>
                        <th style="text-align:right;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $prod)
                        <tr>
                            <td>
                                <div style="width:40px; height:40px; border:1px solid var(--border-hairline); background:#fafafa; display:flex; align-items:center; justify-content:center; overflow:hidden;">
                                    @if($prod->image_url)
                                        <img src="{{ $prod->image_url }}" alt="{{ $prod->name }}" style="width:100%; height:100%; object-fit:cover;">
                                    @else
                                        <span style="font-family:var(--font-mono); font-size:9px;">NA</span>
                                    @endif
                                </div>
                            </td>
                            <td><span class="mono-label">{{ $prod->sku }}</span></td>
                            <td>
                                <strong>{{ $prod->name }}</strong>
                                @if($prod->is_featured)
                                    <span class="badge badge-dark" style="margin-left:6px; font-size:9px;">Pilihan</span>
                                @endif
                            </td>
                            <td>{{ $prod->category->name ?? '-' }}</td>
                            <td><span style="font-family:var(--font-mono);">{{ $prod->formatted_price }}</span></td>
                            <td>
                                @if($prod->stock <= 0)
                                    <span class="badge badge-warning">Habis</span>
                                @elseif($prod->stock <= 5)
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
                            <td style="text-align:right; white-space:nowrap;">
                                <a href="{{ route('products.show', $prod->slug) }}" target="_blank" class="btn btn-outline btn-sm" style="padding:4px 8px; font-size:11px;" title="Lihat di Toko">Lihat</a>
                                <a href="{{ route('admin.products.edit', $prod->id) }}" class="btn btn-outline btn-sm" style="padding:4px 8px; font-size:11px;">Edit</a>
                                <form action="{{ route('admin.products.destroy', $prod->id) }}" method="POST" style="display:inline;" data-confirm="Hapus produk '{{ $prod->name }}'? Tindakan ini tidak dapat dibatalkan.">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline btn-sm" style="padding:4px 8px; font-size:11px; color:#000000;">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" style="text-align:center; padding:40px; color:var(--text-muted);">Tidak ada data produk yang sesuai.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if($products->hasPages())
        <div class="pagination-wrap">
            {{ $products->links() }}
        </div>
    @endif
@endsection
