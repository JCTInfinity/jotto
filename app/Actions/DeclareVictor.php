<?php

namespace App\Actions;

use App\Models\Game;
use App\Models\Player;
use App\Notifications\GameEnded;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class DeclareVictor
{
    use AsAction;

    public function handle(Game $game)
    {
        $game->ended_at = now();
        $game->players->each(fn($player)=>$this->endGameForPlayer($player));
        DB::transaction(fn()=>$game->save() && $game->players->each->save());

        if($game->players
            ->map->latestGuess
            ->every->jotto) $draw = true;

        $game->players->each(fn(Player $player)=>$player->notify(
            new GameEnded($draw ? null : $player->latestGuess->jotto)
        ));
    }

    public function endGameForPlayer(Player $player)
    {
        $player->winner = $player->latestGuess->jotto;
        $player->turn = false;
        $player->code = null;
    }
}
