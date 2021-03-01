<?php

namespace App\Actions;

use App\Models\Game;
use Lorisleiva\Actions\Concerns\AsAction;

class GetGameBoard
{
    use AsAction;

    public function handle(Game $game)
    {
        return view('game',['game'=>$game]);
    }
}
