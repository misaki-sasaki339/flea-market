@extends('layouts.default')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth/register.css') }}">
@endsection

@section('title')
<div class="title">
    <h2 class="title__label">会員登録</h2>
</div>
@endsection

@section('content')
<div class="content">
    <form action="{{ route('register.store') }}" class="form" method="post">
        @csrf
        <div class="form-group">
            <div class="form-group__title">
                <label for="name" class="form__label--item">ユーザー名</label>
            </div>
            <div class="form-group__content">
                <div class="form__input-text">
                    <input class="form__input @error('name') is-invalid @enderror" type="text" name="name" value="{{ old('name') }}" />
                    @error('name')
                    <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="form-group__title">
                <label for="email" class="form__label--item">メールアドレス</label>
            </div>
            <div class="form-group__content">
                <div class="form__input-text">
                    <input class="form__input @error('email') is-invalid @enderror" type="text" name="email" value="{{ old('email') }}"/>
                    @error('email')
                    <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="form-group__title">
                <label for="password" class="form__label--item">パスワード</label>
            </div>
            <div class="form-group__content">
                <div class="form__input-text">
                    <input class="form__input @error('password') is-invalid @enderror" type="password" name="password" />
                    @error('password')
                    <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="form-group__title">
                <label for="password" class="form__label--item">確認用パスワード</label>
            </div>
            <div class="form-group__content">
                <div class="form__input-text">
                    <input class="form__input" type="password" name="password_confirmation" />
                </div>
            </div>
        </div>
        <div class="form__button">
            <button class="form__button-submit" type="submit">登録する</button>
        </div>
    </form>
    <a class="content__link-login" href="{{ route('login') }}">ログインはこちら</a>
</div>
@endsection