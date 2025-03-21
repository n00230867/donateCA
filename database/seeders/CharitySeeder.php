<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Charity;
use Carbon\Carbon;

class CharitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $currentTimestamp = Carbon::now();

        Charity::insert([
            [
                'title' => 'Society of St. Vincent de Paul',
                'registration_no' => '20013806',
                'image' => 'svp.png',
                'description' => 'Provides direct assistance to those in need and tackles social injustice.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Irish Cancer Society',
                'registration_no' => '20009502',
                'image' => 'irish_cancer_society.png',
                'description' => 'Dedicated to cancer research and supporting those affected by cancer.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Irish Heart Foundation',
                'registration_no' => '20008376',
                'image' => 'irish_heart_foundation.png',
                'description' => 'Fights heart disease and stroke through education and research.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Pieta House',
                'registration_no' => '20062026',
                'image' => 'pieta_house.png',
                'description' => 'Provides free support for those in suicidal distress or engaging in self-harm.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Focus Ireland',
                'registration_no' => '20015107',
                'image' => 'focus_ireland.png',
                'description' => 'Works to prevent homelessness and support those at risk.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
