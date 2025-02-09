<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TallaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'descripcion' => $this->faker->sentence(1),
            'estado' => '1',
        ];
    }
}
