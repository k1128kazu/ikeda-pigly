<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WeightTarget;
use Illuminate\Support\Facades\Auth;

class GoalController extends Controller
{
    /**
     * 目標体重設定画面（GET）
     */
    public function show()
    {
        $target = WeightTarget::where('user_id', Auth::id())->first();

        return view('target.show', compact('target'));
    }

    /**
     * 目標体重の更新（POST）
     */
    public function update(Request $request)
    {
        $request->validate([
            'target_weight' => [
                'required',
                'numeric',
                'max:999.9',              // 4桁以内（999.9まで）
                'regex:/^\d{1,3}(\.\d)?$/' // 小数点1桁まで
            ],
        ], [
            'target_weight.required' => '目標の体重を入力してください',
            'target_weight.numeric'  => '4桁までの数字で入力してください',
            'target_weight.max'      => '4桁までの数字で入力してください',
            'target_weight.regex'    => '小数点は1桁で入力してください',
        ]);

        // 初回登録 / 更新
        WeightTarget::updateOrCreate(
            ['user_id' => Auth::id()],
            ['target_weight' => $request->target_weight]
        );

        return redirect()->route('dashboard')
            ->with('message', '目標体重を更新しました！');
    }
}
