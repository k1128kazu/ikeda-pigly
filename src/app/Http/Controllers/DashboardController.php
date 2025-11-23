<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\WeightLog;
use App\Models\WeightTarget;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        // 初期値（STEP2で登録した値）
        $height = $user->height;
        $initial_weight = $user->initial_weight;

        // 最新体重
        $latest_log = WeightLog::where('user_id', $user->id)
            ->orderBy('date', 'desc')
            ->first();

        $current_weight = $latest_log ? $latest_log->weight : $initial_weight;

        // BMI
        $bmi = $height ? round($current_weight / (($height / 100) ** 2), 1) : null;

        // 目標体重
        $target = WeightTarget::where('user_id', $user->id)->first();
        $target_weight = $target ? $target->target_weight : null;

        // 体重ログ（検索 + ページネーション）
        $logs = WeightLog::where('user_id', $user->id)
            ->when($request->start, fn($q) => $q->where('date', '>=', $request->start))
            ->when($request->end, fn($q) => $q->where('date', '<=', $request->end))
            ->orderBy('date', 'desc')
            ->paginate(10)
            ->withQueryString();   // ← 検索キープ

        return view('dashboard', compact(
            'height',
            'initial_weight',
            'current_weight',
            'bmi',
            'target_weight',
            'logs'
        ));
    }
}
