@extends('layouts.app')

@section('css')
@parent
<link rel="stylesheet" href="{{ asset('css/public/exhibition.css') }}">
@endsection

@section('content')
<div class="content">
    <div class="item__img">
        <img class="img__item" src="{{ asset('storage/' . $item->img) }}" alt="{{ $item->name }}">
    </div>
    <div class="item__details">
        <div class="item__title">
            <h3 class="item__title-label">{{ $item->name }}</h3>
            <p class="item__brand-label">{{ $item->brand }}</p>
        </div>
        <div class="item__price">
            <p class="item__price-label">
                <span class="icon-yen">¥</span>
                {{ $item->price }}
                <span class="tax-in">(税込)</span>
            </p>
        </div>
        <div class="item__review">
            <div class="item__review-favorite">
                @if($item->isLikedByAuthUser())
                <a href="{{ route('item.unfavorite', ['id'=>$item->id]) }}" class="">
                    <img src="{{ asset('images/いいねマーク.svg') }}" class="{{ $item->isLikedByAuthUser() ? 'star-liked' : 'star' }}" alt="">
                    <span class="review-count">{{ $item->favorites->count() }}</span>
                </a>
                @else
                <a href="{{ route('item.favorite', ['id'=>$item->id]) }}" class="">
                    <img src="{{ asset('images/いいねマーク.svg') }}" class="{{ $item->isLikedByAuthUser() ? 'star-liked' : 'star' }}" alt="">
                    <span class="review-count">{{ $item->favorites->count() }}</span>
                </a>
                @endif
            </div>
            <div class="item__review-comment">
                <img src="{{ asset('/images/吹き出しマーク.png') }}" alt="コメント">
                <span class="review-count">{{ $item->comments->count() }}</span>
            </div>
        </div>
        <div class="form-order">
            {{--<form class="form" action="{{ route('purchase') }}" method="get">
            @csrf
            <input type="hidden" name="id" value="{{ $item->id }}">
            <div class="form__button">
                <button class="form__button-submit" type="submit">購入手続きへ</button>
            </div>
            </form>--}}
        </div>
        <h3 class="item__description">
            <p class="item__description-label">商品説明</p>
            <p class="item__description-content">{{ $item->description }}</p>
        </h3>
        <div class="item__information">
            <p class="item__information-label">商品の情報</p>
            <div class="item__information-category">
                <p class="item__information-sublabel">カテゴリー</p>
                {{--カテゴリーを持ってくる、表示方法検討--}}
            </div>
            <di class="item__information-condition">
                <p class="item__information-sublabel">商品の状態</p>
        </div>
        <div class="item__review">
            @foreach($item->comments as $comment)
            <div class="item__review-posted">
                <h3 class="item__review-posted--label">コメント
                    <span class="item__review-posted--count">({{ $item->comments->count() }})</span>
                </h3>
                <img class="comment-avatar" src="{{ asset('storage/' . $comment->user->avatar) }}" alt="{{ $comment->user->name }}のアバター">
                <span class="item__review-posted--user">{{ $comment->user->name }}</span>
                <p class="item__review-posted--content">{{ $comment->review }}</p>
            </div>
            @endforeach
            <div class="item__comment-preview">
                <p class="item__comment-label">商品へのコメント</p>
                <textarea class="item__comment-content" name="review" id=""></textarea>
            </div>
        </div>
    </div>
</div>
</div>