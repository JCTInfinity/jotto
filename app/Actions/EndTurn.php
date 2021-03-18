<?php

namespace App\Actions;

use App\Models\Player;
use Lorisleiva\Actions\Concerns\AsAction;

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
