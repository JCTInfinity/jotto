<?php

namespace App\Actions;

use App\Models\Guess;
use App\Models\Word;
use Lorisleiva\Actions\Concerns\AsAction;

class ValidateOldGuessWords
{
    use AsAction;

    public string $commandSignature = 'jotto:guess-cleanup';

    public function handle()
    {
        foreach(Word::cursor() as $word){
            $word->update(['word'=>strtoupper($word->word)]);
        }
        foreach(Guess::cursor() as $guess){
            $guess->update(['word'=>strtoupper($guess->word)]);
            ValidateWord::run($guess->word);
        }
    }
}
