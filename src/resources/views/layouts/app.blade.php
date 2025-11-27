<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">

    {{-- 分割したCSS --}}
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
</head>

<body>

    {{-- ===============================
        ログイン／新規登録画面はヘッダー非表示
        =============================== --}}
    @php
    $authPages = [
    'login', 'login.post',
    'register.step1', 'register.step1.post',
    'register.step2', 'register.step2.post',
    ];
    @endphp

    @if (!in_array(Route::currentRouteName(), $authPages))
    {{-- ===============================
            ログイン後ヘッダー（Figma仕様）
            =============================== --}}
    <header class="p-header">
        <div class="p-header__left">
            <span class="p-header__logo">PiGLy</span>
        </div>

        <div class="p-header__right">
            <a href="{{ route('target.show') }}" class="p-header__btn">目標体重設定</a>

            <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                @csrf
                <button class="p-header__btn">ログアウト</button>
            </form>
        </div>
    </header>
    @endif

    <main>
        @yield('content')
    </main>

</body>

</html>