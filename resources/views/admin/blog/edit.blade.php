@extends('layouts.admin')

@section('title', 'Edit Artikel: ' . $post->title)

@section('content')
    <div style="margin-bottom: 24px;">
        <span class="mono-label">PENGEDITAN KONTEN</span>
        <h1 style="font-size: 24px; margin-top: 4px;">Edit Artikel Jurnal</h1>
    </div>

    <div class="table-card" style="padding: 32px; max-width: 860px;">
        <form action="{{ route('admin.blog.update', $post->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="title" class="form-label">Judul Artikel *</label>
                <input type="text" id="title" name="title" value="{{ old('title', $post->title) }}" required class="form-control">
                @error('title') <div class="form-error">{{ $message }}</div> @enderror
            </div>

            <div style="display:grid; grid-template-columns: 1fr 1fr; gap:20px;">
                <div class="form-group">
                    <label for="author_name" class="form-label">Nama Penulis</label>
                    <input type="text" id="author_name" name="author_name" value="{{ old('author_name', $post->author_name) }}" class="form-control">
                    @error('author_name') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="reading_time_minutes" class="form-label">Estimasi Waktu Baca (Menit)</label>
                    <input type="number" id="reading_time_minutes" name="reading_time_minutes" value="{{ old('reading_time_minutes', $post->reading_time_minutes) }}" min="1" class="form-control">
                    @error('reading_time_minutes') <div class="form-error">{{ $message }}</div> @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="excerpt" class="form-label">Ringkasan / Kutipan (Excerpt)</label>
                <textarea id="excerpt" name="excerpt" rows="2" class="form-control">{{ old('excerpt', $post->excerpt) }}</textarea>
                @error('excerpt') <div class="form-error">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="content" class="form-label">Isi Artikel Lengkap *</label>
                <textarea id="content" name="content" rows="10" required class="form-control">{{ old('content', $post->content) }}</textarea>
                @error('content') <div class="form-error">{{ $message }}</div> @enderror
            </div>

            <div style="display:grid; grid-template-columns: 1fr 1fr; gap:20px;">
                <div class="form-group">
                    <label for="image" class="form-label">Ganti Gambar Sampul (File)</label>
                    <input type="file" id="image" name="image" accept="image/*" data-preview="edit-blog-preview" class="form-control">
                    <div style="margin-top:10px; display:flex; align-items:center; gap:12px;">
                        @if($post->cover_image_url)
                            <img src="{{ $post->cover_image_url }}" alt="Sampul Saat Ini" style="width:100px; height:60px; object-fit:cover; border:1px solid var(--border-hairline);">
                        @endif
                        <img id="edit-blog-preview" src="#" alt="Sampul Baru" style="display:none; width:100px; height:60px; object-fit:cover; border:1px solid var(--border-strong);">
                    </div>
                    @error('image') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="cover_image_url" class="form-label">Atau Path Gambar</label>
                    <input type="text" id="cover_image_url" name="cover_image_url" value="{{ old('cover_image_url', $post->cover_image) }}" class="form-control">
                    @error('cover_image_url') <div class="form-error">{{ $message }}</div> @enderror
                </div>
            </div>

            <div style="margin: 20px 0;">
                <label style="display:flex; align-items:center; gap:8px; cursor:pointer;">
                    <input type="checkbox" name="is_published" value="1" {{ old('is_published', $post->is_published) ? 'checked' : '' }}>
                    <span style="font-size:14px; font-weight:600;">Terbitkan Artikel</span>
                </label>
            </div>

            <div style="display:flex; gap:12px; border-top:1px solid var(--border-hairline); padding-top:20px;">
                <button type="submit" class="btn btn-black btn-lg">Perbarui Artikel</button>
                <a href="{{ route('admin.blog.index') }}" class="btn btn-outline btn-lg">Kembali</a>
            </div>
        </form>
    </div>
@endsection
