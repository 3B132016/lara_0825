<?php

namespace Database\Seeders;
use App\Models\Post;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        foreach (range(1, 20) as $number) {
            Post::create([
                'title' => 'title ' . $number,
                'content' => 'content ' . $number,
            ]);
        }
    }
}




