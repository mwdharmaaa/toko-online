@extends('layouts.app')

@section('title', $post->title)
@section('meta_description', Str::limit($post->excerpt ?? $post->content, 150))

@section('content')
    <article class="container" style="padding-top: 40px; padding-bottom: 80px; max-width: 860px;">
        {{-- Breadcrumb --}}
        <div style="display:flex; align-items:center; gap:8px; font-size:13px; color:var(--text-muted); margin-bottom: 24px;">
            <a href="{{ route('home') }}">Beranda</a>
            <span>/</span>
            <a href="{{ route('blog.index') }}">Jurnal</a>
            <span>/</span>
            <span style="color:var(--text-main);">{{ Str::limit($post->title, 35) }}</span>
        </div>

        <header style="margin-bottom: 32px;">
            <div style="display:flex; gap:12px; align-items:center; margin-bottom:12px;">
                <span class="mono-label">{{ $post->published_at ? $post->published_at->format('d F Y') : 'Draf' }}</span>
                <span style="color:var(--text-light);">&bull;</span>
                <span class="mono-label">{{ $post->reading_time_minutes }} Menit Baca</span>
                <span style="color:var(--text-light);">&bull;</span>
                <span class="mono-label">Oleh {{ $post->author_name }}</span>
            </div>

            <h1 style="font-size: 38px; line-height: 1.25; margin-bottom: 16px;">{{ $post->title }}</h1>

            @if($post->excerpt)
                <p style="font-size: 18px; color: var(--text-muted); line-height: 1.6; border-left: 2px solid var(--border-strong); padding-left: 16px;">
                    {{ $post->excerpt }}
                </p>
            @endif
        </header>

        @if($post->cover_image_url)
            <div style="border: 1px solid var(--border-hairline); margin-bottom: 36px; background-color:var(--bg-surface);">
                <img src="{{ $post->cover_image_url }}" alt="{{ $post->title }}" style="width: 100%; height: auto;">
            </div>
        @endif

        <div style="font-size: 16px; line-height: 1.85; color: var(--text-main); white-space: pre-line; border-bottom: 1px solid var(--border-hairline); padding-bottom: 40px;">
            {{ $post->content }}
        </div>

        {{-- Share & Navigation Footer --}}
        <div style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:16px; padding: 24px 0; border-bottom: 1px solid var(--border-hairline);">
            <div>
                <span class="mono-label">BAGIKAN ESSAY</span>
                <div style="display:flex; gap:10px; margin-top:8px;">
                    <button type="button" onclick="navigator.clipboard.writeText(window.location.href); window.showToast('Tautan artikel berhasil disalin!');" class="btn btn-outline btn-sm">Salin Tautan</button>
                    <a href="https://wa.me/?text={{ rawurlencode($post->title . ' - ' . url()->current()) }}" target="_blank" class="btn btn-outline btn-sm">Share WhatsApp</a>
                </div>
            </div>

            <a href="{{ route('blog.index') }}" class="btn btn-black btn-sm">&larr; Kembali ke Daftar Jurnal</a>
        </div>

        {{-- Related Articles --}}
        @if($recentPosts->isNotEmpty())
            <div style="margin-top: 54px;">
                <span class="mono-label">ARTIKEL LAINNYA</span>
                <h3 style="font-size: 22px; margin-top: 4px; margin-bottom: 24px;">Bacaan Selanjutnya</h3>

                <div class="blog-grid" style="grid-template-columns: repeat(3, 1fr); gap: 20px;">
                    @foreach($recentPosts as $rel)
                        <div style="border: 1px solid var(--border-hairline); padding: 18px; display:flex; flex-direction:column;">
                            <span class="mono-label" style="font-size:10px;">{{ $rel->published_at ? $rel->published_at->format('d M Y') : 'Arsip' }}</span>
                            <h4 style="font-size: 14px; margin: 8px 0; line-height: 1.35;">
                                <a href="{{ route('blog.show', $rel->slug) }}">{{ $rel->title }}</a>
                            </h4>
                            <a href="{{ route('blog.show', $rel->slug) }}" class="btn btn-outline btn-sm" style="margin-top:auto; font-size:11px; padding:4px 8px; width:fit-content;">Baca</a>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </article>
@endsection
