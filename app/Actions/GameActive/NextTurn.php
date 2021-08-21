<?php

namespace App\Actions\GameActive;

use App\Models\Game;
use App\Models\Player;
use App\Notifications\YourTurn;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class NextTurn
{
    use AsAction;

    public function handle(Game $game)
    {
        if($game->players->count() < 2) throw new \BadMethodCallException('Game is not ready');
        $currentPlayer = $game->players->firstWhere('turn',true)
            ?? $game->players->first();
        DB::transaction(fn()=>$this->togglePlayers($currentPlayer,$game->opponent($currentPlayer)));
    }

    public function togglePlayers(Player $currentPlayer, Player $opponent)
    {
        $currentPlayer->update(['turn'=>false]);
        $opponent->update(['turn'=>true]);
        $opponent->notify(new YourTurn());
    }
}
