<?php

namespace App\Actions;

use App\Models\Player;
use Lorisleiva\Actions\Concerns\AsAction;

class AuthorizePlayer
{
    use AsAction;

    public function handle(Player $player, string $word)
    {

    }
}
