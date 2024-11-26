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

Route::get('/filter-posts', function () {
    $posts = Post::where('id', '<', 10)->orderBy('id', 'DESC')->get(); // 查詢 id 小於 10 的貼文，並按降序排序

    foreach ($posts as $post) {
        echo '編號: ' . $post->id . '<br>';
        echo '標題: ' . $post->title . '<br>';
        echo '內容: ' . $post->content . '<br>';
        echo '張貼時間: ' . $post->created_at . '<br><br>';
    }
});


Route::get('/post/{id}', function ($id) {
    $post = Post::find($id); // 根據主鍵 id 查詢貼文

    if ($post) {
        echo '編號: ' . $post->id . '<br>';
        echo '標題: ' . $post->title . '<br>';
        echo '內容: ' . $post->content . '<br>';
        echo '張貼時間: ' . $post->created_at . '<br>';
    } else {
        echo 'Post not found!';
    }
});

Route::get('/posts', function () {
    $posts = Post::all(); // 取得所有貼文

    foreach ($posts as $post) {
        echo '編號: ' . $post->id . '<br>';
        echo '標題: ' . $post->title . '<br>';
        echo '內容: ' . $post->content . '<br>';
        echo '張貼時間: ' . $post->created_at . '<br><br>';
    }
});

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
