<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterStep2Request;
use App\Models\User;
use App\Models\WeightTarget;
use Illuminate\Support\Facades\Auth;

class RegisterStep2Controller extends Controller
{
    public function show()
    {
        if (!session()->has('register.email')) {
            return redirect()->route('register.step1');
        }

        return view('auth.register_step2');
    }

    public function store(RegisterStep2Request $request)
    {
        // STEP1のセッション
        $name     = session('register.name');
        $email    = session('register.email');
        $password = session('register.password');

        // ユーザー作成
        $user = User::create([
            'name'           => $name,
            'email'          => $email,
            'password'       => bcrypt($password),
            'initial_weight' => $request->initial_weight,
        ]);

        // weight_target に保存
        WeightTarget::create([
            'user_id'       => $user->id,
            'target_weight' => $request->target_weight,
        ]);

        // セッションクリア
        session()->forget('register');

        Auth::login($user);

        return redirect()->route('dashboard');
    }
}
