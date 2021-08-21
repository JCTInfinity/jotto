<?php

namespace App\Actions\GameEnd;

use App\Models\Game;
use App\Models\Player;
use App\Notifications\GameEnded;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;
use function now;

class DeclareVictor
{
    use AsAction;

    public function handle(Game $game)
    {
        $game->ended_at = now();
        $game->players->each(fn($player)=>$this->endGameForPlayer($player));
        DB::transaction(fn()=>$game->save() && $game->players->each->save());

        $draw = $game->players
            ->map->latestGuess
            ->every->jotto;

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
