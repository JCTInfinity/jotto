<?php

namespace Tests\Feature\Actions\GameStart;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Game;
use App\Models\Player;
use App\Actions\GameStart\StartNextGame;

class StartNextGameTest extends TestCase
{
    use RefreshDatabase;

    public function test_player_belongs_to_game()
    {
        $game = Game::factory()->create();
        $player = Player::factory()->create();
        $this->expectException(\BadMethodCallException::class);
        StartNextGame::run($game, $player);
    }

    public function test_returns_next_game_with_players()
    {
        $game = Game::factory()
            ->has(Player::factory()->count(2))
            ->create();
        $firstPlayer = $game->players->first();
        $this->assertEquals($game->id, $firstPlayer->game_id);
        $nextGame = StartNextGame::run($game, $firstPlayer);
        $this->assertTrue($nextGame->is($game->nextGame));
    }
}
