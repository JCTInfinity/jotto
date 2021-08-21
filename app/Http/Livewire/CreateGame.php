<?php

namespace App\Http\Livewire;

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

        $game = \App\Actions\GameStart\CreateGame::run($this->makePlayer());
        return redirect()->to($game->url);
    }
}
