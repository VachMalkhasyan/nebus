<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    public function run()
    {
        Company::create([
            'id' => 1,
            'name' => 'ООО «Молочные Продукты»',
        ]);

        Company::create([
            'id' => 2,
            'name' => 'ООО «Мясные Изделия»',
        ]);

        Company::create([
            'id' => 3,
            'name' => 'ООО «Техники и Машины»',
        ]);
    }
}
