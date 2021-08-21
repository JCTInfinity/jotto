<?php

namespace App\Actions\GameActive;

use App\Models\Game;
use Lorisleiva\Actions\Concerns\AsAction;
use function session;

class RemoveSessionPlayer
{
    use AsAction;

    public function handle(Game $game)
    {
        session()->forget('player@'.$game->code);
    }
}
