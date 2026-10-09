@extends('layouts.admin')

@section('title', 'Tambah Kategori')

@section('content')
    <div style="margin-bottom: 24px;">
        <span class="mono-label">FORM TAKSONOMI</span>
        <h1 style="font-size: 24px; margin-top: 4px;">Tambah Kategori Baru</h1>
    </div>

    <div class="table-card" style="padding: 32px; max-width: 680px;">
        <form action="{{ route('admin.categories.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="name" class="form-label">Nama Kategori *</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required class="form-control" placeholder="Contoh: Travel &amp; Gear">
                @error('name') <div class="form-error">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="description" class="form-label">Deskripsi Kategori</label>
                <textarea id="description" name="description" rows="3" class="form-control" placeholder="Penjelasan singkat mengenai ragam produk dalam kategori ini">{{ old('description') }}</textarea>
                @error('description') <div class="form-error">{{ $message }}</div> @enderror
            </div>

            <div style="margin: 20px 0;">
                <label style="display:flex; align-items:center; gap:8px; cursor:pointer;">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                    <span style="font-size:14px; font-weight:600;">Aktifkan Kategori</span>
                </label>
            </div>

            <div style="display:flex; gap:12px; border-top:1px solid var(--border-hairline); padding-top:20px;">
                <button type="submit" class="btn btn-black btn-lg">Simpan Kategori</button>
                <a href="{{ route('admin.categories.index') }}" class="btn btn-outline btn-lg">Batal</a>
            </div>
        </form>
    </div>
@endsection
