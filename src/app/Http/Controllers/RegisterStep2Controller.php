<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterStep2Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class RegisterStep2Controller extends Controller
{
    /**
     * STEP2 表示（身長・初期体重入力）
     */
    public function show()
    {
        // STEP1のセッションが無ければ最初からやり直し
        if (!session()->has('register.email')) {
            return redirect()->route('register.step1');
        }

        return view('auth.register_step2');
    }

    /**
     * STEP2 登録処理 → ユーザー作成 → 自動ログイン
     */
    public function store(RegisterStep2Request $request)
    {
        // STEP1のセッション値を取得
        $email = session('register.email');
        $password = session('register.password');

        // ユーザー作成
        $user = User::create([
            'email' => $email,
            'password' => bcrypt($password),
            'height' => $request->height,
            'initial_weight' => $request->initial_weight,
        ]);

        // セッション削除
        session()->forget('register');

        // 自動ログイン
        Auth::login($user);

        // ダッシュボードへ
        return redirect()->route('dashboard');
    }
}
