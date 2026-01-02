@extends('layouts.app')

@section('css')
    @parent
    <link rel="stylesheet" href="{{ asset('css/auth/message.css') }}">
@endsection

@section('scripts')
    <script src="{{ asset('js/auth/message.js') }}"></script>
@endsection

@section('content')
    <div class="container">
        <div class="chat-sidebar">
            <p class="sidebar-title">その他の取引</p>

            @foreach ($orders as $sideOrder)
                <ul class="item-list-container">
                    <li class ="item-list">
                        <a class="item-link"
                            href="{{ route('messages.show', ['order' => $sideOrder->id]) }}">{{ $sideOrder->item->name }}</a>
                    </li>
                </ul>
            @endforeach
        </div>

        <div class="chat-main">
            <div class="chat-title">
                <div class="chat-title__label">
                    <x-image :path="$partner->avatar" type="avatar" />
                    <p class='chat-title__partner'>「{{ $partner->name }}」さんとの取引画面</p>
                </div>
                <div class="chat-title__button">
                    @if (auth()->id() === $order->user_id)
                        <button type="button" class="complete-button" id="review-modal_open">取引を完了する</button>
                    @endif
                    <div class="review-modal__container" id="review-modal">
                        <div class="review-title">
                            <p class="review-title__message">取引が完了しました。</p>
                        </div>
                        <div class="review-content">
                            <p class="review-content__message">今回の取引相手はどうでしたか？</p>
                            <div class="review-stars">
                                <span class="review-star" data-score="1">★</span>
                                <span class="review-star" data-score="2">★</span>
                                <span class="review-star" data-score="3">★</span>
                                <span class="review-star" data-score="4">★</span>
                                <span class="review-star" data-score="5">★</span>
                            </div>
                        </div>
                        <form class="review-form" action="{{ route('reviews.store', $order) }}" method="POST">
                            @csrf
                            <input type="hidden" name="score" id="review-score">
                            <button type="submit" id="review-modal__close">送信する</button>
                        </form>
                    </div>
                    <div id="review-modal__mask"></div>
                    @if ($canSellerReview)
                        <input type="hidden" id="auto-open-review-modal" value="1">
                    @endif
                </div>
            </div>
            <div class="item-detail">
                <x-image :path="$order->item->img" type="items" />
                <div class="item-detail__content">
                    <p class="item-name">{{ $order->item->name }}</p>
                    <p class="item-price">
                        <span class="enmark">¥</span>
                        {{ number_format($order->item->price) }}
                        <span class="enmark">(税込)</span>
                    </p>
                </div>
            </div>
            <div class="chat-view">
                @foreach ($messages as $message)
                    @php
                        $isMine = auth()->id() === $message->user_id;
                    @endphp

                    <div class="chat-message {{ $isMine ? 'chat-message--mine' : 'chat-message--partner' }}">
                        <div class="chat-user">
                            @if ($isMine)
                                <span class="chat-user-name">{{ $message->user->name }}</span>
                                <x-image :path="$message->user->avatar" type="avatar-small" />
                            @else
                                <x-image :path="$message->user->avatar" type="avatar-small" />
                                <span class="chat-user-name">{{ $message->user->name }}</span>
                            @endif
                        </div>

                        <div class="chat-body" id="message-body-{{ $message->id }}">{{ $message->body }}</div>

                        @if ($message->img)
                            <img src="{{ asset('storage/' . $message->img) }}" alt="チャット画像" class="chat-img">
                        @endif

                        @if ($isMine && $message->id === $latestMyMessageId)
                            <div class="chat-action">
                                <button type="button" class="chat-action__edit" data-message-id="{{ $message->id }}"
                                    data-message-body="{{ $message->body }}">
                                    編集
                                </button>
                                <form action="{{ route('messages.destroy', $message) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="form__button-submit--delete">削除</button>
                                </form>
                            </div>
                        @endif
                    </div>
                @endforeach

            </div>
            <form action="{{ route('messages.store', ['order' => $order->id]) }}" class="chat-form" method="post"
                enctype="multipart/form-data" id="message-form">
                @csrf

                <div class="error-area">
                    @error('body')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                    @error('img')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>

                {{-- 編集用 --}}
                <input type="hidden" name="message_id" id="edit-message-id">

                <div class="form__input-group">
                    <textarea class="form__input" name="body" id="" placeholder="取引メッセージを記入してください">{{ old('body') }}</textarea>
                    <label for="img" class="form__button-upload">画像を追加</label>
                    <input type="file" id="img" class="form__input-img" name="img"
                        accept="image/png, image/jpeg" />
                    <button type="submit" class="form__button-submit">
                        <img class="form__button-submit--img" src="{{ asset('images/inputbutton.svg') }}"
                            alt="送信">
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
