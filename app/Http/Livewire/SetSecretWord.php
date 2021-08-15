<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Actions\SetPlayerWord;
use App\Actions\GetRandomWord;
use App\Models\Player;

class SetSecretWord extends Component
{
    public string $word = '';
    public Player $player;

    protected function rules()
    {
        return SetPlayerWord::make()->rules();
    }

    public function render()
    {
        return view('livewire.set-secret-word');
    }

    public function setWord()
    {
        $this->validate();

        SetPlayerWord::run($this->player, $this->word);

        $opponent = $this->player->opponent();
        if($opponent && $opponent->word) {
            $this->player->game->players()->first()
                ->update(['turn'=>true]);
        }

        $this->emitUp('refreshPlayers');
    }

    public function randomWord()
    {
        $this->word = GetRandomWord::run();
    }
}
