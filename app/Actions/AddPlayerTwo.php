<?php

namespace App\Actions;

use App\Models\Game;
use App\Models\Player;
use Illuminate\Support\Arr;
use Lorisleiva\Actions\Concerns\AsAction;

class AddPlayerTwo
{
    use AsAction;

    public function handle(Game $game, Player $player)
    {
        if($player->exists) throw new \BadMethodCallException('Player already exists');
        $game->players()->save($player);
        SetSessionPlayer::run($player);
        $game->players->random()->update(['turn'=>true]);
    }
}
