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
        $user = User::factory()->create();
        return [
            'name' => $this->faker->word . 'Bot',
            'author_first_name' => $user->first_name,
            'author_last_name' => $user->last_name,
            'coauthors' => implode(', ', $this->faker->words(3)),
            'processor' => $this->faker->randomElement(['ARM Cortex-A', 'Intel i7', 'NVIDIA Tegra X1']),
            'memory_size' => $this->faker->numberBetween(512, 32768) . "MB",
            'frequency' => $this->faker->numberBetween(1000, 5000) . "MHz",
            'sensors' => implode(', ', $this->faker->words(3)),
            'drive' => $this->faker->word,
            'power_supply' => $this->faker->randomElement(['battery', 'solar', 'fuel cell']),
            'programming_language' => $this->faker->randomElement(['Python', 'C++', 'C', 'Arduino']),
            'interesting_facts' => $this->faker->text(255), 
            'website' => $this->faker->url,
            'description' => $this->faker->text(255), 
            'user_id' => $user->id,
            'technology_id' => rand(1,4),
        ];
    }
}
