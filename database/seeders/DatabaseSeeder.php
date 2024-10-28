<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Country;
use App\Models\User;
use App\Models\Admin;
use App\Models\Robot;
use App\Models\Category;
use App\Models\Competition;
use App\Models\CompetitionCategory;
use App\Models\Participation;
use App\Models\Technology;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(CountrySeeder::class);
        $this->call(TechnologySeeder::class);

        $countries = Country::all();
        $slovakia = $countries->where('country_code', 'SK')->first();

        $this->callWith(AdminSeeder::class, ['countryCode' => $slovakia->country_code]);
        $adminUser = User::find(1);
        $admin = Admin::find(1);

        $this->callWith(CompetitionSeeder::class, ['adminID' => $admin->id]);

        User::factory()->count(20)->create()->each(function ($user) use ($countries) {
            $user->country_code = $countries->random()->country_code;
            $user->save();
        });

        // Create robot
        $superBot = Robot::create([
            'name' => 'SuperBot',
            'coauthors' => 'Marek Vasko',
            'processor' => 'ARM Cortex-A',
            'memory_size' => 1024,
            'frequency' => 2000,
            'sensors' => 'Camera',
            'drive' => 'Wheels',
            'power_supply' => 'Battery',
            'programming_language' => 'C++',
            'interesting_facts' => 'Interesting',
            'website' => 'https://www.superbot.com',
            'description' => 'Description',
            'user_id' => User::inRandomOrder()->first()->id,
            'technology_id' => Technology::where('name', 'Lego')->first()->id,
        ]);

        // Create 10 random robots
        Robot::factory()->count(10)->create()->each(function ($robot) use ($countries) {
            $robot->user_id = User::inRandomOrder()->first()->id;
            $robot->technology_id = rand(1, 4);
            $robot->save();
        });

        // Create Category
        $lineFollower = Category::factory()->withAdmin($admin)->create([
            'name_SK' => 'Stopar',
            'name_EN' => 'Linefollower',
            'type_of_evaluation' => 'time',
        ]);

        $istrobot2024 = Competition::factory()->withAdmin($admin)->create([
            'name' => 'Istrobot 2024',
            'year' => 2024,
        ]);

        Participation::create([
            'robot_id' => $superBot->id,
            'category_id' => $lineFollower->id,
            'competition_id' => $istrobot2024->id,
            'start_number' => 77,
            'result' => 123.45,
        ]);

        Participation::factory()->count(10)->create([
            'category_id' => Category::factory()->withAdmin($admin)->create()->id,
            'competition_id' => Competition::factory()->withAdmin($admin)->create()->id,
        ]);

        $competitions = Competition::all();
        $categories = Category::all();

        foreach ($competitions as $competition) {
            $randomCategories = $categories->random(rand(1, $categories->count()))->unique();

            foreach ($randomCategories as $category) {
                CompetitionCategory::create([
                    'competition_id' => $competition->id,
                    'category_id' => $category->id,
                ]);
            }
        }
    }
}
