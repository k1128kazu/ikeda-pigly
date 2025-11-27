@extends('layouts.app')

@section('title', 'Weight Log 編集')

@section('content')

<div class="edit-wrapper">

    <h2 class="edit-title">Weight Log を編集</h2>

    {{-- ============================= --}}
    {{-- ★ 各入力欄下に赤字で表示する方式に変更（create と同じ） --}}
    {{-- ============================= --}}

    <form action="{{ route('weight_logs.update', $log->id) }}" method="POST" class="edit-form" novalidate>
        @csrf
        @method('PUT')

        {{-- 日付 --}}
        <label class="form-label">日付 <span class="required">*</span></label>
        <input type="date" name="date" value="{{ old('date', $log->date) }}" class="form-input">
        @error('date')
        <p class="error-message">{{ $message }}</p>
        @enderror

        {{-- 体重 --}}
        <label class="form-label">体重 <span class="required">*</span></label>
        <input type="number" step="0.1" name="weight" value="{{ old('weight', $log->weight) }}" class="form-input">
        @error('weight')
        <p class="error-message">{{ $message }}</p>
        @enderror

        {{-- 摂取カロリー --}}
        <label class="form-label">摂取カロリー <span class="required">*</span></label>
        <input type="number" name="calories" value="{{ old('calories', $log->calories) }}" class="form-input">
        @error('calories')
        <p class="error-message">{{ $message }}</p>
        @enderror

        {{-- 運動時間 --}}
        <label class="form-label">運動時間 <span class="required">*</span></label>
        <input type="time" name="exercise_time" value="{{ old('exercise_time', $log->exercise_time) }}" class="form-input">
        @error('exercise_time')
        <p class="error-message">{{ $message }}</p>
        @enderror

        {{-- 運動内容 --}}
        <label class="form-label">運動内容（任意）</label>
        <textarea name="exercise_content" class="form-textarea">{{ old('exercise_content', $log->exercise_content) }}</textarea>
        @error('exercise_content')
        <p class="error-message">{{ $message }}</p>
        @enderror


        {{-- ============================= --}}
        {{-- ボタン類（既存デザインそのまま） --}}
        {{-- ============================= --}}
        <div class="button-row">

            <a href="{{ route('dashboard') }}" class="btn-gray">戻る</a>

            <button type="submit" class="btn-gradient">更新</button>

            {{-- 削除アイコン --}}
            <button type="button" id="deleteTrigger" class="delete-icon-btn">
                <svg viewBox="0 0 24 24" fill="none" stroke="#ff4d6d"
                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="3 6 5 6 21 6"></polyline>
                    <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a 2 2 0 0 1-2-2L5 6m5 0V4a 2 2 0 0 1 2-2h2a 2 2 0 0 1 2 2v2"></path>
                    <line x1="10" y1="11" x2="10" y2="17"></line>
                    <line x1="14" y1="11" x2="14" y2="17"></line>
                </svg>
            </button>

        </div>

    </form>


    {{-- ============================= --}}
    {{-- Figma風 削除確認モーダル --}}
    {{-- ============================= --}}
    <div id="deleteModal" class="modal-overlay" style="display:none;">

        <div class="modal-content">
            <h3 class="modal-title">本当に削除しますか？</h3>

            <p class="modal-text">
                この <strong>Weight Log</strong> を削除してもよろしいですか？<br>
                この操作は取り消せません。
            </p>

            <div class="modal-buttons">

                <button id="cancelDelete" class="btn-cancel">キャンセル</button>

                <form action="{{ route('weight_logs.destroy', $log->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn-delete">削除する</button>
                </form>

            </div>
        </div>

    </div>

</div>



{{-- ============================= --}}
{{-- 専用 CSS（既存構造そのまま） --}}
{{-- ============================= --}}
<style>
    .edit-wrapper {
        max-width: 650px;
        margin: 40px auto;
        padding: 40px 50px;
    }

    .edit-title {
        font-size: 26px;
        font-weight: bold;
        margin-bottom: 25px;
    }

    .form-label {
        font-weight: 600;
        display: block;
        margin-top: 18px;
        margin-bottom: 6px;
    }

    .required {
        color: #ff4d6d;
    }

    .form-input,
    .form-textarea {
        width: 100%;
        font-size: 18px;
        padding: 12px;
        border-radius: 8px;
        border: 1px solid #ccc;
    }

    .form-textarea {
        height: 130px;
    }

    .error-message {
        color: #ff4d6d;
        font-size: 14px;
        margin-top: 4px;
        margin-bottom: 2px;
    }

    .button-row {
        margin-top: 40px;
        display: flex;
        justify-content: flex-start;
        align-items: center;
        gap: 25px;
    }

    .btn-gray {
        width: 120px;
        height: 48px;
        line-height: 48px;
        border-radius: 10px;
        background: #ddd;
        display: inline-block;
        text-align: center;
        font-size: 16px;
    }

    .btn-gradient {
        width: 140px;
        height: 48px;
        border-radius: 10px;
        background: linear-gradient(90deg, #8e78ff, #f48acb);
        color: white;
        border: none;
        font-size: 16px;
    }

    .delete-icon-btn {
        background: none;
        border: none;
        cursor: pointer;
        margin-left: auto;
    }

    .delete-icon-btn svg {
        width: 32px;
        height: 32px;
    }

    /* ---- モーダル ---- */
    .modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.35);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 9999;
    }

    .modal-content {
        width: 480px;
        background: #fff;
        padding: 32px;
        border-radius: 20px;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
        text-align: center;
    }

    .modal-title {
        font-size: 22px;
        font-weight: bold;
        margin-bottom: 14px;
    }

    .modal-text {
        font-size: 15px;
        color: #444;
        margin-bottom: 30px;
    }

    .modal-buttons {
        display: flex;
        justify-content: center;
        gap: 20px;
    }

    .btn-cancel {
        padding: 12px 22px;
        background: #ddd;
        border-radius: 8px;
    }

    .btn-delete {
        padding: 12px 22px;
        background: #ff4d6d;
        color: #fff;
        border-radius: 8px;
    }
</style>


{{-- ============================= --}}
{{-- モーダル動作 JS（既存のまま） --}}
{{-- ============================= --}}
<script>
    document.getElementById('deleteTrigger').addEventListener('click', function() {
        document.getElementById('deleteModal').style.display = 'flex';
    });

    document.getElementById('cancelDelete').addEventListener('click', function() {
        document.getElementById('deleteModal').style.display = 'none';
    });
</script>

@endsection