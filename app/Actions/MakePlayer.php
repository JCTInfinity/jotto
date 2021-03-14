<?php

namespace App\Actions;

use App\Models\Player;
use App\Rules\DictionaryWord;
use Lorisleiva\Actions\Concerns\AsAction;

/**
 * @method static Player run(string $name, string $word)
 */
class MakePlayer
{
    use AsAction;

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'alpha_dash'],
            'word' => ['required', 'string', 'size:5', 'alpha', new DictionaryWord()],
        ];
    }

    public function handle($name, $word)
    {
        return new Player([
            'name'=>$name,
            'word'=>strtoupper($word),
            'code'=>GetCode::run('player')
        ]);
    }
}
