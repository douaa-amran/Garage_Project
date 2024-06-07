<?php

namespace Database\Factories;

use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory
 */
class VehicleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
{
    $faker = \Faker\Factory::create();

    return [
        'make' => fake()->name(),
        'model' => fake()->name(),
        'year' => fake()->unique()->year(),
        'license_plate' => fake()->unique()->regexify('[A-Z]{2}[0-9]{2}[A-Z]{2}[0-9]{4}'),
        'vin' => fake()->unique()->regexify('[A-HJ-NPR-Z0-9]{17}'),
        'fuelType' => fake()->randomElement(['Gasoline', 'Diesel', 'Electric', 'Hybrid']),
        'clientId' => Client::inRandomOrder()->first()->id,
    ];
}

}
