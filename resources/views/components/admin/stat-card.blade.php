@props(['label', 'value', 'sublabel' => null])

<div class="stat-card">
    <div class="stat-label">{{ $label }}</div>
    <div class="stat-number">{{ $value }}</div>
    @if($sublabel)
        <span class="mono-label" style="font-size:10px; color:var(--text-light);">{{ $sublabel }}</span>
    @endif
</div>
