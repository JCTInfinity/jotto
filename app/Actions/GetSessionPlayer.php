<?php

namespace App\Actions;

use App\Models\Game;
use App\Models\Player;
use Lorisleiva\Actions\Concerns\AsAction;

/**
 * @method static Player|null run(Game $game)
 */
class GetSessionPlayer
{
    use AsAction;

    public function handle(Game $game)
    {
        $playerId = session('player@'.$game->code);
        if($playerId){
            return $game->players->find($playerId);
        }
        return null;
    }
}
