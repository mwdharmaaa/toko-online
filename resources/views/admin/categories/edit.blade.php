@extends('layouts.admin')

@section('title', 'Edit Kategori: ' . $category->name)

@section('content')
    <div style="margin-bottom: 24px;">
        <span class="mono-label">PENGEDITAN TAKSONOMI</span>
        <h1 style="font-size: 24px; margin-top: 4px;">Edit Kategori: {{ $category->name }}</h1>
    </div>

    <div class="table-card" style="padding: 32px; max-width: 680px;">
        <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name" class="form-label">Nama Kategori *</label>
                <input type="text" id="name" name="name" value="{{ old('name', $category->name) }}" required class="form-control">
                @error('name') <div class="form-error">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="description" class="form-label">Deskripsi Kategori</label>
                <textarea id="description" name="description" rows="3" class="form-control">{{ old('description', $category->description) }}</textarea>
                @error('description') <div class="form-error">{{ $message }}</div> @enderror
            </div>

            <div style="margin: 20px 0;">
                <label style="display:flex; align-items:center; gap:8px; cursor:pointer;">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $category->is_active) ? 'checked' : '' }}>
                    <span style="font-size:14px; font-weight:600;">Aktifkan Kategori</span>
                </label>
            </div>

            <div style="display:flex; gap:12px; border-top:1px solid var(--border-hairline); padding-top:20px;">
                <button type="submit" class="btn btn-black btn-lg">Perbarui Kategori</button>
                <a href="{{ route('admin.categories.index') }}" class="btn btn-outline btn-lg">Kembali</a>
            </div>
        </form>
    </div>
@endsection
