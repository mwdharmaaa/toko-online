@extends('layouts.admin')

@section('title', 'Kategori Produk')

@section('content')
    <div style="display:flex; justify-content:space-between; align-items:flex-end; margin-bottom: 28px;">
        <div>
            <span class="mono-label">PENGELOMPOKAN KOLEKSI</span>
            <h1 style="font-size: 26px; margin-top: 4px;">Kategori Produk</h1>
            <p style="color: var(--text-muted); font-size: 14px; margin-top: 4px;">Kelola taksonomi kategori untuk penyaringan di etalase toko.</p>
        </div>

        <a href="{{ route('admin.categories.create') }}" class="btn btn-black btn-sm">+ Tambah Kategori</a>
    </div>

    <div class="table-card">
        <div class="table-responsive">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Nama Kategori</th>
                        <th>Slug URL</th>
                        <th>Deskripsi</th>
                        <th>Jumlah Produk</th>
                        <th>Status</th>
                        <th style="text-align:right;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $cat)
                        <tr>
                            <td><strong>{{ $cat->name }}</strong></td>
                            <td><span class="mono-label">{{ $cat->slug }}</span></td>
                            <td><span style="font-size:13px; color:var(--text-muted);">{{ Str::limit($cat->description, 60) ?? '-' }}</span></td>
                            <td><span class="mono-label">{{ $cat->products_count }} item</span></td>
                            <td>
                                @if($cat->is_active)
                                    <span class="badge badge-dark">Aktif</span>
                                @else
                                    <span class="badge badge-subtle">Nonaktif</span>
                                @endif
                            </td>
                            <td style="text-align:right; white-space:nowrap;">
                                <a href="{{ route('admin.categories.edit', $cat->id) }}" class="btn btn-outline btn-sm" style="padding:4px 8px; font-size:11px;">Edit</a>
                                <form action="{{ route('admin.categories.destroy', $cat->id) }}" method="POST" style="display:inline;" data-confirm="Hapus kategori '{{ $cat->name }}'? Produk di dalamnya tidak akan terhapus.">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline btn-sm" style="padding:4px 8px; font-size:11px; color:#000000;">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align:center; padding:36px; color:var(--text-muted);">Belum ada kategori yang terdaftar.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
