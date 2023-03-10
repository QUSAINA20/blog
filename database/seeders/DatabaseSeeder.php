<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\Post;
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

        Category::factory(5)->create();


        Category::all()->each(function ($category) {
            Post::factory(2)
                ->state(['category_id' => $category->id])
                ->create();
        });
    }
}
