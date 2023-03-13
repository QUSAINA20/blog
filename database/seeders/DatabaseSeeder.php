<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
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
        User::factory(3)->create()->each(
            fn ($user) =>
            Category::factory(3)->create()->each(
                fn ($category) =>
                Post::factory(3)->create([
                    'user_id' => $user->id,
                    'category_id' => $category->id
                ])->each(
                    fn ($post) =>
                    Comment::factory(5)->create([
                        'user_id' => User::all()->random()->id,
                        'post_id' => $post->id
                    ])
                )
            )
        );
    }
}
