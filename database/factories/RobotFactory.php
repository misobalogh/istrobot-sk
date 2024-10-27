<?php

namespace Database\Factories;

use App\Models\Robot;
use App\Models\User;
use App\Models\Technology;
use Illuminate\Database\Eloquent\Factories\Factory;

class RobotFactory extends Factory
{
    protected $model = Robot::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word . 'Bot',
            'coauthors' => implode(', ', $this->faker->words(3)),
            'processor' => $this->faker->randomElement(['ARM Cortex-A', 'Intel i7', 'NVIDIA Tegra X1']),
            'memory_size' => $this->faker->numberBetween(512, 32768),
            'frequency' => $this->faker->numberBetween(1000, 5000),
            'sensors' => implode(', ', $this->faker->words(3)),
            'drive' => $this->faker->word,
            'power_supply' => $this->faker->randomElement(['battery', 'solar', 'fuel cell']),
            'programming_language' => $this->faker->randomElement(['Python', 'C++', 'C', 'Arduino']),
            'interesting_facts' => $this->faker->sentence,
            'website' => $this->faker->url,
            'description' => $this->faker->paragraph,
            'user_id' => User::factory(),
            'technology_id' => Technology::factory(),
        ];
    }
}
