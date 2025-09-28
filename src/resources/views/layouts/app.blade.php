@extends('layouts.default')

@section('css')
@parent
<link rel="stylesheet" href="{{ asset('css/layouts/app.css') }}">
@endsection

@section('header')
@parent
    <div class="header-nav__search">
        <form action="{{ route('search') }}" class="form-search" method="get">
            @csrf
            <input class="form__input-search" type="text" name="keyword" placeholder="   なにをお探しですか？" value="{{ request('keyword') }}" />
        </form>
    </div>
    <div class="header-nav__link">
        <ul class="header-nav__link-list">
            @auth
            <li><a class="header-nav__link-logout" href="{{ route('logout') }}">ログアウト</a></li>
            <li><a class="header-nav__link-mypage" href="{{ route('mypage') }}">マイページ</a></li>
            <li><a class="header-nav__link-sell" href="">出品</a></li>
            @endauth

            @guest
            <li><a class="header-nav__link-logout" href="{{ route('login') }}">ログイン</a></li>
            <li><a class="header-nav__link-mypage" href="{{ route('login') }}">マイページ</a></li>
            <li><a class="header-nav__link-sell" href="{{ route('login') }}">出品</a></li>
            @endguest
        </ul>
    </div>
@endsection