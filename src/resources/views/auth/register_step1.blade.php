@extends('layouts.auth')

@section('title', '新規会員登録 STEP1')

@section('content')
<div class="auth-wrapper">
    <div class="auth-card">

        {{-- ロゴ --}}
        <h1 class="auth-logo">PiGLy</h1>

        {{-- タイトル --}}
        <h2 class="auth-title" style="margin-bottom: 8px;">新規会員登録</h2>
        <p style="color:#666; margin-bottom: 32px; font-size:14px;">
            STEP1 アカウント情報の登録
        </p>

        {{-- フォーム --}}
        <form action="{{ route('register.step1.store') }}" method="POST" novalidate>
            @csrf

            {{-- 氏名 --}}
            <div class="form-group">
                <label class="form-label">お名前</label>
                <input
                    type="text"
                    name="name"
                    class="form-input"
                    placeholder="氏名を入力"
                    value="{{ old('name') }}">

                {{-- ★複数行エラー --}}
                @foreach ($errors->get('name') as $error)
                <p class="error-text">{{ $error }}</p>
                @endforeach
            </div>

            {{-- メールアドレス --}}
            <div class="form-group">
                <label class="form-label">メールアドレス</label>
                <input
                    type="email"
                    name="email"
                    class="form-input"
                    placeholder="メールアドレスを入力"
                    value="{{ old('email') }}">

                {{-- ★複数行エラー --}}
                @foreach ($errors->get('email') as $error)
                <p class="error-text">{{ $error }}</p>
                @endforeach
            </div>

            {{-- パスワード --}}
            <div class="form-group">
                <label class="form-label">パスワード</label>
                <input
                    type="password"
                    name="password"
                    class="form-input"
                    placeholder="パスワードを入力">

                {{-- ★複数行エラー --}}
                @foreach ($errors->get('password') as $error)
                <p class="error-text">{{ $error }}</p>
                @endforeach
            </div>

            {{-- ボタン --}}
            <button type="submit" class="auth-btn">次に進む</button>

            <div class="auth-link-area">
                <a href="{{ route('login') }}" class="auth-link">ログインはこちら</a>
            </div>

        </form>
    </div>
</div>
@endsection