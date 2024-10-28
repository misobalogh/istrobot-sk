<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Competition;

class CompetitionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    private const YEARS = [
        '2020',
        '2021',
        '2022',
        '2023',
        '2024',
    ];

    public function run(int $adminID)
    {
        foreach (self::YEARS as $year) {
            Competition::updateOrCreate(
                [
                    'name' => "Istrobot $year",
                    'year' => $year,
                    'admin_id' => $adminID,
                ]
            );
        }
    }
}
