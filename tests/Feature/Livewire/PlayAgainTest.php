<?php

namespace Tests\Feature\Livewire;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Livewire\Livewire;
use App\Http\Livewire\PlayAgain;
use App\Models\Game;
use App\Models\Player;
use App\Actions\GameStart\SetSessionPlayer;
use App\Actions\GameStart\StartNextGame;

class PlayAgainTest extends TestCase
{
    use RefreshDatabase;

    public function test_sets_initial_game_property()
    {
        $game = Game::factory()->create();
        Livewire::test(PlayAgain::class, ['game' => $game])
            ->assertSet('game', $game);
    }

    public function test_calls_start_next_game()
    {
        $game = Game::factory()
            ->has(Player::factory()->count(2))
            ->create();
        SetSessionPlayer::run($game->players->first());

        $nextGame = Game::factory()->make();

        StartNextGame::shouldRun()
            ->andReturn($nextGame);

        Livewire::test(PlayAgain::class, ['game' => $game])
            ->call('continueToNextGame')
            ->assertRedirect($nextGame->url);
    }

    public function test_redirects_to_next_game()
    {
        $game = Game::factory()
            ->has(Player::factory()->count(2))
            ->create();
        SetSessionPlayer::run($game->players->first());

        Livewire::test(PlayAgain::class, ['game' => $game])
            ->call('continueToNextGame')
            ->assertRedirect($game->fresh()->nextGame->url);
    }

    public function test_updates_button_text_when_other_player_starts_next_game()
    {
        $game = Game::factory()
            ->has(Player::factory()->count(2))
            ->create();
        $gameClone = $game->fresh();
        $this->assertTrue($gameClone->is($game));
        $this->assertFalse($gameClone === $game);

        SetSessionPlayer::run($game->players->first());
        Livewire::test(PlayAgain::class, ['game' => $gameClone])
            ->call('continueToNextGame');
        SetSessionPlayer::run($game->players->last());
        Livewire::test(PlayAgain::class, ['game' => $game])
            ->call('update')
            ->assertSet('otherPlayerContinued', true)
            ->assertSee('(Your opponent has continued)');
    }
}
