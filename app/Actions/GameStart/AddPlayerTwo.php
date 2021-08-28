<?php

namespace App\Actions\GameStart;

use App\Models\Game;
use App\Models\Player;
use Illuminate\Support\Arr;
use Lorisleiva\Actions\Concerns\AsAction;
use App\Actions\GameStart\SetSessionPlayer;

class AddPlayerTwo
{
    use AsAction;

    public function handle(Game $game, Player $player)
    {
        if($player->exists) throw new \BadMethodCallException('Player already exists');
        $game->players()->save($player);
        SetSessionPlayer::run($player);
    }
}