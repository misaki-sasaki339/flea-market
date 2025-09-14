@extends('layouts.default')

@section('css')
<link rel="stylesheet" href="{{ asset('auth/login.css') }}">
@endsection

@section('content')
<div class="login-form__heading">
    <p>ログイン</p>
</div>
<div class="login-form__content">
    <form action="{{ route('login') }}" class="form" method="post">
        @csrf
        <div class="form-group">
            <div class="form-group__title">
                <p class="form__label--item">メールアドレス</p>
            </div>
            <div class="form-group__content">
                <div class="form__input-text">
                    <input type="text" class="email" />
                    <!--エラーメッセージ-->
                </div>
            </div>
            <div class="form-group__title">
                 <p class="form__label--item">パスワード</p>
            </div>
            <div class="form-group__content">
                <div class="form__input-text">
                    <input type="password" name="password" />
                    <!--エラーメッセージ-->
                </div>              
            </div>
            <div class="form__button">
                <button class="form__button-submit" type="submit">ログインする</button>
            </div>
        </div>
    </form>
    <a href="{{ route('register') }}">会員登録はこちら</a>
</div>
@endsection