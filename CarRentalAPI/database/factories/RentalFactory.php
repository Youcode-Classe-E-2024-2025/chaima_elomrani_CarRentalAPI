<?php

namespace Database\Factories;
use Faker\Generator as Faker;
use App\Models\Car;
use App\Models\User;
use App\Models\Rental;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Rental>
 */
class RentalFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Rental::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $rental_date = $this->faker->dateTimeBetween('-1 month', '+1 month');
        $return_date = clone $rental_date;
        $return_date->modify('+' . rand(1, 30) . ' days');

        return [
            'user_id' => User::factory(),
            'car_id' => Car::factory(),
            'rental_date' => $rental_date,
            'return_date' => $return_date,
            
        ];
    }

  


    /**
     * Indicate that the rental is overdue.
     */
    public function overdue(): Factory
    {
        return $this->state(function (array $attributes) {
            $rental_date = $this->faker->dateTimeBetween('-2 months', '-1 month');
            $return_date = clone $rental_date;
            $return_date->modify('+15 days');

            return [
                'rental_date' => $rental_date,
                'return_date' => $return_date,
                'payment_status' => $this->faker->randomElement(['pending', 'paid'])
            ];
        });
    }

    
}
