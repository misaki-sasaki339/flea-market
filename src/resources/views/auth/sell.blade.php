@extends('layouts.app')

@section('css')
@parent
<link rel="stylesheet" href="{{ asset('css/auth/sell.css') }}">
@endsection

@section('title')
<div class="title">
    <h2>商品の出品</h2>
</div>
@endsection

@section('content')
<div class="content">
    <form class="form" action="{{ route('sell.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group__img">
            <div class="form-group__title">
                <p class="form__label--item">商品の画像</p>
            </div>
            <div class="form-group__content">
                <div class="form-group__input-img">
                    <label for="img" class="form__button-upload">画像を選択する</label>
                    <input class="form__input-file" type="file" id="img" name="img" accept="image/png, image/jpeg" >
                    @error('img')
                    <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>
        <div class="form-group__attributes">
            <p class="form__label">商品の詳細</p>
            <div class="form-group">
                <div class="form-group__title">
                    <p class="form__label--item">カテゴリー</p>
                </div>
                <div class="form-group__content-category">
                    @foreach($categories as $category)
                    <label class="form__item-checkbox">
                        <input class="form__input-checkbox" type="checkbox" name="category_ids[]" value="{{ $category->id }}" {{ old('category_ids',[]) ? 'checked' : ''}} />
                        <span class="checkbox-decoration">{{ $category->content }}</span>
                    </label>
                    @endforeach
                    @error('category_ids')
                    <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <div class="form-group__title">
                    <p class="form__label--item">商品の状態</p>
                </div>
                <div class="form-group__content">
                    <div class="form__item-select">
                        <select class="form__item-select--option" name="condition_id" value="{{ old('condition_id') }}" >
                            <option value="" disabled selected>選択してください</option>
                            @foreach($conditions as $condition)
                            <option value="{{ $condition->id }}" {{ old('condition_id') == $condition->id ? 'selected' : '' }}>{{ $condition->status}}</option>
                            @endforeach
                        </select>
                        @error('condition_id')
                        <p class="error-message">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form-group__desctiption">
                <p class="form__label">商品名と説明</p>
                <div class="form-group">
                    <div class="form-group__title">
                        <p class="form__label--item">商品名</p>
                    </div>
                    <div class="form-group__content">
                        <div class="form-group__input-text">
                            <input class="form__input" type="text" name="name" value="{{ old('name') }}" />
                            @error('name')
                            <p class="error-message">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-group__title">
                        <p class="form__label--item">ブランド名</p>
                    </div>
                    <div class="form-group__content">
                        <div class="form-group__input-text">
                            <input class="form__input" type="text" name="brand" value="{{ old('brand') }}" />
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-group__title">
                        <p class="form__label--item">商品の説明</p>
                    </div>
                    <div class="form-group__content">
                        <div class="form-group__input-textarea">
                            <textarea name="description" class="form__input-textarea">{{ old('description') }}</textarea>
                            @error('description')
                            <p class="error-message">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-group__title">
                        <p class="form__label--item">販売価格</p>
                    </div>
                    <div class="form-group__content">
                        <div class="form-group__input-text">
                            <input class="form__input" type="text" name="price" value="{{ old('price') }}"/>
                            @error('price')
                            <p class="error-message">{{ $message }}</p>
                            @enderror
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
@endsection
