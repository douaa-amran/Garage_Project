<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\Mechanic;
use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reparation>
 */
class RepairFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'description' => $this->faker->sentence,
            'status' => $this->faker->randomElement(['Pending', 'In Progress', 'Completed']),
            'startDate' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'endDate' => $this->faker->dateTimeBetween('now', '+1 month'),
            'mechanicNotes' => $this->faker->paragraph,
            'clientNotes' => $this->faker->paragraph,
            'clientId' => Client::inRandomOrder()->first()->id,
            'mechanicId' => Mechanic::inRandomOrder()->first()->id,
            'vehicleId' => Vehicle::inRandomOrder()->first()->id,
        ];
    }
}
