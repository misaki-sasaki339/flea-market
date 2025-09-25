@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/public/exhibition.css') }}">
@endsection

@section('content')
<div class="content">
    <div class="tab-switch">
        <label><input type="radio" name="tab" checked />おすすめ</label>
        <!--下線表示の方法検討-->
        <div class="tab-content">
            <!--@foreachで表示-->
        </div>

        <label><input type="radio" name="tab" />マイリスト</label>
        <!--下線表示の方法検討-->
        <div class="tab-content">
            <!--favorite使って@foreach表示-->
        </div>
    </div>
</div>