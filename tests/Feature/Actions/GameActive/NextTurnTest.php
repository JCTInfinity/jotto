<?php

namespace Tests\Feature\Actions\GameActive;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Game;
use App\Models\Player;
use App\Actions\GameStart\SetPlayerWord;
use App\Actions\GameActive\NextTurn;

class NextTurnTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function test_it_fails_when_a_player_doesnt_have_a_word()
    {
        $player1 = Player::factory()->withWord()->create();
        $player2 = Player::factory()->create(['game_id' => $player1->game_id]);

        $this->expectException(\BadMethodCallException::class);
        NextTurn::run($player1->game);
        $this->assertDatabaseHas($player1->getTable(), ['id'=>$player1->id, 'turn'=>false]);
        $this->assertDatabaseHas($player1->getTable(), ['id'=>$player2->id, 'turn'=>false]);
    }
}
