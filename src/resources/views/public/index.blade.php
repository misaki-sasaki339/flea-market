@extends('layouts.app')

@section('css')
@parent
<link rel="stylesheet" href="{{ asset('css/public/index.css') }}">
@endsection

@section('content')
<div class="content">
    <div class="tab-wrapper">
            <input class="tab__label-input" type="radio" name="tab_btn" id="tab1" checked>
            <input class="tab__label-input" type="radio" name="tab_btn" id="tab2">
        <div class="tab__label">
            <label for="tab1">おすすめ</label>
            <label for="tab2">マイリスト</label>
        </div>
        <div class="tab__content" id="content1">
            @foreach($items as $item)
            <div class="tab__content-item">
                <a class="item-link" href="{{ route('item.show', $item) }}">
                <img src="{{ asset('storage/' . $item->img) }}" alt="商品画像">
                </a>
                <p class="item-name">{{ $item->name }}</p>
            </div>
            @endforeach
        </div>
        <div class="tab__content" id="content2">
            <p>空白</p>
        </div>
    </div>
</div>
@endsection