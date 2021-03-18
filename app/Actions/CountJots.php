<?php

namespace App\Actions;

use Lorisleiva\Actions\Concerns\AsAction;

class CountJots
{
    use AsAction;

    public function handle(\App\Models\Guess $guess)
    {
        $opponentWord = $guess->player->opponent()->word;
        if($guess->word->exactly((string)$opponentWord)){
            $jots = 6;
        } else {
            $jots = $guess->word->comparableLetters()
                ->intersect($opponentWord->comparableLetters())
                ->count();
        }
        $guess->update(['jots'=>$jots]);
        return $jots;
    }
}
