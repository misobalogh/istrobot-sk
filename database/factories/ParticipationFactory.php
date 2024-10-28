<?php

namespace Database\Factories;

use App\Models\Participation;
use App\Models\Robot;
use App\Models\Category;
use App\Models\Competition;
use Illuminate\Database\Eloquent\Factories\Factory;

class ParticipationFactory extends Factory
{
    protected $model = Participation::class;

    public function definition()
    {
        return [
            'robot_id' => Robot::factory(),
            'category_id' => null,
            'competition_id' => null,
            'start_number' => $this->faker->numberBetween(1, 100),
            'result' => $this->faker->randomFloat(2, 0, 100),
        ];
    }
}
