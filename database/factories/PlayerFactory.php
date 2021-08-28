<?php

namespace Database\Factories;

use App\Models\Player;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Stringable;
use Illuminate\Support\Carbon;
use App\Models\Game;

class PlayerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Player::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->unique()->name,
            'code' => $this->faker->unique()->lexify('?????'),
            'game_id' => Game::factory(),
        ];
    }

    public function withWord()
    {
        return $this->state(fn($attributes) => [
            'word' => strtoupper($this->faker->lexify('?????')),
        ]);
    }
}
