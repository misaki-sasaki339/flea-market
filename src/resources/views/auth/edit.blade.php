@extends('layouts.app')

@section('css')
@parent
<link rel="stylesheet" href="{{ asset('css/auth/edit.css') }}">
@endsection

@section('title')
<div class="title">
    <h2 class="title__label">プロフィール設定</h2>
</div>
@endsection

@section('content')
<section class="content">
    <form action="{{ route('mypage.update') }}" class="form" enctype="multipart/form-data" method="post">
        @csrf
        @method('PATCH')
        <fieldset class="form-group__avatar">
            <img class="img__avatar" src="{{ asset('storage/' . $user->avatar) }}" alt="プロフィール画像">
            <label for="avatar" class="form__button-upload">画像を選択する</label>
            <input type="file" class="form__input-img" id="avatar" name="avatar" accept="image/png, image/jpeg" />
            @error('avatar')
            <p class="error-message">{{ $message }}</p>
            @enderror
        </fieldset>

        <fieldset class="form-group">
            <label for="name" class="form__label--item">ユーザー名</label>
            <input class="form__input @error('email') is-invalid @enderror" id="name" type="text" name="name" value="{{ old('name', $user->name) }}" />
            @error('name')
            <p class="error-message">{{ $message }}</p>
            @enderror
        </fieldset>

        <fieldset class="form-group">
            <label for="postcode" class="fform__label--item">郵便番号</label>
            <input class="form__input @error('postcode') is-invalid @enderror" id="postcode" type="text" name="postcode" value="{{ old('postcode', $user->postcode) }}" />
            @error('postcode')
            <p class="error-message">{{ $message }}</p>
            @enderror
        </fieldset>

        <fieldset class="form-group">
            <label for="address" class="form__label--item">住所</label>
            <input class="form__input @error('email') is-invalid @enderror" id="address" type="text" name="address" value="{{ old('address', $user->address) }}" />
            @error('address')
            <p class="error-message">{{ $message }}</p>
            @enderror
        </fieldset>

        <fieldset class="form-group">
            <label for="building" class="form__label--item">建物名</label>
            <input class="form__input" id="building" type="text" name="building" value="{{ old('building', $user->building) }}" />
        </fieldset>

        <div class="form__button">
            <button class="form__button-submit" type="submit">更新する</button>
        </div>
    </form>
</section>
@endsection