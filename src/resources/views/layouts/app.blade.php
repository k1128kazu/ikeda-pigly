<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'PiGLy')</title>

    {{-- Google Fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=Zen+Kaku+Gothic+New:wght@400;500;700&family=Playfair+Display:wght@600&display=swap" rel="stylesheet">

    {{-- 背景アニメーション --}}
    <style>
        body {
            margin: 0;
            font-family: 'Zen Kaku Gothic New', sans-serif;
            background: linear-gradient(135deg, #ffd6e8, #f7e1ff, #ffd1dc, #ffb6da);
            background-size: 200% 200%;
            animation: bgMove 12s ease infinite;
        }

        @keyframes bgMove {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        header {
            width: 100%;
            background: rgba(255, 255, 255, 0.95);
            border-bottom: 1px solid #eee;
            backdrop-filter: blur(6px);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .header-inner {
            max-width: 1100px;
            margin: 0 auto;
            padding: 15px 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-family: 'Playfair Display', serif;
            font-size: 32px;
            font-weight: 600;
            text-decoration: none;
            color: #d47ad2;
        }

        .header-actions {
            display: flex;
            gap: 12px;
            align-items: center;
        }

        .header-btn {
            padding: 7px 14px;
            font-size: 14px;
            border-radius: 6px;
            border: 1px solid #aaa;
            background: #fff;
            cursor: pointer;
        }

        .logout-btn {
            padding: 7px 14px;
            border: none;
            background: #f66;
            color: #fff;
            font-size: 14px;
            border-radius: 6px;
            cursor: pointer;
        }

        main {
            max-width: 1100px;
            margin: 40px auto;
            padding: 0 20px;
        }
    </style>

    {{-- PiGLy 共通CSS --}}
    <link rel="stylesheet" href="{{ asset('css/pigly.css') }}">

    @yield('css')
</head>

<body>

    {{-- ============================== --}}
    {{-- ヘッダー                     --}}
    {{-- ============================== --}}
    <header>
        <div class="header-inner">

            {{-- ロゴ（ログイン前は login、ログイン後は dashboard に遷移） --}}
            <a class="logo" href="{{ auth()->check() ? route('dashboard') : route('login') }}">
                PiGLy
            </a>

            {{-- ログイン中だけ表示 --}}
            @if (auth()->check())
            <div class="header-actions">

                {{-- 目標体重設定：仕様通り target.show --}}
                <a href="{{ route('target.show') }}">
                    <button class="header-btn">⚙️ 目標体重設定</button>
                </a>

                {{-- ログアウト --}}
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="logout-btn">ログアウト</button>
                </form>

            </div>
            @endif

        </div>
    </header>

    {{-- ============================== --}}
    {{-- ページ内容                   --}}
    {{-- ============================== --}}
    <main>
        @yield('content')
    </main>

</body>

</html>