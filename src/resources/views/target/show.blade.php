@extends('layouts.app')

@section('title', '目標体重設定｜PiGLy')

@section('content')

<div style="
    max-width: 480px;
    margin: 80px auto;
    background: #fff;
    padding: 40px 50px;
    border-radius: 16px;
    box-shadow: 0 4px 18px rgba(0,0,0,0.1);
    text-align: center;
">

    {{-- タイトル --}}
    <h2 id="target-title" style="
        font-size: 24px;
        font-weight: 700;
        color: #333;
        margin-bottom: 25px;
        display:inline-block;
    ">
        目標体重設定
    </h2>

    @php
    // タイトルの横幅を計測 → その幅を使ってレイアウトを揃える
    $titleWidth = strlen('目標体重設定') * 18; // 文字数×px（だいたい）
    @endphp

    @php
    // 最大幅になりすぎないように制限
    if ($titleWidth < 200) $titleWidth=200;
        if ($titleWidth> 310) $titleWidth = 310;
        @endphp

        <form action="{{ route('target.update') }}" method="POST" novalidate style="margin-top:10px;">
            @csrf

            {{-- 入力エリア --}}
            <div style="
            width: {{ $titleWidth }}px;
            margin: 0 auto 20px;
            text-align:left;
        ">

                <div style="display:flex; align-items:center;">
                    <input
                        type="number"
                        name="target_weight"
                        step="0.1"
                        placeholder="0.0"
                        value="{{ old('target_weight', $target->target_weight ?? '') }}"
                        style="
                        flex:1;
                        padding: 10px 12px;
                        font-size: 18px;
                        border: 1px solid #ccc;
                        border-radius: 8px;
                    "
                        required>
                    <span style="
                    margin-left: 8px;
                    font-size: 16px;
                    color: #444;
                ">kg</span>
                </div>

                {{-- エラー --}}
                @error('target_weight')
                <div style="
                    color:#ff4d6d;
                    font-size:14px;
                    margin-top:8px;
                ">
                    {{ $message }}
                </div>
                @enderror

            </div>

            {{-- ボタン行 --}}
            <div style="
            width: {{ $titleWidth }}px;
            margin: 0 auto;
            display:flex;
            justify-content:space-between;
        ">

                {{-- 戻る --}}
                <a href="{{ route('dashboard') }}"
                    style="
                    width: 45%;
                    height: 44px;
                    line-height: 44px;
                    background:#ddd;
                    text-align:center;
                    border-radius:10px;
                    color:#333;
                    font-size:16px;
                    text-decoration:none;
                ">
                    戻る
                </a>

                {{-- 更新 --}}
                <button type="submit"
                    style="
                    width: 45%;
                    height: 44px;
                    border-radius:10px;
                    border:none;
                    background: linear-gradient(90deg, #8e78ff, #f48acb);
                    color:#fff;
                    font-size:16px;
                ">
                    更新
                </button>

            </div>

        </form>

</div>

@endsection