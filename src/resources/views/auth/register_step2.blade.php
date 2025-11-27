@extends('layouts.auth')

@section('title', '新規会員登録 STEP2')

@section('content')
<div class="auth-wrapper">
    <div class="auth-card">

        {{-- ロゴ --}}
        <h1 class="auth-logo">PiGLy</h1>

        {{-- タイトル --}}
        <h2 class="auth-title" style="margin-bottom: 8px;">新規会員登録</h2>
        <p style="color:#666; margin-bottom: 32px; font-size:14px;">
            STEP2 体重データの入力
        </p>

        {{-- フォーム --}}
        <form action="{{ route('register.step2.store') }}" method="POST" novalidate>
            @csrf

            {{-- 現在の体重 --}}
            <div class="form-group">
                <label class="form-label">現在の体重</label>
                <div style="display:flex; align-items:center; gap:8px;">
                    <input
                        type="text"
                        name="initial_weight"
                        class="form-input"
                        placeholder="現在の体重を入力"
                        value="{{ old('initial_weight') }}">
                    <span>kg</span>
                </div>

                {{-- ★複数行エラー --}}
                @foreach ($errors->get('initial_weight') as $error)
                <p class="error-text">{{ $error }}</p>
                @endforeach
            </div>

            {{-- 目標の体重 --}}
            <div class="form-group">
                <label class="form-label">目標の体重</label>
                <div style="display:flex; align-items:center; gap:8px;">
                    <input
                        type="text"
                        name="target_weight"
                        class="form-input"
                        placeholder="目標の体重を入力"
                        value="{{ old('target_weight') }}">
                    <span>kg</span>
                </div>

                {{-- ★複数行エラー --}}
                @foreach ($errors->get('target_weight') as $error)
                <p class="error-text">{{ $error }}</p>
                @endforeach
            </div>

            {{-- ボタン --}}
            <button type="submit" class="auth-btn">アカウント作成</button>

            <div class="auth-link-area">
                <a href="{{ route('login') }}" class="auth-link">ログインはこちら</a>
            </div>

        </form>
    </div>
</div>
@endsection