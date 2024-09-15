<?php

namespace Database\Factories;

use App\Models\Post as ModelsPost;
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
            'post_id'=>ModelsPost::query()->inRandomOrder()->value('id'),
            'content'=>$this->faker->paragraph(3),
            'author'=>$this->faker->name(),
        ];
    }
}
