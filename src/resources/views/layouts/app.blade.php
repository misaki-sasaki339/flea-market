@extends('layouts.default')

@section('css')
@parent
<link rel="stylesheet" href="{{ asset('css/layouts/app.css') }}">
@endsection

@section('header')
@parent
<nav class="header-nav">
    <div class="header-nav__search">
        <form action="{{ route('search') }}" class="form" method="get">
            @csrf
            <input class="form__input" type="text" name="keyword" placeholder="なにをお探しですか？" value="{{ request('keyword') }}" />
        </form>
    </div>
    <ul class="header-nav__link">
        @auth
        <li><a class="header-nav__link-logout" href="{{ route('logout') }}">ログアウト</a></li>
        <li><a class="header-nav__link-mypage" href="{{ route('mypage') }}">マイページ</a></li>
        <li><a class="header-nav__link-sell" href="{{ route('sell') }}">出品</a></li>
        @endauth

        @guest
        <li><a class="header-nav__link-logout" href="{{ route('login') }}">ログイン</a></li>
        <li><a class="header-nav__link-mypage" href="{{ route('login') }}">マイページ</a></li>
        <li><a class="header-nav__link-sell" href="{{ route('login') }}">出品</a></li>
        @endguest
    </ul>
</nav>
@endsection