@extends('layouts.app')

@section('css')
@parent
<link rel="stylesheet" href="{{ asset('css/auth/order/address.css') }}">
@endsection

@section('title')
<div class="title">
    <p class="title__label">住所の変更</p>
</div>
@endsection

@section('content')
<div class="content">
    <form class="form" action="{{ route('purchase.address.update') }}" method="post">
        @method('PATCH')
        @csrf
        <fieldset class="form-group">
            <input type="hidden" name="item_id" value="{{ request('item_id') }}">
            <label for="postcode" class="form__label--item">郵便番号</label>
            <input class="form__input @error('postcode') is-invalid @enderror"" type=" text" name="postcode" value="{{ $user->postcode }}" />
            @error('postcode')
            <p class="error-message">{{ $message }}</p>
            @enderror
        </fieldset>
        <fieldset class="form-group">
            <label for="address" class="form__label--item">住所</label>
            <input class="form__input @error('address') is-invalid @enderror"" type=" text" name="address" value="{{ $user->address }}">
            @error('address')
            <p class="error-message">{{ $message }}</p>
            @enderror
        </fieldset>
        <fieldset class="form-group">
            <label for="postcode" class="form__label--item">建物名</label>
            <input class="form__input" type="text" name="building" value="{{ $user->building }}" />
        </fieldset>
        <div class="form__button">
            <button class="form__button-submit" type="submit">更新する</button>
        </div>
    </form>
</div>
@endsection
