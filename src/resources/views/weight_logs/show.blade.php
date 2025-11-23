@extends('layouts.app')

@section('content')
<div style="width: 90%; max-width: 500px; margin: 40px auto;">

    <h2 style="margin-bottom: 20px;">体重ログ 詳細</h2>

    <div style="margin-bottom: 15px;">
        <strong>日付：</strong>
        {{ $log->date }}
    </div>

    <div style="margin-bottom: 15px;">
        <strong>体重（kg）：</strong>
        {{ $log->weight }}
    </div>

    <div style="margin-bottom: 15px;">
        <strong>BMI：</strong>
        {{ $log->bmi ?? '---' }}
    </div>

    <div style="margin-bottom: 15px;">
        <strong>摂取カロリー（kcal）：</strong>
        {{ $log->calories }}
    </div>

    <div style="margin-bottom: 15px;">
        <strong>運動時間（h:mm）：</strong>
        {{ $log->exercise_time }}
    </div>

    <div style="margin-bottom: 25px;">
        <strong>運動内容：</strong><br>
        {!! nl2br(e($log->exercise_content)) !!}
    </div>

    {{-- 編集 --}}
    <div style="margin-bottom: 10px;">
        <a href="{{ route('weight_logs.edit', $log->id) }}"
            style="padding: 10px 20px; background: #28a745; color: #fff; text-decoration: none;">
            編集する
        </a>
    </div>

    {{-- 一覧へ --}}
    <div>
        <a href="{{ route('dashboard') }}">一覧へ戻る</a>
    </div>

</div>
@endsection