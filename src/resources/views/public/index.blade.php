@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/public/index.css') }}">
@endsection

@section('content')
<div class="content">
    <div class="sub-nav">
        <a href="">おすすめ</a>
        @auth
        <a href="{{ route('mypage') }}">マイリスト</a>
        @endauth

        @guest
        <a href="{{ route('login.create') }}">マイリスト</a>
        @endguest
    </div>

    <div class="list-wrapper">

    </div>
</div>
@endsection