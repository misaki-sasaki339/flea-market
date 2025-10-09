@extends('layouts.app')

@section('css')
<<<<<<< HEAD
@parent
=======
>>>>>>> cc10eaa02d27ab410c2f5713ceb3dfb716ae89fe
<link rel="stylesheet" href="{{ asset('css/auth/sell.css') }}">
@endsection

@section('title')
<div class="title">
<<<<<<< HEAD
    <p class="title__label">商品の出品</p>
=======
    <h2>商品の出品</h2>
>>>>>>> cc10eaa02d27ab410c2f5713ceb3dfb716ae89fe
</div>
@endsection

@section('content')
<<<<<<< HEAD
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
=======
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
>>>>>>> cc10eaa02d27ab410c2f5713ceb3dfb716ae89fe
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-group__title">
<<<<<<< HEAD
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
=======
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
>>>>>>> cc10eaa02d27ab410c2f5713ceb3dfb716ae89fe
</div>
@endsection