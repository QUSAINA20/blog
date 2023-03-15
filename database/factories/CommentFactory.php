<?php

namespace Database\Factories;

use App\Models\Image;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */


    public function definition()
    {
        return [
            'body' => $this->faker->paragraph(),
            'user_id' => User::factory(),
            'commentable_id' => function () {
                return rand(0, 1) ? Post::factory()->create()->id : Image::factory()->create()->id;
            },
            'commentable_type' => function ($attributes) {
                return $attributes['commentable_id'] instanceof Post ? Post::class : Image::class;
            },
        ];
    }
}
