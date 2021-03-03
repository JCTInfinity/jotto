<?php

namespace App\Actions;

use App\Models\Player;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class DeclareVictor
{
    use AsAction;

    public function handle(Player $player)
    {
        $player->game->ended_at = now();
        $this->endGameForPlayer($player, true);
        $this->endGameForPlayer($opponent = $player->opponent(), false);
        DB::transaction(fn()=>$player->game->save() && $player->save() && $opponent->save());
    }

    public function endGameForPlayer(Player $player, bool $winner)
    {
        $player->winner = $winner;
        $player->turn = false;
        $player->code = null;
    }
}
