<?php

namespace App\Actions\GameStart;

use App\Models\Game;
use App\Models\Player;
use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;
use function redirect;
use function session;
use function abort;
use Illuminate\Http\Response;

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
        if(!$request->hasValidSignature()) abort(Response::HTTP_FORBIDDEN);
        $this->handle($player);
        return redirect()->route('game',['game'=>$game->code]);
    }
}
