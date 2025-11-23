@extends('layouts.app')

@section('title', '目標体重設定｜PiGLy')

@section('content')

<div class="card" style="max-width:480px; margin:40px auto;">

    <h2 style="font-size:24px; margin-bottom:20px; color:#d47ad2;">
        目標体重の設定
    </h2>

    <form action="{{ route('target.update') }}" method="POST" novalidate>
        @csrf

        <div class="input-group">
            <label>目標体重 (kg)</label>
            <input type="number"
                name="target_weight"
                step="0.1"
                value="{{ old('target_weight', $target->target_weight ?? '') }}"
                class="form-control"
                required>

            {{-- ★ この位置にエラーを書くと必ず見える --}}
            @error('target_weight')
            <div style="color:#ff4d6d; margin-top:8px; font-size:14px;">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div style="margin-top:25px; text-align:right;">
            <a href="{{ route('dashboard') }}" class="btn-gray"
                style="margin-right:10px;">戻る</a>

            <button type="submit" class="btn-gradient">保存</button>
        </div>

    </form>
</div>

@endsection