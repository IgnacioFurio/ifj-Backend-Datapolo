<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Process\FakeProcessResult;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Game>
 */
class GameFactory extends Factory
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
            'my_team_id' => rand(1,50),
            'my_rival_id' => rand(1,50),
            'locale' => fake()->boolean(),
            'friendly' => fake()->boolean()
        ];
    }
}
