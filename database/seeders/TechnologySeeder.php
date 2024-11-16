<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Technology;

class TechnologySeeder extends Seeder
{
    private const TECHNOLOGIES = [
        'Other',
        'Lego',
        'Arduino',
        'Raspberry Pi',
        'ESP32',
    ];

    public function run()
    {
        foreach (self::TECHNOLOGIES as $technology) {
            Technology::updateOrCreate(
                ['name' => $technology]
            );
        }
    }
}
