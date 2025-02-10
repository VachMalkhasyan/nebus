<?php

namespace Database\Seeders;

use App\Models\Building;
use Illuminate\Database\Seeder;

class BuildingSeeder extends Seeder
{
    public function run()
    {
        Building::create([
            'id' => 1,
            'address' => 'Москва, Ленинский проспект, 1, офис 3',
            'coordinates' => json_encode(['latitude' => 55.7558, 'longitude' => 37.6173]),
            'company_id' => 1,
        ]);

        Building::create([
            'id' => 2,
            'address' => 'Санкт-Петербург, Невский проспект, 12, офис 45',
            'coordinates' => json_encode(['latitude' => 59.9343, 'longitude' => 30.3351]),
            'company_id' => 2,
        ]);

        Building::create([
            'id' => 3,
            'address' => 'Новосибирск, Красный проспект, 20, офис 12',
            'coordinates' => json_encode(['latitude' => 55.0084, 'longitude' => 82.9357]),
            'company_id' => 3,
        ]);
    }
}
