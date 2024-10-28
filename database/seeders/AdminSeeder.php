<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Admin;
class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(string $countryCode): void
    {
        $adminUser = User::create([
            'first_name' => 'Admin',
            'last_name' => 'Adminovic',
            'email' => 'admin@gmail.com',
            'password' => 'admin123',
            'birth_date' => '2000-01-01',
            'school' => 'FEI',
            'city' => 'Bratislava',
            'country_code' => $countryCode,
        ]);

        Admin::create([
            'user_id' => $adminUser->id,
        ]);
    }
}
