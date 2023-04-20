<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Goal>
 */
class GoalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'team_id' => rand(1,50),
            'game_id' => rand(1,500),
            'player_id' => rand(1,150),
            'zone' => rand(1,9),
            'player_nº' => rand(1,13)
        ];
    }
}
