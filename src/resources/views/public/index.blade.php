@extends('layouts.app')

@section('css')
@parent
<link rel="stylesheet" href="{{ asset('css/public/index.css') }}">
@endsection

@section('content')
<section class="content">
    <div class="tab-wrapper">
        <input class="tab__label-input" type="radio" name="tab_btn" id="tab1" {{ $tab === 'recommend' ? 'checked' : '' }} />
        <input class="tab__label-input" type="radio" name="tab_btn" id="tab2" {{ $tab === 'mylist' ? 'checked' : '' }} />
        <div class="tab__label">
            <label for="tab1" onclick="location.href='{{ route('home', ['tab' => 'recommend', 'keyword' => request('keyword')]) }}'">おすすめ</label>
            <label for="tab2" onclick="location.href='{{ route('home', ['tab' => 'mylist', 'keyword' => request('keyword')]) }}'">マイリスト</label>
        </div>
        <section class="tab__content" id="content1">
            @foreach($items as $item)
            <x-item-card :item="$item" />
            @endforeach
        </section>
        <section class="tab__content" id="content2">
            @if(auth()->check())
            @foreach($items as $item)
            <x-item-card :item="$item" />
            @endforeach
            @else
            <p></p>
            @endif
        </section>
    </div>
</section>
@endsection
