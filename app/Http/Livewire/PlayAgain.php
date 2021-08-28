<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Actions\GameActive\GetSessionPlayer;
use App\Actions\GameStart\StartNextGame;
use Illuminate\Http\Response;
use App\Actions\GameStart\SetSessionPlayer;

class PlayAgain extends Component
{
    public \App\Models\Game $game;
    public $updated = false;

    public function render()
    {
        return view('livewire.play-again');
    }

    public function mount()
    {
        $this->update();
    }

    public function update()
    {
        $this->game->refresh();
    }

    public function getOtherPlayerContinuedProperty()
    {
        if (! $this->game->nextGame) {
            return false;
        } else {
            $nextGamePlayer = GetSessionPlayer::run($this->game->nextGame);
            $nextGameOpponent = $nextGamePlayer ?
                $this->game->nextGame->opponent($nextGamePlayer)
                : $this->game->nextGame->players->first();
            return !$nextGameOpponent->active_at;
        }
    }

    public function continueToNextGame()
    {
        $player = GetSessionPlayer::run($this->game);
        if (! $player) {
            abort(Response::HTTP_FORBIDDEN);
        }

        $nextGame = $this->game->fresh()->nextGame;
        if (! $nextGame) {
            $nextGame = StartNextGame::run($this->game, $player);
        } else {
            $nextGamePlayer = GetSessionPlayer::run($nextGame);
            if (! $nextGamePlayer) {
                $nextGamePlayer = $nextGame->players->last();
                SetSessionPlayer::run($nextGamePlayer);
            }
        }
        return redirect()->to($nextGame->url);
    }
}
