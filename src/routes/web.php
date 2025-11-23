<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterStep1Controller;
use App\Http\Controllers\RegisterStep2Controller;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\WeightLogController;
use App\Http\Controllers\GoalController;
use App\Http\Controllers\LoginController;

Route::get('/', function () {
    return redirect('/login');
});
// ---------------------------------------------
// 認証前：STEP1（メール・パスワード）
// ---------------------------------------------
Route::get('/register/step1', [RegisterStep1Controller::class, 'show'])
    ->name('register.step1');
Route::post('/register/step1', [RegisterStep1Controller::class, 'post'])
    ->name('register.step1.post');

// ---------------------------------------------
// 認証前：STEP2（身長・初期体重）
// ---------------------------------------------
Route::get('/register/step2', [RegisterStep2Controller::class, 'show'])
    ->name('register.step2');
Route::post('/register/step2', [RegisterStep2Controller::class, 'post'])
    ->name('register.step2.post');

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
// 目標体重：表示 & 更新（PiGLy仕様）
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
// 体重ログ：新規登録
// ---------------------------------------------
Route::get('/weight-logs/create', [WeightLogController::class, 'create'])
    ->middleware('auth')
    ->name('weight_logs.create');

Route::post('/weight-logs', [WeightLogController::class, 'store'])
    ->middleware('auth')
    ->name('weight_logs.store');

// ---------------------------------------------
// 体重ログ：詳細
// ---------------------------------------------
Route::get('/weight-logs/{id}', [WeightLogController::class, 'show'])
    ->middleware('auth')
    ->name('weight_logs.show');

// ---------------------------------------------
// 体重ログ：編集（表示）
// ---------------------------------------------
Route::get('/weight-logs/{id}/edit', [WeightLogController::class, 'edit'])
    ->middleware('auth')
    ->name('weight_logs.edit');

// ---------------------------------------------
// 体重ログ：更新（PUT に変更 ✔）
// ---------------------------------------------
Route::put('/weight-logs/{id}', [WeightLogController::class, 'update'])
    ->middleware('auth')
    ->name('weight_logs.update');

// ---------------------------------------------
// 体重ログ：削除
// ---------------------------------------------
Route::delete('/weight-logs/{id}', [WeightLogController::class, 'destroy'])
    ->middleware('auth')
    ->name('weight_logs.destroy');

// ---------------------------------------------
// 日本語バリデーションテスト
// ---------------------------------------------
Route::get('/test-lang', function () {
    return __('validation.required');
});
