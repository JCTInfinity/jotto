<?php

namespace App\Actions;

use App\Models\Word;
use Illuminate\Console\Command;
use Lorisleiva\Actions\Concerns\AsAction;

class DefineWord
{
    use AsAction;

    public string $commandSignature = 'define:word {word}';

    public function asCommand(Command $command)
    {
        $word = $this->handle($command->argument('word'));
            $command->{$word->valid ? 'info' : 'warn'}(json_encode($word->api_response,JSON_PRETTY_PRINT));
    }

    public function handle(string $word): ?Word
    {
        ValidateWord::run($word);
        return Word::firstWhere('word',$word);
    }
}
