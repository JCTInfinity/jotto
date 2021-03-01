<?php

namespace App\Http\Livewire;

use App\Actions\GetSessionPlayer;
use App\Actions\MakeGuess;
use App\Models\Player;
use Livewire\Component;
use App\Models\Game as GameModel;

class Game extends Component
{
    public GameModel $game;
    public ?Player $player;
    public ?Player $player1;
    public ?Player $opponent;
    public ?string $guessWord = '';

    protected $rules = [
        'guessWord'=>MakeGuess::RULES['word'],
    ];

    protected $listeners = ['refreshPlayers'];

    public function mount()
    {
        $this->refreshPlayers();
    }

    public function refreshPlayers()
    {
        $this->player1 = $this->player = GetSessionPlayer::run($this->game);
        if(empty($this->player1)){
            $this->player1 = $this->game->players->first();
        }
        $this->opponent = $this->game->opponent($this->player1);
    }

    public function render()
    {
        return view('livewire.game');
    }

    public function guess()
    {
        $this->validateOnly('guessWord');
        MakeGuess::dispatch($this->player,$this->guessWord);
        $this->reset('guessWord');
    }

    public function attend()
    {
        if(empty($this->opponent)) $this->refreshPlayers();
        elseif(!$this->game->guesses->every->hasJots){
            $this->game->refresh();
            $this->game->load('guesses');
        }
    }
}
