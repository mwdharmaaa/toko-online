@props(['type' => 'success'])

<div class="alert alert-{{ $type }}">
    <span>{{ $slot }}</span>
    <button type="button" onclick="this.parentElement.remove()" style="background:none;border:none;cursor:pointer;">[x]</button>
</div>
