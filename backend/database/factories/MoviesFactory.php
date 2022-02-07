<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MoviesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->word,
            'image_url' => $this->faker->imageUrl(),
        ];
    }
}