<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\WeightLog;

class WeightLogController extends Controller
{
    /**
     * 一覧表示（Dashboard）
     */
    public function index(Request $request)
    {
        $user = Auth::user();

        $logs = WeightLog::where('user_id', $user->id)
            ->when($request->start, fn($q) => $q->where('date', '>=', $request->start))
            ->when($request->end, fn($q) => $q->where('date', '<=', $request->end))
            ->orderBy('date', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('dashboard', compact('logs'));
    }

    /**
     * 新規登録画面
     */
    public function create()
    {
        return view('weight_logs.create');
    }

    /**
     * 新規登録処理
     */
    public function store(Request $request)
    {
        $request->validate([
            'date'             => ['required', 'date'],
            'weight'           => ['required', 'numeric', 'max:9999.9'],
            'calories'         => ['required', 'numeric'],
            'exercise_time'    => ['required'],
            'exercise_content' => ['nullable', 'string'],
        ], $this->messages());   // ← ★ここが重要（追加）

        WeightLog::create([
            'user_id'          => Auth::id(),
            'date'             => $request->date,
            'weight'           => $request->weight,
            'calories'         => $request->calories,
            'exercise_time'    => $request->exercise_time,
            'exercise_content' => $request->exercise_content,
        ]);

        return redirect()->route('dashboard')->with('message', '体重ログを登録しました！');
    }

    /**
     * 編集画面
     */
    public function edit($id)
    {
        $log = WeightLog::where('user_id', Auth::id())->findOrFail($id);

        return view('weight_logs.edit', compact('log'));
    }

    /**
     * 更新処理
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'date'             => ['required', 'date'],
            'weight'           => ['required', 'numeric', 'max:9999.9'],
            'calories'         => ['required', 'numeric'],
            'exercise_time'    => ['required'],
            'exercise_content' => ['nullable', 'string'],
        ], $this->messages());   // ← ★ここが重要（追加）

        $log = WeightLog::where('user_id', Auth::id())->findOrFail($id);

        $log->update([
            'date'             => $request->date,
            'weight'           => $request->weight,
            'calories'         => $request->calories,
            'exercise_time'    => $request->exercise_time,
            'exercise_content' => $request->exercise_content,
        ]);

        return redirect()->route('dashboard')->with('message', '体重ログを更新しました！');
    }

    /**
     * 削除処理
     */
    public function destroy($id)
    {
        $log = WeightLog::where('user_id', Auth::id())->findOrFail($id);
        $log->delete();

        return redirect()->route('dashboard')->with('message', '体重ログを削除しました！');
    }

    /**
     * バリデーションメッセージ（共通）
     */
    private function messages()
    {
        return [
            'date.required'             => '日付を入力してください。',
            'weight.required'           => '体重を入力してください。',
            'weight.numeric'            => '体重は数値で入力してください。',
            'weight.max'                => '体重は4桁以内の数字を入力してください。',

            'calories.required'         => '摂取カロリーを入力してください。',
            'calories.numeric'          => '数値で入力してください。',

            'exercise_time.required'    => '運動時間を入力してください。',
        ];
    }
}
