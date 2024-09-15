<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\CategoryPost;
use App\Models\Comment;
use App\Models\Meta;
use App\Models\Post;
use App\Models\PostTag;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(100)->create();
        Post::factory(100)->create();
        Comment::factory(100)->create();
        Meta::factory(100)->create();
        Tag::factory(20)->create();
        Category::factory(20)->create();
        PostTag::factory(50)->create();
        CategoryPost::factory(50)->create();
    }
}
