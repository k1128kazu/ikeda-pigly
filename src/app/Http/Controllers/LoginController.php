<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginRequest;

class LoginController extends Controller
{
    /**
     * ログイン画面表示
     */
    public function show()
    {
        return view('auth.login');
    }

    /**
     * ログイン処理（PiGLy 仕様）
     */
    public function post(LoginRequest $request)
    {
        // PiGLyのフォームは login_email / login_password ではなく
        // 現在のフォームは email / password を使用するため
        // LoginRequest の email / password をそのまま読む。

        $credentials = [
            'email'    => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }

        return back()->withErrors([
            'email' => 'ログイン情報が正しくありません。',
        ])->withInput();
    }

    /**
     * ログアウト処理
     */
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
