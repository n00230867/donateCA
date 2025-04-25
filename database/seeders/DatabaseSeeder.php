<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Donation;
use App\Models\Charity;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(DonationSeeder::class);
        $this->call(CharitySeeder::class);

        User::factory(100)->create();
        Charity::factory(200)->create();

        Donation::factory(500)->create()->each(function ($donation) {
            $donation->charities()->attach(
                Charity::inRandomOrder()->take(rand(1, 3))->pluck('id')
            );
        });
    }
}
