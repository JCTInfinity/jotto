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
        DB::transaction(function()use($player){
            $player->game->ended_at = now();
            $player->winner = true;
            $player->turn = false;
            $opponent = $player->opponent();
            $opponent->winner = false;
            $opponent->turn = false;
            $player->game->save() && $player->save() && $opponent->save();
        });
    }
}
