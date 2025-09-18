@extends('layouts.default')

@section('css')
<link rel="stylesheet" href="{{ asset('layouts/app.css') }}">

@section('header')
<nav class="header__nav-wrapper">
    <div class="header__item-search">
        <form action="{{ route('search') }}" class="search-form" method="get">
            @csrf
            <input type="text" name="keyword" placeholder="なにをお探しですか？" value="{{ request('keyword') }}" />
        </form>
    </div>
    <ul class="nav-list">
        @auth
        <li><a href="{{ route('logout') }}">ログアウト</a></li>
        <li><a href="{{ route('mypage') }}">マイページ</a></li>
        <li><a href="{{ route('sell') }}">出品</a></li>
        @endauth

        @guest
        <li><a href="{{ route('login') }}">ログイン</a></li>
        <li><a href="{{ route('login') }}">マイページ</a></li>
        <li><a href="{{ route('login') }}">出品</a></li>
        @endguest
    </ul>
</nav>

