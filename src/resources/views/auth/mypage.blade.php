@extends('layouts.app')

@section('css')
@parent
<link rel="stylesheet" href="{{ asset('css/auth/mypage.css') }}">
@endsection

@section('content')
<section class="content">
    <div class="profile">
        <div class="profile-content">
            <x-image :path="$user->avatar" type="avatar" />
            <div class="user-name">
                <p class="name">{{ $user->name }}</p>
                @if ($user->average_rating !== null)
                <div class="rating">
                    @for ($i = 1; $i <= 5; $i++)
                    <span class="star {{ $i <= $user->average_rating ? 'star--active' : 'star--inactive' }}">
                        ★
                    </span>
                    @endfor
                </div>
                @endif
            </div>
        </div>
        <div class="profile__edit">
            <form action="{{ route('mypage.edit') }}" method="get">
                @csrf
                <button class="profile__edit-button" type="submit">プロフィールを編集</button>
            </form>
        </div>
    </div>

    <div class="tab-wrapper">
        <input class="tab__label-input" type="radio" name="tab_btn" id="tab1" {{ $page === 'sell' ? 'checked' : '' }} />
        <input class="tab__label-input" type="radio" name="tab_btn" id="tab2" {{ $page === 'buy' ? 'checked' : '' }} />
        <input class="tab__label-input" type="radio" name="tab_btn" id="tab3" {{ $page === 'transaction' ? 'checked' : '' }} />
        <div class="tab__label">
            <label for="tab1" onclick="location.href='{{ route('mypage', ['page' => 'sell']) }}'">出品した商品</label>
            <label for="tab2" onclick="location.href='{{ route('mypage', ['page' => 'buy']) }}'">購入した商品</label>
            <label for="tab3" onclick="location.href='{{ route('mypage', ['page' => 'transaction']) }}'">取引中の商品
                @if ($count = auth()->user()->totalUnreadMessagesCount())
                    <span class="tab-badge">{{ $count }}</span>
                @endif
            </label>
        </div>

        <div class="tab__content" id="content1">
            @foreach($items as $item)
            <x-item-card :item="$item" />
            @endforeach
        </div>

        <div class="tab__content" id="content2">
            @foreach($items as $item)
            <x-item-card :item="$item" />
            @endforeach
        </div>

        <div class="tab__content" id="content3">
            @foreach($orders as $order)
            <x-item-card :item="$order->item" :order="$order" mode="transaction" />
            @endforeach
        </div>
    </div>
</section>
@endsection
