@extends('layouts.app')

@section('title', '体重ログを追加')

@section('content')

<div class="card" style="
    max-width: 650px;
    margin: 40px auto;
    padding: 40px 50px;
    border-radius: 18px;
">

    <h2 style="
        font-size: 26px;
        font-weight: bold;
        margin-bottom: 25px;
        text-align: left;
    ">
        Weight Log を追加
    </h2>

    <form action="{{ route('weight_logs.store') }}" method="POST" novalidate>
        @csrf

        <div style="display:flex; flex-direction:column; gap:22px;">

            {{-- 日付 --}}
            <div>
                <label style="font-weight:600;">日付 <span style="color:#ff4d6d;">必須</span></label><br>
                <input type="date" name="date"
                    value="{{ old('date') }}"
                    class="form-input">

                @error('date')
                <p style="color:#ff4d6d; margin-top:4px;">{{ $message }}</p>
                @enderror
            </div>

            {{-- 体重 --}}
            <div>
                <label style="font-weight:600;">体重 <span style="color:#ff4d6d;">必須</span></label><br>
                <input type="number" step="0.1" name="weight"
                    value="{{ old('weight') }}"
                    class="form-input">

                @error('weight')
                <p style="color:#ff4d6d; margin-top:4px;">{{ $message }}</p>
                @enderror
            </div>

            {{-- 摂取カロリー --}}
            <div>
                <label style="font-weight:600;">摂取カロリー <span style="color:#ff4d6d;">必須</span></label><br>
                <input type="number" name="calories"
                    value="{{ old('calories') }}"
                    class="form-input">

                @error('calories')
                <p style="color:#ff4d6d; margin-top:4px;">{{ $message }}</p>
                @enderror
            </div>

            {{-- 運動時間 --}}
            <div>
                <label style="font-weight:600;">運動時間 <span style="color:#ff4d6d;">必須</span></label><br>
                <input type="time" name="exercise_time"
                    value="{{ old('exercise_time') }}"
                    class="form-input">

                @error('exercise_time')
                <p style="color:#ff4d6d; margin-top:4px;">{{ $message }}</p>
                @enderror
            </div>

            {{-- 運動内容 --}}
            <div>
                <label style="font-weight:600;">運動内容（任意）</label><br>

                <textarea name="exercise_content" class="form-input" style="height:120px;">{{ old('exercise_content') }}</textarea>

                @error('exercise_content')
                <p style="color:#ff4d6d; margin-top:4px;">{{ $message }}</p>
                @enderror
            </div>

        </div>

        <div style="margin-top: 35px; display:flex; gap:20px;">
            <a href="{{ route('dashboard') }}" class="btn-gray" style="width:140px; height:50px; line-height:50px; text-align:center; font-size:16px;">
                戻る
            </a>

            <button type="submit" class="btn-gradient"
                style="width:160px; height:50px; font-size:16px;">
                登録
            </button>
        </div>

    </form>

</div>

@endsection