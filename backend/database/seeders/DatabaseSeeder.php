<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        /*
        * Create multiple test users for later testing.
        * The password is the same for all test users.
        */

        $password = config('seeding.test-users-password');

        User::factory()->create([
            'name' => 'Test User 1',
            'email' => 'test1@example.com',
            'password' => bcrypt($password)
        ]);

        User::factory()->create([
            'name' => 'Test User 2',
            'email' => 'test2@example.com',
            'password' => bcrypt($password)
        ]);

        User::factory()->create([
            'name' => 'Test User 3',
            'email' => 'test3@example.com',
            'password' => bcrypt($password)
        ]);
    }
}
