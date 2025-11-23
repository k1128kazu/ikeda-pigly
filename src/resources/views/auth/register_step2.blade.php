@extends('layouts.app')

@section('content')
<div style="max-width: 500px; margin: 40px auto; padding: 20px; border: 1px solid #ccc;">
    <h2>新規会員登録 STEP2</h2>

    @if ($errors->any())
    <div style="color:red; margin-bottom:15px;">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('register.step2.post') }}" method="post">
        @csrf

        <div style="margin-bottom:15px;">
            <label>身長（cm）</label><br>
            <input type="number" name="height" value="{{ old('height') }}" style="width:100%; padding:8px;">
        </div>

        <div style="margin-bottom:15px;">
            <label>初期体重（kg）</label><br>
            <input type="number" name="initial_weight" value="{{ old('initial_weight') }}" style="width:100%; padding:8px;">
        </div>

        <button type="submit" style="width:100%; padding:10px;">登録する</button>
    </form>
</div>
@endsection