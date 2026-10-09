@extends('layouts.admin')

@section('title', 'Tambah Produk Baru')

@section('content')
    <div style="margin-bottom: 24px;">
        <span class="mono-label">FORM INVENTARIS</span>
        <h1 style="font-size: 24px; margin-top: 4px;">Tambah Produk Baru</h1>
    </div>

    <div class="table-card" style="padding: 32px; max-width: 900px;">
        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div style="display:grid; grid-template-columns: 2fr 1fr; gap:20px;">
                <div class="form-group">
                    <label for="name" class="form-label">Nama Produk *</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" required class="form-control" placeholder="Contoh: Heavy Canvas Tote Bag">
                    @error('name') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="category_id" class="form-label">Kategori *</label>
                    <select id="category_id" name="category_id" class="form-control" required>
                        <option value="">Pilih Kategori</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id') <div class="form-error">{{ $message }}</div> @enderror
                </div>
            </div>

            <div style="display:grid; grid-template-columns: 1fr 1fr 1fr; gap:20px;">
                <div class="form-group">
                    <label for="sku" class="form-label">SKU Produk (Opsional)</label>
                    <input type="text" id="sku" name="sku" value="{{ old('sku') }}" class="form-control" placeholder="Contoh: MN-099">
                    <span class="form-text">Biarkan kosong untuk generate otomatis.</span>
                    @error('sku') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="price" class="form-label">Harga (IDR) *</label>
                    <input type="number" id="price" name="price" value="{{ old('price') }}" required min="0" step="1000" class="form-control" placeholder="Contoh: 350000">
                    @error('price') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="stock" class="form-label">Jumlah Stok *</label>
                    <input type="number" id="stock" name="stock" value="{{ old('stock', 10) }}" required min="0" class="form-control">
                    @error('stock') <div class="form-error">{{ $message }}</div> @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="summary" class="form-label">Ringkasan Singkat (Summary)</label>
                <input type="text" id="summary" name="summary" value="{{ old('summary') }}" class="form-control" placeholder="Satu kalimat sorotan utama produk">
                @error('summary') <div class="form-error">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="description" class="form-label">Deskripsi Lengkap *</label>
                <textarea id="description" name="description" rows="5" required class="form-control" placeholder="Jelaskan detail material, fungsi, dan keunggulan produk...">{{ old('description') }}</textarea>
                @error('description') <div class="form-error">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="specifications_raw" class="form-label">Spesifikasi Teknis (Satu per baris dengan format `Kunci: Nilai`)</label>
                <textarea id="specifications_raw" name="specifications_raw" rows="4" class="form-control" placeholder="Material: 16oz Cotton Canvas&#10;Dimensi: 40x35x12 cm&#10;Kapasitas: 20 Liter&#10;Garansi: 1 Tahun">{{ old('specifications_raw') }}</textarea>
                <span class="form-text">Contoh: <code>Material: Katun 240 GSM</code> lalu enter untuk baris berikutnya.</span>
                @error('specifications_raw') <div class="form-error">{{ $message }}</div> @enderror
            </div>

            <div style="display:grid; grid-template-columns: 1fr 1fr; gap:20px;">
                <div class="form-group">
                    <label for="image" class="form-label">Unggah Foto Produk (File)</label>
                    <input type="file" id="image" name="image" accept="image/*" data-preview="new-image-preview" class="form-control">
                    <span class="form-text">Format: JPG, PNG, WEBP, SVG (Maksimal 2MB).</span>
                    @error('image') <div class="form-error">{{ $message }}</div> @enderror
                    <div style="margin-top:10px;">
                        <img id="new-image-preview" src="#" alt="Preview" style="display:none; max-width:140px; border:1px solid var(--border-hairline);">
                    </div>
                </div>

                <div class="form-group">
                    <label for="image_url" class="form-label">Atau Path / URL Gambar</label>
                    <input type="text" id="image_url" name="image_url" value="{{ old('image_url') }}" class="form-control" placeholder="images/products/mono-tote.svg atau https://...">
                    <span class="form-text">Bisa menggunakan aset lokal contoh SVG atau URL eksternal.</span>
                    @error('image_url') <div class="form-error">{{ $message }}</div> @enderror
                </div>
            </div>

            <div style="display:flex; gap:24px; margin: 20px 0;">
                <label style="display:flex; align-items:center; gap:8px; cursor:pointer;">
                    <input type="checkbox" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}>
                    <span style="font-size:14px; font-weight:600;">Jadikan Produk Pilihan (Featured)</span>
                </label>

                <label style="display:flex; align-items:center; gap:8px; cursor:pointer;">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                    <span style="font-size:14px; font-weight:600;">Aktifkan di Katalog Toko</span>
                </label>
            </div>

            <div style="display:flex; gap:12px; border-top:1px solid var(--border-hairline); padding-top:20px;">
                <button type="submit" class="btn btn-black btn-lg">Simpan Produk ke Katalog</button>
                <a href="{{ route('admin.products.index') }}" class="btn btn-outline btn-lg">Batal</a>
            </div>
        </form>
    </div>
@endsection
