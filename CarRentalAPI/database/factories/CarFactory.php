<?php

namespace Database\Factories;

use App\Models\Car;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Car>
 */
class CarFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Car::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $carBrands = [
            'Toyota', 'Honda', 'Ford', 'BMW', 'Mercedes', 
            'Audi', 'Volkswagen', 'Tesla', 'Hyundai', 'Kia'
        ];

        $carModels = [
            'Sedan', 'SUV', 'Coupe', 'Hatchback', 
            'Convertible', 'Pickup', 'Van'
        ];

        $colors = [
            'Black', 'White', 'Silver', 'Gray', 'Red', 
            'Blue', 'Green', 'Yellow', 'Brown', 'Orange'
        ];

        return [
            'name' => $this->faker->randomElement($carBrands) . ' ' . 
                     $this->faker->randomElement($carModels),
            'model' => (string)$this->faker->year(),
            'color' => $this->faker->randomElement($colors),
            'price' => $this->faker->randomFloat(2, 50, 500), // Daily rental price
        ];
    }

    /**
     * Configure the model factory.
     *
     * @return $this
     */
    public function luxury(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'price' => $this->faker->randomFloat(2, 200, 1000),
            ];
        });
    }

    /**
     * Configure the model factory for economy cars.
     *
     * @return $this
     */
    public function economy(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'price' => $this->faker->randomFloat(2, 30, 100),
            ];
        });
    }
}
