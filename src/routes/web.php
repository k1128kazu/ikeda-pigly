<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterStep1Controller;
use App\Http\Controllers\RegisterStep2Controller;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\WeightLogController;
use App\Http\Controllers\GoalController;
use App\Http\Controllers\LoginController;

// ---------------------------------------------
// トップページ → weight_logs へ
// ---------------------------------------------
Route::get('/', function () {
    return redirect('/login');
});

// ---------------------------------------------
// 認証：STEP1
// ---------------------------------------------
Route::get('/register/step1', [RegisterStep1Controller::class, 'show'])
    ->name('register.step1');

Route::post('/register/step1', [RegisterStep1Controller::class, 'store'])
    ->name('register.step1.store');

// ---------------------------------------------
// 認証：STEP2
// ---------------------------------------------
Route::get('/register/step2', [RegisterStep2Controller::class, 'show'])
    ->name('register.step2');

Route::post('/register/step2', [RegisterStep2Controller::class, 'store'])
    ->name('register.step2.store');

// ---------------------------------------------
// ログイン
// ---------------------------------------------
Route::get('/login', [LoginController::class, 'show'])->name('login');
Route::post('/login', [LoginController::class, 'post'])->name('login.post');

// ---------------------------------------------
// ログアウト
// ---------------------------------------------
Route::post('/logout', [LoginController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// ---------------------------------------------
// 目標体重
// ---------------------------------------------
Route::get('/target', [GoalController::class, 'show'])
    ->middleware('auth')
    ->name('target.show');

Route::post('/target', [GoalController::class, 'update'])
    ->middleware('auth')
    ->name('target.update');

// ---------------------------------------------
// ダッシュボード
// ---------------------------------------------
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware('auth')
    ->name('dashboard');

// ---------------------------------------------
// 体重ログ（一覧）※ /weight_logs にパス統一
// ---------------------------------------------
Route::get('/weight_logs', [WeightLogController::class, 'index'])
    ->middleware('auth')
    ->name('weight_logs.index');

// ---------------------------------------------
// 新規登録
// ---------------------------------------------
Route::get('/weight_logs/create', [WeightLogController::class, 'create'])
    ->middleware('auth')
    ->name('weight_logs.create');

Route::post('/weight_logs', [WeightLogController::class, 'store'])
    ->middleware('auth')
    ->name('weight_logs.store');

// ---------------------------------------------
// 詳細
// ---------------------------------------------
Route::get('/weight_logs/{id}', [WeightLogController::class, 'show'])
    ->middleware('auth')
    ->name('weight_logs.show');

// ---------------------------------------------
// 編集
// ---------------------------------------------
Route::get('/weight_logs/{id}/edit', [WeightLogController::class, 'edit'])
    ->middleware('auth')
    ->name('weight_logs.edit');

Route::put('/weight_logs/{id}', [WeightLogController::class, 'update'])
    ->middleware('auth')
    ->name('weight_logs.update');

// -------------------------------------------------------------
// 削除（DELETE） ← ★重要修正ポイント
// -------------------------------------------------------------
Route::delete('/weight_logs/{id}', [WeightLogController::class, 'destroy'])
    ->middleware('auth')
    ->name('weight_logs.destroy');
