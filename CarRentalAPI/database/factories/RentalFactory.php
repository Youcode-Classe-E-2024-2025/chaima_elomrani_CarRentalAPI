<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Rental>
 */
class RentalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id'=>$this->faker->name(),
            'car_id'=>$this->faker->name(),
            'rental_date'=>$this->faker->name(),
            'return_date'=>$this->faker->name(),    
        ];
    }
}
