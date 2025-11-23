@extends('layouts.app')

@section('content')
<div class="goal-wrapper" style="width: 90%; max-width: 500px; margin: 30px auto;">

    <h2 style="margin-bottom: 20px;">目標体重の設定</h2>

    {{-- 現在の目標体重 --}}
    @if(isset($target))
    <div style="margin-bottom: 20px; padding: 10px; background: #f2f2f2;">
        <p style="margin: 0;">
            現在設定されている目標体重：<strong>{{ $target->target_weight }}kg</strong>
        </p>
    </div>
    @endif

    {{-- エラー表示 --}}
    @if ($errors->any())
    <div style="color: red; margin-bottom: 15px;">
        @foreach ($errors->all() as $error)
        <p style="margin: 0;">{{ $error }}</p>
        @endforeach
    </div>
    @endif

    <form action="{{ route('goal.update') }}" method="POST">
        @csrf

        {{-- 目標体重 --}}
        <div style="margin-bottom: 20px;">
            <label>新しい目標体重（kg）</label>
            <input
                type="text"
                name="target_weight"
                value="{{ old('target_weight', $target->target_weight ?? '') }}"
                placeholder="例：65.0"
                style="width: 100%; padding: 10px; border: 1px solid #ccc;">
        </div>

        {{-- 更新ボタン --}}
        <div style="margin-bottom: 10px;">
            <button
                type="submit"
                style="width: 100%; padding: 12px 0; background: #28a745; color: white; border: none; cursor: pointer;">
                更新する
            </button>
        </div>

    </form>

    <div style="text-align: center;">
        <a href="{{ route('dashboard') }}">一覧へ戻る</a>
    </div>

</div>
@endsection