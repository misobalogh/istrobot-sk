<?php

namespace Database\Factories;

use App\Models\CompetitionCategory;
use App\Models\Category;
use App\Models\Competition;
use Illuminate\Database\Eloquent\Factories\Factory;

class CompetitionCategoryFactory extends Factory
{
    protected $model = CompetitionCategory::class;

    public function definition()
    {
        return [
            'category_id' => Category::factory(),
            'competition_id' => Competition::factory(),
        ];
    }
}
