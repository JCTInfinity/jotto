<?php

namespace Tests\Feature\Actions\GameStart;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Player;
use App\Actions\GameStart\CreateGame;
use App\Models\Game;
use App\Actions\Meta\GetCode;
use Illuminate\Database\QueryException;
use App\Actions\GameStart\SetSessionPlayer;

class CreateGameTest extends TestCase
{
    use RefreshDatabase;

    public function test_rejects_existing_player()
    {
        $player = Player::factory()->create();
        $this->expectException(\BadMethodCallException::class);
        CreateGame::run($player);
    }

    public function test_throws_errors_if_it_cant_get_a_code()
    {
        $existingGame = Game::factory()->create();
        GetCode::shouldRun()
            ->andReturn($existingGame->code);
        $player = Player::factory()->make();
        $this->expectException(QueryException::class);
        CreateGame::run($player);
    }

    public function test_it_creates_game_and_sets_session_player()
    {
        $player = Player::factory()->make();
        SetSessionPlayer::shouldRun()->once();
        $game = CreateGame::run($player);
        $this->assertInstanceOf(Game::class, $game);
        $this->assertTrue($game->exists());
        $this->assertTrue($player->exists());
    }
}
