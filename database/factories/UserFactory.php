<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'mobile' => $this->faker->phoneNumber(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' =>$this->faker->password(),
            'role'=>$this->faker->numberBetween(0,2),
        ];
    }
}
