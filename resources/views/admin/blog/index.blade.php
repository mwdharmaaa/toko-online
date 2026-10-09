@extends('layouts.admin')

@section('title', 'Artikel Blog')

@section('content')
    <div style="display:flex; justify-content:space-between; align-items:flex-end; margin-bottom: 28px;">
        <div>
            <span class="mono-label">PUBLIKASI KONTEN</span>
            <h1 style="font-size: 26px; margin-top: 4px;">Artikel Jurnal Redaksi</h1>
            <p style="color: var(--text-muted); font-size: 14px; margin-top: 4px;">Kelola esai, panduan perawatan produk, dan rilis cerita berkala.</p>
        </div>

        <a href="{{ route('admin.blog.create') }}" class="btn btn-black btn-sm">+ Tulis Artikel Baru</a>
    </div>

    {{-- Filter Search --}}
    <div class="table-card" style="margin-bottom: 24px; padding: 16px 20px;">
        <form action="{{ route('admin.blog.index') }}" method="GET" style="display:flex; gap:12px; align-items:center;">
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari judul artikel..." class="form-control" style="width:280px; padding:7px 12px; font-size:13px;">
            <button type="submit" class="btn btn-black btn-sm">Cari</button>
            @if(request('q'))
                <a href="{{ route('admin.blog.index') }}" class="btn btn-outline btn-sm">Reset</a>
            @endif
        </form>
    </div>

    <div class="table-card">
        <div class="table-responsive">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th style="width:60px;">Cover</th>
                        <th>Judul Artikel</th>
                        <th>Penulis</th>
                        <th>Waktu Baca</th>
                        <th>Status</th>
                        <th>Tanggal Terbit</th>
                        <th style="text-align:right;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($posts as $post)
                        <tr>
                            <td>
                                <div style="width:48px; height:32px; border:1px solid var(--border-hairline); background:#fafafa; overflow:hidden;">
                                    @if($post->cover_image_url)
                                        <img src="{{ $post->cover_image_url }}" alt="{{ $post->title }}" style="width:100%; height:100%; object-fit:cover;">
                                    @else
                                        <span style="font-family:var(--font-mono); font-size:9px; display:flex; align-items:center; justify-content:center; height:100%;">NA</span>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <strong>{{ $post->title }}</strong>
                            </td>
                            <td>{{ $post->author_name }}</td>
                            <td><span class="mono-label">{{ $post->reading_time_minutes }} Menit</span></td>
                            <td>
                                @if($post->is_published)
                                    <span class="badge badge-dark">Terbit</span>
                                @else
                                    <span class="badge badge-subtle">Draf</span>
                                @endif
                            </td>
                            <td><span class="mono-label">{{ $post->published_at ? $post->published_at->format('d/m/Y') : '-' }}</span></td>
                            <td style="text-align:right; white-space:nowrap;">
                                @if($post->is_published)
                                    <a href="{{ route('blog.show', $post->slug) }}" target="_blank" class="btn btn-outline btn-sm" style="padding:4px 8px; font-size:11px;">Lihat</a>
                                @endif
                                <a href="{{ route('admin.blog.edit', $post->id) }}" class="btn btn-outline btn-sm" style="padding:4px 8px; font-size:11px;">Edit</a>
                                <form action="{{ route('admin.blog.destroy', $post->id) }}" method="POST" style="display:inline;" data-confirm="Hapus artikel '{{ $post->title }}'?">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline btn-sm" style="padding:4px 8px; font-size:11px; color:#000000;">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" style="text-align:center; padding:36px; color:var(--text-muted);">Belum ada artikel blog.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if($posts->hasPages())
        <div class="pagination-wrap">
            {{ $posts->links() }}
        </div>
    @endif
@endsection
