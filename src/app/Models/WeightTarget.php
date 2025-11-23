<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeightTarget extends Model
{
    use HasFactory;

    // ★ ここを追加（この1行が今回のエラーの100%の原因を解決）
    protected $table = 'weight_target';

    protected $fillable = [
        'user_id',
        'target_weight',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
