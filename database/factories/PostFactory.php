<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     * 
     * Los factorys sirven para hacer testing.
     */
    public function definition()
    {
        return [
            'titulo' => $this->faker->sentence(5),
            'descripcion' => $this->faker->sentences(20),
            'imagen' => $this->faker->uuid() . '.jpg',
            'user_id' => $this->faker->randomElement([19,20])
        ];
    }
}
