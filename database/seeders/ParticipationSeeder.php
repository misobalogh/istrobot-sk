<?php

namespace Database\Seeders;

use App\Models\Participation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Admin;
class ParticipationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(array $comp, array $cat, array $robots): void
    {
        if (empty($comp) || empty($cat) || empty($robots)) {
            $this->command->info('No competitions, categories, or robots available to seed participations.');
            return;
        }

        foreach ($robots as $robot) {
            $numParticipations = rand(1, 3);

            for ($i = 0; $i < $numParticipations; $i++) {
                $competition = $comp[array_rand($comp)];
                $category = $cat[array_rand($cat)];

                Participation::create([
                    'robot_id' => $robot['id'],
                    'category_id' => $category['id'],
                    'competition_id' => $competition['id'],
                    'start_number' => fake()->numberBetween(1, 100),
                    'result' => fake()->randomFloat(2, 0, 100),
                ]);
            }
        }
    }
}
