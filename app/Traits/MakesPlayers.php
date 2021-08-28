<?php

namespace App\Traits;

use App\Actions\GameStart\GetSessionName;
use App\Actions\GameStart\MakePlayer;
use App\Actions\GameStart\SetSessionName;

trait MakesPlayers
{
    public string $name = '';

    public function getSessionName()
    {
        if(empty($this->name)) $this->name = GetSessionName::run();
    }

    public function playerRules()
    {
        return MakePlayer::make()->rules();
    }

    public function updatedName()
    {
        SetSessionName::run($this->name);
    }

    public function makePlayer()
    {
        return MakePlayer::run($this->name);
    }

}
