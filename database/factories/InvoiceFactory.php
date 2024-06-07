<?php

namespace Database\Factories;

use App\Models\Repair;
use App\Models\SparePart;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Invoice>
 */
class InvoiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'repairId' => Repair::factory(),
            'sparepartId' => SparePart::factory(),
            'quantity' => $this->faker->numberBetween(1, 10),
            'additionalCharges' => $this->faker->randomFloat(2, 0, 100),
            'total' => $this->faker->randomFloat(2, 50, 500),
        ];
    }
}
