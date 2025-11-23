@extends('layouts.app')

@section('content')
<div style="max-width: 500px; margin: 40px auto; padding: 20px; border: 1px solid #ccc;">
    <h2>新規会員登録 STEP1</h2>

    {{-- エラー表示 --}}
    @if ($errors->any())
    <div style="color:red; margin-bottom:15px;">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('register.step1.post') }}" method="post">
        @csrf

        <div style="margin-bottom:15px;">
            <label>メールアドレス</label><br>
            <input type="email" name="email" value="{{ old('email') }}" style="width:100%; padding:8px;">
        </div>

        <div style="margin-bottom:15px;">
            <label>パスワード</label><br>
            <input type="password" name="password" style="width:100%; padding:8px;">
        </div>

        <div style="margin-bottom:15px;">
            <label>パスワード（確認）</label><br>
            <input type="password" name="password_confirmation" style="width:100%; padding:8px;">
        </div>

        <button type="submit" style="width:100%; padding:10px;">次へ</button>
    </form>
</div>
@endsection