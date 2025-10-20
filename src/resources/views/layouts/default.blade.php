<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>COACHTECH</title>
    <link rel="stylesheet" href="{{ asset('css/layouts/default.css') }}">
    <link rel="stylesheet" href="{{ asset('css/layouts/flash.css') }}">
    @yield('css')
</head>

<body>
    <header class="header">
        <div class="header__logo">
            <a class='header__link' href="{{ route('home') }}">
                <img src="{{ asset('images/logo.svg') }}" alt="企業ロゴ" class="header__logo-img" />
            </a>
        </div>
        @yield('header')
    </header>

    <main>
        @yield('title')
        @yield('content')
        @if (session('flash_message'))
        <div id="flash-message"
            class="flash-message {{ session('flash_type') === 'error' ? 'flash-error' : 'flash-success' }}">
            {!! session('flash_message') !!}
        </div>
        @endif
    </main>
</body>

</html>
