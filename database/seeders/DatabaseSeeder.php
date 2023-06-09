<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
        ]);

        \App\Models\User::factory(10)->create();
        \App\Models\Team::factory(50)->create();

        $this->call([
            SeasonSeeder::class
        ]);

        \App\Models\Player::factory(150)->create();
        
        $this->call([
            TrophySeeder::class
        ]);

        \App\Models\Team_Trophy::factory(20)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
