<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ParkingSpot;
use Illuminate\Support\Str;

class ParkingSpotSeeder extends Seeder
{
    public function run()
    {
        $sizes = ['small', 'medium', 'large'];

        $unavailabilityPercentage = 30;

        for ($i = 1; $i <= 5; $i++) {
            $size = $sizes[array_rand($sizes)];

            $availability = (rand(1, 100) > $unavailabilityPercentage) ? true : false;

            ParkingSpot::create([
                'id' => Str::uuid(),
                'parking_name' => 'Parking ' . $i,
                'size' => $size,
                'availability' => $availability,
            ]);
        }
    }
}
