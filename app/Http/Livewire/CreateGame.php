<?php

namespace App\Http\Livewire;

use App\Actions\AddPlayerTwo;
use App\Actions\GetSessionName;
use App\Actions\MakePlayer;
use App\Actions\SetSessionName;
use App\Actions\SetSessionPlayer;
use Livewire\Component;

class CreateGame extends Component
{
    public string $name = '';
    public string $word = '';

    public function mount()
    {
        if(empty($this->name)) $this->name = GetSessionName::run() ?? '';
    }

    protected $rules = MakePlayer::RULES;

    public function render()
    {
        return view('livewire.create-game');
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

        $game = \App\Actions\CreateGame::run(MakePlayer::run($this->name,$this->word));
        return redirect()->to($game->url);
    }
}
