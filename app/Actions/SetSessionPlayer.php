<?php

namespace App\Actions;

use App\Models\Player;
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
}
