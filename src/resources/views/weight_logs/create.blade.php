@extends('layouts.app')

@section('title', '体重ログを追加')

@section('content')

<div class="card" style="
    max-width: 650px;
    margin: 40px auto;
    padding: 40px 50px;
    border-radius: 18px;
">

    {{-- タイトル：左寄せ --}}
    <h2 style="
        font-size: 26px;
        font-weight: bold;
        margin-bottom: 25px;
        text-align: left;
    ">
        Weight Log を追加
    </h2>

    {{-- バリデーション --}}
    @if ($errors->any())
    <div style="
            padding: 12px 18px;
            background: #ffe2e2;
            color: #c0392b;
            border-radius: 8px;
            margin-bottom: 25px;
        ">
        <ul style="margin:0; padding-left:20px;">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif


    <form action="{{ route('weight_logs.store') }}" method="POST" novalidate>
        @csrf

        {{-- ==== 左寄せの入力フォーム ==== --}}
        <div style="display:flex; flex-direction:column; gap:22px;">

            {{-- 日付 --}}
            <div style="text-align:left;">
                <label style="font-weight:600;">日付 <span style="color:#ff4d6d;">必須</span></label><br>
                <input type="date" name="date"
                    value="{{ old('date') }}"
                    required
                    style="width:420px; height:50px; font-size:18px; padding:10px;">
            </div>

            {{-- 体重 --}}
            <div style="text-align:left;">
                <label style="font-weight:600;">体重 <span style="color:#ff4d6d;">必須</span></label><br>
                <input type="number" step="0.1" name="weight"
                    value="{{ old('weight') }}"
                    placeholder="50.0"
                    required
                    style="width:420px; height:50px; font-size:18px; padding:10px;">
            </div>

            {{-- 食事摂取カロリー（ ★ 正しい name に修正） --}}
            <div style="text-align:left;">
                <label style="font-weight:600;">摂取カロリー <span style="color:#ff4d6d;">必須</span></label><br>
                <input type="number" name="calorie"
                    value="{{ old('calories') }}"
                    placeholder="1200"
                    required
                    style="width:420px; height:50px; font-size:18px; padding:10px;">
            </div>

            {{-- 運動時間 --}}
            <div style="text-align:left;">
                <label style="font-weight:600;">運動時間 <span style="color:#ff4d6d;">必須</span></label><br>
                <input type="time" name="exercise_time"
                    value="{{ old('exercise_time') }}"
                    required
                    style="width:420px; height:50px; font-size:18px; padding:10px;">
            </div>

            {{-- 運動内容メモ（ ★ 正しい name に修正） --}}
            <div style="text-align:left;">
                <label style="font-weight:600;">運動内容（任意）</label><br>

                <textarea name="exercise_memo"
                    placeholder="運動内容を追加"
                    style="width:420px; height:120px; font-size:18px; padding:12px;">{{ old('exercise_content') }}</textarea>

                @error('exercise_content')
                <p style="color:#ff4d6d; margin-top:6px;">{{ $message }}</p>
                @enderror
            </div>

        </div>

        {{-- ===== ボタン（左寄せ） ===== --}}
        <div style="
            margin-top: 35px;
            display:flex;
            gap:20px;
            justify-content:flex-start;
        ">

            <a href="{{ route('dashboard') }}"
                class="btn-gray"
                style="
                    width:140px;
                    height:50px;
                    line-height:50px;
                    text-align:center;
                    font-size:16px;
                ">
                戻る
            </a>

            <button type="submit"
                class="btn-gradient"
                style="
                    width:160px;
                    height:50px;
                    font-size:16px;
                ">
                登録
            </button>

        </div>

    </form>

</div>

@endsection