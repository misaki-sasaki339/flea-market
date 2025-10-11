@extends('layouts.default')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth/login.css') }}">
@endsection

@section('title')
<div class="title">
    <h2 class="title__label">ログイン</h2>
</div>
@endsection

@section('content')
<section class="content">
    <form action="{{ route('login.store') }}" class="form" method="post">
        @csrf
        <fieldset class="form-group">
            <label for="email" class="form__label--item">メールアドレス</label>
            <input class="form__input @error('email') is-invalid @enderror" id="email" type="text" name="email" />
            @error('email')
            <p class="error-message">{{ $message }}</p>
            @enderror
        </fieldset>
        <fieldset class="form-group">
            <label for="password" class="form__label--item">パスワード</label>
            <input class="form__input @error('password') is-invalid @enderror" id="password" type="password" name="password" />
            @error('password')
            <p class="error-message">{{ $message }}</p>
            @enderror
        </fieldset>
        <div class="form__button">
            <button class="form__button-submit" type="submit">ログインする</button>
        </div>
    </form>
    <a class="content__link-register" href="{{ route('register') }}">会員登録はこちら</a>
</section>
@endsection
