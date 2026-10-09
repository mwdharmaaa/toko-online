@props(['variant' => 'dark'])

<span class="badge badge-{{ $variant }}">
    {{ $slot }}
</span>
