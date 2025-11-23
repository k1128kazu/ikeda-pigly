<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WeightTarget;
use Illuminate\Support\Facades\Auth;

class GoalController extends Controller
{
    /**
     * 目標体重設定画面（GET）
     * PiGLy 仕様：/target にアクセスすると編集画面を表示
     */
    public function show()
    {
        $target = WeightTarget::where('user_id', Auth::id())->first();

        return view('target.show', compact('target'));
    }

    /**
     * 目標体重の更新（POST）
     * 初めての登録も updateOrCreate で自動対応
     */
    public function update(Request $request)
    {
        // バリデーション（日本語メッセージ）
        $request->validate([
            'target_weight' => ['required', 'numeric'],
        ], [
            'target_weight.required' => '目標体重を入力してください',
            'target_weight.numeric'  => '数値を入力してください',
        ]);

        // 初回登録 / 更新に対応
        WeightTarget::updateOrCreate(
            ['user_id' => Auth::id()],
            ['target_weight' => $request->target_weight]
        );

        return redirect()->route('dashboard')
            ->with('message', '目標体重を更新しました！');
    }
}
