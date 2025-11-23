@extends('layouts.app')

@section('title', 'PiGLy｜ログイン')

@section('content')

<div class="card" style="
    max-width: 460px;
    margin: 60px auto;
    background: #fff;
    padding: 40px 30px;
    border-radius: 20px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.08);
">

    <h2 style="
        text-align:center;
        font-size:28px;
        font-weight:700;
        margin-bottom:25px;
        color:#d47ad2;
    ">
        ログイン
    </h2>

    {{-- バリデーションエラー --}}
    @if ($errors->any())
    <div style="margin-bottom: 20px;">
        <ul style="color:#ff4d6d; font-size:14px; padding-left:20px; margin:0;">
            @foreach ($errors->all() as $error)
            <li style="margin-bottom:6px;">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    {{-- ログインフォーム --}}
    <form method="POST" action="{{ route('login.post') }}" novalidate>
        @csrf

        {{-- メールアドレス --}}
        <div class="input-group" style="margin-bottom:18px;">
            <label style="font-weight:600; display:block; margin-bottom:6px;">
                メールアドレス
            </label>
            <input
                type="email"
                name="email"
                value="{{ old('email') }}"
                autocomplete="off"
                required
                style="
                    width:100%;
                    padding:12px;
                    border:1px solid #ccc;
                    border-radius:6px;
                    font-size:15px;
                ">
        </div>

        {{-- パスワード --}}
        <div class="input-group" style="margin-bottom:25px;">
            <label style="font-weight:600; display:block; margin-bottom:6px;">
                パスワード
            </label>
            <input
                type="password"
                name="password"
                autocomplete="new-password"
                required
                style="
                    width:100%;
                    padding:12px;
                    border:1px solid #ccc;
                    border-radius:6px;
                    font-size:15px;
                ">
        </div>

        {{-- ログインボタン --}}
        <div style="text-align:center;">
            <button type="submit"
                class="btn-gradient"
                style="
                    width:100%;
                    padding:14px 0;
                    font-size:16px;
                    border-radius:8px;
                    border:none;
                    background: linear-gradient(90deg, #ff8ada, #d47ad2);
                    color:#fff;
                    cursor:pointer;
                ">
                ログイン
            </button>
        </div>

    </form>

    {{-- 新規登録 --}}
    <div style="text-align:center; margin-top:25px;">
        <a href="{{ route('register.step1') }}"
            style="color:#d47ad2; text-decoration:none; font-size:15px;">
            新規登録はこちら
        </a>
    </div>

</div>

@endsection