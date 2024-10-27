<?php

namespace Database\Factories;

use App\Models\Competition;
use App\Models\Admin;
use Illuminate\Database\Eloquent\Factories\Factory;

class CompetitionFactory extends Factory
{
    protected $model = Competition::class;

    public function definition()
    {
        $year = $this->faker->year;
        return [
            'name' => "Istrobot {$year}",
            'year' => $year,
            'admin_id' => Admin::factory(),
        ];
    }
}
