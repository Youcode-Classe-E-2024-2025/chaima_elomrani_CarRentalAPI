<?php

namespace Database\Seeders;

use App\Models\Car;
use App\Models\Rental;
use App\Models\User;
use Illuminate\Database\Seeder;

class RentalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create some users first
        $users = User::factory()->count(5)->create();
        
        // Create some cars with collection
        $cars = collect([
            ...Car::factory()->count(3)->create()->all(), // Regular cars
            ...Car::factory()->count(2)->luxury()->create()->all(), // Luxury cars
            ...Car::factory()->count(3)->economy()->create()->all(), // Economy cars
        ]);

        // Create rentals in different states
        foreach ($users as $user) {
            // Create pending rentals
            Rental::factory()
                ->count(2)
                ->pending()
                ->for($user)
                ->for($cars->random())
                ->create();

            // Create active rentals
            Rental::factory()
                ->count(1)
                ->active()
                ->paid()
                ->for($user)
                ->for($cars->random())
                ->create();

            // Create completed rentals
            Rental::factory()
                ->count(2)
                ->completed()
                ->paid()
                ->for($user)
                ->for($cars->random())
                ->create();

            // Create some overdue rentals
            Rental::factory()
                ->count(1)
                ->overdue()
                ->for($user)
                ->for($cars->random())
                ->create();
        }
    }
}
