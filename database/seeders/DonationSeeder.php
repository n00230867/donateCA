<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Donation;
use App\Models\User;
use Carbon\Carbon;

class DonationSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::firstOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'password' => bcrypt('password'),
                'role' => 'user'
            ]
        );

        $currentTimestamp = Carbon::now();

        $donationsData = [
            [
                'user_id' => $user->id,
                'title' => 'Winter Jackets',
                'image' => 'jackets.jpg',
                'category' => 'Clothing',
                'quantity' => 5,
                'description' => 'Gently used winter jackets in good condition.',
                'availability' => 'Available',
                'charities' => [$redCross->id, $focusIreland->id] // Assign to these charities
            ],
            [
                'user_id' => $user->id,
                'title' => 'Coat Hangers',
                'image' => 'coat_hangers.jpg',
                'category' => 'Household Items',
                'quantity' => 30,
                'description' => 'Plastic and wooden coat hangers, various sizes.',
                'availability' => 'Available',
                'charities' => [$cancerSociety->id] // Assign to just this charity
            ],
            [
                'user_id' => $user->id,
                'title' => 'Used Books',
                'image' => 'books.jpg',
                'category' => 'Books',
                'quantity' => 10,
                'description' => 'A mix of novels, textbooks, and self-help books.',
                'availability' => 'Available',
                'charities' => [$heartFoundation->id, $pietaHouse->id, $focusIreland->id] // Multiple charities
            ],
            [
                'user_id' => $user->id,
                'title' => 'Kitchen Utensils',
                'image' => 'kitchen_utensils.jpg',
                'category' => 'Household Items',
                'quantity' => 15,
                'description' => 'Set of spoons, forks, knives, and cooking tools.',
                'availability' => 'Pending',
                'charities' => [$redCross->id] // Single charity
            ],
            [
                'user_id' => $user->id,
                'title' => 'Children Toys',
                'image' => 'toys.jpg',
                'category' => 'Toys',
                'quantity' => 8,
                'description' => 'Assorted toys for kids aged 3-7, including puzzles and stuffed animals.',
                'availability' => 'Available',
                'charities' => [$pietaHouse->id, $cancerSociety->id] // Two charities
            ],
        ];

        foreach ($donations as $donation) {
            Donation::create(array_merge($donation, [
                'created_at' => $currentTimestamp,
                'updated_at' => $currentTimestamp
            ]));
        }
    }
}