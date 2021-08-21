<?php

namespace App\Actions\GameStart;

use App\Models\Game;
use App\Models\Player;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Lorisleiva\Actions\Concerns\AsAction;
use App\Actions\Meta\GetCode;
use App\Actions\GameStart\SetSessionPlayer;

/**
 * @method static Game run(Player $player)
 */
class CreateGame
{
    use AsAction;

    public function handle(Player $player): Game
    {
        if($player->exists) throw new \BadMethodCallException('Player already exists');
        $failures = 0;
        while(empty($game)){
            try {
                $game = DB::transaction(function()use($player){
                    $game = Game::create(['code'=>GetCode::run('game')]);
                    $game->players()->save($player);
                    SetSessionPlayer::run($player);
                    return $game;
                });
            } catch (\Throwable $e) {
                if(++$failures > 10) throw $e;
            }
        }
        return $game;
    }
}
