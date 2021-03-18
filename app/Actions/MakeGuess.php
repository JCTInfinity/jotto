<?php

namespace App\Actions;

use App\Models\Player;
use Lorisleiva\Actions\Concerns\AsAction;

class MakeGuess
{
    use AsAction;

    const RULES = [
        'word'=>['required', 'string', 'size:5', 'alpha']
    ];

    public function handle(Player $player, string $word)
    {
        if(!$player->turn) throw new \Exception("It's not your turn");
        CountJots::run($player->guesses()->create(['word'=>strtoupper($word)]));
        NextTurn::run($player->game);
    }
}
