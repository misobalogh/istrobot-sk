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
        // Create Slovakia
        Country::create([
            'country_code' => 'SK',
            'name_SK' => 'Slovensko',
            'name_EN' => 'Slovakia',
        ]);

        // Create 10 random countries
        $countries = Country::factory()->count(10)->create();

        // Create main user
        $testUser = User::create([
            'first_name' => 'Michal',
            'last_name' => 'Balogh',
            'email' => 'baloghmichal03@gmail.com',
            'password' => bcrypt('strong_password'),
            'birth_date' => '2003-04-12',
            'school' => 'VUT FIT',
            'city' => 'Bratislava',
            'country_code' => 'SK',
        ]);


        // Create 20 random users with random country
        User::factory()->count(20)->create()->each(function ($user) use ($countries) {
            $user->country_code = $countries->random()->country_code;
            $user->save();
        });

        // Create Admin
        Admin::create([
            'user_id' => $testUser->id,
        ]);

        $technologies = [
            'Lego',
            'Arduino',
            'Raspberry Pi',
            'ESP32',
        ];

        foreach ($technologies as $technology) {
            Technology::create(['name' => $technology]);
        }

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
            'user_id' => $testUser->id,
            'technology_id' => Technology::where('name', 'Arduino')->first()->id,
        ]);

        // Create 10 random robots
        Robot::factory()->count(10)->create()->each(function ($robot) use ($countries) {
            $robot->user_id = User::inRandomOrder()->first()->id;
            $robot->technology_id = rand(1,4);
            $robot->save();
        });

        // Create Category
        $lineFollower = Category::create([
            'name_SK' => 'Stopar',
            'name_EN' => 'Linefollower',
            'type_of_evaluation' => 'time',
            'admin_id' => 1,
        ]);

        $istrobot2024 = Competition::create([
            'name' => 'Istrobot 2024',
            'year' => '2024',
            'admin_id' => 1,
        ]);

        $compCateg = CompetitionCategory::create([
            'competition_id' => $istrobot2024->id,
            'category_id' => $lineFollower->id,
        ]);

        Participation::create([
            'robot_id' => $superBot->id,
            'category_id' => $lineFollower->id,
            'competition_id' => $istrobot2024->id,
            'start_number' => 77,
            'result' => 123.45,
        ]);

        Participation::factory()->count(10)->create();
    }
}
