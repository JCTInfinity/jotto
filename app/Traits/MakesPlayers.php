<?php

namespace App\Traits;

use App\Actions\GetRandomWord;
use App\Actions\GetSessionName;
use App\Actions\MakePlayer;
use App\Actions\SetSessionName;
use App\Models\Word;

trait MakesPlayers
{
    public string $name = '';
    public string $word = '';

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
        return MakePlayer::run($this->name,$this->word);
    }

    public function randomWord()
    {
        $this->word = GetRandomWord::run();
    }
}
