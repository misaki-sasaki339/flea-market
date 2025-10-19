@extends('layouts.default')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth/verify-email.css') }}">
@endsection

@section('content')
<section class="verify-email">
    <p class="message">登録していただいたメールアドレスに認証メールを送付しました。<br />
        メール認証を完了してください。</p>

    {{--認証確認ボタン--}}
    <form action="{{ route('verification.check') }}" class="form-check" method="get">
        @csrf
            <button class="form__button-submit" type="submit">認証はこちら</button>
    </form>

    {{--メール再送ボタン--}}
    <form method="POST" action="{{ route('verification.send') }}" class="form-resend">
        @csrf
        <button class="form__link" type="submit">認証メールを再送する</button>
    </form>
</section>
@endsection
