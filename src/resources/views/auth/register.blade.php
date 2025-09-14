@extends('layouts.default')

@section('css')
<link rel="stylesheet" href="{{ asset('auth/register.css') }}">
@endsection

@section('content')
<div class="register-form__heading">
    <p>会員登録</p>
</div>
<div class="register-form__content">
    <form action="{{ route('register') }}" class="form" method="post">
        @csrf
        <div class="form-group">
            <div class="form-group__title">
                <p class="form__label--item">ユーザー名</p>
            </div>
            <div class="form-group__content">
                <div class="form__input-text">
                    <input type="text" class="name" />
                    <!--エラーメッセージ-->
                </div>
            </div>
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
            <div class="form-group__title">
                 <p class="form__label--item">確認用パスワード</p>
            </div>
            <div class="form-group__content">
                <div class="form__input-text">
                    <input type="password" name="password_confirmation" />
                    <!--エラーメッセージ-->
                </div>              
            </div>
            <div class="form__button">
                <button class="form__button-submit" type="submit">ログインする</button>
            </div>
        </div>
    </form>
    <a href="{{ route('login') }}">ログインはこちら</a>
</div>
@endsection