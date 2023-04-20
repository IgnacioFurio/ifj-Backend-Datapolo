<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Team_Trophy>
 */
class Team_TrophyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'season_id' => rand(1,4),
            'trophy_id' => rand(1,11),
            'team_id' => rand(1,50)
        ];
    }
}
