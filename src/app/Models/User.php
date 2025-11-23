<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * テーブルのfillable設定
     */
    protected $fillable = [
        'email',
        'password',
        'height',
        'initial_weight',
    ];

    /**
     * password を自動的に隠す設定
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * キャスト設定（Laravel 標準）
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * WeightLog とのリレーション
     * 1ユーザー：多ログ
     */
    public function weightLogs()
    {
        return $this->hasMany(WeightLog::class);
    }

    /**
     * WeightTarget（目標体重）とのリレーション
     * 1ユーザー：1目標
     */
    public function weightTarget()
    {
        return $this->hasOne(WeightTarget::class);
    }
}
