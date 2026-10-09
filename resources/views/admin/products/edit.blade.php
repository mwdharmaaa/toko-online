@extends('layouts.admin')

@section('title', 'Edit Produk: ' . $product->name)

@section('content')
    <div style="margin-bottom: 24px;">
        <span class="mono-label">PENGEDITAN DATA</span>
        <h1 style="font-size: 24px; margin-top: 4px;">Edit Produk: {{ $product->name }}</h1>
    </div>

    <div class="table-card" style="padding: 32px; max-width: 900px;">
        <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div style="display:grid; grid-template-columns: 2fr 1fr; gap:20px;">
                <div class="form-group">
                    <label for="name" class="form-label">Nama Produk *</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $product->name) }}" required class="form-control">
                    @error('name') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="category_id" class="form-label">Kategori *</label>
                    <select id="category_id" name="category_id" class="form-control" required>
                        <option value="">Pilih Kategori</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('category_id', $product->category_id) == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id') <div class="form-error">{{ $message }}</div> @enderror
                </div>
            </div>

            <div style="display:grid; grid-template-columns: 1fr 1fr 1fr; gap:20px;">
                <div class="form-group">
                    <label for="sku" class="form-label">SKU Produk *</label>
                    <input type="text" id="sku" name="sku" value="{{ old('sku', $product->sku) }}" class="form-control" required>
                    @error('sku') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="price" class="form-label">Harga (IDR) *</label>
                    <input type="number" id="price" name="price" value="{{ old('price', $product->price) }}" required min="0" step="1000" class="form-control">
                    @error('price') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="stock" class="form-label">Jumlah Stok *</label>
                    <input type="number" id="stock" name="stock" value="{{ old('stock', $product->stock) }}" required min="0" class="form-control">
                    @error('stock') <div class="form-error">{{ $message }}</div> @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="summary" class="form-label">Ringkasan Singkat (Summary)</label>
                <input type="text" id="summary" name="summary" value="{{ old('summary', $product->summary) }}" class="form-control">
                @error('summary') <div class="form-error">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="description" class="form-label">Deskripsi Lengkap *</label>
                <textarea id="description" name="description" rows="5" required class="form-control">{{ old('description', $product->description) }}</textarea>
                @error('description') <div class="form-error">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="specifications_raw" class="form-label">Spesifikasi Teknis (Format: `Kunci: Nilai`)</label>
                <textarea id="specifications_raw" name="specifications_raw" rows="4" class="form-control">{{ old('specifications_raw', $specificationsRaw) }}</textarea>
                @error('specifications_raw') <div class="form-error">{{ $message }}</div> @enderror
            </div>

            <div style="display:grid; grid-template-columns: 1fr 1fr; gap:20px;">
                <div class="form-group">
                    <label for="image" class="form-label">Ganti Foto Produk (File)</label>
                    <input type="file" id="image" name="image" accept="image/*" data-preview="edit-image-preview" class="form-control">
                    @error('image') <div class="form-error">{{ $message }}</div> @enderror
                    <div style="margin-top:10px; display:flex; align-items:center; gap:12px;">
                        @if($product->image_url)
                            <img src="{{ $product->image_url }}" alt="Current" style="width:70px; height:70px; object-fit:cover; border:1px solid var(--border-hairline);">
                            <span class="mono-label" style="font-size:10px;">Foto Saat Ini</span>
                        @endif
                        <img id="edit-image-preview" src="#" alt="Preview Baru" style="display:none; width:70px; height:70px; object-fit:cover; border:1px solid var(--border-strong);">
                    </div>
                </div>

                <div class="form-group">
                    <label for="image_url" class="form-label">Atau Path / URL Gambar</label>
                    <input type="text" id="image_url" name="image_url" value="{{ old('image_url', $product->image_path) }}" class="form-control">
                    @error('image_url') <div class="form-error">{{ $message }}</div> @enderror
                </div>
            </div>

            <div style="display:flex; gap:24px; margin: 20px 0;">
                <label style="display:flex; align-items:center; gap:8px; cursor:pointer;">
                    <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $product->is_featured) ? 'checked' : '' }}>
                    <span style="font-size:14px; font-weight:600;">Produk Pilihan (Featured)</span>
                </label>

                <label style="display:flex; align-items:center; gap:8px; cursor:pointer;">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $product->is_active) ? 'checked' : '' }}>
                    <span style="font-size:14px; font-weight:600;">Aktif di Katalog Toko</span>
                </label>
            </div>

            <div style="display:flex; gap:12px; border-top:1px solid var(--border-hairline); padding-top:20px;">
                <button type="submit" class="btn btn-black btn-lg">Perbarui Data Produk</button>
                <a href="{{ route('admin.products.index') }}" class="btn btn-outline btn-lg">Kembali</a>
            </div>
        </form>
    </div>
@endsection
