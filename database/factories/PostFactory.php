<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->name();

        return [
            'user_id' => 1,
            'title' => $name,
            'slug' => Str::slug($name),
            'views' => $this->faker->randomNumber(),
            'image' => $this->faker->imageUrl($width = 640, $height = 480),
            'body' => $this->faker->randomHtml(2,10),
            'published' => 1,
        ];
    }
}
