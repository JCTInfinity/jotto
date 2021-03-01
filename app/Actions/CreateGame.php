<?php

namespace App\Actions;

use App\Models\Game;
use App\Models\Player;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Lorisleiva\Actions\Concerns\AsAction;

/**
 * @method static Game run(Player $player)
 */
class CreateGame
{
    use AsAction;

    public function handle(Player $player): Game
    {
        if($player->exists) throw new \BadMethodCallException('Player already exists');
        $length = 4;
        $failures = 0;
        while(empty($game)){
            try {
                $game = DB::transaction(function()use($player,$length){
                    $game = Game::create(['code'=>strtolower(Str::random($length))]);
                    $game->players()->save($player);
                    SetSessionPlayer::run($player);
                    return $game;
                });
            } catch (\Throwable $e) {
                $failures++;
                if($failures > 10) throw $e;
                if($length < 10 && $failures % 3 === 0){
                    $length++;
                }
            }
        }
        return $game;
    }
}
