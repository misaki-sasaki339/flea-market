@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth/edit.css') }}">
@endsection

@section('title')
<div class="title">
    <h2>プロフィール設定</h2>
</div>
@endsection

@section('content')
<div class="content">
    <div class="edit-form">
        <form action="{{ route('mypage.update') }}" class="form" enctype="multipart/form-data" method="post">
            @csrf
            @method('PATCH')
            <div class="form-group__avatar">
                <img src="{{ asset('storage/' . $user->avator) }}" alt="プロフィール画像">
                <label for="avator" class="form__button-upload">画像を選択する</label>
                <input type="file" class="hidden" name="avator" accept="image/png, image/jpeg" />
            </div>
            <div class="form-group">
                <div class="form-group__title">
                    <p>ユーザー名</p>
                </div>
                <div class="form-group__content">
                    <input class="form-group__input" type="text" name="name" value="{{ old('name', $user->name) }}"/>
                    @error('name')
                    <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <div class="form-group__title">
                    <p>郵便番号</p>
                </div>
                <div class="form-group__content">
                    <input class="form-group__input" type="text" name="postcode" value="{{ old('postcode', $user->postcode) }}" />
                    @error('postcode')
                    <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <div class="form-group__title">
                    <p>住所</p>
                </div>
                <div class="form-group__content">
                    <input class="form-group__input" type="text" name="address" value="{{ old('address', $user->address) }}"/>
                    @error('address')
                    <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <div class="form-group__title">
                    <p>建物名</p>
                </div>
                <div class="form-group__content">
                    <input class="form-group__input" type="text" name="building" value="{{ old('building', $user->building) }}"/>
                </div>
            </div>
            <div class="form__button">
                <button class="form__button-submit" type="submit">更新する</button>
            </div>
        </form>
    </div>
</div>
@endsection