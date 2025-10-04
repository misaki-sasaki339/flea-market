@extends('layouts.app')

@section('css')
@parent
<link rel="stylesheet" href="{{ asset('css/auth/edit.css') }}">
@endsection

@section('title')
<div class="title">
    <h1 class="title__label">プロフィール設定</h1>
</div>
@endsection

@section('content')
<div class="content">
    <form action="{{ route('mypage.update') }}" class="form" enctype="multipart/form-data" method="post">
        @csrf
        @method('PATCH')
        <div class="form-group__avatar">
            <img class="img__avatar" src="{{ asset('storage/' . $user->avatar) }}" alt="プロフィール画像">
            <label for="avatar" class="form__button-upload">画像を選択する</label>
            <input type="file" class="form__input-img" id="avatar" name="avatar" accept="image/png, image/jpeg" />
            @error('avatar')
            <p class="error-message">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group">
            <div class="form-group__title">
                <p class="form__label--item">ユーザー名</p>
            </div>
            <div class="form-group__content">
                <div class="form__input-text">
                    <input class="form__input @error('email') is-invalid @enderror" type="text" name="name" value="{{ old('name', $user->name) }}" />
                    @error('name')
                    <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="form-group__title">
                <p class="form__label--item">郵便番号</p>
            </div>
            <div class="form-group__content">
                <div class="form__input-text">
                    <input class="form__input @error('postcode') is-invalid @enderror" type="text" name="postcode" value="{{ old('postcode', $user->postcode) }}" />
                    @error('postcode')
                    <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="form-group__title">
                <p class="form__label--item">住所</p>
            </div>
            <div class="form-group__content">
                <div class="form__input-text">
                    <input class="form__input @error('email') is-invalid @enderror" type="text" name="address" value="{{ old('address', $user->address) }}" />
                    @error('address')
                    <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="form-group__title">
                <p class="form__label--item">建物名</p>
            </div>
            <div class="form-group__content">
                <div class="form__input-text">
                    <input class="form__input" type="text" name="building" value="{{ old('building', $user->building) }}" />
                </div>
            </div>
        </div>
        <div class="form__button">
            <button class="form__button-submit" type="submit">更新する</button>
        </div>
    </form>
</div>
@endsection