<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Image;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;
use Database\Factories\CommentFactory;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(3)->create()->each(function ($user) {
            Category::factory(3)->create()->each(function ($category) use ($user) {
                Post::factory(3)->create([
                    'user_id' => $user->id,
                    'category_id' => $category->id,
                ])->each(function ($post) {
                    $tags = Tag::factory(mt_rand(1, 3))->create();
                    $post->tags()->attach($tags);
                    Comment::factory(5)->create([
                        'user_id' => User::all()->random()->id,
                        'commentable_id' => $post->id,
                        'commentable_type' => Post::class,
                    ]);
                });
            });
        });


        Image::factory(3)->create()->each(
            fn ($image) =>
            Comment::factory(5)->create([
                'user_id' => User::all()->random()->id,
                'commentable_id' => $image->id,
                'commentable_type' => Image::class,
            ])
        );
    }
}
