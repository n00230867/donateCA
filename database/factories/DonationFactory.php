<?php

namespace Database\Factories;

use App\Models\Donation;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class DonationFactory extends Factory
{
    protected $model = Donation::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'title' => $this->faker->sentence,
            'image' => $this->faker->imageUrl(),
            'category' => $this->faker->word,
            'quantity' => $this->faker->numberBetween(1, 100),
            'description' => $this->faker->text(200), // Limit to 200 characters

            'availability' => $this->faker->randomElement(['Available', 'Pending', 'Unavailable']),

        ];
    }
}
