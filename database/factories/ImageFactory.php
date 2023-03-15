<?php

namespace Database\Factories;

use App\Models\Image;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Image>
 */
class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $name = $this->faker->sentence;
        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'description' => $this->faker->paragraph()
        ];
    }
    public function configure()
    {
        return $this->afterCreating(function (Image $image) {
            $imageFile = $this->faker->image();
            $image
                ->addMedia($imageFile)
                ->preservingOriginal()
                ->toMediaCollection('images');
            Storage::delete($imageFile);
        });
    }
}
