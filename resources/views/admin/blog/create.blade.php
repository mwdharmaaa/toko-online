@extends('layouts.admin')

@section('title', 'Tulis Artikel Blog')

@section('content')
    <div style="margin-bottom: 24px;">
        <span class="mono-label">REDAKSI KONTEN</span>
        <h1 style="font-size: 24px; margin-top: 4px;">Tulis Artikel Baru</h1>
    </div>

    <div class="table-card" style="padding: 32px; max-width: 860px;">
        <form action="{{ route('admin.blog.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="title" class="form-label">Judul Artikel *</label>
                <input type="text" id="title" name="title" value="{{ old('title') }}" required class="form-control" placeholder="Contoh: Filosofi Desain Monokrom dalam Keseharian">
                @error('title') <div class="form-error">{{ $message }}</div> @enderror
            </div>

            <div style="display:grid; grid-template-columns: 1fr 1fr; gap:20px;">
                <div class="form-group">
                    <label for="author_name" class="form-label">Nama Penulis</label>
                    <input type="text" id="author_name" name="author_name" value="{{ old('author_name', 'Studio Editorial') }}" class="form-control">
                    @error('author_name') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="reading_time_minutes" class="form-label">Estimasi Waktu Baca (Menit)</label>
                    <input type="number" id="reading_time_minutes" name="reading_time_minutes" value="{{ old('reading_time_minutes', 4) }}" min="1" class="form-control">
                    @error('reading_time_minutes') <div class="form-error">{{ $message }}</div> @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="excerpt" class="form-label">Ringkasan / Kutipan (Excerpt)</label>
                <textarea id="excerpt" name="excerpt" rows="2" class="form-control" placeholder="Ringkasan 1-2 kalimat pengantar artikel...">{{ old('excerpt') }}</textarea>
                @error('excerpt') <div class="form-error">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="content" class="form-label">Isi Artikel Lengkap *</label>
                <textarea id="content" name="content" rows="10" required class="form-control" placeholder="Tulis esai atau panduan lengkap di sini...">{{ old('content') }}</textarea>
                @error('content') <div class="form-error">{{ $message }}</div> @enderror
            </div>

            <div style="display:grid; grid-template-columns: 1fr 1fr; gap:20px;">
                <div class="form-group">
                    <label for="image" class="form-label">Unggah Gambar Sampul (File)</label>
                    <input type="file" id="image" name="image" accept="image/*" data-preview="new-blog-preview" class="form-control">
                    <div style="margin-top:10px;">
                        <img id="new-blog-preview" src="#" alt="Preview Sampul" style="display:none; max-width:180px; border:1px solid var(--border-hairline);">
                    </div>
                    @error('image') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="cover_image_url" class="form-label">Atau Path Gambar Sampul</label>
                    <input type="text" id="cover_image_url" name="cover_image_url" value="{{ old('cover_image_url') }}" class="form-control" placeholder="images/blog/blog-1.svg atau https://...">
                    @error('cover_image_url') <div class="form-error">{{ $message }}</div> @enderror
                </div>
            </div>

            <div style="margin: 20px 0;">
                <label style="display:flex; align-items:center; gap:8px; cursor:pointer;">
                    <input type="checkbox" name="is_published" value="1" {{ old('is_published', true) ? 'checked' : '' }}>
                    <span style="font-size:14px; font-weight:600;">Terbitkan Artikel Sekarang</span>
                </label>
            </div>

            <div style="display:flex; gap:12px; border-top:1px solid var(--border-hairline); padding-top:20px;">
                <button type="submit" class="btn btn-black btn-lg">Simpan Artikel</button>
                <a href="{{ route('admin.blog.index') }}" class="btn btn-outline btn-lg">Batal</a>
            </div>
        </form>
    </div>
@endsection
