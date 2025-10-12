@extends('layouts.default')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth/register.css') }}">
@endsection

@section('content')
<p class="message">登録していただいたメールアドレスに認証メールを送付しました。
メール認証を完了してください。</p>

<form action="" class="form">

        <div class="form__button">
            <button class="form__button-submit" type="submit">認証はこちら</button>
        </div>

</form>
@endsection
