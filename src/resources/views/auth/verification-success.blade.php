@extends('layouts.default')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth/verification-success.css') }}">
@endsection

@section('content')
<section class="verification-success">
    <h2>メール認証が完了しました</h2>
    <p class="message">この度はご登録いただきありがとうございます<br />
    会員情報の登録をお願いいたします</p>

    <form action="{{ route('mypage.edit') }}" class="form" method="get">
        @csrf
        <button class="form__link" type="submit">登録はこちら</button>
    </form>
</section>
@endsection
