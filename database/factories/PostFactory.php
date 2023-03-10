<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $title = $this->faker->sentence;
        $content = $this->faker->paragraphs(5, true);
        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'body' => $content,
            'category_id' => Category::factory(),
        ];
    }
    public function configure()
    {
        return $this->afterCreating(function (Post $post) {
            $image = $this->faker->image();
            $post
                ->addMedia($image)
                ->preservingOriginal()
                ->toMediaCollection('images');
            Storage::delete($image);
        });
    }
}
