@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth/order/address.css') }}">
@endsection

@section('title')
<div class="title">
    <p class="title__label">住所の変更</p>
</div>
@endsection

@section('content')
<div class="content">
    <form action="{{ route('') }}" class="form" method="post">
        @method('PATCH')
        @csrf
        <div class="form-group">
            <div class="form-group__title">
                <p class="form__label--item">郵便番号</p>
            </div>
            <div class="form-group__content">
                <div class="form-group__input-text">
                    <input class="form__input @error('postcode') is-invalid @enderror"" type="text" name="postcode" value="{{ $user->postcode }}"/>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="form-group__title">
                <p class="form__label--item">住所</p>
            </div>
            <div class="form-group__content">
                <div class="form-group__input-text">
                    <input class="form__input @error('address') is-invalid @enderror"" type="text" name="address" value="{{ $user->address }}">
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="form-group__title">
                <p class="form__label--item">建物名</p>
            </div>
            <div class="form-group__content">
                <div class="form-group__input-text">
                    <input class="form__input" type="text" name="building" value="{{ $user->bulding }}"/>
                </div>
            </div>
        </div>
        <div class="form__button">
            <button class="form__button-submit" type="submit">更新する</button>
        </div>
    </form>
</div>
@endsection