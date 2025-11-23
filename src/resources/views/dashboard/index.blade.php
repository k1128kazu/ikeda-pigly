@extends('layouts.app')

@section('content')
<div class="dashboard-wrapper" style="width: 90%; max-width: 900px; margin: 30px auto;">

    <h2 style="margin-bottom: 20px;">体重一覧</h2>

    {{-- 最新体重と目標との差 --}}
    @if(isset($latest_weight) && isset($user->weightTarget))
    @php
    $target = $user->weightTarget->target_weight;
    $diff = $latest_weight - $target;
    @endphp
    <div style="margin-bottom: 20px; padding: 10px; background: #f2f2f2;">
        <p style="margin: 0;">
            最新体重：{{ $latest_weight }}kg　
            目標体重：{{ $target }}kg　
            差：{{ number_format($diff, 1) }}kg
        </p>
    </div>
    @endif

    {{-- 検索フォーム --}}
    <form method="GET" action="{{ route('dashboard') }}" style="margin-bottom: 20px;">
        <div style="display: flex; gap: 10px; align-items: center;">
            <div>
                <label>開始日</label><br>
                <input type="date" name="start_date" value="{{ $start_date }}" style="padding: 5px;">
            </div>
            <div>
                <label>終了日</label><br>
                <input type="date" name="end_date" value="{{ $end_date }}" style="padding: 5px;">
            </div>
            <div style="margin-top: 23px;">
                <button
                    type="submit"
                    style="padding: 8px 15px; background: #007bff; color: white; border: none; cursor: pointer;">検索</button>
            </div>
        </div>
    </form>

    {{-- 新規登録 --}}
    <div style="margin-bottom: 15px;">
        <a
            href="{{ route('weight_logs.store') }}"
            onclick="event.preventDefault(); document.getElementById('createForm').submit();"
            style="padding: 8px 12px; background: #28a745; color: white; text-decoration: none;">体重を登録する</a>
    </div>

    <form id="createForm" action="{{ route('weight_logs.store') }}" method="POST" style="display: none;">
        @csrf
    </form>

    {{-- 一覧テーブル --}}
    <table style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr style="background: #e6e6e6;">
                <th style="padding: 8px; border: 1px solid #ccc;">日付</th>
                <th style="padding: 8px; border: 1px solid #ccc;">体重</th>
                <th style="padding: 8px; border: 1px solid #ccc;">カロリー</th>
                <th style="padding: 8px; border: 1px solid #ccc;">運動時間</th>
                <th style="padding: 8px; border: 1px solid #ccc;">運動内容</th>
                <th style="padding: 8px; border: 1px solid #ccc;">詳細</th>
                <th style="padding: 8px; border: 1px solid #ccc;">編集</th>
                <th style="padding: 8px; border: 1px solid #ccc;">削除</th>
            </tr>
        </thead>
        <tbody>
            @foreach($logs as $log)
            <tr>
                <td style="padding: 8px; border: 1px solid #ccc;">{{ $log->date }}</td>
                <td style="padding: 8px; border: 1px solid #ccc;">{{ $log->weight }}kg</td>
                <td style="padding: 8px; border: 1px solid #ccc;">{{ $log->calories }}kcal</td>
                <td style="padding: 8px; border: 1px solid #ccc;">{{ $log->exercise_time }}</td>
                <td style="padding: 8px; border: 1px solid #ccc;">{{ $log->exercise_content }}</td>

                {{-- 詳細 --}}
                <td style="text-align:center; border: 1px solid #ccc;">
                    <a href="{{ url('/weight_logs/'.$log->id) }}" style="color: #007bff;">詳細</a>
                </td>

                {{-- 編集 --}}
                <td style="text-align:center; border: 1px solid #ccc;">
                    <a href="{{ route('weight_logs.edit', $log->id) }}" style="color: #28a745;">編集</a>
                </td>

                {{-- 削除 --}}
                <td style="text-align:center; border: 1px solid #ccc;">
                    <form action="{{ route('weight_logs.delete', $log->id) }}" method="POST">
                        @csrf
                        <button type="submit" style="color: red; border: none; background: none; cursor: pointer;">
                            削除
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{-- ページネーション --}}
    <div style="margin-top: 20px;">
        {{ $logs->links() }}
    </div>

</div>
@endsection