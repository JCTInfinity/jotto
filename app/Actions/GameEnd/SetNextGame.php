<?php

namespace App\Actions\GameEnd;

use Lorisleiva\Actions\Concerns\AsAction;
use App\Models\Game;

class SetNextGame
{
    use AsAction;

    public function handle(Game $game, Game $nextGame)
    {
        $game->update(['next_game_id' => $nextGame->id]);
    }
}
