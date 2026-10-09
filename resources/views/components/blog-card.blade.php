@props(['post'])

<article class="blog-card">
    <a href="{{ route('blog.show', $post->slug) }}" class="blog-thumb-wrap">
        @if($post->cover_image_url)
            <img src="{{ $post->cover_image_url }}" alt="{{ $post->title }}" loading="lazy">
        @endif
    </a>
    <div class="blog-body">
        <span class="mono-label" style="font-size:10px;">{{ $post->published_at ? $post->published_at->format('d M Y') : 'Terbit' }} &bull; {{ $post->reading_time_minutes }} Menit Baca</span>
        <h3 class="blog-title"><a href="{{ route('blog.show', $post->slug) }}">{{ $post->title }}</a></h3>
        <p class="blog-excerpt">{{ Str::limit($post->excerpt, 110) }}</p>
        <a href="{{ route('blog.show', $post->slug) }}" class="btn btn-outline btn-sm" style="margin-top:auto; width:fit-content;">Baca Artikel &rarr;</a>
    </div>
</article>
