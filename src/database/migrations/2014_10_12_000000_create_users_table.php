<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            // --- 今回のシステムで使うカラム ---
            $table->string('email')->unique();
            $table->string('password');

            $table->unsignedInteger('height');         // 身長
            $table->unsignedInteger('initial_weight'); // 初期体重

            // --- Laravel 標準 ---
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
