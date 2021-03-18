<?php

namespace App\Http\Livewire;

use App\Actions\AddPlayerTwo;
use App\Actions\GetSessionName;
use App\Actions\MakePlayer;
use App\Actions\SetSessionName;
use App\Actions\SetSessionPlayer;
use App\Traits\MakesPlayers;
use Livewire\Component;

class JoinGame extends Component
{
    use MakesPlayers;
    public \App\Models\Game $game;
    public string $name = '';
    public string $word = '';

    public function mount()
    {
        $this->getSessionName();
    }

    protected function rules()
    {
        return array_merge_recursive(
            $this->playerRules(),
            ['name'=>'not_in:'.$this->game->players->first()->name]
        );
    }

    protected $messages = [
        'name.not_in' => 'You cannot have the same name as your opponent.',
    ];

    public function render()
    {
        return view('livewire.join-game');
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function submit()
    {
        $this->validate();

        if($this->game->players->count() > 1){
            $this->addError('game full','This game already has 2 players');
        } else {
            AddPlayerTwo::run($this->game,$this->makePlayer());
            $this->emit('refreshPlayers');
        }
    }
}
