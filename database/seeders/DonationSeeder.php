<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Donation;
use App\Models\User;
use Carbon\Carbon;

class DonationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // First, ensure we have at least one user
        $user = User::firstOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'password' => bcrypt('password'),
                'role' => 'user'
            ]
        );

        $currentTimestamp = Carbon::now();

        Donation::insert([
            [
                'user_id' => $user->id,
                'title' => 'Winter Jackets',
                'image' => 'jackets.jpg',
                'category' => 'Clothing',
                'quantity' => 5,
                'description' => 'Gently used winter jackets in good condition.',
                'availability' => 'Available',
                'created_at' => $currentTimestamp,
                'updated_at' => $currentTimestamp,
            ],
            [
                'user_id' => $user->id,
                'title' => 'Coat Hangers',
                'image' => 'coat_hangers.jpg',
                'category' => 'Household Items',
                'quantity' => 30,
                'description' => 'Plastic and wooden coat hangers, various sizes.',
                'availability' => 'Available',
                'created_at' => $currentTimestamp,
                'updated_at' => $currentTimestamp,
            ],
            [
                'user_id' => $user->id,
                'title' => 'Used Books',
                'image' => 'books.jpg',
                'category' => 'Books',
                'quantity' => 10,
                'description' => 'A mix of novels, textbooks, and self-help books.',
                'availability' => 'Available',
                'created_at' => $currentTimestamp,
                'updated_at' => $currentTimestamp,
            ],
            [
                'user_id' => $user->id,
                'title' => 'Kitchen Utensils',
                'image' => 'kitchen_utensils.jpg',
                'category' => 'Household Items',
                'quantity' => 15,
                'description' => 'Set of spoons, forks, knives, and cooking tools.',
                'availability' => 'Pending',
                'created_at' => $currentTimestamp,
                'updated_at' => $currentTimestamp,
            ],
            [
                'user_id' => $user->id,
                'title' => 'Children Toys',
                'image' => 'toys.jpg',
                'category' => 'Toys',
                'quantity' => 8,
                'description' => 'Assorted toys for kids aged 3-7, including puzzles and stuffed animals.',
                'availability' => 'Available',
                'created_at' => $currentTimestamp,
                'updated_at' => $currentTimestamp,
            ],
        ]);
    }
}