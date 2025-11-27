<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // ★ truncate → delete に変更（外部キー制約エラー回避）
        DB::table('users')->delete();

        DB::table('users')->insert([
            [
                'name'           => '山田 太郎',
                'email'          => 'taro@example.com',
                'password'       => Hash::make('password123'),
                'initial_weight' => 65.0,
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            [
                'name'           => '佐藤 花子',
                'email'          => 'hanako@example.com',
                'password'       => Hash::make('password123'),
                'initial_weight' => 55.5,
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            [
                'name'           => '鈴木 次郎',
                'email'          => 'jiro@example.com',
                'password'       => Hash::make('password123'),
                'initial_weight' => 72.3,
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
        ]);
    }
}
