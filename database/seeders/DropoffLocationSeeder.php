<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DropoffLocation;

class DropoffLocationSeeder extends Seeder
{
    public function run()
    {
        DropoffLocation::insert([
            [
                'charity_id' => 1, // Society of St. Vincent de Paul
                'location_name' => 'SVP South Circular Road',
                'cord' => '53.3347,-6.2781', // Dublin
                'collection_point' => 'Main Entrance',
            ],
            [
                'charity_id' => 1,
                'location_name' => 'SVP Cork City Centre',
                'cord' => '51.8985,-8.4756', // Cork
                'collection_point' => 'Rear Drop-off Area',
            ],
            [
                'charity_id' => 2, // Irish Cancer Society
                'location_name' => 'Irish Cancer Society HQ',
                'cord' => '53.3398,-6.2630', // Dublin
                'collection_point' => 'Reception Desk',
            ],
            [
                'charity_id' => 3, // Irish Heart Foundation
                'location_name' => 'Irish Heart Foundation Office',
                'cord' => '53.3438,-6.2546', // Dublin
                'collection_point' => 'Front Entrance',
            ],
            [
                'charity_id' => 4, // Pieta House
                'location_name' => 'Pieta House Tallaght',
                'cord' => '53.2869,-6.3661', // Tallaght, Dublin
                'collection_point' => 'Main Lobby',
            ],
            [
                'charity_id' => 5, // Focus Ireland
                'location_name' => 'Focus Ireland Drop-in Centre',
                'cord' => '53.3500,-6.2603', // Dublin
                'collection_point' => 'Side Gate',
            ],
            [
                'charity_id' => 5,
                'location_name' => 'Focus Ireland Limerick',
                'cord' => '52.6648,-8.6231', // Limerick
                'collection_point' => 'Reception',
            ],
        ]);
    }
}