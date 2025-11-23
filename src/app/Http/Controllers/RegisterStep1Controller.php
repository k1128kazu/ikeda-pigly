<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterStep1Request;

class RegisterStep1Controller extends Controller
{
    /**
     * STEP1 表示（メール・パスワード入力）
     */
    public function show()
    {
        return view('auth.register_step1');
    }

    /**
     * STEP1 登録処理（バリデーション → セッション保存 → STEP2へ）
     */
    public function store(RegisterStep1Request $request)
    {
        // STEP1 の入力データをセッションに保存
        session([
            'register.email' => $request->email,
            'register.password' => $request->password,
        ]);

        // STEP2 へ遷移
        return redirect()->route('register.step2');
    }
}
