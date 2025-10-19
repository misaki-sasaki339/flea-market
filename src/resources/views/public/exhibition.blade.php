@extends('layouts.app')

@section('css')
@parent
<link rel="stylesheet" href="{{ asset('css/public/exhibition.css') }}">
@endsection

@section('content')
<article class="content">
    <figure class="item__img">
        <x-image :path="$item->img" type="items" />
    </figure>

    <div class="item__details">
        <section class="item__title">
            <h2>{{ $item->name }}</h2>
            <p class="item__brand-label">{{ $item->brand }}</p>
            <p class="item__price-label">¥
                <span class="item-price">{{ number_format($item->price) }}</span>
                (税込)
            </p>
        </section>

        <section class="item__review-summary">
            <div class="item__review-favorite">
                @if($item->isLikedByAuthUser())
                <a href="{{ route('item.unfavorite', ['id'=>$item->id]) }}" class="no-app-style">
                    <img src="{{ asset('images/いいねマーク.svg') }}" class="star-liked" alt="いいね">
                    <span class="review-count">{{ $item->favorites->count() }}</span>
                </a>
                @else
                <a href="{{ route('item.favorite', ['id'=>$item->id]) }}" class="no-app-style">
                    <img src="{{ asset('images/いいねマーク.svg') }}" class="star" alt="いいね">
                    <span class="review-count">{{ $item->favorites->count() }}</span>
                </a>
                @endif
            </div>
            <div class="item__review-comment">
                <img src="{{ asset('/images/吹き出しマーク.png') }}" class="comment-icon" alt="コメント">
                <span class="review-count">{{ $item->comments->count() }}</span>
            </div>
        </section>

        <div class="form-order">
            <form class="form" action="{{ route('purchase', $item) }}" method="get">
                @csrf
                <input type="hidden" name="id" value="{{ $item->id }}">
                <div class="form__button">
                    <button class="form__button-submit" type="submit">購入手続きへ</button>
                </div>
            </form>
        </div>

        <section class="item__description">
            <h3>商品説明</h3>
            <p class="item__description-content">{{ $item->description }}</p>
        </section>

        <section class="item__information">
            <h3>商品の情報</h3>
            <dl class="item__information-list">
                <dd>カテゴリー
                    <span class="item__information-content--category">
                        @foreach($item->categories as $category)
                        <span class="category-name">{{ $category->content }}</span>
                        @endforeach
                    </span>
                </dd>
                <dd>商品の状態
                    <span class="item__information-content--condition">{{ $item->condition->status }}</span>
                </dd>
            </dl>
        </section>

        <article class="item__review">
            <h3 class="item__review-posted--label">コメント({{ $item->comments->count() }})</h3>
            @foreach($item->comments as $comment)
            <div class="item__review-posted">
                <div class="item__review-user">
                    <x-image :path="$comment->user->avatar" type="avatar" />
                    <span class="user-name">{{ $comment->user->name }}</span>
                </div>
                <p class="item__review-posted--content">{{ $comment->review }}</p>
            </div>
            @endforeach
        </article>

        <section class="item__comment-preview">
            <form class="form" action="{{ route('item.comment', ['id'=>$item->id]) }}" method="post">
                @csrf
                <label for="review" class="item__comment-label">商品へのコメント</label>
                <textarea class="item__comment-content" name="review" id="review">{{ old('review') }}</textarea>
                <input type="hidden" name="item_id" value="{{ $item->id }}">
                <div class="form__button">
                    <button class="form__button-submit" type="submit">コメントを送信する</button>
                </div>
            </form>
        </section>
    </div>
</article>
@endsection
