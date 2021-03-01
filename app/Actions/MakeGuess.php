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
        $guess = $player->guesses()->create(['word'=>strtoupper($word)]);
        if(CountJots::run($guess) !== 6) NextTurn::run($player->game);
    }
}
