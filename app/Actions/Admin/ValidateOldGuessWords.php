<?php

namespace App\Actions\Admin;

use App\Models\Guess;
use App\Models\Word;
use Lorisleiva\Actions\Concerns\AsAction;
use Illuminate\Console\Command;
use App\Actions\ValidateWord;

class ValidateOldGuessWords
{
    use AsAction;

    public string $commandSignature = 'jotto:guess-cleanup';

    protected Command $command;

    public function consoleInfo($string)
    {
        if (isset($this->command)) {
            $this->command->info($string);
        }
    }

    public function handle()
    {
        foreach(Word::cursor() as $word){
            $ucWord = strtoupper($word->word);
            if ($ucWord !== $word->word) {
                $this->consoleInfo('Capitalizing word '.$word->word);
                $word->update(['word'=>$ucWord]);
            }
        }
        /** @var Guess $guess */
        foreach(Guess::cursor() as $guess){
            $ucGuess = $guess->word->upper();
            if (!$ucGuess->is($guess->word)) {
                $this->consoleInfo('Capitalizing guess '.$guess->word);
                $guess->update(['word'=>$ucGuess]);
            }
            ValidateWord::run($guess->word);
        }
    }

    public function asCommand(Command $command)
    {
        $this->command = $command;
        $this->handle();
    }
}
