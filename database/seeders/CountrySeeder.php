<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Country;

class CountrySeeder extends Seeder
{
    private const COUNTRIES = [
        ['country_code' => '--', 'name_SK' => 'Zahraničie', 'name_EN' => 'Abroad'],
        ['country_code' => 'SK', 'name_SK' => 'Slovensko', 'name_EN' => 'Slovakia'],
        ['country_code' => 'CZ', 'name_SK' => 'Česko', 'name_EN' => 'Czechia'],
        ['country_code' => 'HU', 'name_SK' => 'Maďarsko', 'name_EN' => 'Hungary'],
        ['country_code' => 'AT', 'name_SK' => 'Rakúsko', 'name_EN' => 'Austria'],
        ['country_code' => 'PL', 'name_SK' => 'Poľsko', 'name_EN' => 'Poland'],
        ['country_code' => 'DE', 'name_SK' => 'Nemecko', 'name_EN' => 'Germany'],
    ];

    public function run()
    {
        foreach (self::COUNTRIES as $country) {
            Country::updateOrCreate(
                ['country_code' => $country['country_code']],
                $country
            );
        }
    }
}
