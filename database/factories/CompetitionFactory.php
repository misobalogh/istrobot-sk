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
        $year = $this->faker->randomElement([2020, 2021, 2022, 2023, 2024]);
        return [
            'name' => "Istrobot {$year}",
            'year' => $year,
        ];
    }

    public function withAdmin(Admin $admin)
    {
        return $this->state([
            'admin_id' => $admin->id,
        ]);
    }
}
