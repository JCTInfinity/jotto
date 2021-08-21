<?php

namespace App\Actions\GameActive;

use App\Models\Game;
use Lorisleiva\Actions\Concerns\AsAction;
use function view;

class GetGameBoard
{
    use AsAction;

    public function handle(Game $game)
    {
        return view('game',['game'=>$game]);
    }
}
