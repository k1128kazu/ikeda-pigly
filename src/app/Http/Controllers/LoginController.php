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
        // ★ 戻るボタンで古い画面を表示しない
        return response()
            ->view('auth.login')
            ->header('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0')
            ->header('Pragma', 'no-cache');
    }

    /**
     * ログイン処理
     */
    public function post(LoginRequest $request)
    {
        $credentials = [
            'email'    => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials)) {

            // ★ セッション再生成
            $request->session()->regenerate();

            // ★ ログイン成功後のキャッシュも禁止 → 1回目でも必ず /dashboard へ
            return redirect()->intended('/dashboard')->withHeaders([
                'Cache-Control' => 'no-store, no-cache, must-revalidate, max-age=0',
                'Pragma' => 'no-cache',
            ]);
        }

        return back()
            ->withErrors(['email' => 'ログイン情報が正しくありません。'])
            ->withInput()
            ->withHeaders([
                'Cache-Control' => 'no-store, no-cache, must-revalidate, max-age=0',
                'Pragma' => 'no-cache',
            ]);
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
