<?php

namespace App\Http\Livewire;

use App\Actions\AddPlayerTwo;
use App\Actions\GetSessionName;
use App\Actions\MakePlayer;
use App\Actions\SetSessionName;
use App\Actions\SetSessionPlayer;
use Livewire\Component;

class JoinGame extends Component
{
    public ?\App\Models\Game $game = null;
    public string $name = '';
    public string $word = '';

    public function mount()
    {
        if(empty($this->name)) $this->name = GetSessionName::run() ?? '';
    }

    protected function rules()
    {
        $rules = MakePlayer::RULES;
        if($this->game){
            array_push($rules['name'], 'not_in:'.$this->game->players->first()->name);
        }
        return $rules;
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
        if($propertyName === 'name'){
            SetSessionName::run($this->name);
        }
    }

    public function submit()
    {
        $this->validate();

        if($this->game){
            if($this->game->players->count() > 1){
                $this->addError('game full','This game already has 2 players');
                return;
            }
            AddPlayerTwo::run($this->game,MakePlayer::run($this->name,$this->word));
            $this->emit('refreshPlayers');
            return;
        } else {
            $game = \App\Actions\CreateGame::run(MakePlayer::run($this->name,$this->word));
            return redirect()->to($game->url);
        }
    }
}
