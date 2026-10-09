@extends('layouts.app')

@section('title', 'Jurnal & Blog')
@section('meta_description', 'Kumpulan esai, panduan perawatan material, dan catatan desain dari tim Mono Archive.')

@section('content')
    <div class="container" style="padding-top: 40px; padding-bottom: 70px;">
        <div style="display:flex; justify-content:space-between; align-items:flex-end; flex-wrap:wrap; gap:16px; margin-bottom: 36px;">
            <div>
                <span class="mono-label">PUBLIKASI RESMI</span>
                <h1 style="font-size: 32px; margin-top: 4px;">Jurnal &amp; Catatan Desain</h1>
                <p style="color: var(--text-muted); font-size: 15px; margin-top: 6px;">
                    Mendalami filosofi minimalisme, ketahanan material objek, dan manajemen utilitas harian.
                </p>
            </div>

            <form action="{{ route('blog.index') }}" method="GET" style="display:flex; gap:8px;">
                <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari artikel..." class="form-control" style="width:240px; padding:7px 12px; font-size:13px;">
                <button type="submit" class="btn btn-black btn-sm">Cari</button>
            </form>
        </div>

        @if($posts->isEmpty())
            <div style="text-align:center; padding:70px 20px; border:1px dashed var(--border-hairline);">
                <span class="mono-label">ARSIP BELUM DITEMUKAN</span>
                <h3 style="margin-top:8px;">Belum ada artikel yang sesuai</h3>
                <a href="{{ route('blog.index') }}" class="btn btn-outline btn-sm" style="margin-top:14px;">Tampilkan Semua Artikel</a>
            </div>
        @else
            <div class="blog-grid">
                @foreach($posts as $post)
                    <article class="blog-card">
                        <a href="{{ route('blog.show', $post->slug) }}" class="blog-thumb-wrap">
                            @if($post->cover_image_url)
                                <img src="{{ $post->cover_image_url }}" alt="{{ $post->title }}" loading="lazy">
                            @endif
                        </a>

                        <div class="blog-body">
                            <span class="mono-label" style="font-size:10px;">
                                {{ $post->published_at ? $post->published_at->format('d M Y') : 'Draf' }} &bull; {{ $post->reading_time_minutes }} Menit Baca
                            </span>

                            <h2 class="blog-title" style="font-size: 18px;">
                                <a href="{{ route('blog.show', $post->slug) }}">{{ $post->title }}</a>
                            </h2>

                            <p class="blog-excerpt">{{ Str::limit($post->excerpt, 120) }}</p>

                            <div style="margin-top: auto; display:flex; justify-content:space-between; align-items:center; border-top:1px dashed var(--border-hairline); padding-top:12px;">
                                <span class="mono-label" style="font-size:10px;">Penulis: {{ $post->author_name }}</span>
                                <a href="{{ route('blog.show', $post->slug) }}" class="btn btn-outline btn-sm" style="padding:4px 10px; font-size:12px;">Baca &rarr;</a>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>

            @if($posts->hasPages())
                <div class="pagination-wrap">
                    @if($posts->onFirstPage())
                        <span class="pagination-item" style="color:var(--text-light);">&laquo; Sebelumnya</span>
                    @else
                        <a href="{{ $posts->previousPageUrl() }}" class="pagination-item">&laquo; Sebelumnya</a>
                    @endif

                    @foreach(range(1, $posts->lastPage()) as $page)
                        @if($page == $posts->currentPage())
                            <span class="pagination-item active">{{ $page }}</span>
                        @else
                            <a href="{{ $posts->url($page) }}" class="pagination-item">{{ $page }}</a>
                        @endif
                    @endforeach

                    @if($posts->hasMorePages())
                        <a href="{{ $posts->nextPageUrl() }}" class="pagination-item">Berikutnya &raquo;</a>
                    @else
                        <span class="pagination-item" style="color:var(--text-light);">Berikutnya &raquo;</span>
                    @endif
                </div>
            @endif
        @endif
    </div>
@endsection
