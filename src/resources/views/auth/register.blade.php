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
<section class="content">
    <form action="{{ route('register.store') }}" class="form" method="post">
        @csrf
        <fieldset class="form-group">
            <label for="name" class="form__label--item">ユーザー名</label>
            <input class="form__input @error('name') is-invalid @enderror" id="name" type="text" name="name" value="{{ old('name') }}" />
            @error('name')
            <p class="error-message">{{ $message }}</p>
            @enderror
        </fieldset>

        <fieldset class="form-group">
            <label for="email" class="form__label--item">メールアドレス</label>
            <input class="form__input @error('email') is-invalid @enderror" id="email" type="text" name="email" value="{{ old('email') }}" />
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

        <fieldset class="form-group">
            <label for="password_confirmation" class="form__label--item">確認用パスワード</label>
            <input class="form__input" type="password" id="password_confirmation" name="password_confirmation" />
        </fieldset>

        <div class="form__button">
            <button class="form__button-submit" type="submit">登録する</button>
        </div>
    </form>
    <a class="content__link-login" href="{{ route('login') }}">ログインはこちら</a>
</section>
@endsection