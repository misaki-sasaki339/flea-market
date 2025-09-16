@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth/edit.css') }}">
@endsection

@section('content')
<div class="content">
    <div class="content__title">
        <h2>プロフィール設定</h2>
    </div>
    <div class="edit-form__wrapper">
        <form action="{{ route('') }}" class="form" method="post">
            @csrf
            <div class="form-group__avatar">

            </div>
            <div class="form-group">
                <div class="form-group__title">
                    <p>ユーザー名</p>
                </div>
                <div class="form-group__content">
                    <input class="form-group__input" type="text" name="name" />
                </div>
            </div>
            <div class="form-group">
                <div class="form-group__title">
                    <p>郵便番号</p>
                </div>
                <div class="form-group__content">
                    <input class="form-group__input" type="text" name="postcode" />
                </div>
            </div>
            <div class="form-group">
                <div class="form-group__title">
                    <p>住所</p>
                </div>
                <div class="form-group__content">
                    <input class="form-group__input" type="text" name="address" />
                </div>
            </div>
            <div class="form-group">
                <div class="form-group__title">
                    <p>建物名</p>
                </div>
                <div class="form-group__content">
                    <input class="form-group__input" type="text" name="building" />
                </div>
            </div>
            <div class="form__button">
                <button class="form__button-submit" type="submit">更新する</button>
            </div>
        </form>
    </div>
</div>
@endsection