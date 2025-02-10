<?php

namespace Database\Seeders;

use App\Models\Phone;
use Illuminate\Database\Seeder;

class PhoneSeeder extends Seeder
{
    public function run()
    {
        Phone::create([
            'id' => 1,
            'company_id' => 1,
            'phone_number' => '+7 495 123-45-67',
        ]);

        Phone::create([
            'id' => 2,
            'company_id' => 1,
            'phone_number' => '+7 495 234-56-78',
        ]);

        Phone::create([
            'id' => 3,
            'company_id' => 2,
            'phone_number' => '+7 812 111-22-33',
        ]);

        Phone::create([
            'id' => 4,
            'company_id' => 2,
            'phone_number' => '+7 812 444-55-66',
        ]);

        Phone::create([
            'id' => 5,
            'company_id' => 3,
            'phone_number' => '+7 383 777-88-99',
        ]);

        Phone::create([
            'id' => 6,
            'company_id' => 3,
            'phone_number' => '+7 383 555-66-77',
        ]);
    }
}
