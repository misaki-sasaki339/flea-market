@props(['path' => null, 'type' => 'avatar'])

@php
    if (empty($type)) $type = 'avatar';
@endphp

<div class="image-card">
    @php use Illuminate\Support\Str; @endphp
    <img
        src="{{ $path
            ? (Str::startsWith($path, 'dummy/')
                ? asset($path)
                : asset('storage/' . $path))
            : asset('dummy/' . $type . '/default.png') }}"
        alt="{{ $type }}画像">
</div>
