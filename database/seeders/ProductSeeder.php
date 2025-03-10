<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $currentTimestamp = Carbon::now();

        // Get a user ID dynamically (for example, the first user in the table)
        $userId = User::first()->id;

        Product::insert([
            [
                'title' => 'Coat Hangers',
                'category' => 'Plastic',
                'price' => 5.99,
                'user_id' => $userId,
                'image' => 'images/products/coat_hangers.jpg',
                'created_at' => $currentTimestamp,
                'updated_at' => $currentTimestamp
            ],
            [
                'title' => 'Leather Wallet',
                'category' => 'Accessories',
                'price' => 19.99,
                'user_id' => $userId,
                'image' => 'images/products/leather_wallet.jpg',
                'created_at' => $currentTimestamp,
                'updated_at' => $currentTimestamp
            ],
            [
                'title' => 'Cotton T-shirt',
                'category' => 'Clothing',
                'price' => 14.99,
                'user_id' => $userId,
                'image' => 'images/products/cotton_tshirt.jpg',
                'created_at' => $currentTimestamp,
                'updated_at' => $currentTimestamp
            ],
            [
                'title' => 'Wireless Mouse',
                'category' => 'Electronics',
                'price' => 29.99,
                'user_id' => $userId,
                'image' => 'images/products/wireless_mouse.jpg',
                'created_at' => $currentTimestamp,
                'updated_at' => $currentTimestamp
            ],
            [
                'title' => 'Desk Lamp',
                'category' => 'Furniture',
                'price' => 39.99,
                'user_id' => $userId,
                'image' => 'images/products/desk_lamp.jpg',
                'created_at' => $currentTimestamp,
                'updated_at' => $currentTimestamp
            ]
        ]);
    }
}
