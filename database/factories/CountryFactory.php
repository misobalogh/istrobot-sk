<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Country;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Country>
 */
class CountryFactory extends Factory
{
    protected $model = Country::class;

    public function definition()
    {
        return [
            'country_code' => $this->faker->countryCode,
            'name_SK' => $this->faker->text(50),
            'name_EN' => $this->faker->text(50),
        ];
    }
}