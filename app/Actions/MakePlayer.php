<?php

namespace App\Actions;

use App\Models\Player;
use Lorisleiva\Actions\Concerns\AsAction;

/**
 * @method static Player run(string $name, string $word)
 */
class MakePlayer
{
    use AsAction;

    const RULES = [
        'name' => ['required', 'string', 'alpha_dash'],
        'word' => ['required', 'string', 'size:5', 'alpha'],
    ];

    public function rules(): array
    {
        return self::RULES;
    }

    public function handle($name, $word)
    {
        return new Player(['name'=>$name,'word'=>strtoupper($word)]);
    }
}
