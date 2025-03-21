<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        User::truncate();

        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@testing.com',
            'password' => bcrypt('password'),
        ]);
    }
}
