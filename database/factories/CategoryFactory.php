<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title'=>$this->faker->sentence(3),
            'meta_title'=>$this->faker->sentence(4),
            'slug'=>$this->faker->sentence(3),
            'content'=>$this->faker->paragraph(3),
        ];
    }
}
