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

        \App\Models\Game::factory(500)->create();
        \App\Models\Player::factory(150)->create();
        \App\Models\Goal::factory(1500)->create();
        
        $this->call([
            TrophySeeder::class
        ]);

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
