@extends('layouts.app')

@section('css')
@parent
<link rel="stylesheet" href="{{ asset('css/auth/order/purchase.css') }}">
@endsection

@section('content')
<section class="content">
    <form class="form" action="{{ route('purchase.store', $item) }}" method="post">
        @csrf
        <div class="form__left">
            <section class="form-group__item">
                <x-item-card :item="$item" />
                <div class="item-info">
                    <p class="form__label--item-name">{{ $item->name }}</p>
                    <p class="item__price-label">¥
                        <span class="item-price">{{ number_format($item->price) }}</span>
                    </p>
                </div>
            </section>
            <section class="form-group__payment">
                <label for="payment" class="form__label--title">支払い方法</label>
                <select name="payment" id="payment">
                    <option value="" disabled selected>選択してください</option>
                    <option value="konbini">コンビニ払い</option>
                    <option value="card">カード払い</option>
                </select>
                @error('payment')
                <p class="error-message">{{ $message }}</p>
                @enderror
            </section>
            <section class="form-group__address">
                <p class="form__label">
                    <span class="form__label--title">配送先</span><a class="address-change__link" href="{{ route('purchase.address.edit', ['item_id' => $item->id]) }}">変更する</a></span>
                </p>
                <div class="form-group__content">
                    @php
                    $shipping = session()->only(['postcode', 'address', 'building']);
                    @endphp
                    <p class="postcode">〒{{ $shipping['postcode'] ?? $user->postcode }}</p>
                    <p class="address">{{ $shipping['address'] ?? $user->address}} {{ $shipping['building'] ?? $user->building }}</p>
                </div>
            </section>
        </div>
        <div class="form__right">
            <table class="form-group__table">
                <tr>
                    <th>商品代金</th>
                    <td>¥<span class="item-price">{{ number_format($item->price) }}</span></td>
                </tr>
                <tr>
                    <th>支払い方法</th>
                    <td id="result">選択してください</td>
                </tr>
            </table>
            <script>
                document.getElementById('payment').onchange = function() {
                    const text = this.options[this.selectedIndex].text;
                    document.getElementById('result').textContent = text;
                };
            </script>
            <div class="form__button">
                <button class="form__button-submit" type="submit">購入する</button>
            </div>
        </div>
    </form>
</section>
@endsection
