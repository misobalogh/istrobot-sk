<?php

namespace Database\Factories;

use App\Models\Admin;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition()
    {
        return [
            'name_SK' => $this->faker->word,
            'name_EN' => $this->faker->word,
            'type_of_evaluation' => $this->faker->randomElement(['score', 'time']),
            'admin_id' => 1,
        ];
    }
}
