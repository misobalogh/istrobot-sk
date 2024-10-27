<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Country;
use Database\Seeders\DatabaseSeeder;

use Illuminate\Foundation\Testing\RefreshDatabase;

class UserModelTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(DatabaseSeeder::class);
    }

    public function test_user_can_be_created()
    {
        $user = User::factory()->create([
            'country_code' => 'SK',
        ]);

        $this->assertDatabaseHas('users', [
            'email' => $user->email,
        ]);
    }

    public function test_user_can_be_deleted()
    {
        $user = User::factory()->create([
            'country_code' => 'SK',
        ]);

        $user->delete();

        $this->assertDatabaseMissing('users', [
            'email' => $user->email,
        ]);
    }

    
}
