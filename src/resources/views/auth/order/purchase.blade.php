@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth/order/purchase.css') }}">
@endsection

@section('content')
<div class="content">
    <form action="{{ route('') }}" class="form" method="post">
        @csrf
        <div class="form-group">
            <img src="" alt="">
            <!--商品名の表示-->
            <!--値段の表示-->
        </div>
        <div class="form-group">
            <div class="form-group__title">
                <p>支払い方法</p>
            </div>
            <div class="form-group__content">
                <!--select-->
            </div>
            <div class="form-group">
                <div class="form-group__title">
                    <p>配送先
                        <span><a href="{{ route('') }}">変更する</a></span>
                    </p>
                </div>
                <div class="form-group__content">
                    <!--住所の出力-->
                </div>
            </div>
            <table class="form-group__table">
                <tr>
                    <th>商品代金</th>
                    <td></td>
                </tr>
                <tr>
                    <th>支払い方法</th>
                    <td></td>
                </tr>
            </table>
            <div class="form__button">
                <button class="form__button-submit"type="submit">購入する</button>
            </div>
        </div>
    </form>
</div>