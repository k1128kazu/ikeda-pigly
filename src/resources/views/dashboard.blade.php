@extends('layouts.app')

@section('title', 'PiGLy｜ダッシュボード')

@section('content')

{{-- =============================== --}}
{{-- 上部サマリー（3カード 横並び） --}}
{{-- =============================== --}}

<div class="summary-wrapper">

    {{-- 目標体重 --}}
    <div class="summary-card-3">
        <div class="summary-title">目標体重</div>
        <div class="summary-value-big">
            {{ $target_weight ? number_format($target_weight, 1) : '-' }}
            <span class="summary-unit">kg</span>
        </div>
    </div>

    {{-- 目標まで --}}
    <div class="summary-card-3">
        <div class="summary-title">目標まで</div>
        <div class="summary-value-big">
            @if ($target_weight)
            {{ number_format($current_weight - $target_weight, 1) }}
            <span class="summary-unit">kg</span>
            @else
            -
            @endif
        </div>
    </div>

    {{-- 最新体重 --}}
    <div class="summary-card-3">
        <div class="summary-title">最新体重</div>
        <div class="summary-value-big">
            {{ number_format($current_weight, 1) }}
            <span class="summary-unit">kg</span>
        </div>
    </div>

</div>



{{-- =============================== --}}
{{-- 検索フォーム --}}
{{-- =============================== --}}

<div class="search-card">
    <form action="{{ route('dashboard') }}" method="GET" class="search-form-row">

        <div class="search-item">
            <label>開始日</label>
            <input type="date" name="start" value="{{ request('start') }}">
        </div>

        <div class="search-tilde">〜</div>

        <div class="search-item">
            <label>終了日</label>
            <input type="date" name="end" value="{{ request('end') }}">
        </div>

        <button type="submit" class="btn-search">検索</button>
    </form>
</div>



{{-- =============================== --}}
{{-- 体重ログ一覧 --}}
{{-- =============================== --}}

<div class="list-card">
    <div class="list-header">
        <span class="list-title">体重ログ一覧</span>
        <a href="{{ route('weight_logs.create') }}" class="btn-add-data">データ追加</a>
    </div>

    <table class="log-table">
        <thead>
            <tr>
                <th>日付</th>
                <th>体重</th>
                <th>食事摂取カロリー</th>
                <th>運動時間</th>
                <th></th>
            </tr>
        </thead>

        <tbody>
            @forelse ($logs as $log)
            <tr>
                <td>{{ $log->date }}</td>
                <td>{{ number_format($log->weight, 1) }}kg</td>

                {{-- カロリー --}}
                <td>{{ $log->calories !== null ? $log->calories . 'cal' : '-' }}</td>


                {{-- 運動時間 --}}
                <td>{{ $log->exercise_time ?? '-' }}</td>

                <td class="action-icons">

                    {{-- 編集 --}}
                    <a href="{{ route('weight_logs.edit', $log->id) }}" class="edit-icon">✎</a>

                    {{-- 削除（モーダル呼び出し） --}}
                    <span class="delete-icon"
                        onclick="openDeleteModal({{ $log->id }}, '{{ $log->date }}', '{{ $log->weight }}', '{{ $log->calorie }}', '{{ $log->exercise_time }}', `{{ $log->exercise_memo }}`)">
                        🗑
                    </span>

                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="no-data">データがありません</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="pagination-area">
        {{ $logs->links('pagination::bootstrap-5') }}
    </div>
</div>



{{-- =============================== --}}
{{-- 削除モーダル（PiGLyデザイン） --}}
{{-- =============================== --}}

<div id="deleteModal" class="modal-overlay" style="
    display:none;
    position: fixed;
    top: 0; left: 0;
    width: 100%; height: 100%;
    background: rgba(0,0,0,0.6);
    justify-content: center;
    align-items: center;
    z-index: 9999;
">

    <div class="modal-card" style="
        width: 600px;
        background: #fff;
        border-radius: 18px;
        padding: 35px 40px;
        box-shadow: 0 8px 18px rgba(0,0,0,0.25);
    ">

        <h2 style="font-size:24px; font-weight:bold; margin-bottom:25px;">
            Weight Log を削除しますか？
        </h2>

        <div id="delete-details" style="font-size:18px; line-height:1.7; margin-bottom:30px;">
            {{-- JavaScript で埋め込み --}}
        </div>

        <form id="deleteForm" method="POST" action="">
            @csrf
            @method('DELETE')

            <div style="display:flex; justify-content:flex-end; gap:20px;">

                {{-- キャンセル --}}
                <button type="button"
                    onclick="closeDeleteModal()"
                    style="
                        width:130px; height:48px;
                        background:#ddd;
                        border:none;
                        border-radius:8px;
                        font-size:16px;
                    ">
                    キャンセル
                </button>

                {{-- 削除する --}}
                <button type="submit"
                    style="
                        width:150px; height:48px;
                        background: linear-gradient(90deg, #ff4d6d, #d90429);
                        color:#fff;
                        border:none;
                        border-radius:8px;
                        font-size:16px;
                    ">
                    削除する
                </button>

            </div>
        </form>

    </div>

</div>


{{-- =============================== --}}
{{-- JavaScript：モーダル --}}
{{-- =============================== --}}
<script>
    function openDeleteModal(id, date, weight, calorie, time, memo) {

        document.getElementById('delete-details').innerHTML =
            `
        日付：${date}<br>
        体重：${weight}kg<br>
        摂取カロリー：${calorie ? calorie + 'cal' : '-'}<br>
        運動時間：${time ?? '-'}<br>
        運動内容：${memo && memo !== 'null' ? memo : '-'}
        `;

        document.getElementById('deleteForm').action =
            `/weight-logs/${id}`;

        document.getElementById('deleteModal').style.display = 'flex';
    }

    function closeDeleteModal() {
        document.getElementById('deleteModal').style.display = 'none';
    }
</script>

@endsection