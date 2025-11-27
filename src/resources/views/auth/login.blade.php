<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PiGLy | ログイン</title>

    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
</head>

<body>

    <div class="auth-wrapper">

        <div class="auth-card">

            {{-- ロゴ --}}
            <div class="auth-logo">PiGLy</div>

            {{-- タイトル --}}
            <div class="auth-title">ログイン</div>

            {{-- ログインフォーム --}}
            <form action="{{ route('login.post') }}" method="POST" novalidate>
                @csrf

                {{-- メールアドレス --}}
                <div class="form-group">
                    <label class="form-label">メールアドレス</label>
                    <input type="email" name="email" class="form-input"
                        placeholder="名前を入力"
                        value="{{ old('email') }}" required>

                    {{-- メールエラー --}}
                    @error('email')
                    <div class="error-text">{{ $message }}</div>
                    @enderror
                </div>

                {{-- パスワード --}}
                <div class="form-group">
                    <label class="form-label">パスワード</label>
                    <input type="password" name="password" class="form-input"
                        placeholder="名前を入力"
                        required>

                    {{-- パスワードエラー（← 🔥ここが今回の修正ポイント） --}}
                    @error('password')
                    <div class="error-text">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="auth-btn">ログイン</button>
            </form>

            {{-- 下部リンク --}}
            <div class="auth-link-area">
                <a href="{{ route('register.step1') }}" class="auth-link">アカウント作成はこちら</a>
            </div>

        </div>

    </div>

</body>

</html>