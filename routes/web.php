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

Route::get('/comment-post/{id}', function ($id) {
    $comment = App\Models\Comment::find($id); // 查詢指定 ID 的留言

    if (!$comment) {
        return "Comment with ID {$id} not found!";
    }

    // 取得留言所屬的貼文
    $post = $comment->post;

    echo "留言內容：{$comment->content}<br>";
    echo "所屬貼文標題：{$post->title}<br>";
});

Route::get('/post-comments/{id}', function ($id) {
    $post = App\Models\Post::find($id); // 查詢指定 ID 的貼文

    if (!$post) {
        return "Post with ID {$id} not found!";
    }

    // 取得貼文的所有留言
    $comments = $post->comments;

    echo "貼文標題：{$post->title}<br>";
    echo "留言清單：<br>";

    foreach ($comments as $comment) {
        echo "留言內容：{$comment->content}<br>";
    }
});

Route::get('/add-comment/{id}', function ($id) {
    $post = Post::find($id);

    if (!$post) {
        return "Post with ID {$id} not found!";
    }

    $post->comments()->create([
        'content' => 'This is a test comment.',
    ]);

    return "Comment added to post with ID {$id}!";
});

Route::get('/latest-post', function () {
    $lastPost = Post::orderBy('id', 'DESC')->first(); // 取得最新一筆資料
    dd($lastPost);
});

Route::get('/single-post/{id}', function ($id) {
    $post = Post::find($id); // 根據 ID 查詢貼文
    dd($post);
});

Route::get('/featured-posts', function () {
    $featuredPosts = Post::where('is_feature', 1)->get(); // 篩選出 is_feature = 1 的貼文
    dd($featuredPosts);
});


Route::get('/all-posts', function () {
    $allPosts = Post::all(); // 取得所有貼文（Collection）
    dd($allPosts); // 顯示 Collection 的內容
});


Route::get('/destroy-posts', function () {
    Post::destroy([2, 3, 5]); // 刪除多筆貼文（ID 為 2, 3, 5）
    return "Posts with IDs 2, 3, 5 deleted successfully!";
});


Route::get('/delete-post/{id}', function ($id) {
    $post = Post::find($id); // 查詢要刪除的貼文
    if ($post) {
        $post->delete(); // 刪除貼文
        return "Post with ID {$id} deleted successfully!";
    } else {
        return "Post with ID {$id} not found!";
    }
});


Route::get('/save-update-post/{id}', function ($id) {
    $post = Post::find($id); // 查詢貼文
    if ($post) {
        $post->title = 'saved title'; // 修改 title 欄位
        $post->content = 'saved content'; // 修改 content 欄位
        $post->save(); // 保存至資料庫

        return 'Post saved successfully!';
    } else {
        return 'Post not found!';
    }
});


Route::get('/update-post/{id}', function ($id) {
    $post = Post::find($id); // 查詢貼文
    if ($post) {
        $post->update([
            'title' => 'updated title',
            'content' => 'updated content',
        ]);

        return 'Post updated successfully!';
    } else {
        return 'Post not found!';
    }
});

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
