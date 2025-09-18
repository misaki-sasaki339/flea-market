@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth/order/address.css') }}">
@endsection

@section('title')
<div class="title">
    <h2>住所の変更</h2>
</div>
@endsection

@section('content')
<div class="content">
    <form action="{{ route('') }}" class="form" method="post">
        <div class="form-group">
            <div class="form-group__title">
                <p>郵便番号</p>
            </div>
            <div class="form-group__content">
                <div class="form-group__input-text">
                    <input class="form__input" type="text" name="postcode" />
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="form-group__title">
                <p>住所</p>
            </div>
            <div class="form-group__content">
                <div class="form-group__input-text">
                    <input class="form__input" type="text" name="address" />
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="form-group__title">
                <p>建物名</p>
            </div>
            <div class="form-group__content">
                <div class="form-group__input-text">
                    <input class="form__input" type="text" name="building" />
                </div>
            </div>
        </div>
        <div class="form__button">
            <button class="form__button-submit" type="submit">更新する</button>
        </div>
    </form>
</div>
@endsection