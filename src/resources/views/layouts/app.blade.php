@extends('layouts.default')

@session('css')
<link rel="stylesheet" href="{{ asset('layouts/app.css') }}">

@section('header')
<div class="header__item-search">

</div>

<div class="header__nav">
    <ul class="nav-list">
        @auth
        <li><a href="{{ route('logout') }}">ログアウト</a></li>
        <li><a href="{{ route('mypage') }}">マイページ</a></li>
        <li><a href="{{ route('sell') }}">出品</a></li>
        @endauth

        @guest
        <li><a href="{{ route('login') }}">ログイン</a></li>
        <li><a href="{{ route('login') }}">マイページ</a></li>
        <li><a href="{{ route('login') }}">出品</a></li>            @endguest
    </ul>
</div>