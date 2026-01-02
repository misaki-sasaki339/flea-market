@props([
    'item',
    'type' => 'items',
    'mode' => null,
    'order' => null,
])

@php
    if ($mode === 'transaction' && $order instanceof \App\Models\Order && !empty($order->id)) {
        $url = route('messages.show', ['order' => $order->id]);
    } else {
        $url = route('item.show', ['item' => $item->id]);
    }
@endphp

<div class="item-card">
    <div class="tab__content-item">
        <a class="item-link" href="{{ $url }}">
            <div class="item-image-wrapper">
                <x-image :path="$item->img" :type="$type" />

                @if($item->stock === 0 && $mode !== 'transaction')
                <div class="sold-overlay">
                    <span class="sold-text">Sold</span>
                </div>
                @endif

                @php
                    $unreadCount = 0;

                    if ($mode === 'transaction' && $order) {
                        $unreadCount = $order->unreadMessagesCountForUser(auth()->id());
                    }
                @endphp

                @if ($unreadCount > 0)
                    <div class="unread-badge">
                        <span class="unread-count">{{ $unreadCount }}</span>
                    </div>
                @endif
            </div>
        </a>
        <p class="item-name">{{ $item->name }}</p>
    </div>
</div>
