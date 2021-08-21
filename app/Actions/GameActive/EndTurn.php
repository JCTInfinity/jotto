<?php

namespace App\Actions\GameActive;

use App\Models\Player;
use Lorisleiva\Actions\Concerns\AsAction;
use App\Actions\GameEnd\DeclareVictor;
use App\Actions\GameActive\NextTurn;

class EndTurn
{
    use AsAction;

    public function handle(Player $player)
    {
        $game = $player->game;
        if($player->is($game->players->last())){
            $latestGuesses = $game->players->map->latestGuess;
            if($latestGuesses->some('jots',6)){
                DeclareVictor::run($game);
                return;
            }
        }
        NextTurn::run($player->game);
    }
}
