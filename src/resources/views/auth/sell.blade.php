@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth/sell.css') }}">
@endsection

@section('title')
<div class="title">
    <h2>商品の出品</h2>
</div>
@endsection

@section('content')
<div class="content__wrapper">
    <div class="sell-form__wrapper">
        <form class="form" action="{{ route('') }}" method="post">
            @csrf
            <div class="form-group__img">
                <div class="form-group__title">
                    <h3>商品の画像</h3>
                </div>
                <div class="form-group__content">
                    <div class="form-group__input-img">
                        <input class="form__input" type="file" name="img" accept="image/png, image/jpeg" required>
                    </div>
                </div>
            </div>
            <div class="form-group__attributes">
                <h3>商品の詳細</h3>
                <div class="form-group">
                    <div class="form-group__title">
                        <p>カテゴリー</p>
                    </div>
                    <div class="form-group__content">
                        <div class="form-group__input-xxxx">
                            <input class="form__input" type="xxxx" name="category" />
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-group__title">
                        <p>商品の状態</p>
                    </div>
                    <div class="form-group__content">
                        <div class="form-group__xxxx">

                        </div>
                    </div>
                </div>
                <div class="form-group__desctiption">
                    <h3>商品名と説明</h3>
                    <div class="form-group">
                        <div class="form-group__title">
                            <p>商品名</p>
                        </div>
                        <div class="form-group__content">
                            <div class="form-group__input-text">
                                <input class="form__input" type="text" name="name" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-group__title">
                            <p>ブランド名</p>
                        </div>
                        <div class="form-group__content">
                            <div class="form-group__input-text">
                                <input class="form__input" type="text" name="brand" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-group__title">
                            <p>商品の説明</p>
                        </div>
                        <div class="form-group__content">
                            <div class="form-group__input-textarea">
                                <textarea name="description" class="form__input"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-group__title">
                            <p>販売価格</p>
                        </div>
                        <div class="form-group__content">
                            <div class="form-group__input-text">
                                <input class="form__input" type="text" name="price" />
                                <!--￥マークの表示を疑似要素使うかJS使うか検討-->
                            </div>
                        </div>
                    </div>
                    <div class="form__button">
                        <button class="form__button-submit" type="submit">出品する</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection