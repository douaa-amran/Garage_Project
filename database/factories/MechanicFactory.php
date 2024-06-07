<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Mechanic>
 */
class MechanicFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'firstname' => fake()->name(),
            'lastname' => fake()->name(),
            'cin' => fake()->unique()->regexify('[A-Z][0-9]{6}'),
            'address' => fake()->address(),
            'phoneNumber' => fake()->phoneNumber(),
            'recruitmentDate' => fake()->date(),
            'userId' => \App\Models\User::factory(),
        ];
    }
}
