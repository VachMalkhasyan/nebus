<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run()
    {
        Category::create([
            'id' => 1,
            'name' => 'Продукты Питания',
        ]);

        Category::create([
            'id' => 2,
            'name' => 'Мясные Продукты',
            'parent_id' => 1,
        ]);

        Category::create([
            'id' => 3,
            'name' => 'Молочные Продукты',
            'parent_id' => 1,
        ]);


    }
}
