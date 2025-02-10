<?php

namespace Database\Seeders;

use App\Models\CompanyActivity;
use Illuminate\Database\Seeder;

class CompanyActivitySeeder extends Seeder
{
    public function run()
    {
        CompanyActivity::create([
            'company_id' => 1,
            'category_id' => 2,
        ]);

        CompanyActivity::create([
            'company_id' => 1,
            'category_id' => 3,
        ]);

        CompanyActivity::create([
            'company_id' => 2,
            'category_id' => 2,
        ]);
    }
}
