<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CreatePostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $post = [
            'title' => 'Test title 3.',
            'body' => 'Test body 3.',
            'user_id' => '3',
            'category_id' => '2'
        ];
        Post::create($post);
    }
}
