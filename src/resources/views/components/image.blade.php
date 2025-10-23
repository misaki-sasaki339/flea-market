@props(['path' => null, 'type' => 'avatar'])

@php
if (empty($type)) $type = 'avatar';
@endphp

<div class="image-card">
    @php
    if (empty($path)) {
    $src = asset("dummy/{$type}/default.png");
    } elseif (Str::startsWith($path, 'dummy/')) {
    $src = asset($path);
    } else {
    $src = asset('storage/' . $path);
    }
    @endphp

    <img
        src="{{ $path
            ? (Str::startsWith($path, 'dummy/')
                ? asset($path)
                : asset('storage/' . $path))
            : asset('dummy/' . $type . '/default.png') }}"
        alt="{{ $type }}画像"
        class="image image--{{ $type }}">
</div>
