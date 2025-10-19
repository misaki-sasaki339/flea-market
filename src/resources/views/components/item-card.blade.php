{{-- テスト用：この行を item-card.blade.php の上部に一時的に入れる --}}
{{ $item->img }}

@props([
    'item',
    'type' => 'items'
])
<div class="item-card">
    <div class="tab__content-item">
        <a class="item-link" href="{{ route('item.show', ['item' => $item->id]) }}">
            <div class="item-image-wrapper">
                <x-image :path="$item->img" :type="$type" />

                @if($item->stock === 0)
                <div class="sold-overlay">
                    <span class="sold-text">Sold</span>
                </div>
                @endif
            </div>
        </a>
        <p class="item-name">{{ $item->name }}</p>
    </div>
</div>
