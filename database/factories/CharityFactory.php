<?php

namespace Database\Factories;

use App\Models\Charity;
use Illuminate\Database\Eloquent\Factories\Factory;

class CharityFactory extends Factory
{
    protected $model = Charity::class;

    public function definition()
    {
        return [
            'title' => $this->faker->company,
            'registration_no' => $this->faker->unique()->uuid,
            'image' => $this->faker->imageUrl(),
            'description' => $this->faker->paragraph,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
