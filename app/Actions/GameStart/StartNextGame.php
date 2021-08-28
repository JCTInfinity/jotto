<?php

namespace App\Actions\GameStart;

use Lorisleiva\Actions\Concerns\AsAction;
use App\Models\Game;
use App\Models\Player;

class StartNextGame
{
    use AsAction;

    protected CreateGame $createGameAction;
    protected MakePlayer $makePlayerAction;

    public function __construct(CreateGame $createGameAction, MakePlayer $makePlayerAction)
    {
        $this->createGameAction = $createGameAction;
        $this->makePlayerAction = $makePlayerAction;
    }

    public function handle(Game $game, Player $player)
    {
        if ($player->game_id != $game->id) {
            throw new \BadMethodCallException('Player must belong to game');
        }

        $player1 = $this->makePlayerAction->handle($player->name);
        $player2 = $this->makePlayerAction->handle($game->opponent($player)->name);
        $nextGame = $this->createGameAction->handle($player1);
        $game->nextGame()->associate($nextGame)->save();
        $nextGame->players()->save($player2);
        return $nextGame;
    }
}
