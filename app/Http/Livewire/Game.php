<?php

namespace App\Http\Livewire;

use App\Actions\GetSessionPlayer;
use App\Actions\MakeGuess;
use App\Actions\RemoveSessionPlayer;
use App\Models\Player;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Livewire\Component;
use App\Models\Game as GameModel;

class Game extends Component
{
    public GameModel $game;
    public ?Player $player;
    public ?Player $player1;
    public ?Player $player2;
    public ?string $guessWord = '';
    public string $title;


    protected function rules()
    {
        return [
            'guessWord'=>MakeGuess::make()->rules()['word'],
        ];
    }

    protected $listeners = ['refreshPlayers'];

    public function mount()
    {
        $this->refreshPlayers();
    }

    public function refreshPlayers()
    {
        $this->game->refresh();
        $this->player = GetSessionPlayer::run($this->game);
        $this->player1 = $this->game->players->first();
        $this->player2 = $this->player1 ? $this->game->opponent($this->player1) : null;
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
        if($this->player){
            $this->player->activity();
            $unreadNotification = $this->player->unreadNotifications()->first();
            if($unreadNotification){
                $this->dispatchBrowserEvent('notification',[
                    'id'=>$unreadNotification->id,
                    'body'=>$unreadNotification->data['body'] ??
                        Str::afterLast($unreadNotification->type,'\\'),
                ]);
            }
        }
    }

    public function readNotifications($before)
    {
        if($this->player){
            $beforeTimestamp = $this->player->notifications()->find($before)->created_at;
            $this->player->unreadNotifications()
                ->where('created_at','<=',$beforeTimestamp)
                ->get()
                ->each(function(DatabaseNotification $n) {
                    $n->markAsRead();
                    $n->save();
                });
        }
    }

    public function disconnectPlayer()
    {
        RemoveSessionPlayer::run($this->game);
        $this->refreshPlayers();
    }
}
