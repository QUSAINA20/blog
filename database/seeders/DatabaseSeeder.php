<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
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
        User::factory(2)->create()->each(function ($user) {
            Category::factory(3)->create()->each(function ($category) use ($user) {
                Post::factory(3)->create([
                    'user_id' => $user->id,
                    'category_id' => $category->id
                ]);
            });
        });
        // User::factory(5)->create()->each(function ($user) {
        //     Post::factory(3)->create(['user_id' => $user->id]);
        // });
        // Category::factory(5)->create();


        // Category::all()->each(function ($category) {
        //     Post::factory(2)
        //         ->state(['category_id' => $category->id])
        //         ->create();
        // });
    }
}
