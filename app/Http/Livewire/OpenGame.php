<?php

namespace App\Http\Livewire;

use App\Actions\GameActive\GetGameBoard;
use Livewire\Component;

class OpenGame extends Component
{
    public string $code = '';

    protected function rules(){
        return [
            'code'=>['required','string','size:'.config('jotto.codes.game.length'),'exists:games,code'],
        ];
    }

    public function render()
    {
        return view('livewire.open-game');
    }

    public function submit()
    {
        ['code'=>$code] = $this->validate();
        return redirect()->route('game',['game'=>strtolower($code)]);
    }
}
