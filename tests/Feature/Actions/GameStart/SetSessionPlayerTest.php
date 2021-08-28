<?php

namespace Tests\Feature\Actions\GameStart;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Player;
use App\Actions\GameStart\SetSessionPlayer;
use App\Models\Game;

class SetSessionPlayerTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_sets_session_player_id()
    {
        $game = Game::factory()
            ->has(Player::factory())
            ->create();
        $player = $game->players->first();
        SetSessionPlayer::run($player);
        $this->assertEquals($player->id, session('player@'.$game->code));
    }

    public function test_it_rejects_unsigned_request()
    {
        $game = Game::factory()
            ->has(Player::factory())
            ->create();
        $player = $game->players->first();

        $this->get(route('return-to-game', ['game'=>$game, 'player'=>$player]))
            ->assertForbidden();
    }

    public function test_it_sets_session_player_with_signed_request()
    {
        $game = Game::factory()
            ->has(Player::factory())
            ->create();
        $player = $game->players->first();

        SetSessionPlayer::partialMock()
            ->shouldReceive('handle')
            ->once();

        $this->get($player->url)
            ->assertRedirect($game->url);
    }
}
