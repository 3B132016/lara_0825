<?php

namespace Database\Seeders;

use App\Models\Post; // 引用 Post 模型
use Illuminate\Database\Seeder; // 引用 Seeder 基礎類
use Carbon\Carbon; // 引用 Carbon 處理日期
use Faker\Factory as Faker; // 引用 Faker 工具

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // 清空資料表並重置主鍵
        Post::truncate();

        // 使用 Faker，設置語系為繁體中文
        $faker = Faker::create('zh_TW');

        // 定義生成資料的筆數
        $total = 20;

        // 生成 20 筆測試資料
        foreach (range(1, $total) as $number) {
            Post::create([
                'title' => $faker->sentence, // 使用 Faker 生成隨機標題
                'content' => $faker->paragraph, // 使用 Faker 生成隨機內容
                'is_feature' => rand(0, 1), // 隨機生成布林值 (0 或 1)
                'created_at' => Carbon::now()->subDays($total - $number), // 生成有順序的日期
                'updated_at' => Carbon::now()->subDays($total - $number), // 與 created_at 相同
            ]);
        }
    }
}
