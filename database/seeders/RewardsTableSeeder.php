<?php

// database/seeders/RewardsTableSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Reward;

class RewardsTableSeeder extends Seeder
{
    public function run()
    {
        $rewards = [
            ['name' => 'Kecap Manis', 'points' => 6],
            ['name' => 'Susu UHT 1L', 'points' => 12],
            ['name' => 'Gula 1Kg', 'points' => 15],
            ['name' => 'Minyak Goreng 1.5L', 'points' => 20],
            ['name' => 'Beras 5Kg', 'points' => 30],
        ];

        foreach ($rewards as $reward) {
            Reward::create($reward);
        }
    }
}