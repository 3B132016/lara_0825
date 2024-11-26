<?php

use Illuminate\Support\Facades\Route;
use App\Models\Post;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/save-post', function () {
    $post = new Post(); // 創建 Post 的物件
    $post->title = 'test title'; // 設定 title 欄位
    $post->content = 'test content'; // 設定 content 欄位
    $post->save(); // 保存至資料庫

    return 'Post saved successfully!';
});

Route::get('/create-post', function () {
    Post::create([
        'title' => 'created title',
        'content' => 'created content',
    ]);

    return 'Post created successfully!';
});

Route::get('/', function () {
    return view('welcome');
});
