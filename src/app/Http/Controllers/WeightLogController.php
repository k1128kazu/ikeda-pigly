<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\WeightLog;

class WeightLogController extends Controller
{
    /**
     * 一覧表示（Dashboardで使用）
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
            'weight'           => ['required', 'numeric'],
            'calories'         => ['required', 'integer'],    // ★ 正しいカラム
            'exercise_time'    => ['required'],
            'exercise_content' => ['nullable', 'string'],     // ★ 正しいカラム
        ]);

        WeightLog::create([
            'user_id'          => Auth::id(),
            'date'             => $request->date,
            'weight'           => $request->weight,
            'calories'         => $request->calories,         // ★ 正しいキー
            'exercise_time'    => $request->exercise_time,
            'exercise_content' => $request->exercise_content, // ★ 正しいキー
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
            'weight'           => ['required', 'numeric'],
            'calories'         => ['required', 'integer'],    // ★ 正しいカラム
            'exercise_time'    => ['required'],
            'exercise_content' => ['nullable', 'string'],      // ★ 正しいカラム
        ]);

        $log = WeightLog::where('user_id', Auth::id())->findOrFail($id);

        $log->update([
            'date'             => $request->date,
            'weight'           => $request->weight,
            'calories'         => $request->calories,         // ★ 正しいキー
            'exercise_time'    => $request->exercise_time,
            'exercise_content' => $request->exercise_content,  // ★ 正しいキー
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
}
