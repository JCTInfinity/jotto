<?php

namespace App\Actions;

use App\Models\Game;
use Lorisleiva\Actions\Concerns\AsAction;

class RemoveSessionPlayer
{
    use AsAction;

    public function handle(Game $game)
    {
        session()->forget('player@'.$game->code);
    }
}
