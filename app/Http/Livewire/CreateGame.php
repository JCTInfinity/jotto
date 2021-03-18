<?php

namespace App\Http\Livewire;

use App\Actions\AddPlayerTwo;
use App\Actions\GetSessionName;
use App\Actions\MakePlayer;
use App\Actions\SetSessionName;
use App\Actions\SetSessionPlayer;
use App\Actions\ValidateWord;
use App\Traits\MakesPlayers;
use Livewire\Component;

class CreateGame extends Component
{
    use MakesPlayers;

    public function mount()
    {
        $this->getSessionName();
    }

    protected function rules()
    {
        return $this->playerRules();
    }

    public function render()
    {
        return view('livewire.create-game');
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function submit()
    {
        $this->validate();

        $game = \App\Actions\CreateGame::run($this->makePlayer());
        return redirect()->to($game->url);
    }
}
