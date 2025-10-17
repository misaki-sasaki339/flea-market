@extends('layouts.app')

@section('css')
@parent
<link rel="stylesheet" href="{{ asset('css/auth/mypage.css') }}">
@endsection

@section('content')
<section class="content">
    <section class="profile-content">
            <img class="img__avatar" src="{{ asset('storage/' . $user->avatar) }}" alt="プロフィール画像">
            <span class="name">{{ $user->name }}</span>
        <div class="profile__edit">
            <form action="{{ route('mypage.edit') }}" method="get">
                @csrf
                <button class="profile__edit-button" type="submit">プロフィールを編集</button>
            </form>
        </div>
    </section>

    <div class="tab-wrapper">
        <input class="tab__label-input" type="radio" name="tab_btn" id="tab1" {{ $page === 'sell' ? 'checked' : '' }} />
        <input class="tab__label-input" type="radio" name="tab_btn" id="tab2" {{ $page === 'buy' ? 'checked' : '' }} />
        <div class="tab__label">
            <label for="tab1" onclick="location.href='{{ route('mypage', ['page' => 'sell']) }}'">出品した商品</label>
            <label for="tab2" onclick="location.href='{{ route('mypage', ['page' => 'buy']) }}'">購入した商品</label>
        </div>

        <section class="tab__content" id="content1">
            @foreach($items as $item)
            <x-item-card :item="$item" />
            @endforeach
        </section>

        <section class="tab__content" id="content2">
            @foreach($items as $item)
            <x-item-card :item="$item" />
            @endforeach
        </section>
    </div>
</section>
@endsection
