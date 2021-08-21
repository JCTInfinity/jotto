<?php

namespace App\Actions\GameStart;

use App\Models\Player;
use App\Rules\DictionaryWord;
use Lorisleiva\Actions\Concerns\AsAction;
use App\Actions\Meta\GetCode;

/**
 * @method static Player run(string $name)
 */
class MakePlayer
{
    use AsAction;

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'alpha_dash'],
        ];
    }

    public function handle($name)
    {
        return new Player([
            'name'=>$name,
            'code'=>GetCode::run('player')
        ]);
    }
}
