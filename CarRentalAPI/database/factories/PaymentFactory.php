<?php

namespace Database\Factories;

use App\Models\Rental;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'amount' => $this->faker->randomFloat(2, 10, 100),
            'payment_date' => $this->faker->dateTimeBetween('-1 month', '+1 month'),
            'rental_id' => Rental::factory(),

        ];
    }
}
