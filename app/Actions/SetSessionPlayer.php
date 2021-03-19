<?php

namespace App\Actions;

use App\Models\Game;
use App\Models\Player;
use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;

/**
 * @method static run(Player $player)
 */
class SetSessionPlayer
{
    use AsAction;

    public function handle(Player $player)
    {
        session(['player@'.$player->game->code=>$player->id]);
    }

    public function asController(Request $request, Game $game, Player $player)
    {
        if(!$request->hasValidSignature()) abort(403);
        $this->handle($player);
        return redirect()->route('game',['game'=>$game->code]);
    }
}
