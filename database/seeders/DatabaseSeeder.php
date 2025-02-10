<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            CompanySeeder::class,
            BuildingSeeder::class,
            PhoneSeeder::class,
            CategorySeeder::class,
            CompanyActivitySeeder::class,
        ]);
    }
}
